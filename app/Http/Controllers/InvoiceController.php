<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Services\InvoiceService;
use App\Models\Item;
use Inertia\Inertia;
use App\Models\Buyer;
use Inertia\Response;
use App\Models\Seller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use LaravelDaily\Invoices\Classes\Party;
use App\Http\Requests\InvoiceCreateRequest;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice as CreateInvoice;

class InvoiceController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = ['Paid', 'Pending'];
    }

    public function index(): Response {
        $invoices = Invoice::with('seller', 'buyer', 'item')->get();
        return Inertia::render('Invoices/Index', [
            'invoices' => $invoices,
        ]);
    }

    public function create(): Response {
        return Inertia::render('Invoices/Partials/Create', [
            'status' => $this->status,
        ]);
    }


    public function submit(InvoiceCreateRequest $request): RedirectResponse {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            // Create Seller
            $sellerData = [
                'name' => $validatedData['seller_name'],
                'phone' => $validatedData['seller_phone'],
                'address' => $validatedData['seller_address'],
                'business_id' => $validatedData['seller_business_id'] ?? null,
                'code' => $validatedData['seller_code'] ?? null,
            ];
            $seller = Seller::create($sellerData);

            // Create Buyer
            $buyerData = [
                'name' => $validatedData['buyer_name'],
                'phone' => $validatedData['buyer_phone'],
                'address' => $validatedData['buyer_address'],
                'business_id' => $validatedData['buyer_business_id'] ?? null,
                'code' => $validatedData['buyer_code'] ?? null,
            ];
            $buyer = Buyer::create($buyerData);

            // Create Invoice
            $invoiceData = [
                'serial_no' => $validatedData['serial_no'],
                'invoice_date' => $validatedData['invoice_date'],
                'order_number' => $validatedData['order_number'] ?? null,
                'currency' => $validatedData['currency'],
                'notes' => $validatedData['notes'] ?? null,
                'due_date' => $validatedData['due_date'],
                'status' => $validatedData['status'],
                'sellers_id' => $seller->id,
                'buyers_id' => $buyer->id,
            ];
            $invoice = Invoice::create($invoiceData);

            // Create Items
            $itemsData = array_map(function ($item) use ($invoice) {
                // Calculate the subtotal
                $subTotal = $item['price'] * $item['quantity'];
                if (isset($item['discount']) && $item['discount']) {
                    $subTotal -= $item['discount'];
                }

                return [
                    'name' => $item['name'],
                    'description' => $item['description'] ?? null,
                    'unit' => $item['unit'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'] ?? null,
                    'invoices_id' => $invoice->id,
                    'sub_total' => $subTotal,
                ];
            }, $validatedData['items']);
            Item::insert($itemsData);

            // Commit the transaction
            DB::commit();

            // Create pdf
            $client = new Party([
                'name'          => $seller->name,
                'phone'         => $seller->phone,
                'address'         => $seller->address,
                'custom_fields' => [
                    'code'        => $seller->code,
                    'business id' => $seller->business_id,
                ],
            ]);

            $customer = new Party([
                'name'          => $buyer->name,
                'phone'         => $buyer->phone,
                'address'         => $buyer->address,
                'custom_fields' => [
                    'code'        => $buyer->code,
                    'business id' => $buyer->business_id,
                ],
            ]);

            $items = [
                InvoiceItem::make('Service 1')
                    ->description('Your product or service description')
                    ->pricePerUnit(47.79)
                    ->quantity(2)
                    ->discount(10),
                InvoiceItem::make('Service 2')->pricePerUnit(71.96)->quantity(2),
                InvoiceItem::make('Service 3')->pricePerUnit(4.56),
                InvoiceItem::make('Service 4')->pricePerUnit(87.51)->quantity(7)->discount(4)->units('kg'),
                InvoiceItem::make('Service 5')->pricePerUnit(71.09)->quantity(7)->discountByPercent(9),
                InvoiceItem::make('Service 6')->pricePerUnit(76.32)->quantity(9),
                InvoiceItem::make('Service 7')->pricePerUnit(58.18)->quantity(3)->discount(3),
                InvoiceItem::make('Service 8')->pricePerUnit(42.99)->quantity(4)->discountByPercent(3),
                InvoiceItem::make('Service 9')->pricePerUnit(33.24)->quantity(6)->units('m2'),
                InvoiceItem::make('Service 11')->pricePerUnit(97.45)->quantity(2),
                InvoiceItem::make('Service 12')->pricePerUnit(92.82),
                InvoiceItem::make('Service 13')->pricePerUnit(12.98),
                InvoiceItem::make('Service 14')->pricePerUnit(160)->units('hours'),
                InvoiceItem::make('Service 15')->pricePerUnit(62.21)->discountByPercent(5),
                InvoiceItem::make('Service 16')->pricePerUnit(2.80),
                InvoiceItem::make('Service 17')->pricePerUnit(56.21),
                InvoiceItem::make('Service 18')->pricePerUnit(66.81)->discountByPercent(8),
                InvoiceItem::make('Service 19')->pricePerUnit(76.37),
                InvoiceItem::make('Service 20')->pricePerUnit(55.80),
            ];

            $pdf = CreateInvoice::make('receipt')
                ->status($invoice->status)
                ->sequence($invoice->serial_no)
                ->seller($client)
                ->buyer($customer)
                ->date(now())
                ->dateFormat('m/d/Y')
                ->payUntilDays(14)
                ->currencySymbol($invoice->currency)
                ->currencyCode($invoice->currency)
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator('.')
                ->currencyDecimalPoint(',')
                ->filename($client->name . ' ' . $customer->name)
                ->addItems($items)
                ->notes($invoice->notes ?? '-')
                ->logo(public_path('assets/images/aksesreka.jpeg'))
                ->save('public');

            // Get pdf link
            $link = $pdf->url();

            dd($link);

            return Redirect::route('invoices')->with('success', 'Invoice created successfully');
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            dd($e->getMessage());
            return Redirect::route('invoices')->with('error', 'Failed to create invoice: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'serial_no' => ['required', 'string'],
            'invoice_date' => ['required', 'date'],
            'order_number' => ['nullable', 'string'],
            'currency' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
            'due_date' => ['required', 'date'],
            'status' => ['required', 'string'],
            'seller_name' => ['required', 'string'],
            'seller_phone' => ['required', 'string'],
            'seller_address' => ['required', 'string'],
            'seller_business_id' => ['nullable', 'string'],
            'seller_code' => ['nullable', 'string'],
            'buyer_name' => ['required', 'string'],
            'buyer_phone' => ['required', 'string'],
            'buyer_address' => ['required', 'string'],
            'buyer_business_id' => ['nullable', 'string'],
            'buyer_code' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min: 1'],
            'items.*.name' => ['required', 'string'],
            'items.*.description' => ['nullable', 'string'],
            'items.*.unit' => ['nullable', 'string'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.discount' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}

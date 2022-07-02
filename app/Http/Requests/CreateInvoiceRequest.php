<?php

namespace App\Http\Requests;

use App\Rules\NotOverlapped;
use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start'         => ['required', 'date_format:Y-m-d',new NotOverlapped('invoices', 'start', 'end')],
            'end'           => 'required|date_format:Y-m-d|after:start',
            'customer_id'   => 'required|exists:customers,id'
        ];
    }
}

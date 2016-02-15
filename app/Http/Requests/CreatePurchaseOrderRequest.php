<?php

namespace Nixzen\Http\Requests;

use Nixzen\Http\Requests\Request;

class CreatePurchaseOrderRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'vendor'    => 'required',
            'date'      => 'required',
            'items'     => 'required',
            'terms'     => 'required',
            'type'      =>  'required',
            'paymenttype'=> 'required'
        ];
    }

    public function message()
    {
        return [
            'vendor.required'   => 'Vendor is required',
            'item.required'     => 'At least 1 item is required',
            'date.required'     => 'Date is required',
            'terms.required'    => 'Terms is required',
            'type.required'     => 'PO Type is required',
            'paymenttype.required'=>'Payment type is required'
        ];
    }
}

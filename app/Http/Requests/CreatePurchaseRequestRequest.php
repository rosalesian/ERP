<?php

namespace Nixzen\Http\Requests;

use Nixzen\Http\Requests\Request;

class CreatePurchaseRequestRequest extends Request
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
            'requestedby'   => 'required',
            'date'          => 'required',
            'type'          => 'required',
            'items'         => 'required'
        ];
        }

    public function messages()
    {        
        return [
            'requester.required' => 'A requester is required to complete the transaction',
            'item.required' => 'At least 1 item is required to create this transaction',
            'type.required' => 'PR type is required',
            'date.required' => 'Date is required'
        ];
    }
}

<?php

namespace Nixzen\Http\Requests;

use Nixzen\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

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
            'requestedby' => 'required',
            'date' => 'required',
            'items' => 'required'
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }

    public function messages()
    {        
        return [
            'requested_by.required' => 'A requester is required to complete the transaction',
            'item.required' => 'At least 1 item is required to create this transaction'
        ];
    }
}

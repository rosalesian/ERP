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
            'requester'   => 'required',
            'date'          => 'required',
            'type_id'          => 'required',
						'deliver_to'	=> 'required',
            'items'         => 'required'
        ];
    }

		/**
		 * Get the error messages for the defined validation rules.
		 *
		 * @return array
		 */
    public function messages()
    {
        return [
            'requester.required' => 'A requester is required to complete the transaction',
            'items.required' => 'At least 1 item is required to create this transaction',
            'type_id.required' => 'PR type is required',
            'date.required' => 'Date is required'
        ];
    }

		/**
		 * {@inheritdoc}
		 */
		protected function formatErrors(Validator $validator)
		{
		    return $validator->errors()->all();
		}
}

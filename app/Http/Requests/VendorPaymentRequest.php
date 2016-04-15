<?php

namespace Nixzen\Http\Requests;

use Nixzen\Http\Requests\Request;

class VendorPaymentRequest extends Request
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
            'transno' => 'required',
						'coa_id' => 'required',
						'date' => 'required',
						'posting_period_id' => 'required',
						'checkno' => 'required',
						'checkdate' => 'required',
						'principal_id' => 'required',
						'branch_id' => 'required'
        ];
    }
}

<?php

namespace Nixzen\Http\Requests;

use Nixzen\Http\Requests\Request;

class CreateVendorBillRequest extends Request
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
          /*  'vendor_id' => 'required',
            'suppliers_inv_no' => 'required',
            'billtype_id' => 'required',
            'billtype_nontrade_subtype_id' => 'required_if:billtype_id,2',
            'terms_id' => 'required',
            'date' => 'required',
            'department_id' => 'required',
            'division_id' => 'required',
            'branch_id' => 'required'*/
        ];
    }
}

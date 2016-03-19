<?php

namespace Nixzen\Http\Requests;

use Nixzen\Http\Requests\Request;

class ItemRequest extends Request
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
            'itemcode' => 'required',
						'unittype_id' => 'required',
						'itemtype_id' => 'required',
						'default_purchaseunit_id' => 'required',
						'default_salesunit_id' => 'required',
						'default_stockunit_id' => 'required',
						'itemcategory_id' => 'required',
						'expensecategory_id' => 'required',
						'taxcode_id' => 'required',
						'account_id' => 'required'
        ];
    }
}

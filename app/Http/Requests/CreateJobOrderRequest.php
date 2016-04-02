<?php

namespace Nixzen\Http\Requests;

use Nixzen\Http\Requests\Request;

class CreateJobOrderRequest extends Request
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
            'transdate' => 'required',
            'asset' => 'required',
            'requested_by' => 'required',
            'maintenancetype_id' => 'required',
            'prcategory_id' => 'required',
            'memo' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests\Supplier;

use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends CreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['email'] = 'bail|required|string|email|max:255|unique:' . with(new Supplier())->getTable() . ',email,' . $this->route('supplier')->id;

        return $rules;
    }

}

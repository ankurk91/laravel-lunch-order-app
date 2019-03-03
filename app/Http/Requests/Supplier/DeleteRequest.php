<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    /**
     * @var string
     */
    protected $errorBag = 'delete';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $supplier = $this->route('supplier');

            $productUsageCount = Product::withTrashed()
                ->whereHas('supplier', function ($query) use ($supplier) {
                    $query->where('supplier_id', $supplier->id);
                })->count();

            if ($productUsageCount) {
                $validator->errors()->add('supplier', 'Could not delete the supplier because it is already associated with ' . $productUsageCount . ' ' . Str::plural('product', $productUsageCount) . '.');
            }
        });
    }
}

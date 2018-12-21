<?php

namespace App\Http\Requests\User;

use App\Models\Order;
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
            $user = $this->route('user');

            $orderCount = Order::withTrashed()
                ->whereHas('createdByUser', function ($query) use ($user) {
                    $query->where('id', $user->id);
                })
                ->orWhereHas('createdForUser', function ($query) use ($user) {
                    $query->where('id', $user->id);
                })
                ->count();

            if ($orderCount) {
                $validator->errors()->add('user', 'Could not delete the user. This user has purchase history associated with ' . $orderCount . ' ' . str_plural('order', $orderCount) . '.');
            }
        });
    }
}

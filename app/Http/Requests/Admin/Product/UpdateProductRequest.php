<?php

namespace App\Http\Requests\Admin\Product;

use App\Models\Product;
use App\Rules\NullableIntegerRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateProductRequest
 * @package App\Http\Requests\Admin\Product
 *
 * @property $category_id
 * @property $name
 * @property $price
 * @property $unit_type
 * @property $available_stock
 * @property $critical_stock
 */
class UpdateProductRequest extends FormRequest
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
            "category_id" => "required|exists:categories,id",
            "name" => "required|max:100",
            "price" => "required|numeric",
            "available_stock" => "required|numeric|min:0",
            "unit_type" => "required|in:" . implode(",", array_keys(Product::UNIT_TYPES)),
            "critical_stock" => new NullableIntegerRule(),
        ];
    }

    public function attributes()
    {
        return [
            "category_id" => "category"
        ];
    }

    public function prepareForValidation()
    {
        if (empty($this->request->get("available_stock")))
            $this->merge([
                "available_stock" => "0"
            ]);
    }
}

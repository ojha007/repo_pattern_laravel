<?php

namespace App\Http\Controllers\Request;


class ProductRequest extends ApiFormRequest
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
//            'name' => 'required|alpha_num|unique:products,name|min:5|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'description' => 'required|min:5',
            'unit_id' => 'required|exists:units,id',
            'reference_number' => 'required|integer|unique:products,reference_number'
        ];

    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {

        return [
            'name.required' => 'Product name is required!',
            'name.alpha_num' => 'Product name should be alphabets or number!',
            'name.unique' => 'Product name should be unique!',
            'name.min' => 'Product name should not be less than 5 characters!',
            'product_category_id.required' => 'Product category is required!',
            'product_category_id.exists' => "Product category doesn't exist!",
            'description.required' => 'Product description is required!',
            'unit_id.required' => 'Product Unit is required!',
            'unit_id.exists' => "Unit doesn't exits",
        ];
    }

}

<?php

namespace App\Http\Controllers\Request;
class ProductCategoryRequest extends ApiFormRequest
{
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
            'name' => 'required|min:3|max:255|unique:product_categories,name,' . $this->products_category,
            'product_category_id' => 'nullable|exists:product_categories,id',
            'slug' => 'required|min:3|max:255|unique:product_categories,slug,' . $this->products_category,
            'description' => 'nullable'
        ];

    }

    public function message()
    {
        return [
            'name.required' => 'Title Field is required!',
            'name.min' => 'Title should not be less than 5 characters!',
            'name.unique' => 'Title should be unique!',
        ];
    }
}

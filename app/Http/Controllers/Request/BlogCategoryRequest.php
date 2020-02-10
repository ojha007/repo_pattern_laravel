<?php


namespace App\Http\Controllers\Request;


class BlogCategoryRequest extends ApiFormRequest
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
            'name' => 'required|min:5|max:255|unique:blog_categories,name,' . $this->category,
            'slug' => 'required|min:5|max:255|unique:blog_categories,slug,' . $this->category,
            'parent_id' => 'nullable|exists:blog_categories,id',
            'description' => 'required|min:5',
        ];

    }

    public function message()
    {
        return [
            'name.required' => 'Category Field is required!',
            'name.min' => 'Category should not be less than 5 characters!',
            'name.alpha_num' => 'Category should be alphabets or number!',
            'name.unique' => 'Category should be unique!',
            'slug.min' => 'Category should not be less than 5 characters!',
            'slug.required' => 'Slug for the categories is required!',
            'slug.alpha_num' => 'Slug should be alphabets or number!',
            'slug.unique' => 'Slug should be unique!',
            'parent_id.exists' => "Category doesn't exist!",
            'description.required' => 'Category description is required!',

        ];
    }
}

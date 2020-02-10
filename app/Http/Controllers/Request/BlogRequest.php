<?php


namespace App\Http\Controllers\Request;


class BlogRequest extends ApiFormRequest
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
            'title' => 'required|min:5|max:255|unique:blogs,title,' . $this->blog,
            'slug' => 'required|min:5|max:255|unique:blogs,slug,' . $this->blog,
            'description' => 'required|min:5',
            'blog_category_id' => 'required|exists:blog_categories,id'
        ];

    }

    public function message()
    {
        return [
            'title.required' => 'Title Field is required!',
            'title.min' => 'Title should not be less than 5 characters!',
            'title.unique' => 'Title should be unique!',
            'slug.min' => 'Slug should not be less than 5 characters!',
            'slug.required' => 'Slug for the categories is required!',
            'slug.unique' => 'Slug should be unique!',
            'blog_category_id.exists' => "Category doesn't exist!",
            'description.required' => 'Category description is required!',

        ];
    }
}

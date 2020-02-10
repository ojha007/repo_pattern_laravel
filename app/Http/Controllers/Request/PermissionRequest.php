<?php


namespace App\Http\Controllers\Request;


class PermissionRequest extends ApiFormRequest
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
            'name' => 'required|min:5|max:255|unique:permissions,name,' . $this->permission,
            'guard_name' => 'required|min:2',
            'role_name' => 'required|exists:roles,name'
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

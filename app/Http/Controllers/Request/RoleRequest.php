<?php


namespace App\Http\Controllers\Request;


class RoleRequest extends ApiFormRequest
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
            'name' => 'required|min:3|max:255|unique:roles,name,' . $this->role,
            'permissions' => 'required|exists:permissions,name|array',
            'guard_name' => 'required|min:2'
        ];

    }

    public function message()
    {
    }
}

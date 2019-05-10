<?php

namespace App\Modules\User\Http\Requests;

use App\Ship\Parents\Request;

class CreateUserRequest extends Request
{
    protected $urlParameters = [];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:30',
            'password_repeat' => 'required|regex:('.$this->password.')',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'email' => 'required|email',
            'password' => ''
        ];

        if($this->isRegisterRoute()){
            $rules = $this->addRegistrationRule($rules);
        }

        return $rules;
    }

    public function addRegistrationRule($rules)
    {
        $rules['email'] = $rules['email'] . '|unique:users';
        $rules['password'] = 'required|confirmed';

        $rules = array_merge($rules,[
            'name' => 'required'
        ]);

        return $rules;
    }

    private function isRegisterRoute()
    {
        return request()->routeIs('auth.register');
    }
}

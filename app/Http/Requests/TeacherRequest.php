<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TeacherRequest extends Request
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
        if(Request::is('admin/teachers/*'))
        {
            $rules = [
                'firstname'  => 'required',
                'dob' => 'required',
                'phone' => 'numeric',
                'join' => 'required'
            ];
        }
        else
        {
            $rules = [
                'firstname'  => 'required',
                'lastname' => 'required',
                'email' => 'required|email|unique:users',
                'join' => 'required',
                'dob' => 'required',
                'phone' => 'numeric'
            ];
        }

        return $rules;
    }
}

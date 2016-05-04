<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentRequest extends Request
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
        if(Request::is('admin/students/*'))
        {
            $rules = [
                'name'  => 'required',
                'course' => 'required',
                'batch' => 'required',
                'dob' => 'required',
                'phone' => 'numeric'
            ];
        }
        else
        {
            $rules = [
                'name'  => 'required',
                'email' => 'required|email|unique:users',
                'admission' => 'required|unique:students',
                'course' => 'required',
                'batch' => 'required',
                'dob' => 'required',
                'phone' => 'numeric'
            ];
        }

        return $rules;
    }
}

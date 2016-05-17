<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AssignmentRequest extends Request
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


         if(Request::is('assignment/*'))
        {
            $rules = [
                'title' => 'required',
            ];
        }
        else
        {
            $rules = [
                'title' => 'required',
                'file' => 'required|mimes:pdf,doc,docx',
            ];
        }

        return $rules;
       
    }
}

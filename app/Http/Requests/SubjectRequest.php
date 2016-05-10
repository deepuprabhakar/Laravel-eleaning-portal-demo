<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SubjectRequest extends Request
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
        if(Request::is('admin/subjects/*'))
        {
            $rules = [
                'name'  => 'required|min:2|unique_with:subjects,batch,course,semester',
                'course'=> 'required',
                'semester'=> 'required'
            ];
        }
        else
        {
            $rules = [
                'name'  => 'required|min:2|unique_with:subjects,batch,course,semester',
                'batch' => 'required|regex:/\b\d{4}\b/',
                'course'=> 'required',
                'semester'=> 'required',
                'file' => 'required|mimes:pdf,doc,docx',
            ];
        }

        return $rules;
        
    }

    public function messages()
    {
        return [
            'batch.regex' => 'The batch should be 4 digits (yyyy)'
        ];
    }
}

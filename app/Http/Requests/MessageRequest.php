<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MessageRequest extends Request
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
        if(Request::is('admin/messages/*'))
        {
            $rules = [
                'to'  => 'required',
                'subject' => 'required',
                'message'=> 'required'
            ];
        }
        else
        {
            $rules = [
                'subject' => 'required',
                'message'=> 'required'
            ];
        }

        return $rules;

    }
}

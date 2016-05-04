<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CourseRequest extends Request
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
        if(Request::is('admin/courses/*'))
        {
            $rules = [
                'semester' => 'required|numeric|min:1|max:10'
            ];
        }
        else
        {
            $rules = [
                'title' =>'required|min:2|max:200|unique:courses',
                'semester' => 'required|numeric|min:1|max:10'
            ];
        }

        return $rules;
    }
}

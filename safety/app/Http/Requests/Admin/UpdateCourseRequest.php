<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'ar_name' => 'required',
            'slug' => 'required|unique:courses,id,'.$request->id,   
            'parent' => 'required',
            'image' => 'mimes:png,jpg',
            'duration' => 'required', 
            'ar_duration' => 'required'  
        ];
    }
}

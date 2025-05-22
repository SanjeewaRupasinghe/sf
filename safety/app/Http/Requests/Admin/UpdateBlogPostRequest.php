<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
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
        return [
            'name' => 'required',
            'slug' => 'required|unique:blog_posts,id,'.$this->blogPost->id,
            'category' => 'required',
            'image' => 'mimes:png,jpg',
            'publish' => 'required',
            'description' => 'required',
            'ar_name' => 'required',
            'ar_description' => 'required',
        ];
    }
}

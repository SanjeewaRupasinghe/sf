<?php

namespace App\Http\Requests\Appraisal\Auth;

use App\Models\Common;
use Illuminate\Foundation\Http\FormRequest;

class PersonalDetailRequest extends FormRequest
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
            "name"=>"required",
            "gmcNumber"=>"required",
            "address"=>"required",
            "phone"=>"required",
            "email"=>"required",
            "yearOfAppraisal"=>"required",
            "revalidationRecommendation"=>"required",
        ];
    }

     /**
     * return errors as per the validation rules that apply to the request.
     *
     * @return
     */
    public function messages()
    {
        return Common::VALIDATE_MESSAGES;
    }
}

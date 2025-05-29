<?php

namespace App\Http\Requests\Appraisal\Auth;

use App\Models\Common;
use Illuminate\Foundation\Http\FormRequest;

class EmailConfirmationRequest extends FormRequest
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
            "email" => "required",
            "otp1" => "required",
            "otp2" => "required",
            "otp3" => "required",
            "otp4" => "required",
            "otp5" => "required",
            "otp6" => "required",
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

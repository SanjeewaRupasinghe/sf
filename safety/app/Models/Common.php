<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    public const VALIDATE_MESSAGES = [
        'required' => 'The :attribute field is required.',
        'min' => 'The :attribute field length is invalid.',
        'max' => 'The :attribute field length is invalid.',
        'regex' => 'The :attribute invalid input.',
        'unique' => 'The :attribute already exist.',
        'mimes' => 'Invalid file format.',
        'alpha' => 'Alpha letters only accept.',
        'digit' => 'Invalid input number of digits.',
    ];

}

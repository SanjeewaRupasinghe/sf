<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AppraisaUser extends Authenticatable
{
    // GETTING FROM DB ======================================
    // END GETTING FROM DB ======================================

    // ADDING TO DB ======================================

    static function create(
        $name,
        $email,
        $contact,
        $password
    ) {
        $query = new AppraisaUser();
        $query->name = $name;
        $query->email = $email;
        $query->contact = $contact;
        $query->password = $password;
        $query->otp = rand(100000, 999999);
        $query->save();

        return $query;
    }

    // END ADDING TO DB ======================================

    // RELATIONSHIP ======================================
    // END RELATIONSHIP ======================================
}

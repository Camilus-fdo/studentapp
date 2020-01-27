<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    protected $fillable = [
        'std_id', 'std_first_name','std_last_name', 'std_full_name', 'std_gender', 'std_birthday', 'std_address', 'std_contact_mobile', 'std_contact_home', 'std_email', 'std_active_status'
    ];
}

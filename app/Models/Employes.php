<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Employes extends Authenticatable
{

    use Notifiable;
    protected $table = 'employees';
    protected $fillable = [
        'emp_code',
        'name',
        'emp_email',
        'emp_mobile',
        'password',
        'raw_password',
        'note'
    ];
    protected $guard_name = 'employes';


}

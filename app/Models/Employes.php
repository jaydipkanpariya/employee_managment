<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Employes extends Authenticatable
{

    use Notifiable;
    protected $guard_name = 'employes';
    protected $table = 'employees';
}

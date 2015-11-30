<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class Fuel extends Model
{
    protected $table = 'fuel';

    protected $fillable = [
        'org_id',
        'date',
        'station',
        'value',
        'car'
    ];
}

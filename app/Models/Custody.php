<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Custody extends Model
{
    protected $table = 'custodies';

    protected $guarded = [];

    public $incrementing = true;

    public $timestamps = true;

    public function employees()
    {
        return $this->belongsToMany(User::class, 'employees_custodies', 'employee_id', 'custody_id');
    }
}

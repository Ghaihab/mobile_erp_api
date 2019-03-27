<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $table = 'vacations';

    protected $guarded = [];

    public $incrementing = true;

    public $timestamps = true;

    public function employees()
    {
        return $this->belongsToMany(User::class, 'employees_custodies', 'employee_id', 'vacation_id');
    }

}

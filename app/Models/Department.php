<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $guarded = [];

    public $incrementing = true;

    public $timestamps = true;

    public function manager()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}

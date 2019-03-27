<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeUpload extends Model
{
    protected $table = 'employee_uploads';

    protected $guarded = [];

    public $incrementing = true;

    public $timestamps = true;

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }



}

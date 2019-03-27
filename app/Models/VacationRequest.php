<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class VacationRequest extends Model
{
    protected $table = 'vacations_requests';

    protected $guarded = [];

    public $incrementing = true;

    public $timestamps = true;

    const
        STATUS_APPROVED = 'APPROVED',
        STATUS_REJECTED = 'REJECTED',
        STATUS_UNDER_MANAGER_APPROVAL = 'UNDER_MANAGER_APPROVAL',
        STATUS_UNDER_HR_APPROVAL = 'UNDER_HR_APPROVAL';

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function vacation()
    {
        return $this->belongsTo(Vacation::class, 'vacation_id');
    }
}

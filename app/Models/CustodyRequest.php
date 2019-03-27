<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustodyRequest extends Model
{
    protected $table = 'custody_requests';

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

    public function custody()
    {
        return $this->belongsTo(Custody::class, 'custody_id');
    }
}

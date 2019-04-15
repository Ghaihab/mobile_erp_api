<?php

namespace App;

use App\Models\Custody;
use App\Models\Department;
use App\Models\EmployeeUpload;
use App\Models\Vacation;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ssn',
        'gender',
        'rate',
        'phone_number',
        'birth_date',
        'city',
        'street',
        'zip_code',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function custodies()
    {
        return $this->belongsToMany(Custody::class, 'employees_custodies', 'employee_id', 'custody_id');
    }

    public function vacations()
    {
        return $this->belongsToMany(Vacation::class, 'employees_vacations', 'employee_id', 'vacation_id')
            ->withPivot('number_of_days');
    }

    public function uploads()
    {
        return $this->hasMany(EmployeeUpload::class, 'employee_id');
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'user' => auth()->user()
        ];
    }

    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}

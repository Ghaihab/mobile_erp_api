<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function custodies()
    {
        return auth()->user()->custodies;
    }

    public function vacations()
    {
        return auth()->user()->vacations;
    }

    public function uploads()
    {
        return auth()->user()->uploads;
    }

    public function changePassword()
    {
        $user = auth()->user();
        $user->setPasswordAttribute(request('password'));
        $user->save();
    }


}

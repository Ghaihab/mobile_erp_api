<?php

namespace App\Http\Controllers;

use App\Models\VacationRequest;
use App\User;
use Illuminate\Http\Request;

class VacationRequestsController extends Controller
{
    public function showManagerRequests()
    {
        return VacationRequest::where('status' , VacationRequest::STATUS_UNDER_MANAGER_APPROVAL)->get();
    }

    public function showHrRequests()
    {
        return VacationRequest::where('status' , VacationRequest::STATUS_UNDER_HR_APPROVAL)->get();
    }

    public function create(Request $request)
    {
        VacationRequest::create([
            'employee_id' => auth()->user()->id,
            'vacation_id' => $request->vacation_id,
            'status'      => VacationRequest::STATUS_UNDER_MANAGER_APPROVAL,
        ]);
    }

    public function acceptManager(VacationRequest $request)
    {
        $request->status = VacationRequest::STATUS_UNDER_HR_APPROVAL;
        $request->save();
        $this->accept($request);
    }

    public function acceptHR(VacationRequest $request)
    {
        $request->status = VacationRequest::STATUS_APPROVED;
        $request->save();
        $this->accept($request);
    }

    public function reject(VacationRequest $request)
    {
        $request->status = VacationRequest::STATUS_REJECTED;
        $request->save();
    }

    private function accept(VacationRequest $request)
    {
        /** @var User $user */
        $user = User::findOrFail($request->employee_id);

        $user->vacations()->attach([
            'vacation_id' => $request->vacation_id
        ]);
    }

}

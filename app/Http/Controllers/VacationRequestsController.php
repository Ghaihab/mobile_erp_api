<?php

namespace App\Http\Controllers;

use App\Models\VacationRequest;
use App\User;
use Illuminate\Http\Request;

class VacationRequestsController extends Controller
{

    public function index()
    {
        return VacationRequest::with('vacation', 'employee')
            ->get();
    }

    public function showManagerRequests()
    {
        return VacationRequest::with('vacation', 'employee')
            ->where('status' , VacationRequest::STATUS_UNDER_MANAGER_APPROVAL)
            ->get();
    }

    public function showHrRequests()
    {
        return VacationRequest::with('vacation', 'employee')
            ->where('status' , VacationRequest::STATUS_UNDER_HR_APPROVAL)
            ->get();
    }

    public function create(Request $request)
    {
        VacationRequest::create([
            'employee_id' => auth()->user()->id,
            'vacation_id' => $request->vacation_id,
            'status'      => VacationRequest::STATUS_UNDER_MANAGER_APPROVAL,
        ]);
    }

    public function acceptManager($id)
    {
        $vacationRequest = VacationRequest::findOrFail($id);
        $vacationRequest->status = VacationRequest::STATUS_UNDER_HR_APPROVAL;
        $vacationRequest->save();
        $this->accept($vacationRequest);
    }

    public function acceptHR($id)
    {
        $vacationRequest = VacationRequest::findOrFail($id);
        $vacationRequest->status = VacationRequest::STATUS_APPROVED;
        $vacationRequest->save();
        $this->accept($vacationRequest);
    }

    public function reject($id)
    {
        $vacationRequest = VacationRequest::findOrFail($id);
        $vacationRequest->status = VacationRequest::STATUS_REJECTED;
        $vacationRequest->save();
    }

    private function accept(VacationRequest $vacationRequest)
    {
        /** @var User $user */
        $user = User::findOrFail($vacationRequest->employee_id);

        $user->vacations()->attach([
            $vacationRequest->vacation_id
        ]);
    }

}

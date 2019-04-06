<?php

namespace App\Http\Controllers;

use App\Models\CustodyRequest;
use App\User;
use Illuminate\Http\Request;

class CustodyRequestsController extends Controller
{
    public function index()
    {
        return CustodyRequest::with('custody')->get();
    }
    public function showManagerRequests()
    {
        return CustodyRequest::where('status' , CustodyRequest::STATUS_UNDER_MANAGER_APPROVAL)->get();
    }

    public function showHrRequests()
    {
        return CustodyRequest::where('status' , CustodyRequest::STATUS_UNDER_HR_APPROVAL)->get();
    }

    public function create(Request $request)
    {
        CustodyRequest::create([
            'employee_id'   => auth()->user()->id,
            'custody_id'    => $request->custody_id,
            'status'        => CustodyRequest::STATUS_UNDER_MANAGER_APPROVAL,
        ]);
        return response()->json([], 200);
    }

    public function acceptManager($id)
    {
        $custodyRequest = CustodyRequest::findOrFail($id);
        $custodyRequest->status = CustodyRequest::STATUS_UNDER_HR_APPROVAL;
        $this->accept($custodyRequest);
        $custodyRequest->save();
    }

    public function acceptHR($id)
    {
        $custodyRequest = CustodyRequest::findOrFail($id);
        $custodyRequest->status = CustodyRequest::STATUS_APPROVED;
        $this->accept($custodyRequest);
        $custodyRequest->save();
    }

    public function reject($id)
    {
        $custodyRequest = CustodyRequest::findOrFail($id);
        $custodyRequest->status = CustodyRequest::STATUS_REJECTED;
        $custodyRequest->save();
    }

    private function accept(CustodyRequest $custodyRequest)
    {
        /** @var User $user */
        $user = User::findOrFail($custodyRequest->employee_id);
        $user->custodies()->attach([
            $custodyRequest->custody_id
        ]);
    }

}

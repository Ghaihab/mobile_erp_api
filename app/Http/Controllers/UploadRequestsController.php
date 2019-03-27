<?php

namespace App\Http\Controllers;

use App\Models\UploadRequest;
use App\User;
use Illuminate\Http\Request;

class UploadRequestsController extends Controller
{
    public function showManagerRequests()
    {
        return UploadRequest::where('status' , UploadRequest::STATUS_UNDER_MANAGER_APPROVAL)->get();
    }

    public function showHrRequests()
    {
        return UploadRequest::where('status' , UploadRequest::STATUS_UNDER_HR_APPROVAL)->get();
    }

    public function create(Request $request)
    {
        UploadRequest::create([
            'employee_id' => auth()->user->id,
            'file_name' => $request->file->file_name,
            'file_type' => $request->file->file_type,
            'course_name' => $request->course_name,
            'training_place' => $request->training_palce,
            'expected_hours' => $request->expected_hours,
            'from' => $request->from,
            'to' => $request->to,
            'status' => UploadRequest::STATUS_UNDER_MANAGER_APPROVAL,
        ]);
    }

    public function acceptManager(UploadRequest $request)
    {
        $request->status = UploadRequest::STATUS_UNDER_HR_APPROVAL;
        $request->save();
        $this->accept($request);
    }

    public function acceptHR(UploadRequest $request)
    {
        $request->status = UploadRequest::STATUS_APPROVED;
        $this->accept($request);
        $request->save();
    }

    public function rejectManager(UploadRequest $request)
    {
        $request->status = UploadRequest::STATUS_REJECTED;
        $request->save();
    }

    private function accept(UploadRequest $request)
    {
        /** @var User $user */
        $user = User::findOrFail($request->employee_id);
        $user->uploads()->create([
            'file_name' => $request->file_name,
            'file_type' => $request->file_type,
            'course_name' => $request->course_name,
            'training_place' => $request->training_place,
            'expected_hours' => $request->expected_hours,
            'from' => $request->from,
            'to' => $request->to
        ]);
    }
}

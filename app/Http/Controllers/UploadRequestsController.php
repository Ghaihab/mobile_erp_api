<?php

namespace App\Http\Controllers;

use App\Models\UploadRequest;
use App\User;
use Illuminate\Http\Request;

class UploadRequestsController extends Controller
{
    public function index()
    {
        return UploadRequest::all();
    }

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
            'employee_id' => auth()->user()->id,
//            'file_name' => $request->file->file_name,
//            'file_type' => $request->file->file_type,
            'course_name' => $request->course_name,
            'training_place' => $request->training_palce,
            'expected_hours' => $request->expected_hours,
            'from' => $request->from,
            'to' => $request->to,
            'status' => UploadRequest::STATUS_UNDER_MANAGER_APPROVAL,
        ]);
    }

    public function acceptManager($id)
    {
        $uploadRequest = UploadRequest::findOrFail($id);
        $uploadRequest->status = UploadRequest::STATUS_UNDER_HR_APPROVAL;
        $uploadRequest->save();
        $this->accept($uploadRequest);
    }

    public function acceptHR($id)
    {
        $uploadRequest = UploadRequest::findOrFail($id);
        $uploadRequest ->status = UploadRequest::STATUS_APPROVED;
        $this->accept($uploadRequest);
        $uploadRequest->save();
    }

    public function reject($id)
    {
        $uploadRequest = UploadRequest::findOrFail($id);
        $uploadRequest->status = UploadRequest::STATUS_REJECTED;
        $uploadRequest->save();
    }

    private function accept(UploadRequest $request)
    {
        /** @var User $user */
        $user = User::findOrFail($request->employee_id);
        $user->uploads()->create([
//            'file_name' => $request->file_name,
//            'file_type' => $request->file_type,
            'course_name' => $request->course_name,
            'training_place' => $request->training_place,
            'expected_hours' => $request->expected_hours,
            'from' => $request->from,
            'to' => $request->to
        ]);
    }
}

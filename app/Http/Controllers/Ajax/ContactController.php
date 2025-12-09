<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactRequest;

class ContactController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $statuses = ContactRequest::statusList();

        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys($statuses)),
        ]);

        $contactRequest = ContactRequest::findOrFail($id);

        $contactRequest->status = (int) $request->status;
        $contactRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái thành công.',
            'label' => $contactRequest->status_label,
        ]);
    }
}

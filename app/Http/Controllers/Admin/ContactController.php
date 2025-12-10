<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactRequest;
use App\Http\Requests\Admin\ContactUpdateRequest;

class ContactController extends Controller
{
    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Contact';
        $data['sidebar_child'] = 'Contact';
        $data['title'] = 'Danh Sách Liên Hệ';
        $data['breadcrumb'] = [
            ['route' => 'admin.contacts.index', 'name' => 'Danh Sách Liên Hệ'],
        ];
        $contactRequests = ContactRequest::query()->with(['customer', 'items.product']);
        if ($request->filled('keyword')) {
            $keyword = $request->get('keyword');
            $contactRequests->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'like', '%' . $keyword . '%');
                $query->orWhere('phone', 'like', '%' . $keyword . '%');
            });
        }
        $contactRequests->orderBy('created_at', 'DESC');
        $data['contactRequests'] = $contactRequests->paginate($this->limit);
        return view('backend.contact.index', $data);
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Contact';
        $data['sidebar_child'] = 'Contact';
        $data['title'] = 'Chỉnh sửa liên hệ';
        $data['breadcrumb'] = [
            ['route' => 'admin.contacts.index', 'name' => 'Danh Sách Liên Hệ'],
            ['route' => 'admin.contacts.edit', 'name' => 'Chỉnh sửa liên hệ'],
        ];
        $data['contactRequest'] = ContactRequest::query()->with(['customer', 'items.product'])->findOrFail($id);
        return view('backend.contact.edit', $data);
    }

    public function update(ContactUpdateRequest $request, $id)
    {
        try {
            $contactRequest = ContactRequest::findOrFail($id);
            $data = $request->validated();
            $data['save_info'] = $request->boolean('save_info');
            $contactRequest->fill($data);
            $contactRequest->save();
            return redirect()->route('admin.contacts.index')->with('success', 'Cập nhật liên hệ thành công.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại.');
        }
    }

    public function delete($id)
    {
        try {
            $contactRequest = ContactRequest::findOrFail($id);
            $contactRequest->delete();
            return redirect()->route('admin.contacts.index')->with('success', 'xóa liện h thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được liên hệ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    protected $limit = 20;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Customer';
        $data['sidebar_child'] = 'Customer';
        $data['breadcrumb'] = [
            ['route' => 'admin.customers.index', 'name' => 'Danh Sách Khách hàng'],
        ];
        $customers = Customer::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $customers->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('full_name', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        $customers->orderByDesc('id');
        $data['customers'] = $customers->paginate($this->limit);
        $data['model'] = 'Customer';
        return view('backend.customer.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Customer';
        $data['sidebar_child'] = 'Customer';
        $data['breadcrumb'] = [
            ['route' => 'admin.customers.index', 'name' => 'Danh Sách Khách hàng'],
            ['route' => 'admin.customers.create', 'name' => 'Thêm Mới khách hàng']
        ];
        $data['title'] = 'Thêm mới khách hàng';
        return view('backend.customer.form', $data);
    }

    public function store(CustomerRequest $request)
    {
        try {
            $data = $request->all();
            $customer = Customer::create($data);
            return redirect()->route('admin.customers.index')->with('success', 'Tạo khách hàng thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được khách hàng' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Customer';
        $data['sidebar_child'] = 'Customer';
        $data['title'] = 'Sửa khách hàng';
        $data['customer'] = Customer::findOrFail($id);
        $data['id'] = $id;
        return view('backend.customer.form', $data);
    }

    public function update(CustomerRequest $request, $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $data = $request->all();
            $customer->update($data);
            return redirect()->route('admin.customers.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không sửa được khách hàng' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return back()->with('success', 'Xóa khách hàng thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Không xóa được khách hàng' . $exception->getMessage());
        }
    }
}

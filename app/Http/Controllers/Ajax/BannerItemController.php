<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\BannerItem;
use Illuminate\Http\Request;

class BannerItemController extends Controller
{
    public function sort(Request $request)
    {
        if ($request->has('orders')) {
            foreach ($request->orders as $id => $order) {
                BannerItem::where('id', $id)->update(['sort_order' => (int)$order]);
            }
        }
        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        }
        return redirect()->back()->with('success', 'Cập nhật thứ tự thành công');
    }
}

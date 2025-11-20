<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerIcon;

class DashboardController extends Controller
{
    public function changeStatus(Request $request)
    {
        $modelName = '\\App\\Models\\' . ucfirst($request->input('model'));
        $modelId = $request->input('modelId');
        $field = $request->input('field');
        $value = $request->input('value');
        if (!class_exists($modelName)) {
            return response()->json(['flag' => false, 'message' => 'Không tìm thấy Model']);
        }
        $model = $modelName::find($modelId);
        if (!$model) {
            return response()->json(['flag' => false, 'message' => 'Không tìm thấy bản ghi']);
        }
        if (!in_array($field, array_keys($model->getAttributes()))) {
            return response()->json(['flag' => false, 'message' => 'Không tìm thấy trường']);
        }
        $model->$field = ($value == 1) ? 0 : 1;
        $model->save();
        return response()->json([
            'flag' => true,
            'new_value' => $model->$field,
            'message' => 'Cập nhật thành công'
        ]);
    }


}

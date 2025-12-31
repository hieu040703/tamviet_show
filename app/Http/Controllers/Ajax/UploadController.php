<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function uploadVariantImage(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                $path = 'uploads/variants/' . date('Y/m/d');

                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0755, true);
                }

                $file->move(public_path($path), $filename);

                $fullPath = '/' . $path . '/' . $filename;

                return response()->json([
                    'success' => true,
                    'path' => $fullPath,
                    'message' => 'Upload thành công'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy file'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteVariantImage(Request $request)
    {
        try {
            $path = $request->input('path');

            if ($path && file_exists(public_path($path))) {
                unlink(public_path($path));
            }

            return response()->json([
                'success' => true,
                'message' => 'Xóa ảnh thành công'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

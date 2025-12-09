<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System;
use App\Classes\SystemLibrary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class SystemController extends Controller
{
    /**
     * @var SystemLibrary
     */

    protected $systemLibrary;

    public function __construct(SystemLibrary $systemLibrary)
    {
        $this->systemLibrary = $systemLibrary;
    }

    public function index(Request $request)
    {
        $data['title'] = __('System Config');
        $data['sidebar'] = 'SystemLibrary';
        $data['sidebar_child'] = 'SystemLibrary';
        $data['systemConfig'] = $this->systemLibrary->config();
        $data['systems'] = System::pluck('content', 'keyword')->toArray();
        return view('backend.system.index', $data);
    }

    public function store(Request $request)
    {
        // Lấy text config bình thường
        $config = $request->input('config', []);

        // Lấy các file trong nhóm config
        $files = $request->file('config', []);

        if (!empty($files) && is_array($files)) {
            foreach ($files as $key => $file) {
                if (!$file instanceof UploadedFile || !$file->isValid()) {
                    continue;
                }

                // Nếu đã có giá trị cũ thì xóa file cũ
                $oldPath = $config[$key] ?? null;
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                // Tạo tên file đẹp
                $baseName  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $baseName  = Str::slug($baseName);
                $extension = $file->getClientOriginalExtension();
                $fileName  = $baseName . '-' . time() . '.' . $extension;

                // Lưu file vào storage/app/public/system
                $path = $file->storeAs('system', $fileName, 'public');

                // Gán lại vào mảng config => sẽ ghi xuống DB (cột content)
                $config[$key] = $path;
            }
        }

        $ok = $this->save($config);

        if ($ok) {
            return redirect()
                ->route('admin.system.index')
                ->with('success', __('Cập nhật bản ghi thành công'));
        }

        return redirect()
            ->route('admin.system.index')
            ->with('error', __('Cập nhật bản ghi không thành công. Hãy thử lại'));
    }


    protected function save(array $config)
    {
        if (empty($config)) {
            return true;
        }
        foreach ($config as $key => $val) {
            $content = is_array($val) ? json_encode(array_values($val), JSON_UNESCAPED_UNICODE) : (string)$val;
            System::updateOrCreate(
                ['keyword' => $key],
                [
                    'content' => $content,
                    'user_id' => Auth::id(),
                ]
            );
        }
        return true;
    }
}

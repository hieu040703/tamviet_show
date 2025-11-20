<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System;
use App\Classes\SystemLibrary;
use Illuminate\Support\Facades\Auth;

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
        $config = $request->input('config', []);
        $ok = $this->save($config);
        if ($ok) {
            return redirect()
                ->route('admin.system.index')
                ->with('success', __('Cập nhật bản ghi thành công'));
        }
        return redirect()->route('admin.system.index')->with('error', __('Cập nhật bản ghi không thành công. Hãy thử lại'));
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

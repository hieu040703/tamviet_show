<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UpdateProfileRequest;
use App\Models\ContactRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class AccountController extends Controller
{
    public function index()
    {
        if (!Agent::isMobile()) {
            return redirect()->route('account.personal-info');
        }
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $user = auth('web')->user();
        $data = $this->makeProfileViewData($user);
        return view('frontend.account.index', [
            'hiddenHeader' => $hiddenHeader,
            'hidden' => $hidden,
            'data' => $data,
        ]);
    }

    public function setting()
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        if (!Agent::isMobile()) {
            return redirect()->route('homepage.index');
        }
        return view('frontend.account.setting', [
            'hiddenHeader' => $hiddenHeader,
            'hidden' => $hidden,
        ]);
    }

    protected function makeProfileViewData(?object $user): array
    {
        $avatar = $user && $user->avatar ? asset($user->avatar) : asset('backend/img/not-found.jpg');
        $displayName = $user && ($user->full_name ?? $user->name)
            ? ($user->full_name ?? $user->name)
            : 'Khách hàng';
        $phoneMasked = '';
        if ($user && $user->phone) {
            $digits = preg_replace('/\D/', '', $user->phone);
            $last3 = substr($digits, -3);
            $phoneMasked = '**** *** ' . $last3;
        }
        $birthday = $user && $user->birthday ? Carbon::parse($user->birthday) : null;
        $gender = $user && $user->gender ? (int)$user->gender : null;
        return compact('user', 'avatar', 'displayName', 'phoneMasked', 'birthday', 'gender');
    }

    public function profile()
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $bottomNav = "hidden md:grid";
        $user = auth('web')->user();
        $data = $this->makeProfileViewData($user);
        return view('frontend.account.profile', [
            'hiddenHeader' => $hiddenHeader,
            'hidden' => $hidden,
            'bottomNav' => $bottomNav,
        ], $data);
    }

    protected function fillUserProfile($user, UpdateProfileRequest $request): void
    {
        $data = $request->validated();
        $user->name = $data['full_name'];
        $user->gender = $data['gender'] ?? null;
        $user->birthday = !empty($data['birthday'])
            ? Carbon::parse($data['birthday'])->format('Y-m-d')
            : null;

        if (!empty($data['email'])) {
            $user->email = $data['email'];
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('uploads/avatars', 'public');
            $user->avatar = 'storage/' . $path;
        }
    }

    protected function profileUpdatedResponse(Request $request, $user)
    {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật hồ sơ của bạn thành công!',
                'data' => [
                    'full_name' => $user->name,
                    'avatar_url' => $user->avatar ? asset($user->avatar) : null,
                    'email' => $user->email,
                    'gender' => $user->gender,
                    'birthday' => $user->birthday,
                ],
            ]);
        }
        return redirect()
            ->route('account.personal-info')
            ->with('success', 'Cập nhật hồ sơ của bạn thành công!');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth('web')->user();
        if (!$user) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bạn chưa đăng nhập.',
                ], 401);
            }

            abort(403);
        }
        $this->fillUserProfile($user, $request);
        $user->save();
        return $this->profileUpdatedResponse($request, $user);
    }

    public function contactHistory()
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $user = auth('web')->user();
        $requests = ContactRequest::with('items')->forCustomer($user)->orderByDesc('created_at')->get();
        $profileData = $this->makeProfileViewData($user);
        return view('frontend.account.contact-history', array_merge($profileData, [
            'requests' => $requests,
            'hidden' => $hidden,
            'hiddenHeader' => $hiddenHeader
        ]));
    }
}

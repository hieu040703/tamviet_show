@extends('frontend.layout')

@section('content')
    @php
        $birthdayValue = old('birthday', $birthday ? $birthday->format('Y-m-d') : '');
        $genderValue = old('gender', $gender);
        $todayMax = now()->format('Y-m-d');

        $genderLabel = 'Chọn giới tính';
        if ((string)$genderValue === '1') $genderLabel = 'Nam';
        if ((string)$genderValue === '2') $genderLabel = 'Nữ';
        if ((string)$genderValue === '3') $genderLabel = 'Khác';
    @endphp

    <div id="account" class="h-[100vh] md:h-auto md:pt-0">
        <div class="mx-auto max-w-screen-xl md:container md:pb-4">

            <div class="hidden md:mt-4 md:flex md:gap-4">
                <div>
                    <div class="grid w-[288px] gap-4 rounded-md bg-white">
                        <div class="px-4 pt-4">
                            <div class="grid gap-4">
                                <div class="flex items-center gap-2">
                                    <img
                                        class="rounded-full w-12 h-12 object-cover"
                                        src="{{ $avatar }}"
                                        alt="avatar"
                                        loading="lazy"
                                        width="500"
                                        height="500"
                                        data-customer-avatar
                                    >
                                    <div class="flex-1 text-sm font-medium">
                                        <div class="text-neutral-900 text-base font-bold capitalize" data-customer-name>
                                            {{ $displayName ?? 'Khách hàng' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            @include('frontend.account.sidebar')
                        </div>
                    </div>
                </div>
                <div class="flex-1 md:max-w-[calc(1200px-288px-16px)]">
                    <div>
                        <div class="items-center space-x-4 mb-4 hidden md:block">
                            <div class="flex-1">
                                <h1 class="text-xl font-semibold text-neutral-900">
                                    Thông tin cá nhân
                                </h1>
                            </div>
                        </div>
                        <div class="rounded-lg bg-white p-6">
                            <form id="accountFormDesktop"
                                  action="{{ route('account.profile.update') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                <span class="text-sm font-semibold text-neutral-900">
                                    Ảnh đại diện
                                </span>
                                    <div class="mt-2 flex items-center gap-6">
                                        <img
                                            class="h-[80px] w-[80px] rounded-full object-cover"
                                            src="{{ $avatar }}"
                                            alt="avatar"
                                            loading="lazy"
                                            width="500"
                                            height="500"
                                            data-account-picture-trigger
                                            data-customer-avatar
                                        >
                                        <div>
                                            <div class="mb-2 flex">
                                                <button
                                                    data-size="sm"
                                                    type="button"
                                                    data-account-picture-button
                                                    class="relative flex justify-center outline-none font-semibold bg-neutral-200 border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 h-9 items-center rounded-lg p-4 text-sm"
                                                >
                                                    <span>Cập nhật ảnh mới</span>
                                                </button>
                                                <input
                                                    id="picture"
                                                    class="hidden"
                                                    accept=".jpg, .jpeg, .png, .heic, .heif"
                                                    type="file"
                                                    name="avatar"
                                                >
                                            </div>
                                            <div class="grid text-sm font-medium text-neutral-700">
                                                <p>Dung lượng file tối đa 5 MB.</p>
                                                <p>Định dạng: .JPEG, .PNG</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-5">
                                    <div class="col-span-1 grid gap-3">
                                        <div class="space-y-2">
                                            <label
                                                class="leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-fit font-semibold text-neutral-900"
                                                for="full_name_desktop"
                                            >Họ và tên</label>
                                            <div class="relative flex">
                                                <input
                                                    maxlength="50"
                                                    id="full_name_desktop"
                                                    class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                                    placeholder="Họ và tên"
                                                    type="text"
                                                    value="{{ old('full_name', $displayName) }}"
                                                    name="full_name"
                                                >
                                            </div>
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-fit font-semibold text-neutral-900"
                                                for="birthday_desktop"
                                            >Ngày sinh</label>
                                            <div class="relative flex">
                                                <input
                                                    id="birthday_desktop"
                                                    type="date"
                                                    name="birthday"
                                                    class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                                    value="{{ $birthdayValue }}"
                                                    max="{{ $todayMax }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="space-y-2 relative" data-gender="desktop">
                                            <label
                                                class="leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-fit font-semibold text-neutral-900"
                                            >Giới tính</label>
                                            <button
                                                type="button"
                                                data-gender-trigger="desktop"
                                                class="flex items-center justify-between bg-background text-left ring-offset-background focus:outline-none focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[placeholder]:text-base data-[placeholder]:font-medium data-[placeholder]:text-neutral-600 [&>span]:line-clamp-1 w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                            >
                                            <span
                                                data-gender-label="desktop"
                                                style="pointer-events: none;"
                                            >
                                                {{ $genderLabel }}
                                            </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="h-6 w-6 text-neutral-950" aria-hidden="true">
                                                    <path d="m6 9 6 6 6-6"></path>
                                                </svg>
                                            </button>
                                            <div
                                                data-gender-dropdown="desktop"
                                                class="absolute left-0 right-0 mt-1 rounded-md border bg-white shadow-lg z-20 hidden"
                                            >
                                                <button
                                                    type="button"
                                                    data-gender-option="1"
                                                    class="block w-full text-left px-3 py-2 text-sm hover:bg-neutral-100"
                                                >Nam
                                                </button>
                                                <button
                                                    type="button"
                                                    data-gender-option="2"
                                                    class="block w-full text-left px-3 py-2 text-sm hover:bg-neutral-100"
                                                >Nữ
                                                </button>
                                                <button
                                                    type="button"
                                                    data-gender-option="3"
                                                    class="block w-full text-left px-3 py-2 text-sm hover:bg-neutral-100"
                                                >Khác
                                                </button>
                                            </div>
                                            <select
                                                aria-hidden="true"
                                                tabindex="-1"
                                                name="gender"
                                                id="gender_desktop"
                                                class="hidden"
                                            >
                                                <option value="">Chọn giới tính</option>
                                                <option value="1" {{ (string)$genderValue === '1' ? 'selected' : '' }}>
                                                    Nam
                                                </option>
                                                <option value="2" {{ (string)$genderValue === '2' ? 'selected' : '' }}>
                                                    Nữ
                                                </option>
                                                <option value="3" {{ (string)$genderValue === '3' ? 'selected' : '' }}>
                                                    Khác
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-span-1 grid gap-4 border-l border-divider pl-5">
                                        <div class="flex justify-between">
                                            <div
                                                class="flex flex-1 flex-col gap-1 text-sm font-semibold text-neutral-900">
                                                <p>Số điện thoại</p>
                                                <p class="font-medium text-neutral-600 break-all">
                                                    {{ $phoneMasked ?: 'Chưa cập nhật' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex justify-between">
                                            <div
                                                class="flex flex-1 flex-col gap-1 text-sm font-semibold text-neutral-900">
                                                <p>Email</p>
                                                <div class="text-sm font-medium">
                                                    {{ $user && $user->email ? $user->email : 'Chưa cập nhật' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button
                                    id="saveDesktopBtn"
                                    data-size="sm"
                                    disabled
                                    type="submit"
                                    class="relative flex justify-center outline-none border-0 h-9 items-center rounded-lg cursor-not-allowed bg-neutral-100 hover:bg-neutral-100 hover:text-neutral-600 focus:ring-neutral-100 text-neutral-600 z-0 mt-10 p-6 text-base font-semibold"
                                >
                                    <span>Lưu thay đổi</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:hidden">
                <div class="flex-1 md:max-w-[calc(1200px-288px-16px)]">
                    <div>
                        <div>
                            <div class="fixed left-0 top-0 z-10 h-11 w-full bg-white md:hidden">
                                <div class="z-50 grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-4">
                                    <div class="flex">
                                        <div class="flex w-6 items-center">
                                            <button
                                                data-size="sm"
                                                type="button"
                                                data-back-button
                                                class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent border-0 hover:text-primary-500 h-6 p-0 text-neutral-900"
                                            >
                                            <span
                                                class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                                <svg viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                                        fill="currentColor"/>
                                                </svg>
                                            </span>
                                            </button>
                                        </div>
                                        <div class="grid flex-1 items-center text-center">
                                            <h4
                                                class="truncate px-2 text-base font-semibold text-neutral-900 md:text-2xl md:font-bold">
                                                Thông tin cá nhân
                                            </h4>
                                        </div>
                                        <div class="w-6"></div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="mt-11 pb-[120px] md:mt-0">
                                    <div class="bg-white">
                                        <div class="flex flex-col items-center bg-white pt-4">
                                            <img
                                                class="h-[100px] w-[100px] rounded-full object-cover"
                                                src="{{ $avatar }}"
                                                data-account-picture-trigger
                                                data-customer-avatar
                                            >

                                            <button
                                                data-size="sm"
                                                type="button"
                                                data-account-picture-button
                                                class="relative flex justify-center outline-none focus:ring-neutral-300 px-4 py-2 h-9 bg-transparent border-0 hover:text-primary-500 font-normal text-hyperLink text-sm"
                                            >
                                                <span>Cập nhật ảnh</span>
                                            </button>
                                        </div>
                                        <form id="accountFormMobile"
                                              action="{{ route('account.profile.update') }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input
                                                id="picture_mobile"
                                                class="hidden"
                                                accept=".jpg, .jpeg, .png, .heic, .heif"
                                                type="file"
                                                name="avatar"
                                            >
                                            <div class="grid gap-4 p-4">
                                                <div class="space-y-2">
                                                    <label
                                                        class="leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-fit font-semibold text-neutral-900"
                                                        for="full_name_mobile"
                                                    >Họ và tên</label>
                                                    <div class="relative flex">
                                                        <input
                                                            maxlength="50"
                                                            id="full_name_mobile"
                                                            class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                                            placeholder="Họ và Tên"
                                                            type="text"
                                                            value="{{ old('full_name', $displayName) }}"
                                                            name="full_name"
                                                        >
                                                    </div>
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-fit font-semibold text-neutral-900"
                                                        for="birthday_mobile"
                                                    >Ngày sinh</label>
                                                    <div class="relative flex">
                                                        <input
                                                            id="birthday_mobile"
                                                            type="date"
                                                            name="birthday"
                                                            class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                                            value="{{ $birthdayValue }}"
                                                            max="{{ $todayMax }}"
                                                        >
                                                    </div>
                                                </div>

                                                <div class="space-y-2 relative" data-gender="mobile">
                                                    <label
                                                        class="leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-fit font-semibold text-neutral-900"
                                                    >Giới tính</label>
                                                    <button
                                                        type="button"
                                                        data-gender-trigger="mobile"
                                                        class="flex items-center justify-between bg-background text-left ring-offset-background focus:outline-none focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[placeholder]:text-base data-[placeholder]:font-medium data-[placeholder]:text-neutral-600 [&>span]:line-clamp-1 w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                                    >
                                                    <span
                                                        data-gender-label="mobile"
                                                        style="pointer-events: none;"
                                                    >
                                                        {{ $genderLabel }}
                                                    </span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                             height="24" viewBox="0 0 24 24" fill="none"
                                                             stroke="currentColor" stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             class="h-6 w-6 text-neutral-950" aria-hidden="true">
                                                            <path d="m6 9 6 6 6-6"></path>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        data-gender-dropdown="mobile"
                                                        class="absolute left-0 right-0 mt-1 rounded-md border bg-white shadow-lg z-20 hidden"
                                                    >
                                                        <button
                                                            type="button"
                                                            data-gender-option="1"
                                                            class="block w-full text-left px-3 py-2 text-sm hover:bg-neutral-100"
                                                        >Nam
                                                        </button>
                                                        <button
                                                            type="button"
                                                            data-gender-option="2"
                                                            class="block w-full text-left px-3 py-2 text-sm hover:bg-neutral-100"
                                                        >Nữ
                                                        </button>
                                                        <button
                                                            type="button"
                                                            data-gender-option="3"
                                                            class="block w-full text-left px-3 py-2 text-sm hover:bg-neutral-100"
                                                        >Khác
                                                        </button>
                                                    </div>
                                                    <select
                                                        aria-hidden="true"
                                                        tabindex="-1"
                                                        name="gender"
                                                        id="gender_mobile"
                                                        class="hidden"
                                                    >
                                                        <option value="">Chọn giới tính</option>
                                                        <option
                                                            value="1" {{ (string)$genderValue === '1' ? 'selected' : '' }}>
                                                            Nam
                                                        </option>
                                                        <option
                                                            value="2" {{ (string)$genderValue === '2' ? 'selected' : '' }}>
                                                            Nữ
                                                        </option>
                                                        <option
                                                            value="3" {{ (string)$genderValue === '3' ? 'selected' : '' }}>
                                                            Khác
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-fit font-semibold text-neutral-900"
                                                    >Số điện thoại</label>
                                                    <div class="relative flex">
                                                        <input
                                                            disabled
                                                            class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                                            placeholder="Nhập số điện thoại"
                                                            type="text"
                                                            value="{{ $user && $user->phone ? $user->phone : '' }}"
                                                            name="phone_number"
                                                        >
                                                    </div>
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-fit font-semibold text-neutral-900"
                                                    >Email</label>
                                                    <div class="relative flex">
                                                        <input
                                                            disabled
                                                            maxlength="50"
                                                            class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                                            placeholder="Nhập email"
                                                            type="text"
                                                            value="{{ $user && $user->email ? $user->email : '' }}"
                                                            name="email"
                                                        >
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="fixed bottom-0 z-20 grid w-full gap-4 bg-white px-4 pb-4 pt-6 md:hidden">
                                                <button
                                                    id="saveMobileBtn"
                                                    data-size="lg"
                                                    disabled
                                                    type="submit"
                                                    class="relative flex justify-center outline-none font-semibold border-0 text-base px-6 py-3 h-13.5 items-center rounded-lg cursor-not-allowed bg-neutral-100 hover:bg-neutral-100 hover:text-neutral-600 focus:ring-neutral-100 text-neutral-600"
                                                >
                                                    <span>Lưu thay đổi</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

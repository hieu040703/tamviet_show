@extends('frontend.layout')

@section('content')
    <div id="mainContent" class="z-20 mx-auto min-h-screen bg-neutral-100 md:min-h-fit md:pt-0">
        <div class="flex flex-col gap-4 bg-neutral-100 pt-0 md:pt-4">
            <div class="md:container">
                <div class="grid gap-6 bg-white md:rounded-md">
                    <div>
                        <div
                            class="z-50 w-full content-start gap-4 px-4 py-2.5 pt-4 transition-colors md:hidden bg-emerald-500">
                            <div class="grid grid-flow-col items-center justify-between gap-4">
                                <a href="{{ route('homepage.index') }}"
                                   class="relative flex justify-center outline-none font-semibold text-sm bg-transparent border-0 text-white">
                                    <span class="p-icon inline-flex h-6 w-6 justify-center">
                                        <svg viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div
                            class="grid justify-between gap-4 px-4 py-6 pt-[calc(74rem/16)] md:grid-flow-col md:flex-row md:items-center md:gap-2 md:rounded-md md:px-6 md:py-3 bg-emerald-500">
                            <div
                                class="grid items-center justify-items-center gap-2 md:grid-flow-col md:justify-items-start md:gap-4">
                                <span
                                    class="p-icon inline-flex h-[calc(82rem/16)] w-[calc(82rem/16)] justify-center text-white md:h-[calc(72rem/16)] md:w-[calc(72rem/16)]">
                                    <svg viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M12.5 22C18.0228 22 22.5 17.5228 22.5 12C22.5 6.47715 18.0228 2 12.5 2C6.97715 2 2.5 6.47715 2.5 12C2.5 17.5228 6.97715 22 12.5 22ZM16.9205 8.82691C17.2256 9.13209 17.2256 9.62678 16.9205 9.9318L11.6794 15.173C11.3742 15.4781 10.8797 15.4781 10.5745 15.173L8.07953 12.6779C7.77435 12.3729 7.77435 11.8782 8.07953 11.5732C8.38455 11.268 8.87924 11.268 9.18427 11.5732L11.1269 13.5158L15.8156 8.82691C16.1208 8.52189 16.6154 8.52189 16.9205 8.82691Z"
                                              fill="currentColor"/>
                                    </svg>
                                </span>
                                <div class="grid gap-2 md:gap-0">
                                    <h3 class="text-center text-xl font-bold text-white md:text-start md:text-2xl">
                                        Gửi yêu cầu liên hệ thành công
                                    </h3>
                                    <p class="text-center text-sm font-semibold text-white md:text-start">
                                        Cảm ơn bạn đã để lại thông tin. Nhân viên của chúng tôi sẽ liên hệ
                                        lại trong thời gian sớm nhất qua số điện thoại bạn đã cung cấp.
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <a class="relative flex h-12 items-center justify-center truncate rounded-lg border border-neutral-200 bg-white px-5 py-2.5 text-base font-semibold hover:text-primary-500 md:h-9 md:px-3 md:py-2 md:text-xs"
                                   href="{{ route('cart.index') }}">
                                    <span>Quay lại giỏ hàng</span>
                                </a>
                                <a class="relative flex h-12 items-center justify-center truncate rounded-lg border border-neutral-200 bg-white px-5 py-2.5 text-base font-semibold hover:text-primary-500 md:h-9 md:px-3 md:py-2 md:text-xs"
                                   href="{{ url('/') }}">
                                    <span>Tiếp tục mua sắm</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mx-4 md:mx-6 pb-6">
                        <p class="mb-2 text-base font-semibold text-neutral-900">
                            Một vài lưu ý:
                        </p>
                        <ul class="grid list-disc gap-3 ps-6 marker:text-[12px]">
                            <li class="text-sm text-neutral-900">
                                Vui lòng giữ điện thoại bên mình, nhân viên tư vấn có thể gọi cho bạn trong giờ làm
                                việc.
                            </li>
                            <li class="text-sm text-neutral-900">
                                Nếu sau 24 giờ bạn chưa nhận được cuộc gọi, hãy liên hệ trực tiếp qua
                                hotline <strong>{{$system['contact_hotline'] ?? '092.686.5566'}}</strong> để được hỗ trợ.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

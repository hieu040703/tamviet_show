<div class="{{$hidden ?? null}}">
    <div class="w-full bg-neutral-200">
        <div class="hidden h-2 bg-primary-500 md:block"></div>
        <footer class="container pb-24 pt-4 text-sm md:pb-6">
            @include('frontend.layouts.partials.footer-menu-follow', ['menuKey' => 'footer-menu'])
            <div
                class="mt-3 w-full border-t border-neutral-300 pt-3 text-xs text-center md:mt-1"
            >
                <h4 class="text-[14px] leading-[20px] font-semibold text-center">
                    {{ $system['homepage_company'] ?? 'CÔNG TY CỔ PHẦN ĐẦU TƯ & THƯƠNG MẠI QUỐC TẾ TÂM VIỆT' }}
                </h4>

                <div class="mt-2 flex justify-center">
                    <div class="text-center">
                        <p>
                            GCNDKDN:
                            {{ $system['contact_address'] ?: '0108893581 do sở KH & ĐT TP. Hà Nội cấp ngày 10/09/2019.' }}
                        </p>
                        <p>
                            Trụ sở:
                            {{ $system['contact_office'] ?: '139 Đa Lộc, Thiên Lộc, Thành phố Hà Nội' }}
                        </p>
                        <p>
                            Điện thoại:
                            {{ $system['contact_hotline'] ?: '092.686.5566' }}
                            -
                            Email:
                            {{ $system['contact_email'] ?: 'duoctbyt@tamvietmed.com' }}
                        </p>
                        <p class="mt-2">
                            {{ $system['homepage_copyright'] ?: 'Copyright © 2025 Tamvietmed. Thiết kế bởi Tamvietmed.com' }}
                        </p>
                    </div>
                </div>
            </div>

        </footer>
    </div>
</div>

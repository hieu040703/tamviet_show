@php
    $shareUrl = $url ?? request()->fullUrl();
    $facebookShare = $socialLinks['facebook'] ?? ('https://www.facebook.com/sharer/sharer.php?u=' . $shareUrl);
    $zaloShare     = $socialLinks['zalo']     ?? $shareUrl;
@endphp

<div class="flex gap-2">
    <button data-size="sm" type="button"
            class="relative outline-none font-semibold border border-neutral-200 hover:bg-bg-white hover:text-primary-500 focus:text-primary-500 text-sm flex h-9 w-9 items-center justify-center rounded-full bg-neutral-200 p-0"
            data-share-facebook="{{ $facebookShare }}">
        <img class="h-5 w-5"
             src="https://prod-cdn.pharmacity.io/e-com/images/static-website/20240706163158-0-facebook.svg"
             alt="Share Facebook" loading="lazy">
    </button>
    <div
        class="zalo-share-button flex h-9 w-9 cursor-pointer items-center justify-center rounded-full bg-neutral-200 p-0"
        data-href="{{ $zaloShare }}"
        data-oaid="1123198001548302988"
        data-layout="1"
        data-color="blue"
        data-customize="true">
        <img class="h-4 w-4"
             src="https://prod-cdn.pharmacity.io/e-com/images/static-website/20240809162128-0-zalo.svg"
             alt="Share Zalo" loading="lazy">
    </div>
    <button
        type="button"
        class="relative border-0 text-sm font-normal text-hyperLink outline-none md:hover:text-primary-600 flex h-9 w-9 items-center justify-center rounded-full bg-neutral-200 p-0"
        data-copy-link="{{ $shareUrl }}"
        data-success-text="Đã sao chép liên kết bài viết!">

        <svg class="h-5 w-5 text-primary pointer-events-none" viewBox="0 0 24 24" fill="none">
            <path
                d="M19.89 4.112c-1.583-1.588-4.276-1.46-6.018.286l-3.94 3.95a4.466 4.466 0 0 0-.694.883c-.634 1.023-.84 2.207-.598 3.287a3.78 3.78 0 0 0 1.008 1.864c.248.248.524.452.818.617l1.475-1.479a1.21 1.21 0 0 0 .175-.225c-.33-.081-.64-.241-.892-.493-.53-.532-.674-1.308-.452-2.033.107-.352.31-.7.594-.984l3.94-3.95c.866-.87 2.22-.933 3.009-.143.788.79.724 2.148-.143 3.017l-1.912 1.918c.063.18.121.363.164.553.155.692.155 1.421.019 2.137l3.163-3.17c1.741-1.747 1.869-4.447.285-6.035Zm-5.538 5.506a3.71 3.71 0 0 0-.818-.617L12.06 10.48a1.214 1.214 0 0 0-.175.225c.33.081.64.241.892.493.53.532.674 1.308.452 2.033-.107.352-.31.7-.594.984l-3.94 3.95c-.866.869-2.22.933-3.009.143-.788-.79-.724-2.148.143-3.017l1.912-1.918a4.991 4.991 0 0 1-.164-.553 5.277 5.277 0 0 1-.019-2.137l-3.163 3.17C2.653 15.6 2.525 18.3 4.11 19.889s4.277 1.46 6.019-.286l3.94-3.95c.275-.276.506-.565.694-.883.634-1.023.84-2.207.598-3.287a3.782 3.782 0 0 0-1.008-1.864Z"
                fill="currentColor"></path>
        </svg>
    </button>
</div>

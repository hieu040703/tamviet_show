@php
    $cartCount = $cartCount ?? \Cart::count();
@endphp
<div class="container flex flex-col bg-white md:pt-6">

    @include('frontend.layouts.partials.header-mobile',['model' => $category])

    @if($category->children->count())
        <div class="fixed left-0 top-0 z-10 h-11 w-full bg-white block md:static md:z-auto">
            <div class="grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-0 md:px-0">
                <div class="flex">
                    <div class="flex w-6 items-center md:hidden">
                        <button class="h-6 p-0 text-neutral-900">
                            <span class="p-icon w-6 h-6">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M6.292 12.714L15.286 21.705c.395.394 1.035.394 1.431 0s.396-1.033 0-1.426L8.435 12l8.28-8.277c.395-.394.395-1.034 0-1.428s-1.036-.394-1.431 0L6.291 11.286c-.389.389-.389 1.039 0 1.428z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="grid flex-1 items-center text-center md:text-start">
                        <h1 class="text-[24px] font-bold leading-[32px] md:flex">
                            {{ $category->name }}
                        </h1>
                    </div>

                    <div class="md:hidden w-10"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4 pb-4 pt-4 md:grid-cols-[repeat(auto-fill,136px)] md:pb-6">
            @foreach($category->children as $child)
                <a
                    class="grid w-fit content-start justify-center gap-2"
                    href="{{ router_link('categories', $child->id) }}"
                >
                    <span
                        class="relative h-[76px] w-[76px] md:h-[136px] md:w-[136px] overflow-hidden rounded-full border border-primary-50"
                    >
                        <img
                            class="h-full w-full object-cover"
                            src="{{ $child->image ? asset('storage/'.$child->image) : asset('backend/img/not-found.jpg') }}"
                            alt="{{ $child->name }}"
                        >
                    </span>
                    <p class="line-clamp-2 text-center text-sm md:text-base font-medium text-neutral-900">
                        {{ $child->name }}
                    </p>
                </a>
            @endforeach
        </div>
    @endif
</div>

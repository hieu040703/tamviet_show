@extends('frontend.layout')

@section('content')
    @php
        $suffix = config('apps.general.suffix', '');
        $href   = $post->canonical
                    ? url($post->canonical . $suffix)
                    : request()->fullUrl();
    @endphp

    <div class="z-20 mx-auto bg-neutral-100">
        <div class="bg-white pt-11 md:pb-0 md:pt-4">
            @include('frontend.components.breadcrumb', ['items' => $breadcrumb ?? []])
            <div class="fixed left-0 top-0 z-10 h-11 w-full bg-white md:hidden">
                <div class="z-50 grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-4">
                    <div class="flex">
                        <div class="flex w-6 items-center">
                            <button data-size="sm" type="button"
                                    data-back-button="true"
                                    class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0 text-neutral-900">
                                        <span
                                            class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                            <svg viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                            </button>
                        </div>
                        <div class="grid flex-1 items-center text-center">
                            <h4 class="truncate px-2 text-base font-semibold text-neutral-900 md:text-2xl md:font-bold">
                                <div class="[&_a:not(.ignore-css_a)]:text-hyperLink inline">
                                    {{ $post->catalogue->name ?? 'Khác' }}
                                </div>
                            </h4>
                        </div>
                        <div class="relative block w-6 md:hidden">
                            <div class="flex">
                                <a
                                    href=""
                                    class="relative flex h-9 items-center justify-center p-0 text-sm font-semibold
                                           text-inherit bg-transparent border-0 outline-none
                                           hover:bg-0 hover:text-primary-500
                                           focus:text-primary-500 focus:ring-primary-300
                                           data-[size=sm]:text-sm"
                                >
                                    <span
                                        class="p-icon inline-flex w-6 h-6 max-h-full max-w-full
                                               justify-center align-[-0.125em]"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M15.5 15.4366C15.7936 15.143 16.2697 15.143 16.5634 15.4366L21.7798 20.7163C22.0734 21.01 22.0734 21.4861 21.7798 21.7797C21.4861 22.0734 21.01 22.0734 20.7164 21.7797L15.5 16.5C15.2064 16.2064 15.2064 15.7303 15.5 15.4366Z"
                                                fill="currentColor"
                                            ></path>
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M10.5 3.57732C6.67671 3.57732 3.57732 6.67671 3.57732 10.5C3.57732 14.3233 6.67671 17.4227 10.5 17.4227C14.3233 17.4227 17.4227 14.3233 17.4227 10.5C17.4227 6.67671 14.3233 3.57732 10.5 3.57732ZM2 10.5C2 5.80558 5.80558 2 10.5 2C15.1944 2 19 5.80558 19 10.5C19 15.1944 15.1944 19 10.5 19C5.80558 19 2 15.1944 2 10.5Z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white">
                <div class="md:container md:flex md:justify-center">
                    <div class="lg:flex lg:gap-8">
                        <div class="flex flex-col items-center">
                            <div class="container max-w-[868px] py-4 md:py-6">
                                <h1 class="mb-4 text-[24px] font-bold leading-[32px]">
                                    <div class="[&_a:not(.ignore-css_a)]:text-hyperLink">
                                        {{ $post->name ?? '' }}
                                    </div>
                                </h1>

                                <div class="mb-4 flex items-center gap-2">
                                    <a class="contents" href="/goc-suc-khoe/lam-dep">
                                        <span
                                            class="rounded-sm bg-neutral-800 px-1 py-[2px] text-xs font-medium text-white"
                                        >
                                            <div class="[&_a:not(.ignore-css_a)]:text-hyperLink">
                                                {{ $post->catalogue->name ?? '' }}
                                            </div>
                                        </span>
                                    </a>
                                    <span class="text-[14px] leading-[20px]">
                                        {{ optional($post->created_at)->format('d/m/Y') }}
                                    </span>
                                </div>

                                @include('frontend.components.share-buttons', ['url' => $href])

                                <div class="mb-4 mt-4 md:mb-6">
                                    {!! $post->content ?? '' !!}
                                </div>
                            </div>

                            @include('frontend.components.post-related', ['relatedPosts' => $relatedPosts])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/assets/js/share-buttons.js') }}"></script>
@endpush

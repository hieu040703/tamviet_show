@extends('frontend.layout')

@section('content')
    @php
        $suffix = config('apps.general.suffix', '');
        $href = $post->canonical ? url($post->canonical . $suffix) : request()->fullUrl();
    @endphp
    <div class="z-20 mx-auto bg-neutral-100">
        <div class="bg-white pt-11 md:pb-0 md:pt-4">
            @include('frontend.components.breadcrumb', ['items' => $breadcrumb ?? []])
            <div class="bg-white">
                <div class="md:container md:flex md:justify-center">
                    <div class="lg:flex lg:gap-8 ">
                        <div class="flex flex-col items-center">
                            <div class="container max-w-[868px] py-4 md:py-6">
                                <h1 class="text-[24px] font-bold leading-[32px] mb-4">
                                    <div class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink">
                                        {{$post->name ?? ''}}
                                    </div>
                                </h1>
                                <div class="mb-4 flex items-center gap-2"><a class="contents"
                                                                             href="/goc-suc-khoe/lam-dep"><span
                                            class="rounded-sm px-1 py-[2px] text-xs font-medium bg-neutral-800 text-white"><div
                                                class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink">{{$post->catalogue->name ?? ''}}</div></span></a><span
                                        class="text-[14px] leading-[20px]">{{ optional($post->created_at)->format('d/m/Y') }}</span>
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

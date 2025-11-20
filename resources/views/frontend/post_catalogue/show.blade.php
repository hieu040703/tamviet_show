@extends('frontend.layout')

@section('content')
    <div class="z-20 mx-auto bg-neutral-100">
        <div class=" pt-11 md:pb-0 md:pt-4">
            @include('frontend.components.breadcrumb', ['items' => $breadcrumb ?? []])
            @include('frontend.post_catalogue.partials.header', ['catalogue' => $catalogue])
            <div class="mb-4 md:container md:flex">
                <div class="flex-1 md:mr-4 md:mt-4">
                    <div class="grid bg-white px-4 md:gap-4 md:bg-transparent md:px-0">
                        <div id="post-list" class="contents-post-list">
                            @include('frontend.post_catalogue.partials.list', ['posts' => $posts])
                        </div>
                        @if($posts->hasMorePages())
                            <div class="flex justify-center bg-white pb-2 md:bg-transparent md:pb-0">
                                <button
                                    id="load-more"
                                    data-url="{{ request()->url() }}"
                                    data-page="2"
                                    class="relative flex justify-center border-0 bg-transparent text-sm font-normal text-hyperLink outline-none md:hover:text-primary-600 md:text-base"
                                    type="button">
                                    Xem thêm
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-neutral-100 h-2 md:hidden"></div>
                <div class="md:mt-4 md:w-[288px]">
                    <div class=" mb-2 bg-white p-4 pt-4 md:rounded-md md:p-6 md:pt-4">
                        <div class="flex items-center p-4 px-0 pt-0">
                            <h4 class="font-semibold flex-1 text-base md:text-[20px]">Chuyên mục nổi bật</h4>
                        </div>
                        <div class="-m-2 grid grid-cols-2 md:block">
                            @if(!empty($postCatalogues) && count($postCatalogues))
                                @php
                                    $suffix = config('apps.general.suffix', '');
                                @endphp
                                @foreach($postCatalogues as $postCatalogue)
                                    @php
                                        $image = $postCatalogue->image ? asset('storage/' . $postCatalogue->image) : asset('backend/img/not-found.jpg');
                                        $href = $postCatalogue->canonical ? url($postCatalogue->canonical . $suffix)  : '#';
                                    @endphp
                                    <a class="mx-2 mb-4 mt-2 flex rounded-xl p-2 shadow-lg"
                                       href="{{$href}}">
                                        <div class="mr-2 h-[38px] w-[38px] md:h-[62px] md:w-[62px]">
                                            <img
                                                src="{{$image}}"
                                                alt="{{$postCatalogue->name ?? ''}}"
                                                loading="lazy"
                                                width="500"
                                                height="500">
                                        </div>
                                        <div
                                            class=" flex flex-1 flex-col items-start justify-center text-sm md:text-[18px] md:leading-[28px]">
                                            <div class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink line-clamp-1">
                                                {{$postCatalogue->name ?? ''}}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/assets/js/post-load-more.js') }}"></script>
@endpush



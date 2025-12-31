@extends('frontend.layout')
@section('content')
    <div id="mainContent" class="z-20 mx-auto bg-white pt-[46px] md:pb-0 md:pt-4">
        <div>
            <div class="flex w-full flex-col md:flex-col-reverse">
                @include('frontend.layouts.partials.banner')
            </div>
            <div></div>
            @include('frontend.components.featured-categories',compact('homeCategories'))
            @include('frontend.components.deal',compact('homeProductCategories','homeProductCategories1'))
            @include('frontend.components.featured-brands',compact('homeProductBrands'))
            @include('frontend.components.disease-lookup', compact('healthCategories','featuredArticle'))
            @include('frontend.components.featured-video',compact('featured_videos','featured_videos_1'))
{{--            @include('frontend.components.featured-short-video',compact('featured_short_videos'))--}}
            @include('frontend.components.service-icons')
        </div>
    </div>
@endsection
@push('scripts')

@endpush


@extends('frontend.layout')
@section('content')
    <div id="mainContent" class="z-20 mx-auto bg-white pt-[46px] md:pb-0 md:pt-4">
        <div>
            <div class="flex w-full flex-col md:flex-col-reverse">
                @include('frontend.layouts.partials.banner')
            </div>
            <div></div>
            <div class="bg-neutral-100 h-3"></div>
            @include('frontend.components.deal',compact('homeProductCategories'))
            @include('frontend.components.featured-brands',compact('homeProductBrands'))
            @include('frontend.components.featured-categories',compact('homeCategories'))
            @include('frontend.components.disease-lookup', compact('healthCategories','featuredArticle'))
        </div>
    </div>
@endsection
@push('scripts')

@endpush


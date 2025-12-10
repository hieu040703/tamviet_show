@extends('frontend.layout')
@section('content')
<<<<<<< HEAD
    <div>
        <div class="flex w-full flex-col md:flex-col-reverse">
            @include('frontend.layouts.partials.banner')
        </div>
        <div></div>
        <div class="bg-neutral-100 h-3"></div>
        @include('frontend.components.deal')
        @include('frontend.components.featured-brands')
        @include('frontend.components.featured-categories')
        @include('frontend.components.top-brands')
        @include('frontend.components.best-sellers')
        @include('frontend.components.disease-lookup')
=======
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
            @include('frontend.components.disease-lookup', compact('healthCategories'))
        </div>
>>>>>>> hieu/update-feature
    </div>
@endsection
@push('scripts')

@endpush


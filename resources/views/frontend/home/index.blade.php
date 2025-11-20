@extends('frontend.layout')
@section('content')
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
    </div>
@endsection
@push('scripts')

@endpush


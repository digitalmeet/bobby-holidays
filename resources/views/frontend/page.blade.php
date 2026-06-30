@extends('frontend.layouts.app')

@section('title', ($page->meta_title ?? $page->title) . ' — UniWorld Holidays')
@section('meta_description', $page->meta_description ?? '')
@section('og_image_meta')
@if($page->og_image)<meta property="og:image" content="{{ asset('storage/' . $page->og_image) }}">@endif
@endsection

@section('content')
    @include('frontend.components.page-banner', ['title' => $page->title, 'subtitle' => ''])

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="h2 fw-bold mb-4" style="color:#064f68;">{{ $page->title }}</h1>
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-4 p-lg-5">
                            <div class="content-body">
                                {!! $page->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.components.cta')
@endsection

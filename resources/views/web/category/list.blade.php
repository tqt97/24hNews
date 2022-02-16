@extends('layouts.web')
@section('styles')
    <link rel="stylesheet" href="{{ asset('web/assets/css/custom.css') }}">
@endsection
@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Danh mục</h4>
                            <h2>Tất cả danh mục</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="blog-posts grid-system">
        <div class="container">
            {{-- <div class="row"> --}}
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-lg-6">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{ $category->cate_image }}" alt="{{ $category->name }}">
                                    </div>
                                    <div class="down-content">
                                        <a href="{{ route('categories.show', $category->slug) }}">
                                            <h4>{{ $category->name }}</h4>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12">
                            <ul class="page-numbers">
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @include('web.partials.category-menu') --}}
            {{-- </div> --}}
        </div>
    </section>
@endsection

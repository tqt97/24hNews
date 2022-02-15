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
                            <h2>{{ $category->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @forelse ($posts as $post)
                                <div class="col-lg-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="{{ $post->post_image }}" alt="{{ $post->title }}">
                                        </div>
                                        <div class="down-content">
                                            <a href="{{ route('posts.show', $post->slug) }}">
                                                <h4>{{ $post->limitTitle() }}</h4>
                                            </a>
                                            <ul class="post-info">
                                                <li><i class="fa fa-clock-o"></i> {{ $post->created_at }}</li>
                                            </ul>
                                            @foreach ($post->post_category as $item)
                                                <span class="badge badge-primary">{{ $item->name }}</span>
                                            @endforeach
                                            <p>{{ $post->limitDescription() }}</p>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3>Không có bài viết</h3>
                            @endforelse
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
                @include('web.partials.sidebar')
            </div>
        </div>
    </section>
@endsection

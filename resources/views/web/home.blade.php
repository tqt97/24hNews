@extends('layouts.web')
@section('styles')
    <link rel="stylesheet" href="{{ asset('web/assets/css/custom.css') }}">
@endsection
@section('content')
    @include('web.partials.banner')
    <section class="blog-posts">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @forelse ($posts as $post)
                                <div class="col-lg-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="{{ $post->getFirstMediaUrl('posts', 'thumb') }}"
                                                alt="{{ $post->title }}">
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
                        </div>
                    </div>
                </div>
                @include('web.partials.sidebar')
            </div>
        </div>
    </section>
@endsection

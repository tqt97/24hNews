@extends('layouts.web')

@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Tag</h4>
                            <h2>{{ $tag->name }}</h2>
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
                            @foreach ($posts as $post)
                                <div class="col-lg-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="{{ $post->post_image }}" alt="{{ $post->title }}">
                                        </div>
                                        <div class="down-content">
                                            @foreach ($post->post_category as $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                            <a href="{{ route('posts.show', $post->slug) }}">
                                                <h4>{{ $post->limitTitle() }}</h4>
                                            </a>
                                            <ul class="post-info">
                                                <li><a href="#">{{ $post->author_name }}</a></li>
                                                <li><a href="#">{{ $post->created_at }}</a></li>
                                                <li><a href="#">12 Comments</a></li>
                                            </ul>
                                            <p>{{ $post->limitDescription() }}</p>
                                            <div class="post-options">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-tags"></i></li>
                                                            @foreach ($post->tags as $tag)
                                                                <li><a href="{{ route('tags.show',$tag->id) }}">{{ $tag->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <ul class="post-share">
                                                            <li><i class="fa fa-share-alt"></i></li>
                                                            <li><a href="#">Facebook</a>,</li>
                                                            <li><a href="#"> Twitter</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
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
                @include('web.partials.sidebar')
            </div>
        </div>
    </section>
@endsection

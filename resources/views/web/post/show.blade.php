@extends('layouts.web')

@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Bài viết</h4>
                            <h2>{{ $post->title }}</h2>
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
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{ $post->getFirstMediaUrl('posts', 'main') }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="down-content">
                                        @foreach ($post->post_category as $item)
                                            <span>{{ $item->name }}</span>
                                        @endforeach
                                        <a href="post-details.html">
                                            <h4>{{ $post->title }}</h4>
                                        </a>
                                        <ul class="post-info">
                                            <li><a href="#">{{ $post->author_name }}</a></li>
                                            <li><a href="#">{{ $post->created_at }}</a></li>
                                            <li><a href="#">{{ $post->comment_count }} <i class="fa fa-comments"></i>    </a></li>
                                        </ul>
                                        <p>{!! $post->content !!}</p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i></li>
                                                        @foreach ($post->tags as $tag)
                                                            <li class="badge badge-default">
                                                                <a href="{{ route('tags.show',$tag->slug) }}">{{ $tag->name }}</a>
                                                            </li>
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
                            <div class="col-lg-12">
                                <div class="sidebar-item comments">
                                    <div class="sidebar-heading">
                                        <h2>{{ $post->comment_count }} bình luận</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                        @foreach ($post->comments as $comment)
                                            <li>
                                                <div class="author-thumb">
                                                    <img src="{{ asset('web/assets/images/comment-author-01.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="right-content">
                                                    <h4>{{ $comment->author_name }}
                                                        <span>{{ $comment->created_at }}</span>
                                                    </h4>
                                                    <p>{{ $comment->content }}
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="replied">
                                                {{-- <div class="author-thumb">
                                                    <img src="{{ asset('web/assets/images/comment-author-02.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="right-content">
                                                    <h4>Thirteen Man<span>May 20, 2020</span></h4>
                                                    <p>In porta urna sed venenatis sollicitudin. Praesent urna sem, pulvinar
                                                        vel mattis eget.
                                                    </p>
                                                </div> --}}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item submit-comment">
                                    <div class="sidebar-heading">
                                        <h2>Bình luận</h2>
                                    </div>
                                    @guest
                                        <div class="content">
                                            <p class="alert alert-primary">
                                                Bạn cần đăng nhập để bình luận. Đăng nhập
                                                <a href="{{ route('login') }}">tại đây</a>
                                            </p>
                                        </div>
                                    @else
                                        <div class="content">
                                            <form id="comment" action="{{ route('comments.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Nội dung bình luận :</label>
                                                            <textarea name="content" id=""
                                                                class="form-control @error('content') is-invalid @enderror"
                                                                rows="5"
                                                                placeholder="Nhập nội dung">{{ old('content') }}</textarea>

                                                            @error('content')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <button type="submit" id="form-submit" class="main-button">Bình
                                                                luận</button>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endguest
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @include('web.partials.sidebar')
            </div>
        </div>
    </section>
@endsection

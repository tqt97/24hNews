<div class="col-lg-4">
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item search">
                    <form method="GET" action="{{ route('search') }}">
                        <div class="search2">
                            <input type="text" name="keyword" id="search" placeholder="Nhập từ khóa ..."
                                value="{{ request('keyword') }}" class="search2__input">
                            <button type="submit" class="search2__button" tabIndex="-1">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                        <h2>
                            <i class="fa fa-bookmark"></i>
                            Bài viết gần đây
                        </h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach ($postView as $post)
                                <li>
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        <h5>
                                            {{ $post->limitTitle() }}
                                        </h5>
                                        <span>{{ $post->created_at }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                        <h2>
                            <i class="fa fa-list"></i>
                            Danh mục
                        </h2>
                    </div>
                    <div class="content">
                        <ul class="tags">
                            @foreach ($categoryView as $category)
                                <li>
                                    <a href="{{ route('categories.show', $category->slug) }}" class="tag">
                                        {{ $category->name }}
                                        <span class="badge badge-warning">{{ $category->posts->count() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                        <h2>
                            <i class="fa fa-tag"></i>
                            Tags
                        </h2>
                    </div>
                    <div class="content">
                        <ul class="tags">
                            @foreach ($tagView as $tag)
                                <li>
                                    <a href="{{ route('tags.show', $tag->slug) }}" class="tag" title="{{ $tag->name}}">
                                        {{ $tag->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

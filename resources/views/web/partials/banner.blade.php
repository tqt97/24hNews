<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @forelse ($sliders as $slider)
                <div class="item">
                    <img src="{{ $slider->slider_image }}" alt="{{ $slider->title }}">
                    <div class="item-content">
                        <div class="main-content">
                            <div class="meta-category">
                                <span>Fashion</span>
                            </div>
                            <a href="{{ $slider->url }}">
                                <h4>{{ $slider->title }}</h4>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>

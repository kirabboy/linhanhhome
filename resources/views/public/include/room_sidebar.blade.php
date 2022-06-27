<div class="blog-grid-auth mb-3">
    <a href="{{ route('blog.show', $room->slug) }}">
        <div class="row">
            <div class="col col-lg-12 col-md-4 col-12">
                <img src="{{ asset($room->avatar) }}" onerror="this.onerror=null;this.src='{{ asset(config('custom.default-image')) }}';" alt="" style="width: 100%;">
            </div>
            <div class="col col-lg-12 col-md-8 col-12">
                <h4>{{ $room->name_blog }}</h4>
            </div>
        </div>
    </a>
</div>
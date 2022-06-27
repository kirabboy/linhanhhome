<div class="blog-grid-home">
    <a href="{{ route('blog.show', $room->slug) }}">
        <div class="row">
            <div class="col col-lg-3 col-md-4 col-12">
                <img src="{{ asset($room->avatar) }}"  onerror="this.onerror=null;this.src='{{ asset(config('custom.default-image')) }}';" alt="" style="width: 100%;">
            </div>
            <div class="col col-lg-9 col-md-8 col-12">
                <h4>{{ $room->name_blog }}</h4>
                <div>
                    <div class="left">
                        <div><i class="fal fa-home-lg-alt"></i> 
                        <span>{{ config('custom.room.type')[$room->type] }}</span>
                        </div>
                        <div>
                            <i class="fal fa-sack-dollar"></i> 
                            <span class="mr-3">{{ number_format($room->price).config('custom.currency') }}</span>
                            <i class="fal fa-ruler"></i>
                            <span>{{ $room->acreage }}m<sup>2</sup></span>
                        </div>
                        <div><i class="fal fa-map-marked-alt"></i> 
                            <span>{{ optional($room->building)->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
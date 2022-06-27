@foreach ($building->floor as $floor)
    @if (isset($status))
        @include(
            'admin.room.include.block_floor',
            compact('floor', 'building', 'status')
        )
    @else
        @include(
            'admin.room.include.block_floor',
            compact('floor', 'building')
        )
    @endif
@endforeach

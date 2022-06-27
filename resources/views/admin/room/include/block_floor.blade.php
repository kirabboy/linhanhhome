<div class="row pb-2">
    <div class="col-6 col-sm-3">
        <div class="card p-2">
            <h6>{{ $floor['name'] }}</h6>
            <button onclick="createRoom(this)" id="" class="btn-create-room btn btn-success p-1 text-12" style="width: 25% !important"
                data-url="{{ route('phong.create') }}" data-building_id="{{ $building->id }}"
                data-floor_id="{{ $floor['id'] }}">
                <i class="fa fa-plus"></i></button>
            <p class="border-bottom pt-2 m-0"></p>
            <div class="progress" style="width: 100%; margin-top: 10px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $floor['ratio']}}%" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100">{{ round($floor['ratio'])}}%</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-9">
        <div class="row list-room-{{ $floor['id'] }}">
            {{-- @if (isset($status))

                @foreach ($floor->room()->whereStatus($status)->get()
    as $item)
                    @include('admin.room.include.room_unit', ['room' => $item])
                @endforeach
            @else --}}
                @foreach ($floor['room'] as $item)
                    @if (isset($status))
                        @if($item->status == $status)
                            @include('admin.room.include.room_unit', ['room' => $item])
                        @endif
                    @else
                        @include('admin.room.include.room_unit', ['room' => $item])
                    @endif
                @endforeach
            {{-- @endif --}}
        </div>

    </div>
</div>

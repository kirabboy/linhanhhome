<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomManagerController extends Controller
{
    //
    public function showQuickly(Room $room){
        $room = (object) $room->only('id', 'name', 'code', 'status', 'acreage', 'type');
        return view('admin.manager_building.modal.show_quickly_room', ['room' => $room])->render();
    }
}

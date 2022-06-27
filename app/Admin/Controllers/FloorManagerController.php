<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Admin\Requests\FloorRequest;

class FloorManagerController extends Controller
{
    //

    public function edit(Floor $floor){
        $floor = (object) $floor->only('id', 'name', 'code');
        return view('admin.manager_building.modal.edit_floor', ['floor' => $floor])->render();

    }

    public function update(FloorRequest $request){
        $floor = Floor::find($request->id);
        $data = $request->only('name', 'code');
        $floor->update($data);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thành công',
            'data' => $floor->name
        ]);
    }

    public function delete(Request $request, Floor $floor){
        $floor->delete();
        if($request->ajax()){
            return response()->json(['status' => 'success', 'id' => $floor->id]);
        }
    }
}

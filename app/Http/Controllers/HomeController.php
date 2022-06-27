<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Room;
use App\Models\Building;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = Cache::remember('room_home', now()->minutes(60), function(){
            return Room::select('id', 'building_id', 'name_blog', 'acreage', 'status', 'type', 'price', 'slug', 'avatar')->whereNotIn('status', [3])->with('building:id,address')->orderBy('id', 'desc')->limit(4)->get();
        });
        $buildings = Cache::remember('building_home', now()->minutes(60), function(){
            return Building::select('id', 'slug', 'name', 'avatar', 'address')->orderBy('id', 'desc')->get();
        });
        // dd($buildings);
        $rooms_empty = $rooms->where('status', 0);
        
        return view('public.home', compact('rooms', 'rooms_empty', 'buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

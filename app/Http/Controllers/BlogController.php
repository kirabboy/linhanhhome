<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Room;
use App\Models\Building;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Room::select('id', 'building_id', 'name_blog', 'acreage', 'status', 'type', 'price', 'slug', 'avatar')->whereNotIn('status', [3])->with('building:id,address')->orderBy('id', 'desc');

        $result = $this->filter('blog_index', $query, $request);
        
        $rooms = $result['rooms'];
        $price_min = $result['price_min'];
        $price_max = $result['price_max'];
        $type = $result['type'];

        return view('public.blog_list', compact('rooms', 'price_min', 'price_max', 'type'));

    }

    public function building(Request $request, $slug){
        $building = Building::select('id')->whereSlug($slug)->first()->id;

        $query = Room::select('id', 'building_id', 'name_blog', 'acreage', 'status', 'type', 'price', 'slug', 'avatar')->whereNotIn('status', [3])->whereBuildingId($building)->with('building:id,address')->orderBy('id', 'desc');

        $result = $this->filter('blog_building'.$slug, $query, $request);
        // dd($result);
        $rooms = $result['rooms'];
        $price_min = $result['price_min'] ?? 0;
        $price_max = $result['price_max'] ?? 0;
        $type = $result['type'];

        return view('public.blog_list', compact('rooms', 'price_min', 'price_max', 'type'));
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
    public function show($slug)
    {
        //
        $room =  Cache::remember('blog_detail'.$slug, now()->minutes(60), function () use ($slug){
            return Room::select('id', 'building_id', 'name_blog', 'avatar', 'price', 'acreage', 'type', 'asset', 'description', 'created_at')->whereSlug($slug)->with('building:id,name,slug,owner,owner_phone,address,messenger,google_map')->first();
        });
        if($room){

            return view('public.blog_detail', compact('room'));
        }
        return abort(404);
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

    public function filter($remember_name, $query, $request){

        $cache = Cache::remember($remember_name, now()->minutes(60), function () use ($query){
            return $query->get();
        });

        $type = $cache->pluck('type')->unique();
        $price_min = $cache->min('price');
        $price_max = $cache->max('price');

        if ($request->filled('type')) {
            $query = $query->whereIn('type', $request->type);
            
        }

        if ($request->filled('price_min')) {
            $query = $query->where('price', '>=', $request->price_min);
            
        }
        if ($request->filled('price_max')) {
            $query = $query->where('price', '<=', $request->price_max);
        }

        $rooms = $query->paginate(4);
        return [
            'rooms' => $rooms,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'type' => $type
        ];
    }
}

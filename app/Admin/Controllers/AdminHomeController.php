<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Building;
use App\Models\Contract;
use Illuminate\Support\Facades\Artisan;

class AdminHomeController extends Controller
{

    // ->middleware('permission:Bảng quản trị,admin')
    public function __construct()
    {
        $this->middleware('permission:Bảng quản trị,admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Artisan::call('schedule:run');
        $admin = auth()->guard('admin')->user();
        $building = Building::select('id', 'name');
        //check admin full quyền
        if(!$admin->hasRole(config('custom.role-admin'))){

            $building = $building->whereAdminId('admin_id', $admin->id);

        }
        //thực hiện truy vấn dữ liệu
        $building = $building->with(['room' => function($query) {
            $query->select('id', 'building_id', 'status');
            $query->with(['contract' => function($query) {
                $query->select('id', 'id_room');
                $query->with(['invoices' => function($query) {
                    $query->select('id', 'id_contract', 'date_create', 'total');
                }]);
            }]);
        }])->get();

        //thống kê tình trạng phòng
        $room = $building->map(function ($item){
            return $item->room->map(function ($item){
                return $item->status;
            })->flatten();
        })->flatten()->countBy();
        $marco = [$room[0] ?? 0, $room[2] ?? 0, $room[1] ?? 0, $room[3] ?? 0];

        //marco dữ liệu
        $building = $building->map(function($item) {
            $invoices = $item->room->map(function($item){
                return $item->contract->map(function($item){
                    return $item->invoices->flatten();
                });
            })->flatten();
            return collect($item->only('id', 'name'))->merge(['invoices' => $invoices]);
        });
        
        //Thống kê doanh thu từng tòa nhà theo tháng
        $statistic_building = $building->map(function ($item) {
            $invoices = collect($item['invoices'])->map(function ($item){
                return collect($item)->merge(['date_create' => $item->date_create->month]);
            })->groupBy('date_create')->map(function ($item){
                return $item->sum('total');
            });

            //Lấy tháng hiện tại
            $key_max = now()->format('m');
            $collect = collect();
            for ($i = 1; $i <= $key_max; $i++) {
                $collect->put($i, $invoices->get($i, 0));
            }
            return collect($item->only('id', 'name'))->merge(['invoices' => $collect->values()->all()]);
        });
        // return $building[5]; 
        // return $building[5]['invoices'];
        // $room = Room::select('status')->get();
        // $room = $room->countBy('status');
        
        //Thống kê theo tháng
        $statistic_all = collect()->range(0, now()->format('m') - 1)->map(function ($item){
            return 0;
        });
        $statistics_quarterly = collect()->range(0, 11)->map(function ($item){
            return 0;
        });
        $statistics_quarterly = $statistics_quarterly->map(function ($item) {
            return 0;
        });

        foreach($statistic_building as $key => $item){
            foreach($item['invoices'] as $key1 => $value){
                    $statistic_all[$key1] += $value;
                    $statistics_quarterly[$key1] += $value;
            }
        }
        $statistic_all = $statistic_all->all();
        //Thống kê theo quý        
        $statistics_quarterly = $statistics_quarterly->chunk(3);
        $statistics_quarterly = $statistics_quarterly->map(function ($item) {
            return $item->sum();
        });
        $statistics_quarterly = $statistics_quarterly->all();


        return view('admin.home', compact('marco', 'statistic_building', 'statistic_all', 'statistics_quarterly'));
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

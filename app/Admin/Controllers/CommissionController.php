<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\Contract;
use App\Models\Setting;
use App\Models\Admin;

class CommissionController extends Controller
{
    //
    public function index(){
        $commission = Commission::query();
        $admin = auth()->guard('admin')->user();
        //check admin full quyền
        if(!$admin->hasRole(config('custom.role-admin'))){

            $admin_id = $admin->id;
            $admin_id = Admin::whereParentId($admin_id)->pluck('id')->push($admin_id);
            $commission = $commission->whereIn('admin_id', $admin_id);

        }
        $commission = $commission->with([
            'admin' => function ($query){
                $query->select('id', 'username');
            },
            'contract' => function ($query){
                $query->select('id', 'code', 'name', 'id_room');
                $query->with(['room' => function ($query){
                    $query->select('id', 'building_id', 'floor_id','name');
                    $query->with('building:id,name');
                    $query->with('floor:id,name');
                }]);
            }
        ])->orderBy('id', 'desc')->get();
        // dd($commission);

        return view('admin.commission.index', compact('commission'));
    }

    public function add($contract_id = null){
        if($contract_id == null){
            return false;
        }
        $contract = Contract::select('id')->whereId($contract_id)->with(['customers' => function($query){
            $query->select('admin_id');
            $query->whereIsRepresentative(1);
            $query->first();
        }, 'contractinfo:id_contract,price_room'])->first();
        if(!$contract){
            return false;
        }
        $setting = Setting::where('key', 'percent_commission')->first();
        $data = [
            'admin_id' => $contract->customers[0]->admin_id,
            'contract_id' => $contract_id,
            'amount' => $contract->contractinfo->price_room * floatval($setting->value['percent']) /100
        ];
        if(Commission::create($data)){
            return true;
        }
        return false;
    }

    public function multiple(Request $request){

        $this->validate($request, 
        [
            'action' => ['required', 'in:0,1']
        ],
        [
            'action.required' => 'Bạn chưa chọn hành động nào',
            'action.in' => 'Bạn chọn hành động không hợp lệ'
        ]
        );
        
        Commission::whereIn('id', $request->id)->update(['status' => $request->action]);

        return back()->with('success', 'Thực hiện thành công');
    }
}

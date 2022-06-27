<?php

namespace App\Admin\Controllers;

use App\Models\Room;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\ContractInfo;
use Illuminate\Http\Request;
use App\Models\ContractCustomer;
use App\Http\Controllers\Controller;
use App\Models\ContractServiceDetail;
use App\Admin\Requests\ContractRequest;
use App\Admin\Controllers\CommissionController;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contracts = Contract::with('contractinfo')->with('room')->latest()->get();
        return view('admin.contract.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function managerContractExpired(){
        $contracts = Contract::whereStatus(1)->latest()->get();
        $day = date('d');
        $array = [];
        foreach($contracts as $contract){ 
            if(!$contract->invoices()->where('month',date('m'))->first()){
                if(intval(date('d', strtotime($contract->time_charge)) - intval($day)) < 10){
                    $contract->day_remaining = date('d', strtotime($contract->time_charge)) - $day;

                    array_push($array, $contract);
                }
            }
        }
        return view('admin.contract.expired', ['contracts' => $array]);

    }         

    public function create(Request $request)
    {
        //
        $room = Room::whereId($request->room_id)->first();
        if($room->contract()->whereType(1)->whereStatus(0)->first()){
            return response()->json(['status' => false, 'message'=> 'Phòng đã có hợp đồng đang chờ duyệt']);

        }elseif($room->contract()->whereType(1)->whereStatus(1)->first()){
            return response()->json(['status' => false, 'message'=> 'Phòng đã có hợp đồng đang còn hiệu lực']);
        }elseif($room->status == 3){
            return response()->json(['status' => false, 'message'=> 'Phòng đã ngưng sử dụng']);
        }
        $contract_earnest = $room->contract()->with('contractinfo')->whereType(2)->whereStatus(1)->first();
       
        return response()->json(['status' => true, 'message'=> view('admin.contract.modal.create_contract', compact('room', 'contract_earnest'))->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
        //
        $room = Room::whereId($request->id_room)->first();
        $contract = Contract::create( $request->all());
        $request->id_contract = $contract->id;
        $request->amount_earnest = ($request->is_earnest == 1 ) ? $request->amount_earnest : 0;
        $contract_info = ContractInfo::create(
            $request->all()
        );
        $contract_info->id_contract = $contract->id;
        $contract_info->save();
        foreach($request->customer_ids as $id){
            ContractCustomer::create([
                'id_contract' =>$contract->id,
                'is_representative' => ($id == $request->is_representative) ? 1:0,
                'id_customer' => $id,
                'note' => $_POST['note'.$id],
            ]);
        }
        ContractServiceDetail::create([
            'id_contract' => $contract->id,
            'type' => 1,
            'month' => date('m'),
            'year' => date('Y'),
        ]);
        if($contract_info->type_water == 2){
            ContractServiceDetail::create([
                'id_contract' => $contract->id,
                'type' => 2,
                'month' => date('m'),
                'year' => date('Y'),
            ]);
        }
        // $room->status = 2;
        // $room->save();
        $status = 0;
        if(auth()->guard('admin')->user()->roles()->where('name',config('custom.role-admin'))->first()){
            $room->status = 2;
            $room->save();
            $commissionController = new CommissionController();
            $result = $commissionController->add($contract->id);
            $status = 2;
        }
        $contracts = $room->contract();
        $current_contract = $contract;
        $html_contract = view('admin.contract.include.show_quickly', compact('current_contract'))->render();
        $html_room =  view('admin.room.show', compact('room','current_contract'))->render();
        $html_room_contract_history = view('admin.room.include.room_contract_history', compact('contracts'))->render();
        $html_service_detail = view('admin.service_detail.show', ['current_contract' => $contract])->render();
        return response()->json(['message' => 'Thêm hợp đồng thành công','status'=>$status,'html_room' => $html_room, 'html_service_detail'=>$html_service_detail, 'html_contract' => $html_contract, 'html_contract_history' => $html_room_contract_history]);
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
        $contract = Contract::whereId($id)->with('contractinfo')->with('room')->first();
        return view('admin.contract.modal.edit_contract', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id)
    {
        $contract = Contract::whereId($id)->first();
        Contract::whereId($id)->update($request->only('code', 'name', 'time_start', 'time_end', 'time_charge', 'is_earnest', 'note'));
        $contract_info = $contract->contractinfo()->first();
        $contract_info->update($request->only('number_room', 'price_room', 'note_room', 'number_electric',
         'price_electric', 'note_electric', 'number_water', 'price_water','note_water', 
         'number_service', 'price_service', 'note_service'));
        $contract->contract_customer()->delete();
        foreach($request->customer_ids as $id_customer){

            ContractCustomer::create([
                'id_contract' =>$contract->id,
                'is_representative' => ($id_customer == $request->is_representative) ? 1:0,
                'id_customer' => $id_customer,
                'note' => $request->get('note'.$id_customer),
            ]);
        }
        $room = $contract->room()->first();
        $contracts = $room->contract();
        $current_contract = Contract::whereId($id)->first();
        $html_contract = view('admin.contract.include.show_quickly', compact('current_contract'))->render();
        $html_room =  view('admin.room.show', compact('room','current_contract'))->render();
        $html_room_contract_history = view('admin.room.include.room_contract_history', compact('contracts'))->render();
        $html_service_detail = view('admin.service_detail.show', ['current_contract' => $contract])->render();
        return response()->json(['message' => 'Sửa hợp đồng thành công','html_room' => $html_room, 'html_service_detail'=>$html_service_detail, 'html_contract' => $html_contract, 'html_contract_history' => $html_room_contract_history]);
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

    public function getProcessContract(Request $request){
        $contract = Contract::whereId($request->id_contract)->with('contractinfo')->with(['room' => function($join){
            $join->select('id','building_id','name');
            $join->with(['building:id,name']);
        }])->first();
        if($contract->status != 0){
            return response()->json(['status' => false, 'message'=> 'Hợp đồng đã được kiểm duyệt']);
        }else{
            $customer = Customer::join('contract_customer', function ($join) use($contract) {
                $join->on( 'customer.id' , '=', 'contract_customer.id_customer')
                     ->where('contract_customer.is_representative', '=', 1)
                     ->where('contract_customer.id_contract', '=', $contract->id);
            })->first();
            return response()->json(['status' => true, 'message' => view('admin.contract.modal.process_contract', compact('contract', 'customer'))->render()]);
        }
    }

    public function runprocessContract($id, $status = 1){
        $contract = Contract::whereId($id)->first();
        if($status == 1){
            $contract->status = $status;
            $contract->save();
            $room = $contract->room()->first();
            $room->status = 2;
            $room->save();
            $commissionController = new CommissionController();
            $result = $commissionController->add($contract->id);
            return response()->json(['status' => true, 'message' => 'Duyệt hợp đồng thành công']);
        }elseif($status == 3 ){
            $room = $contract->room()->first();
            $room->status = 0;
            $room->save();
            $contract->status = $status;
            $contract->save();
            return response()->json(['status' => false, 'message' => 'Hủy hợp đồng thành công']);        
        }else{
            return response()->json(['status' => false, 'message' => 'Hợp đồng đã được kiểm duyệt']);
        }
    }
}

<?php

namespace App\Admin\Controllers;

use App\Models\Room;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractInfo;
use App\Models\ContractCustomer;
use App\Http\Controllers\Controller;
use App\Admin\Requests\ContractEarnestRequest;

class ContractEarnestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $room = Room::find($request->room_id);
        if($room->contract()->whereType(2)->whereStatus(1)->first()){
            return false;
        }
        $customers = Customer::get();
        return view('admin.contract_earnest.modal.create_contract_earnest', compact('room','customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractEarnestRequest $request)
    {
        $room = Room::whereId($request->id_room)->first();
        $contract_earnest = $room->contract()->whereType(2)->whereStatus(1)->first();
        if($contract_earnest == null){
            $request->is_earnest = 1;
            $contract_earnest = Contract::create($request->all());
            $contract_earnest->update(['status' => 1]);
            ContractInfo::create([
                'id_contract' => $contract_earnest->id,
                'amount_earnest' => $request->amount_earnest,
            ]);
            ContractCustomer::create([
                'id_customer' => $request->id_customer,
                'id_contract' => $contract_earnest->id,
            ]);
            if($room->status != 2){
                $room->status = 1;
                $room->save();
            }
            return response()->json([
                'status' => 200,
                'message' => 'Thêm hợp đồng thành công',
                'data' => '',
                'model' => $room,
            ]);
        }
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
        $contract_earnest = Contract::whereId($id)->with('room')->with('contractinfo')->first();
        $customers = Customer::get();
        $customer = $contract_earnest->customers()->first();
        return view('admin.contract_earnest.modal.edit_contract_earnest', compact('contract_earnest', 'customers', 'customer'));
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
        $contract_earnest = Contract::whereId($id)->first();
        ContractInfo::whereIdContract($id)->update([
            'id_contract' => $contract_earnest->id,
            'amount_earnest' => $request->amount_earnest,
        ]);
        $contract_earnest->contract_customer()->delete();
        ContractCustomer::create([
            'id_customer' => $request->id_customer,
            'id_contract' => $id,
        ]);
        return response()->json(['status' => true, 'message'=>'Sửa hợp đồng thành công']);
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

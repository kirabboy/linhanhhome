<?php

namespace App\Admin\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContractServiceDetail;

class ContractServiceDetailController extends Controller
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
        $contract = Contract::whereId($request->id_contract)->with('contractinfo')->first();
        return view('admin.service_detail.modal.create_service_detail', compact('contract'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contract = Contract::whereId($request->id_contract)->first();
        if($contract->service_detail()->whereType($request->type)->where('month', $request->month)->where('year', $request->year)->first()){
            return response()->json(['status' => false, 'message' => 'Chỉ số tháng này đã tồn tại']);
        }else{
            ContractServiceDetail::create([
                'id_contract' => $contract->id,
                'type' => $request->type,
                'start_number' => $request->start_number,
                'end_number' => $request->end_number,
                'month' => $request->month,
                'year' => $request->year,
            ]);
            $html_service_detail = view('admin.service_detail.show', ['current_contract' => $contract])->render();

            return response()->json(['status' => true, 'message' => 'Thêm  chỉ số thành công', 'html_service_detail' => $html_service_detail]);
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
        $contract = Contract::whereId($id)->with('room')->first();
        return view('admin.contract.service_detail', ['current_contract' => $contract]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract_service = ContractServiceDetail::whereId($id)->first();
        return view('admin.service_detail.modal.edit_service_detail', compact('contract_service'));
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
        $contract_service = ContractServiceDetail::whereId($id)->first();
        $contract_service->update([
            'start_number' => $request->start_number,
            'end_number' => $request->end_number,
        ]);
        if($request->confirm == 1){
            $contract_service->is_confirm = 1;
            $contract_service->confirm_date = date('Y-m-d');
            $contract_service->save();
        }
        $contract = $contract_service->contract()->first();
        $html_service_detail = view('admin.service_detail.show', ['current_contract' => $contract])->render();

        return response()->json(['status' => true, 'message' => 'Sửa chỉ số thành công', 'html_service_detail' => $html_service_detail]);
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

<?php

namespace App\Admin\Controllers;

use App\Models\Room;
use App\Models\Invoice;
use App\Models\Contract;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Admin\Requests\InvoiceRequest;

class InvoiceController extends Controller
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
        $room = Room::whereId($request->id_room)->with('building')->first();

        $contract = $room->contract()->with('contractinfo')->first();
        $service_detail = $contract->service_detail()->whereStatus(0)->get();
        if($contract->contractinfo->type_water == 2 ){
            if(count($service_detail ) > 1){
                return response()->json(['status' =>true, 'message' => view('admin.invoice.modal.create_invoice', compact('room', 'contract','service_detail'))->render()]);
            }
        }elseif(count($service_detail ) > 0){
            return response()->json(['status' =>true, 'message' => view('admin.invoice.modal.create_invoice', compact('room', 'contract','service_detail'))->render()]);
        }else{
            return response()->json(['status' =>false, 'message' => 'Bạn cần cập nhập chỉ số điện nước tháng trước khi xuất hóa đơn']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {        
        $contract = Contract::whereId($request->id_contract)->with(['contract_customer' => function($join) use($request){
            $join->where('contract_customer.id_contract', '=',$request->id_contract )
            ->where('contract_customer.is_representative', '=', 1)
            ->with(['customer:id,fullname,phone,email']);
        }])->with(['room' => function($join){
            $join->select('id','building_id','name');
            $join->with(['building:id,name,owner_phone,owner_email,owner']);
        }])->with('contractinfo')->first();
        $service_detail = $contract->service_detail()->whereStatus(0)->get();
        $check = true;
        foreach ($service_detail as $item){
            if($item->is_confirm == 0){
                $check = false;
            }
        }
        if($check){
            $invoice = Invoice::create($request->all());    
            $contract->service_detail()->whereStatus(0)->update(['status'=>1]);
            $this->sendMailInvoice($contract, $invoice, $service_detail);
            return response()->json(['status' =>true, 'message' => 'Thêm hóa đơn thành công']);
        }else{
            return response()->json(['status' =>false, 'message' => 'Chỉ số điện nước chưa được chốt']);
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
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::whereId($id)->first();
        $contract = $invoice->contract()->with('contractinfo')->first();
        $service_detail = $contract->service_detail()->get();
        $room = $contract->room()->with('building')->first();
        return response()->json(['status' =>true, 'message' => view('admin.invoice.modal.edit_invoice', compact('invoice','room', 'contract','service_detail'))->render()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, $id)
    {
        $invoice = Invoice::whereId($id)->first();
        $invoice->update($request->only('name', 'code', 'date_create', 'date_expried', 'amount_paid', 'amount_rest'));
        return response()->json(['status' =>true, 'message' => 'Sửa hóa đơn thành công']);
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
    public function sendMailInvoice($contract , $invoice , $service_detail ){
        $content = new \stdClass();
        $content->subject = 'Hóa đơn tiền nhà tháng '. $service_detail[0]->month.'-'.$service_detail[0]->year;
        // $contract = Contract::whereId(1)->with(['contract_customer' => function($join){
        //     $join->where('contract_customer.id_contract', '=',1 )
        //     ->where('contract_customer.is_representative', '=', 1)
        //     ->with(['customer:id,fullname,phone,email']);
        // }])->with(['room' => function($join){
        //     $join->select('id','building_id','name');
        //     $join->with(['building:id,name,owner_phone']);
        // }])->with('contractinfo')->first();
        // $service_detail = $contract->service_detail()->get();

        // return $contract->contract_customer[0]->customer->email;
        $content->invoice = $invoice;
        $content->contract = $contract;
        $content->service_detail = $service_detail;
        Mail::to( $contract->contract_customer[0]->customer->email)->send(new \App\Mail\InvoiceMail($content));
        return 'sucesss';
    }
}

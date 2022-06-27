<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\Invoice;
use App\Models\Contract;

class ExportPDF extends Controller
{
    //
    public function invoice(Invoice $invoice){

        $invoice = $invoice->load(['contract' => function($query){
            $query->select('id', 'code', 'id_room');
            $query->with([
                'contractinfo:id_contract,number_room,price_room,number_electric,price_electric,number_water,price_water,type_water,number_service,price_service', 
                'service_detail:id_contract,type,end_number,start_number', 
                'customers:id,fullname', 'room' => function($query){
                    $query->select('id', 'building_id', 'floor_id', 'name');
                    $query->with(['building:id,name', 'floor:id,name']);
                }
            ]);
        }]);

        // dd($invoice);
        // $pdf = PDF::loadHTML(view('admin.pdf.invoice')->with('invoice', $invoice)->render());
        $pdf = PDF::loadView('admin.pdf.invoice', compact('invoice'));
        // $pdf = PDF::loadView('admin.pdf.test');
        // dd($pdf);
    	$pdf->setPaper('a3', 'landscape');
        return $pdf->stream();
        // return $pdf->download('phieugiaohang.pdf');
    }

    public function contract(Contract $contract){

        $contract = $contract->load([
            'contractinfo:id_contract,number_room,price_room,number_electric,price_electric,price_water,number_water,number_service,price_service', 
            'customers:id,fullname', 
            'room' => function($query){
            $query->select('id', 'building_id', 'floor_id', 'name');
            $query->with(['building:id,name', 'floor:id,name']);
        }]);
        $pdf = PDF::loadView('admin.pdf.contract', compact('contract'));

    	$pdf->setPaper('a3', 'landscape');
        return $pdf->stream();

    }
}

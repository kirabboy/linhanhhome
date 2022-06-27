<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Datatables;
use Illuminate\Support\Arr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.customer.index');
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

    public function getCustomerInfo(Request $request){
        $customer = Customer::find($request->customer_id);
        $customer->identification_date = date('Y/m/d', strtotime($customer->identification_date));
        return response()->json($customer);
    }

    public function dataAjax(Request $request){
        $search = $request->search;

        $data = Customer::where('fullname','LIKE',"%".$search."%")->limit(25)->get();
        return $data;
    }
    public function indexDatatableEdit(Request $request){
        $customers_contract = Customer::join('contract_customer', function ($join) use ($request){
            $join->on( 'customer.id' , '=', 'contract_customer.id_customer')
                 ->where('contract_customer.id_contract', '=', $request->id);
        })->with('contract_customer')
        ->get()->toArray();
        $ids = Arr::pluck($customers_contract, 'id_customer');
        $customers =  Customer::whereNotIn('id', $ids)->get()->toArray();
        $customers = array_merge($customers_contract,$customers);
        
        return datatables()->of($customers)->toJson();

    }
    public function indexDatatable(){
        $customers = Customer::latest()->get();
        return datatables()->of($customers)->toJson();
    }


}

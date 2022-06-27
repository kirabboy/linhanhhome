<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    //
    public function index(){
        $percent_commission = Setting::select('key', 'value')->where('key', '=', 'percent_commission')->first();
        return view('admin.setting.index', compact('percent_commission'));
    }

    public function update(Request $request){
        $setting = Setting::where('key', 'percent_commission')->first();
        $setting->value['percent'] = $request->percent_commission;
        $setting->save();
        return back()->with('success', 'Thực hiện thành công');
    }
}

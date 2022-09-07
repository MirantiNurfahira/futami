<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Str;

class StaffController extends Controller
{
   // Home Adnub
	public function Home()
	{
		$staffs = Operator::where('ttd_operator', '!=', null)
			->where('rejected', '!=', 1)->get();
		return view('staffs.index')->with('staffs', $staffs)
		->with('i', (request()->input('page', 1) -1) * 5);
	}
	
	//ttd qr code
	public function ttd_staff($id) {
		$staffs = Operator::findOrFail($id);
		$user = auth::guard('users')->user();
		$dateNow = Carbon::now()->tz('Asia/Jakarta')->format('Y-m-d');
		$ttd = "$user->name/$user->jabatan/$user->id/$dateNow";
		$staffs->ttd_staff = $ttd;
		$staffs->rejected = 0;
		$staffs->save();
		return redirect('/staffs')->with('success', 'Berhasil ttd');


	}

	//approve and reject
	public function approve($id){
		$staffs = Operator::findOrFail($id);
		$staffs->rejected = 0; //Approved
		$staffs->save();
		return redirect()->back(); 
	 }
	 
	 public function decline($id){
		$staffs = Operator::findOrFail($id);
		$staffs->ttd_operator = null;
		$staffs->rejected = 1; //Declined
		$staffs->save();
		return redirect()->back(); 
	 }
}

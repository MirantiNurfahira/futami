<?php

namespace App\Http\Controllers;
use App\Models\Supervisor;
use App\Models\Staff;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Str;

class SupervisorController extends Controller
{
    // Home Adnub
	public function Home()
	{
		$supervisors = Operator::where('ttd_operator', '!=', null)
			->where('ttd_staff', '!=', null)
			->get();

		return view('supervisors.index')->with('supervisors', $supervisors)
		->with('i', (request()->input('page', 1) -1) * 5);
	}
	
	//ttd qr code
	public function ttd_supervisor($id) {
		$supervisors = Operator::findOrFail($id);
		$user = auth::guard('users')->user();
		$dateNow = Carbon::now()->tz('Asia/Jakarta')->format('Y-m-d');
		$ttd = "$user->name/$user->jabatan/$user->id/$dateNow";
		$supervisors->ttd_supervisor = $ttd;
		$supervisors->save();
		return redirect('/supervisors')->with('success', 'Berhasil ttd');
	}

	
}
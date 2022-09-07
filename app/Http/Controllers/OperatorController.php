<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Str;

class OperatorController extends Controller
{
   // Home Adnub
	public function Home()
	{
		$operators = Operator::all();

		//dd($operators);
		return view('operators.index')->with('operators', $operators)
		->with('i', (request()->input('page', 1) -1) * 5);
	}	

	// Process Create
	public function Store(Request $request)
	{
		try {

			// dd($request->all());
			
			$operator = new Operator;

			// dd($request->all());

			$parameterAndValues = [];

			foreach ($request->parameter_and_values as $item) {
				$valueArray = [
					$item['test_values']
				];
				// dd($valueArray);
				$parameterAndValues[$item['parameter']] = $valueArray;
			}

			$operator->document_no = $request->document_no;
			$operator->sampler = $request->sampler;
			$operator->testing_parameter = $request->testing_parameter;
			$operator->recieved_date = $request->recieved_date;
			$operator->sample_count = $request->sample_count;
			$operator->test_start_date = $request->test_start_date;
			$operator->test_end_date = $request->test_end_date;
			$operator->sample_no = $request->sample_no;
			$operator->parameter_and_values = $parameterAndValues;
			$operator->specification = $request->specification;
			$operator->note = $request->note;

			// dd($operator);

			$operator->save();



			// Operator::create([
			// 	'document_no' => $request->document_no,
            //     'sampler'=> $request->sampler,
            //     'testing_parameter'=> $request->testing_parameter,
            //     'recieved_date'=> $request->recieved_date,
            //     'sample_count'=> $request->sample_count,
            //     'test_start_date'=> $request->test_start_date,
            //     'test_end_date'=> $request->test_end_date,
            //     'sample_no'=> $request->sample_no,
            //     'parameter_and_values'=> $request->parameter_and_values,
            //     'specification'=> $request->specification,
            //     'note'=> $request->note,
			// ]);
			// foreach ($request->addmore as $key => $value) {
			// 	Operator::create($value);
			// }

			return redirect()->back()->with('sukses', 'Berhasil Menambahkan Data');
			
		} catch (Exception $e) {

			return redirect()->back()->with('gagal', 'Gagal Menambahkan Data');
		}
	}

	// Get Edit Users
	public function edit($id)
	{
		$operators = Operator::find($id);

		return response()->json(['code' => '200', 'data' => $operators]);
	}

	// Process Update 
	public function Update(Request $request, $id)
	{
		try {
			$parameterAndValues = [];

			foreach ($request->parameter_and_values as $key => $item) {
				$parameterAndValues[$key] = $item;
			}

				$update = Operator::findOrFail($id);
				$update->update([
				'document_no' => $request->document_no,
                'sampler'=> $request->sampler,
                'testing_parameter'=> $request->testing_parameter,
                'recieved_date'=> $request->recieved_date,
                'sample_count'=> $request->sample_count,
                'test_start_date'=> $request->test_start_date,
                'test_end_date'=> $request->test_end_date,
                'sample_no'=> $request->sample_no,
                'parameter_and_values'=> $parameterAndValues,
                'specification'=> $request->specification,
                'note'=> $request->note
				]);

				return response()->json(['code' => 200, 'data' => $update], 200);

		} catch (Exception $e) {
			
			return response()->json(['code' => 300, 'msg' => 'error'], 300);	
		}
	}

	// Process Delete Users
	public function Delete($id)
	{
		$data = Operator::find($id);

		if ($data != null) {
			
			$data->delete();

			return redirect()->back();
		}else{

			return redirect()->back();
		}

	}

    //ttd qr code
	public function ttd_operator($id) {
		$operator = Operator::findOrFail($id);	
		$user = auth::guard('users')->user();
		$dateNow = Carbon::now()->tz('Asia/Jakarta')->format('Y-m-d');
		$ttd = "$user->name/$user->jabatan/$user->id/$dateNow";
		$operator->ttd_operator = $ttd;
		$operator->rejected = 0;
		$operator->save();
		return redirect('/operators')->with('success', 'Berhasil ttd');

}
}
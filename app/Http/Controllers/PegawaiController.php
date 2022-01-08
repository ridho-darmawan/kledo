<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    
    public function index()
    {
        $pegawais = Pegawai::select('nama','gaji')->paginate(10);
        
        foreach ($pegawais as $pegawai) {

            $data [] = [
                'nama'=>strtoupper(strtok($pegawai->nama, " ")),
                'gaji'=>number_format($pegawai->gaji,2,".",",")
            ];
           
        }

        return response()->json($data);

    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:pegawais|max:10',
            'gaji' => 'integer|required|between:4000000,10000000',
        ]);

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first()
            ];
            return response()->json($response);
        }

        $createPegawai = Pegawai::create($request->all());

        if($createPegawai){
            return response()->json(['message'=>'success']);
           
        }

    }

    public function show($id)
    {
        $pegawai = Pegawai::select('nama','gaji')->find($id);
        
        if($pegawai){
            $output = [
                'message'=>'Success',
                'data'=>[
                    'nama'=>strtoupper(strtok($pegawai->nama, " ")),
                    'gaji'=>number_format($pegawai->gaji,2,".",",")
                ],
            ];
            return response()->json($output);
        }
       
    }

   
    public function update(Request $request, $id)
    {

       $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:pegawais|max:10',
            'gaji' => 'integer|required|between:4000000,10000000',
        ]);

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first()
            ];
            return response()->json($response);
        }
        
        $pegawai = Pegawai::find($id);

        $updatePegawai = $pegawai->update($request->all());

        if($updatePegawai){
            return response()->json(['message'=>'Update successfully']);
        }

       
    }

   
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);

        if($pegawai){
            $pegawai->delete();
            return response()->json(['message'=>'delete successfully']);
        }
    }
}

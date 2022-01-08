<?php

namespace App\Http\Controllers;

use App\Models\GajiPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GajiPegawaiController extends Controller
{
   
    public function index(Request $request)
    {
       

        $gajiPegawai = GajiPegawai::orderBy('created_at','desc');

        if ($request->has('tahun') && $request->has('bulan')) {
            $gajiPegawai->whereYear("created_at","=", $request->tahun)->whereMonth('created_at','=',$request->bulan);
        }

        $getGajiPegawais = $gajiPegawai->paginate(10);


        foreach ($getGajiPegawais as $getGajiPegawai) {
            $data [] = [
                'nama_pegawai' => strtoupper(strtok($getGajiPegawai->pegawai->nama, " ")),
                'total_diterima'   => number_format($getGajiPegawai->total_gaji,2,".",","),
                'waktu' => date('DD/MM/YYYY HH:mm', strtotime($getGajiPegawai->created_at))

            ];
        }

        return response()->json($data);


       
        
    }

  

    public function batchGajiPegawai()
    {
        $pegawais = Pegawai::all();

        foreach ($pegawais as $pegawai) {
           
            GajiPegawai::create([
                'pegawai_id'=>$pegawai->id,
                'total_gaji'=>$pegawai->gaji,
            ]);

         
        }

        return response()->json(['message'=>'Gaji seluruh pegawai telah di distibusikan']);

       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'message'=>$validator->errors()->first()
            ];
            return response()->json($response);
        }
        

        $pegawai = Pegawai::find($request->pegawai_id);
        $cekIdPegawai = GajiPegawai::where('pegawai_id',$request->pegawai_id)->whereYear('created_at','=',date('Y'))->whereMonth('created_at','=',date('m'))->get();

        if($pegawai){

            if ($cekIdPegawai == null) {
                $createPegawai = GajiPegawai::create([
                    'pegawai_id'=>$request->pegawai_id,
                    'total_gaji'=>$pegawai->gaji,
                ]);

                return response()->json(['message'=>'success']);
            }else{
                return response()->json(['message'=>'Gaji Pegawai telah di distibusikan']);
            }
            
            
        }else{
            return response()->json(['message'=>'Id Pegawai tidak ditemukan']);
        }

    }

 
}

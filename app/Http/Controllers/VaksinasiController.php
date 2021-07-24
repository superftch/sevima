<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vaksinasi;
use Illuminate\Validation\Rule;
use Validator;
use Auth;
use DB;

class VaksinasiController extends Controller
{
    public function tambah(Request $request)
    {
        $rules = array(
            'nik'         =>  'required|unique:vaksinasis',
            'alamat'   =>  'required',
            'kelurahan'   =>  'required',
            'kecamatan'  =>  'required',
            'kota'         =>  'required',
            'provinsi'         =>  'required',
            'tlpn'         =>  'required',
            'kelompok'         =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $form_data = array(
            'nik' => $request->nik,
            'alamat'   => $request->alamat,
            'kelurahan'=> $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota'=> $request->kota,
            'provinsi'=> $request->provinsi,
            'tlpn'=> $request->tlpn,
            'kelompok'=> $request->kelompok,
            'user_id'=> $request->user_id,
        );

        Vaksinasi::create($form_data);

        return response()->json(['success' => 'Data Vaksinasi berhasil diinput.']);
    }
    public function getdetail($id)
    {
        if(request()->ajax())
        {
            $data = Vaksinasi::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    } 
    public function delete($id)
    {
        Vaksinasi::find($id)->delete();
        return response()->json(['success' => 'Data Vaksinasi berhasil dihapus.']);
    }
    public function edit(Request $request)
    {
        $rules = array(
            'nik' =>  'required|unique:vaksinasis,nik,'.$request->idnow.',id',
            'alamat'   =>  'required',
            'kelurahan'   =>  'required',
            'kecamatan'  =>  'required',
            'kota'         =>  'required',
            'provinsi'         =>  'required',
            'tlpn'         =>  'required',
            'kelompok'         =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nik' => $request->nik,
            'alamat'   => $request->alamat,
            'kelurahan'=> $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota'=> $request->kota,
            'provinsi'=> $request->provinsi,
            'tlpn'=> $request->tlpn,
            'kelompok'=> $request->kelompok,
            'user_id'=> $request->user_id,
        );

        Vaksinasi::whereId($request->idnow)->update($form_data);

        return response()->json(['success' => 'Data Vaksinasi berhasil diubah.']);
    }
}

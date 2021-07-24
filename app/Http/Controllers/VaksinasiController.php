<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vaksinasi;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
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
    public function getprovinsi()
    {
        $provinces = Province::all();
        return response()->json(['data' => $provinces]);
    }
    public function getkota($id)
    {
        $regencies = Provice::where('id',$id)->regencies;
        return response()->json(['data' => $regencies]);
    }
    public function getkecamatan($id)
    {
        $districts = Regency::where('id',$id)->districts;
        return response()->json(['data' => $districts]);
    }
    public function getkelurahan($id)
    {
        $villages = District::where('id',$id)->villages;
        return response()->json(['data' => $villages]);
    }
}

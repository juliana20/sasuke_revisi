<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\ModelKodeSurat;
use DataTables;
use Carbon\Carbon;
use DB;
use Cookie;
use Illuminate\Support\Str;
use Alert;
use PDF;
use Redirect;

class KodeSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Session::get('login')){
            $notification = array(
            'message' => 'Perhatian, Silahkan login terlebih dahulu!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return redirect('login')->with($notification);
        }
        elseif(Session::get('user_tipe')=='Wakil Kepala'){
            $notification = array(
            'message' => 'Perhatian, Anda tidak bisa mengakses halaman Kode Surat!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return Redirect::back()->with($notification);
        }else{
            $idAuto=ModelKodeSurat::all()
            ->max('kode_id');
            $noUrut = (int) substr($idAuto, 3, 3);
            $noUrut++;
            $char = "KD";
            $newID = $char . sprintf("%03s", $noUrut);

            $kodeSurat=ModelKodeSurat::all();
            return view('kode_surat.index',compact('kodeSurat','newID'));    

        }
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
        $k = new ModelKodeSurat;
        $k->kode_id = $request->txtIdKode;
        $k->kode_surat = $request->txtKode;
        $k->keterangan = $request->txtKeterangan;
        
        $count=$k->save();
            if($count){
            $notification = array(
            'message' => 'Data kode surat berhasil disimpan!',
            'alert-type' => 'success',
            'closeButton' => 'false',
            );
            }else{
            $notification = array(
            'message' => 'Data kode surat gagal disimpan!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
            );
            
        }
            return redirect('kode_surat')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kodeSurat= ModelKodeSurat::where('id', $id)->first();
        return view('kode_surat.edit', compact('kodeSurat'));
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
        $u=ModelKodeSurat::find($request->id);
        $u->kode_surat = $request->txtKode;
        $u->keterangan = $request->txtKeterangan;
        $count=$u->save();
            if($count){
            $notification = array(
            'message' => 'Data kode surat berhasil diperbarui!',
            'alert-type' => 'success',
            'closeButton' => 'false',
            );
            }else{
            $notification = array(
            'message' => 'Data kode surat gagal disimpan!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
            );
            
        }
        return redirect('kode_surat')->with($notification);
            
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

}

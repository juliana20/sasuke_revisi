<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\ModelSuratMasuk;
use App\ModelSuratKeluar;
use DataTables;
use Carbon\Carbon;
use DB;
use Cookie;
use Alert;
use PDF;
use Redirect;
use Image;
use Illuminate\Support\Str;

class DashboardController extends Controller
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
            return Redirect::back()->with($notification);
        }
        elseif(Session::get('user_tipe')=='Wakil Kepala'){
            $jumlahSuratMasuk=ModelSuratMasuk::all()
            ->where('tindak_lanjut',Session::get('id'))
            ->count('id');
            $jumlahSuratKeluar=ModelSuratKeluar::all()
            ->where('user_id',Session::get('id'))
            ->count('id');
        }
        else{
        $jumlahSuratMasuk=ModelSuratMasuk::all()
        ->count('id');
        $jumlahSuratKeluar=DB::table('tb_surat_keluar')
        ->whereNotNull('kode_surat_keluar')
        ->count('id');
    }
            return view('dashboard.dashboard',compact('jumlahSuratMasuk','jumlahSuratKeluar'));

           
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

       
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
       

    }
    public function destroy(Request $request)
    {
       
    }

    

   public function dashboard()
    {
           

        

    }
}

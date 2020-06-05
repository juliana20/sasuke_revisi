<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\ModelSuratKeluar;
use App\ModelKodeSurat;
use App\ModelAdmin;
use DataTables;
use Carbon\Carbon;
use DB;
use Cookie;
use Illuminate\Support\Str;
use Alert;
use PDF;
use Image;
use Redirect;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Session::get('id');
        if(!Session::get('login')){
            $notification = array(
            'message' => 'Perhatian, Silahkan login terlebih dahulu!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return redirect('login')->with($notification);
        }elseif(Session::get('user_tipe')=='Wakil Kepala'){
            $waka=ModelAdmin::all()
            ->where('user_tipe','Wakil Kepala');

            $kodeSurat=ModelKodeSurat::all();
            $suratKeluar= DB::table('tb_surat_keluar as sm')
            ->where('sm.user_id',$user)
            ->leftjoin('tb_kode_surat as a','sm.kode_surat_keluar','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai')
            ->get();
        }elseif(Session::get('user_tipe')=='Kepala Sekolah'){
            $waka=ModelAdmin::all();

            $kodeSurat=ModelKodeSurat::all();
            $suratKeluar= DB::table('tb_surat_keluar as sm')
            ->where('sm.kode_surat_keluar','!=','')
            ->leftjoin('tb_kode_surat as a','sm.kode_surat_keluar','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai')
            ->get();
        }else{
            $waka=ModelAdmin::all()
            ->where('user_tipe','Wakil Kepala');

            $kodeSurat=ModelKodeSurat::all();
            $suratKeluar= DB::table('tb_surat_keluar as sm')
            ->join('tb_kode_surat as a','sm.kode_surat_keluar','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai')
            ->get();
        }
        return view('surat_keluar.index',compact('suratKeluar','kodeSurat','waka'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $idAuto=ModelSuratKeluar::all()
        ->max('surat_keluar_id');
        $noUrut = (int) substr($idAuto, 3, 3);
        $noUrut++;
        $char = "SK";
        $newID = $char . sprintf("%03s", $noUrut);

        $kodeSurat=ModelKodeSurat::all();
        $waka=ModelAdmin::all()
        ->where('user_tipe','Wakil Kepala');
        return view('surat_keluar.create',compact('kodeSurat','waka','newID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Session::get('id');
        $s = new ModelSuratKeluar;
        if(Session::get('user_tipe')=='Wakil Kepala'){ 
            $s->surat_keluar_id = $request->txtIdSuratKeluar;
            $s->user_id = $user;

            $file=$request->file('txtFile');
            $fileName=$file->getClientOriginalName();
            $path='public/image/scan_surat_keluar/'.$fileName;
            Image::make($file)->resize(500,700)->save($path);
            $s->file=$fileName;
        }else{
            $s->surat_keluar_id = $request->txtIdSuratKeluar;
            $s->user_id = $user;
            $s->tanggal_dikirim = $request->txtTanggalKirim;
            $s->kode_surat_keluar = $request->txtIdKodeSurat;
            $s->no_surat_keluar = $request->txtNoSurat;
            $s->tujuan_surat = $request->txtTujuanSurat;
            $s->perihal_surat_keluar = $request->txtPerihalSurat;
            $s->tanggal_surat_keluar = $request->txtTanggalSurat;
            $s->keterangan_surat_keluar = $request->txtKeterangan;
            $s->status_surat = $request->txtStatus;

            $file=$request->file('txtFile');
            $fileName=$file->getClientOriginalName();
            $path='public/image/scan_surat_keluar/'.$fileName;
            Image::make($file)->resize(500,700)->save($path);
            $s->file=$fileName;

            $filex=$request->file('txtBuktiPengiriman');
            $fileNamex=$filex->getClientOriginalName();
            $pathx='public/image/scan_surat_keluar/'.$fileNamex;
            Image::make($filex)->resize(500,700)->save($pathx);
            $s->bukti_pengiriman_surat=$fileNamex;
        }
        
         $count=$s->save();
            if($count){
            $notification = array(
            'message' => 'Data surat keluar berhasil disimpan!',
            'alert-type' => 'success',
            'closeButton' => 'false',
            );
            }else{
            $notification = array(
            'message' => 'Data surat keluar murid gagal disimpan!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
            );
            
        }
        return redirect('surat_keluar')->with($notification);
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
            $suratKeluar = DB::table('tb_surat_keluar As ds')
            ->where('ds.id', $id)
            ->leftjoin('tb_user as u','ds.user_id','=','u.id')
            ->leftjoin('tb_kode_surat as ks','ds.kode_surat_keluar','=','ks.id')
            ->select('ds.*','u.jabatan','u.nama_pegawai','ks.kode_surat')
            ->first();
            $kodeSurat=ModelKodeSurat::all();
            $waka=ModelAdmin::all()
            ->where('user_tipe','Wakil Kepala');

            return view('surat_keluar.edit',compact('suratKeluar','kodeSurat','waka'));
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
        $s=ModelSuratKeluar::find($request->id);
        $user=Session::get('id');
        if(Session::get('user_tipe')=='Wakil Kepala'){ 
            $s->user_id = $user;
        }elseif($request->txtIdKodeSurat==''){
            $s->no_surat_keluar = $request->txtNoSurat;
        }else{
            $s->surat_keluar_id = $request->txtIdSuratKeluar;
            $s->user_id = $user;
            $s->tanggal_dikirim = $request->txtTanggalKirim;
            $s->kode_surat_keluar = $request->txtIdKodeSurat;
            $s->no_surat_keluar = $request->txtNoSurat;
            $s->tujuan_surat = $request->txtTujuanSurat;
            $s->perihal_surat_keluar = $request->txtPerihalSurat;
            $s->tanggal_surat_keluar = $request->txtTanggalSurat;   
            $s->keterangan_surat_keluar = $request->txtKeterangan;
            $s->status_surat = $request->txtStatus;
        }
        if($request->hasFile('txtFile')){
            $file=$request->file('txtFile');
            $fileName=$file->getClientOriginalName();
            $path='public/image/scan_surat_keluar/'.$fileName;
            Image::make($file)->resize(500,700)->save($path);
            $s->file=$fileName;
            $s->user_id = $user;
        }   
        if($request->hasFile('txtBuktiPengiriman')){
            $filex=$request->file('txtBuktiPengiriman');
            $fileNamex=$filex->getClientOriginalName();
            $pathx='public/image/scan_surat_keluar/'.$fileNamex;
            Image::make($filex)->resize(500,700)->save($pathx);
            $s->bukti_pengiriman_surat=$fileNamex;
        }

        $count=$s->save();
        if($count){
        $notification = array(
            'message' => 'Data surat keluar berhasil diperbarui!',
            'alert-type' => 'success',
            'closeButton' => 'false',
        );
        }else{
           $notification = array(
            'message' => 'Data surat keluar gagal diperbarui!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
        );
        
        }
        return redirect('surat_keluar')->with($notification); 
    
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
    public function destroy(Request $request, $id)
    {
        
    }

    public function laporanSuratKeluar(){
        $laporanSuratKeluar=DB::table('tb_surat_keluar as ds')
        ->whereNotNull('ds.kode_surat_keluar')
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_keluar','=','ks.id')
        ->leftjoin('tb_user as u','ds.user_id','=','u.id')
        ->select('ds.*','ks.kode_surat','u.nama_pegawai')
        ->get();

        $jumlahSuratKeluar=count($laporanSuratKeluar);
        $kodeSurat=ModelKodeSurat::all();
       return view('laporan.laporan_surat_keluar', compact('laporanSuratKeluar','jumlahSuratKeluar','kodeSurat'));
    }

    public function filterLaporanSuratKeluar(Request $request){
        $awal = $request->txtAwal;
        $akhir = $request->txtAkhir;
        
        $laporanSuratKeluar=DB::table('tb_surat_keluar as ds')
        ->whereBetween('ds.tanggal_dikirim',[$awal,$akhir])
        ->whereNotNull('ds.kode_surat_keluar')
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_keluar','=','ks.id')
        ->leftjoin('tb_user as u','ds.user_id','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.nama_pegawai')
        ->get();
        $jumlahSuratKeluar=count($laporanSuratKeluar);
        $kodeSurat=ModelKodeSurat::all();
        return view('laporan.laporan_surat_keluar',compact('laporanSuratKeluar','awal','akhir','jumlahSuratKeluar','kodeSurat'));
        
    }

    public function cetakLaporanSuratKeluar(Request $request, $awal, $akhir){
        $laporanSuratKeluar=DB::table('tb_surat_keluar as ds')
        ->whereBetween('ds.tanggal_dikirim',[$awal,$akhir])
        ->whereNotNull('ds.kode_surat_keluar')
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_keluar','=','ks.id')
        ->leftjoin('tb_user as u','ds.user_id','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.nama_pegawai')
        ->get();
        $jumlahSuratKeluar=count($laporanSuratKeluar);
        $pdf=PDF::loadView('laporan.cetak_laporan_surat_keluar',compact('laporanSuratKeluar','jumlahSuratKeluar'));
        return $pdf->stream('laporan_surat_keluar.pdf');
        
    }

    public function cetakLaporanSuratKeluarAll(Request $request){
        $laporanSuratKeluar=DB::table('tb_surat_keluar as ds')
        ->whereNotNull('ds.kode_surat_keluar')
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_keluar','=','ks.id')
        ->leftjoin('tb_user as u','ds.user_id','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.nama_pegawai')
        ->get();
        $jumlahSuratKeluar=count($laporanSuratKeluar);
        $pdf=PDF::loadView('laporan.cetak_laporan_surat_keluar',compact('laporanSuratKeluar','jumlahSuratKeluar'));
        return $pdf->stream('laporan_surat_keluar.pdf');
    }

    public function cetakLaporanSuratKeluarId(Request $request, $id){
        $laporanSuratKeluar=DB::table('tb_surat_keluar as ds')
        ->whereNotNull('ds.kode_surat_keluar')
        ->where('ds.id',$id)
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_keluar','=','ks.id')
        ->leftjoin('tb_user as u','ds.user_id','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.nama_pegawai')
        ->get();
        $jumlahSuratKeluar=count($laporanSuratKeluar);
        $pdf=PDF::loadView('laporan.cetak_laporan_surat_keluar',compact('laporanSuratKeluar','jumlahSuratKeluar'));
        return $pdf->stream('laporan_surat_keluar.pdf');
        
    }



    public function filterKodeSurat(Request $request){
        $txtKodeSurat = $request->txtKodeSurat;
        $awal = $request->txtAwal;
        $akhir = $request->txtAkhir;
        $laporanSuratKeluar=DB::table('tb_surat_keluar as ds')
        ->where('ds.kode_surat_keluar',$txtKodeSurat)
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_keluar','=','ks.id')
        ->leftjoin('tb_user as u','ds.user_id','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.nama_pegawai')
        ->get();
        $jumlahSuratKeluar=count($laporanSuratKeluar);
        $kodeSurat=ModelKodeSurat::all();
        return view('laporan.laporan_surat_keluar',compact('laporanSuratKeluar','kodeSurat','jumlahSuratKeluar','txtKodeSurat','awal','akhir'));
        
    }



    public function cetakLaporanSuratKeluarPerKode(Request $request, $txtKodeSurat){
        $laporanSuratKeluar=DB::table('tb_surat_keluar as ds')
        ->where('ds.kode_surat_keluar',$txtKodeSurat)
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_keluar','=','ks.id')
        ->leftjoin('tb_user as u','ds.user_id','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.nama_pegawai')
        ->get();
        $jumlahSuratKeluar=count($laporanSuratKeluar);
        $pdf=PDF::loadView('laporan.cetak_laporan_surat_keluar',compact('laporanSuratKeluar','jumlahSuratKeluar'));
        return $pdf->stream('laporan_surat_keluar.pdf');
              
    }

    public function belumIsiNoSurat(){
            $suratKeluar= DB::table('tb_surat_keluar as sm')
            ->whereNull('sm.no_surat_keluar')
            ->leftjoin('tb_kode_surat as a','sm.kode_surat_keluar','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->select('sm.*')
            ->get();
        return view('surat_keluar.daftar_belum_isi_no_surat',compact('suratKeluar'));
    }

}

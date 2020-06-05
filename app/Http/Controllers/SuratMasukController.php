<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\ModelSuratMasuk;
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

class SuratMasukController extends Controller
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
        }elseif(Session::get('user_tipe')=='Wakil Kepala'){
            $suratMasuk= DB::table('tb_surat_masuk as sm')
            ->where('sm.tindak_lanjut',Session::get('id'))
            ->join('tb_kode_surat as a','sm.kode_surat_masuk','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->leftjoin('tb_user as t','sm.tindak_lanjut','=','t.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai','t.jabatan as tindak_lanjut2')
            ->get();
            
        }else{
            $waka=ModelAdmin::all()
            ->where('user_tipe','Wakil Kepala');
            $kodeSurat=ModelKodeSurat::all();
            $suratMasuk= DB::table('tb_surat_masuk as sm')
            ->join('tb_kode_surat as a','sm.kode_surat_masuk','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->leftjoin('tb_user as t','sm.tindak_lanjut','=','t.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai','t.jabatan as tindak_lanjut2')
            ->get();
        }
            $count=count($suratMasuk);
            return view('surat_masuk.index',compact('suratMasuk','kodeSurat','waka','count'));
        

    }

    public function BelumDibaca()
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
            $suratMasuk= DB::table('tb_surat_masuk as sm')
            ->where('sm.tindak_lanjut',Session::get('id'))
            ->where('sm.sudah_dibaca','0')
            ->join('tb_kode_surat as a','sm.kode_surat_masuk','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->leftjoin('tb_user as t','sm.tindak_lanjut','=','t.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai','t.jabatan as tindak_lanjut2')
            ->get();
            
        }else{

            $waka=ModelAdmin::all()
            ->where('user_tipe','Wakil Kepala');

            $kodeSurat=ModelKodeSurat::all();
            $suratMasuk= DB::table('tb_surat_masuk as sm')
            ->where('sm.sudah_dibaca','0')
            ->join('tb_kode_surat as a','sm.kode_surat_masuk','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->leftjoin('tb_user as t','sm.tindak_lanjut','=','t.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai','t.jabatan as tindak_lanjut2')
            ->get();
        }
            $count=count($suratMasuk);
            return view('surat_masuk.index_surat_belum_dibaca',compact('suratMasuk','kodeSurat','waka','count'));
        
        

    }

    public function BelumDisposisi()
    {
        if(!Session::get('login')){
            $notification = array(
            'message' => 'Perhatian, Silahkan login terlebih dahulu!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return redirect('login')->with($notification);
        }else{

            $waka=ModelAdmin::all()
            ->where('user_tipe','Wakil Kepala');

            $kodeSurat=ModelKodeSurat::all();
            $suratMasuk= DB::table('tb_surat_masuk as sm')
            ->where('sm.disposisi','0')
            ->join('tb_kode_surat as a','sm.kode_surat_masuk','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->leftjoin('tb_user as t','sm.tindak_lanjut','=','t.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai','t.jabatan as tindak_lanjut2')
            ->get();
        }
            $count=count($suratMasuk);
            return view('surat_masuk.index_surat_belum_disposisi',compact('suratMasuk','kodeSurat','waka','count'));
        
        

    }

     public function BelumDikirim()
    {
        if(!Session::get('login')){
            $notification = array(
            'message' => 'Perhatian, Silahkan login terlebih dahulu!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return redirect('login')->with($notification);
        }else{

            $waka=ModelAdmin::all()
            ->where('user_tipe','Wakil Kepala');

            $kodeSurat=ModelKodeSurat::all();
            $suratMasuk= DB::table('tb_surat_masuk as sm')
            ->where('sm.status_dikirim','0')
            ->where('sm.tindak_lanjut','!=','0')
            ->where('sm.disposisi','!=','0')
            ->join('tb_kode_surat as a','sm.kode_surat_masuk','=','a.id')
            ->leftjoin('tb_user as u','sm.user_id','=','u.id')
            ->leftjoin('tb_user as t','sm.tindak_lanjut','=','t.id')
            ->select('sm.*','a.kode_surat','u.nama_pegawai','t.jabatan as tindak_lanjut2')
            ->get();
            }
            $count=count($suratMasuk);
            return view('surat_masuk.index_surat_belum_dikirim',compact('suratMasuk','kodeSurat','waka','count'));
        
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idAuto=ModelSuratMasuk::all()
        ->max('surat_masuk_id');
        $noUrut = (int) substr($idAuto, 3, 3);
        $noUrut++;
        $char = "SM";
        $newID = $char . sprintf("%03s", $noUrut);

        $kodeSurat=ModelKodeSurat::all();
        $kepala=ModelAdmin::all()
        ->where('user_tipe','Kepala Sekolah');
        return view('surat_masuk.create',compact('kodeSurat','kepala','newID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $s = new ModelSuratMasuk;
        $s->surat_masuk_id = $request->txtIdSuratMasuk;
        $s->user_id = '1';
        $s->tanggal_terima = $request->txtTanggalTerima;
        $s->kode_surat_masuk = $request->txtIdKodeSurat;
        $s->no_surat_masuk = $request->txtNoSurat;
        $s->asal_surat_masuk = $request->txtAsalSurat;
        $s->perihal_surat_masuk = $request->txtPerihalSurat;
        $s->tanggal_surat_masuk = $request->txtTanggalSurat;
        $s->disposisi = '0';     
        $s->keterangan_surat_masuk = $request->txtKeterangan;
        $s->validasi = '0';
        $s->tindak_lanjut = '0';
        $s->sudah_dibaca = '0';


        $file=$request->file('txtFile');
        $fileName=$file->getClientOriginalName();
        $path='public/image/scan_surat/'.$fileName;
        Image::make($file)->resize(500,700)->save($path);
        $s->file=$fileName;
        
         $count=$s->save();
            if($count){
            $notification = array(
            'message' => 'Data surat masuk berhasil disimpan!',
            'alert-type' => 'success',
            'closeButton' => 'false',
            );
            }else{
            $notification = array(
            'message' => 'Data surat masuk murid gagal disimpan!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
            );
            
        }
        return redirect('surat_masuk')->with($notification);
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
            $suratMasuk = DB::table('tb_surat_masuk As ds')
            ->where('ds.id', $id)
            ->leftjoin('tb_user as u','ds.user_id','=','u.id')
            ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
            ->select('ds.*','u.jabatan','u.nama_pegawai','ks.kode_surat')
            ->first();
            $kodeSurat=ModelKodeSurat::all();
            $kepala=ModelAdmin::all()
            ->where('user_tipe','Kepala Sekolah');

            return view('surat_masuk.edit',compact('suratMasuk','kodeSurat','kepala'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formKirimWaka($id)
    {
        $suratMasuk = DB::table('tb_surat_masuk')
        ->where('tb_surat_masuk.id',$id)
        ->join('tb_user','tb_user.id','=','tb_surat_masuk.tindak_lanjut')
        ->select('tb_surat_masuk.*','tb_user.jabatan')
        ->first();
        $waka=ModelAdmin::all()
        ->where('user_tipe','Wakil Kepala');
        return view('surat_masuk.form_kirim_waka', compact('suratMasuk','waka'));
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aksiKirimWaka(Request $request, $id)
    {
        $s=ModelSuratMasuk::find($request->id);
        $s->status_dikirim= 1;


        $count=$s->save();
        if($count){
        $notification = array(
            'message' => 'Data berhasil terkirim!',
            'alert-type' => 'success',
            'closeButton' => 'false',
        );
        }else{
           $notification = array(
            'message' => 'Data gagal terkirim!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
        );
        
        }
        return redirect('surat_masuk')->with($notification); 
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formPersetujuanDisposisi($id)
    {
        $suratMasuk = ModelSuratMasuk::where('id', $id)->first();
        $waka=ModelAdmin::all()
        ->where('user_tipe','Wakil Kepala');
        return view('surat_masuk.persetujuan_disposisi', compact('suratMasuk','waka'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aksiPersetujuanDisposisi(Request $request, $id)
    {
        $s=ModelSuratMasuk::find($request->id);
        $s->disposisi= $request->txtDisposisi;
        $s->tindak_lanjut= $request->txtTindakLanjut;


        $count=$s->save();
        if($count){
        $notification = array(
            'message' => 'Data berhasil disimpan!',
            'alert-type' => 'success',
            'closeButton' => 'false',
        );
        }else{
           $notification = array(
            'message' => 'Data gagal disimpan!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
        );
        
        }
        return Redirect::back()->with($notification);
    }


     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formBatalDisposisi($id)
    {
        $suratMasuk = ModelSuratMasuk::where('id', $id)->first();
        return view('surat_masuk.batal_disposisi', compact('suratMasuk'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aksiBatalDisposisi(Request $request, $id)
    {
        $s=ModelSuratMasuk::find($request->id);
        $s->disposisi= '0';
        $s->tindak_lanjut='0';
        $s->status_dikirim='0';


        $count=$s->save();
        if($count){
        $notification = array(
            'message' => 'Data disposisi berhasil dibatalkan!',
            'alert-type' => 'success',
            'closeButton' => 'false',
        );
        }else{
           $notification = array(
            'message' => 'Data disposisi gagal dibatalkan!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
        );
        
        }
       return Redirect::back()->with($notification); 
    }


     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formSudahDibaca($id)
    {
        $suratMasuk = ModelSuratMasuk::where('id', $id)->first();
        return view('surat_masuk.sudah_dibaca', compact('suratMasuk'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aksiSudahDibaca(Request $request, $id)
    {
        $s=ModelSuratMasuk::find($request->id);
        $s->sudah_dibaca= '1';


        $count=$s->save();
        if($count){
        $notification = array(
            'message' => 'Data berhasil disimpan!',
            'alert-type' => 'success',
            'closeButton' => 'false',
        );
        }else{
           $notification = array(
            'message' => 'Data gagal di proses!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
        );
        
        }
        return Redirect::back()->with($notification);
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
        $s=ModelSuratMasuk::find($request->id);
        
         $s->surat_masuk_id = $request->txtIdSuratMasuk;
            $s->user_id = '1';
            $s->tanggal_terima = $request->txtTanggalTerima;
            $s->kode_surat_masuk = $request->txtIdKodeSurat;
            $s->no_surat_masuk = $request->txtNoSurat;
            $s->asal_surat_masuk = $request->txtAsalSurat;
            $s->perihal_surat_masuk = $request->txtPerihalSurat;
            $s->tanggal_surat_masuk = $request->txtTanggalSurat;
            $s->disposisi = '0';     
            $s->keterangan_surat_masuk = $request->txtKeterangan;
            $s->validasi = '0';
            // $s->tindak_lanjut = $request->txtTindakLanjut;
        if($request->hasFile('txtFile')){
            $file=$request->file('txtFile');
            $fileName=$file->getClientOriginalName();
            $path='public/image/scan_surat/'.$fileName;
            Image::make($file)->resize(500,700)->save($path);
            $s->file=$fileName;
        }
            

        $count=$s->save();
        if($count){
        $notification = array(
            'message' => 'Data surat masuk berhasil diperbarui!',
            'alert-type' => 'success',
            'closeButton' => 'false',
        );
        }else{
           $notification = array(
            'message' => 'Data surat masuk gagal diperbarui!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
        );
        
        }
        return redirect('surat_masuk')->with($notification); 
    
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

    public function cetakSuratMasuk($id){
        $suratMasuk=DB::table('tb_surat_masuk as ds')
        ->where('ds.id',$id)
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->select('ds.*','ks.kode_surat','u.jabatan')
        ->first();

        $pdf=PDF::loadView('surat_masuk.cetak_surat_masuk',compact('suratMasuk'));
        return $pdf->stream('surat_masuk.pdf');
    }

    public function lembarDisposisi($id){
        $suratMasuk=DB::table('tb_surat_masuk as ds')
        ->where('ds.id',$id)
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->select('ds.*','ks.kode_surat','u.jabatan')
        ->first();
       return view('surat_masuk.lembar_disposisi', compact('suratMasuk'));
    }

    public function laporanSuratMasuk(){
        $laporanSuratMasuk=DB::table('tb_surat_masuk as ds')
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->select('ds.*','ks.kode_surat','u.jabatan as tindak_lanjut2')
        ->get();
        $jumlahSuratMasuk=count($laporanSuratMasuk);
        $kodeSurat=ModelKodeSurat::all();
       return view('laporan.laporan_surat_masuk', compact('laporanSuratMasuk','jumlahSuratMasuk','kodeSurat'));
    }

    public function filterLaporanSuratMasuk(Request $request){
        $awal = $request->txtAwal;
        $akhir = $request->txtAkhir;
        
        $laporanSuratMasuk=DB::table('tb_surat_masuk as ds')
        ->whereBetween('ds.tanggal_terima',[$awal,$akhir])
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.jabatan as tindak_lanjut2')
        ->get();
        $jumlahSuratMasuk=count($laporanSuratMasuk);
        $kodeSurat=ModelKodeSurat::all();
        return view('laporan.laporan_surat_masuk',compact('laporanSuratMasuk','awal','akhir','jumlahSuratMasuk','kodeSurat'));
        
    }

    public function cetakLaporanSuratMasuk(Request $request, $awal, $akhir){

        $laporanSuratMasuk=DB::table('tb_surat_masuk as ds')
        ->whereBetween('ds.tanggal_terima',[$awal,$akhir])
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.jabatan as tindak_lanjut2')
        ->get();
        $jumlahSuratMasuk=count($laporanSuratMasuk);
        $pdf=PDF::loadView('laporan.cetak_laporan_surat_masuk',compact('laporanSuratMasuk','jumlahSuratMasuk'));
        return $pdf->stream('laporan_surat_masuk.pdf');
              
    }

    public function cetakLaporanSuratMasukAll(Request $request){

        $laporanSuratMasuk=DB::table('tb_surat_masuk as ds')
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.jabatan as tindak_lanjut2')
        ->get();
        $jumlahSuratMasuk=count($laporanSuratMasuk);
        $pdf=PDF::loadView('laporan.cetak_laporan_surat_masuk',compact('laporanSuratMasuk','jumlahSuratMasuk'));
        return $pdf->stream('laporan_surat_masuk.pdf');
        
    }
    public function cetakLaporanSuratMasukId(Request $request, $id){

        $laporanSuratMasuk=DB::table('tb_surat_masuk as ds')
        ->where('ds.id',$id)
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.jabatan as tindak_lanjut2')
        ->get();
        $jumlahSuratMasuk=count($laporanSuratMasuk);
        $pdf=PDF::loadView('laporan.cetak_laporan_surat_masuk',compact('laporanSuratMasuk','jumlahSuratMasuk'));
        return $pdf->stream('laporan_surat_masuk.pdf');
              
    }


    public function filterKodeSurat(Request $request){
        $txtKodeSurat = $request->txtKodeSurat;
        $awal = $request->txtAwal;
        $akhir = $request->txtAkhir;
        $laporanSuratMasuk=DB::table('tb_surat_masuk as ds')
        ->where('ds.kode_surat_masuk',$txtKodeSurat)
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.jabatan as tindak_lanjut2')
        ->get();
        $jumlahSuratMasuk=count($laporanSuratMasuk);
        $kodeSurat=ModelKodeSurat::all();
        return view('laporan.laporan_surat_masuk',compact('laporanSuratMasuk','kodeSurat','jumlahSuratMasuk','txtKodeSurat','awal','akhir'));
        
    }



    public function cetakLaporanSuratMasukPerKode(Request $request, $txtKodeSurat){

        $laporanSuratMasuk=DB::table('tb_surat_masuk as ds')
        ->where('ds.kode_surat_masuk',$txtKodeSurat)
        ->leftjoin('tb_kode_surat as ks','ds.kode_surat_masuk','=','ks.id')
        ->leftjoin('tb_user as u','ds.tindak_lanjut','=','u.id')
        ->orderBy('ds.id','desc')
        ->select('ds.*','ks.kode_surat','u.jabatan as tindak_lanjut2')
        ->get();
        $jumlahSuratMasuk=count($laporanSuratMasuk);
        $pdf=PDF::loadView('laporan.cetak_laporan_surat_masuk',compact('laporanSuratMasuk','jumlahSuratMasuk'));
        return $pdf->stream('laporan_surat_masuk.pdf');
              
    }
}

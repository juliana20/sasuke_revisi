<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\ModelAdmin;
use DataTables;
use Carbon\Carbon;
use DB;
use Cookie;
use Alert;
use PDF;
use Redirect;
use Image;
use Illuminate\Support\Str;

class KepalaSekolahController extends Controller
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
            'message' => 'Perhatian, Anda tidak bisa mengakses halaman Kepala Sekolah!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return Redirect::back()->with($notification);
        }else{
            $idAuto=ModelAdmin::where('user_id','LIKE',"%KS%")
            ->max('user_id');
            $noUrut = (int) substr($idAuto, 3, 3);
            $noUrut++;
            $char = "KS";
            $newID = $char . sprintf("%03s", $noUrut);

            $kepalaSekolah=ModelAdmin::all()
            ->where('user_tipe','=','Kepala Sekolah');
            return view('kepala_sekolah.index',compact('kepalaSekolah','newID'));

        }
           
        

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
            'message' => 'Perhatian, Anda tidak bisa mengakses halaman Kepala Sekolah!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return Redirect::back()->with($notification);
        }else{

        $aturan=[
            'txtIdKepalaSekolah' => 'required',
            'txtNamaPegawai' => 'required',
            'txtJabatan' => 'required',
            'txtUsername' => 'required',
            'txtPassword' => 'required',
            'txtStatus' => 'required',
            'txtFoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $pesan=[
            'required'=>'Data ini wajib diisi',
            'image' => 'Mohon upload file gambar'
        ];

        $this->validate($request,$aturan,$pesan);

        $s = new ModelAdmin;
        $s->user_id = $request->txtIdKepalaSekolah;
        $s->nama_pegawai= $request->txtNamaPegawai;
        $s->jabatan = $request->txtJabatan;
        $s->username = $request->txtUsername;
        $s->password = bcrypt($request->txtPassword);
        $s->status= $request->txtStatus;
        $s->user_tipe='Kepala Sekolah';
        
        $file=$request->file('txtFoto');
        $fileName=$file->getClientOriginalName();
        $path='public/image/foto_staff/'.$fileName;
        Image::make($file)->resize(500,700)->save($path);
        $s->foto=$fileName;

        $count=$s->save();
            if($count){
            $notification = array(
            'message' => 'Data kepala sekolah berhasil disimpan!',
            'alert-type' => 'success',
            'closeButton' => 'false',
            );
            }else{
            $notification = array(
            'message' => 'Data kepala sekolah gagal disimpan!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
            );
            
        }
        return redirect('kepala_sekolah')->with($notification);
        }
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
            'message' => 'Perhatian, Anda tidak bisa mengakses halaman Kepala Sekolah!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return Redirect::back()->with($notification);
        }else{
        $kepalaSekolah = ModelAdmin::where('id', $id)->first();
        return view('kepala_sekolah.edit', compact('kepalaSekolah'));
        }
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
            'message' => 'Perhatian, Anda tidak bisa mengakses halaman Kepala Sekolah!',
            'alert-type' => 'warning',
            'closeButton' => 'true',
            );
            return Redirect::back()->with($notification);
        }else{
        $s=ModelAdmin::find($request->id);

        // JIKA FOTO BERUBAH DAN PASSWORD BERUBAH
        if($request->hasFile('txtFoto') && ($s->password!=$request->txtPassword))
        {   
            $file=$request->file('txtFoto');
            $fileName=$file->getClientOriginalName();
            $path='public/image/foto_staff/'.$fileName;
            Image::make($file)->resize(500,700)->save($path);

            $s->user_id = $request->txtIdKepalaSekolah;
            $s->nama_pegawai = $request->txtNamaPegawai;
            $s->jabatan = $request->txtJabatan;
            $s->status= $request->txtStatus;
            $s->username= $request->txtUsername;
            $s->foto=$fileName;
            $s->password=bcrypt($request->txtPassword);
        // JIKA FOTO BERUBAH DAN PASSWORD TIDAK BERUBAH
        }elseif($request->hasFile('txtFoto') && ($s->password==$request->txtPassword)){
            $file=$request->file('txtFoto');
            $fileName=$file->getClientOriginalName();
            $path='public/image/foto_staff/'.$fileName;
            Image::make($file)->resize(500,700)->save($path);

            $s->user_id = $request->txtIdKepalaSekolah;
            $s->nama_pegawai = $request->txtNamaPegawai;
            $s->jabatan = $request->txtJabatan;
            $s->status= $request->txtStatus;
            $s->username= $request->txtUsername;
            $s->foto=$fileName;
            
        }
        // JIKA PASSWORD SAJA DIUBAH
        elseif($s->password!=$request->txtPassword){
            $s->user_id = $request->txtIdKepalaSekolah;
            $s->nama_pegawai = $request->txtNamaPegawai;
            $s->jabatan = $request->txtJabatan;
            $s->status= $request->txtStatus;
            $s->username= $request->txtUsername;
            $s->password=bcrypt($request->txtPassword);
        }
        // JIKA TIDAK BERUBAH FOTO DAN PASSWORD
        else{
            $s->user_id = $request->txtIdKepalaSekolah;
            $s->nama_pegawai = $request->txtNamaPegawai;
            $s->jabatan = $request->txtJabatan;
            $s->status= $request->txtStatus;
            $s->username= $request->txtUsername;
            
        }
        // TAMPILKAN NOTIFIKASI
            $count=$s->save();
            if($count){
            $notification = array(
            'message' => 'Data kepala sekolah berhasil diperbarui!',
            'alert-type' => 'success',
            'closeButton' => 'false',
            );
            }else{
            $notification = array(
            'message' => 'Data kepala sekolah gagal diperbarui!',
            'alert-type' => 'warning',
            'closeButton' => 'false',
            );
            
        }
        //REDIRECT KE HALAMAN
        return redirect('kepala_sekolah')->with($notification);
        }
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
}


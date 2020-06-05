<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAdmin;
use Illuminate\Support\Facades\Hash;
use DB;
use DataTables;
use Session;
use Cookie;
use Alert;
use Redirect;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function index(){
     if(!Session::get('login')){
            alert()->warning('Perhatian','Silahkan login terlebih dahulu!')->persistent('Tutup');
            return redirect('login');
        }
        else{
           $admin=ModelAdmin::all();
            return view('admin.index',compact('admin'));
        }
    }

    public function login(){
        return view('auth.login');
    }

    public function loginPost(Request $request){

        $username=$request->txtUsername;
        $password=$request->txtPassword;
        // $status=$request->txtStatus;
        $data=ModelAdmin::where('username',$username)
        ->first();
        if($data){ //apakah username tersebut ada atau tidak
            if(Hash::check($password,$data->password) AND ($data->status=='Aktif')){
                Session::put('username',$data->username);
                Session::put('id',$data->id);
                Session::put('id_pegawai',$data->id);
                Session::put('jabatan',$data->jabatan);
                Session::put('nama_pegawai',$data->nama_pegawai);
                Session::put('user_tipe',$data->user_tipe);
                Session::put('foto',$data->foto);
                Session::put('login',TRUE);

                return redirect('/dashboard');                  
            }
            elseif($data->status=='Tidak Aktif'){
                $notification = array(
                'message' => 'Login Gagal, Akun anda sudah tidak aktif!',
                'alert-type' => 'error',
                'closeButton' => 'false',
                );
                return redirect('login')->with($notification);
            }    
            else{
                $notification = array(
                'message' => 'Login gagal, Silahkan cek username, password atau jabatan anda!',
                'alert-type' => 'error',
                'closeButton' => 'false',
                );
                return redirect('login')->with($notification);
            }
        }
        else{
             $notification = array(
                'message' => 'Login gagal, Silahkan cek username, password atau jabatan anda!',
                'alert-type' => 'error',
                'closeButton' => 'false',
                );
            return redirect('login')->with($notification);
        }
    }
    public function logout(){
        Session::flush();
        $notification = array(
                'message' => 'Logout berhasil!',
                'alert-type' => 'success',
                'closeButton' => 'false',
                );
        return redirect('login')->with($notification);
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

     public function update(Request $request)
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

    public function akun($id){
            $akun=ModelAdmin::where('id',$id)->first();
            return view('auth.akun',compact('akun'));
    }

    public function editAkun(Request $request, $id){
        $akun=ModelAdmin::find($request->id);
        
        $passwordlama=$request->txtPasswordLama;
         if(Hash::check($passwordlama,$akun->password)){
            $akun->username=$request->txtUsername;
            $akun->password=bcrypt($request->txtPasswordBaru);
            if($request->txtPasswordBaru==$request->txtVerifikasi){       
                $akun->save();
                if($akun->save()){
                    $notification = array(
                    'message' => 'Username / password berhasil diubah!',
                    'alert-type' => 'success',
                    'closeButton' => 'false',
                    );
                    return Redirect::back()->with($notification);
                }
            }else{
                $notification = array(
                    'message' => 'Verifikasi password tidak cocok!',
                    'alert-type' => 'warning',
                    'closeButton' => 'false',
                    );
                return Redirect::back()->with($notification);
            }
        }else{
            $notification = array(
                    'message' => 'Password anda tidak cocok!',
                    'alert-type' => 'error',
                    'closeButton' => 'false',
                    );
            return Redirect::back()->with($notification);
        }
    }
    


}

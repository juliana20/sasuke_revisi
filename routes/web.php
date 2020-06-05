<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





// 

// RUOTE DIPAKAI =============================================================================================================
Route::get('/',function(){
	return view('auth.login');
});
Route::resource('/dashboard','DashboardController');

Route::resource('/admin','AdminController');
Route::resource('/wakil_kepala','WakilKepalaController');
Route::resource('/kepala_sekolah','KepalaSekolahController');
Route::resource('/kode_surat','KodeSuratController');
Route::resource('/surat_masuk','SuratMasukController');
Route::resource('/surat_keluar','SuratKeluarController');

Route::get('/surat_masuk/kirim_waka/{id}','SuratMasukController@formKirimWaka');
Route::put('/surat_masuk/aksi_kirim_waka/{id}','SuratMasukController@aksiKirimWaka');
Route::get('/surat_masuk/edit/{id}','SuratMasukController@edit');
Route::get('/surat_masuk/cetak/{id}','SuratMasukController@cetakSuratMasuk');
Route::get('/surat_masuk/lembar_disposisi/{id}','SuratMasukController@lembarDisposisi');
Route::get('/surat_masuk/persetujuan_disposisi/{id}','SuratMasukController@formPersetujuanDisposisi');
Route::put('/surat_masuk/aksi_persetujuan_disposisi/{id}','SuratMasukController@aksiPersetujuanDisposisi');
Route::get('/surat_masuk/batal_disposisi/{id}','SuratMasukController@formBatalDisposisi');
Route::get('/surat_masuk/aksi_batal_disposisi/{id}','SuratMasukController@aksiBatalDisposisi');
Route::get('/surat_masuk/sudah_dibaca/{id}','SuratMasukController@formSudahDibaca');
Route::get('/surat_masuk/aksi_sudah_dibaca/{id}','SuratMasukController@aksiSudahDibaca');

Route::get('/daftar_belum_dibaca','SuratMasukController@BelumDibaca');
Route::get('/daftar_belum_disposisi','SuratMasukController@BelumDisposisi');
Route::get('/daftar_belum_dikirim','SuratMasukController@BelumDikirim');

Route::get('/laporan_surat_masuk','SuratMasukController@laporanSuratMasuk');
Route::get('/laporan_surat_masuk/filter_periode','SuratMasukController@filterLaporanSuratMasuk');
Route::get('/laporan_surat_masuk/filter_periode/cetak/{awal}/{akhir}','SuratMasukController@cetakLaporanSuratMasuk');
Route::get('/laporan_surat_masuk/filter_periode/cetak','SuratMasukController@cetakLaporanSuratMasukAll');

Route::get('/laporan_surat_masuk/filter_kode_surat','SuratMasukController@filterKodeSurat');
Route::get('/laporan_surat_masuk/filter_kode_surat/cetak/{txtKodeSurat}','SuratMasukController@cetakLaporanSuratMasukPerKode');

Route::get('/laporan_surat_keluar/filter_kode_surat','SuratKeluarController@filterKodeSurat');
Route::get('/laporan_surat_keluar/filter_kode_surat/cetak/{txtKodeSurat}','SuratKeluarController@cetakLaporanSuratKeluarPerKode');


Route::get('/surat_keluar/edit/{id}','SuratKeluarController@edit');
Route::get('/laporan_surat_keluar','SuratKeluarController@laporanSuratKeluar');
Route::get('/laporan_surat_keluar/filter_periode','SuratKeluarController@filterLaporanSuratKeluar');
Route::get('/laporan_surat_keluar/filter_periode/cetak/{awal}/{akhir}','SuratKeluarController@cetakLaporanSuratKeluar');
Route::get('/laporan_surat_keluar/filter_periode/cetak','SuratKeluarController@cetakLaporanSuratKeluarAll');

Route::get('/login','UserController@login');
Route::post('/login_post','UserController@loginPost');
Route::get('/logout', 'UserController@logout');
Route::get('/akun/{id}','UserController@akun');
Route::put('/edit_akun/{id}','UserController@editAkun');

Route::get('/cetak_surat_keluar/{id}','SuratKeluarController@cetakLaporanSuratKeluarId');
Route::get('/cetak_surat_masuk/{id}','SuratMasukController@cetakLaporanSuratMasukId');

Route::get('/belum_isi_no_surat','SuratKeluarController@belumIsiNoSurat');

// =========================================================================================================================

?>
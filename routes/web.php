<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('/welcome', function () {
  return view('welcome');
});

Route::get('/clear-cache', function () {
  Artisan::call('config:clear');
  Artisan::call('cache:clear');
  Artisan::call('config:cache');
  return 'DONE';
});

Auth::routes();
Route::get('/login/cek_email/json', 'UserController@cek_email');
Route::get('/login/cek_password/json', 'UserController@cek_password');
Route::post('/cek-email', 'UserController@email')->name('cek-email')->middleware('guest');
Route::get('/reset/password/{id}', 'UserController@password')->name('reset.password')->middleware('guest');
Route::patch('/reset/password/update/{id}', 'UserController@update_password')->name('reset.password.update')->middleware('guest');

Route::middleware(['auth'])->group(function () {
  Route::get('/', 'HomeController@index')->name('home');
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/jadwal/sekarang', 'JadwalController@jadwalSekarang');
  Route::get('/profile', 'UserController@profile')->name('profile');
  Route::get('/pengaturan/profile', 'UserController@edit_profile')->name('pengaturan.profile');
  Route::post('/pengaturan/ubah-profile', 'UserController@ubah_profile')->name('pengaturan.ubah-profile');
  Route::get('/pengaturan/edit-foto', 'UserController@edit_foto')->name('pengaturan.edit-foto');
  Route::post('/pengaturan/ubah-foto', 'UserController@ubah_foto')->name('pengaturan.ubah-foto');
  Route::get('/pengaturan/email', 'UserController@edit_email')->name('pengaturan.email');
  Route::post('/pengaturan/ubah-email', 'UserController@ubah_email')->name('pengaturan.ubah-email');
  Route::get('/pengaturan/password', 'UserController@edit_password')->name('pengaturan.password');
  Route::post('/pengaturan/ubah-password', 'UserController@ubah_password')->name('pengaturan.ubah-password');

  Route::middleware(['santri'])->group(function () {
      Route::get('/absen/harian', 'SantriController@absen')->name('absen.harian');
      Route::post('/absen/simpan', 'SantriController@simpan')->name('absen.simpan');
      Route::get('/jadwal/santri', 'JadwalController@santri')->name('jadwal.santri');
      // Route::get('/absen/santri', 'Absen@santri')->name('absen.santri');
      Route::resource('absensisantri', 'AbsensiSantri2Controller');
      Route::get('/ulangan/santri', 'UlanganController@santri')->name('ulangan.santri');
      Route::get('/sikap/santri', 'SikapController@santri')->name('sikap.santri');
      Route::get('/rapot/santri', 'RapotController@santri')->name('rapot.santri');
    }
    );

    Route::middleware(['ustadz'])->group(function () {
      Route::get('/absen/harian', 'UstadzController@absen')->name('absen.harian');
      Route::post('/absen/simpan', 'UstadzController@simpan')->name('absen.simpan');
      Route::get('/jadwal/ustadz', 'JadwalController@ustadz')->name('jadwal.ustadz');
      Route::resource('/nilai', 'NilaiController');
      Route::resource('/ulangan', 'UlanganController');
      Route::resource('/sikap', 'SikapController');
      Route::get('/rapot/predikat', 'RapotController@predikat');
      Route::resource('/rapot', 'RapotController');
    }
    );

    Route::middleware(['admin'])->group(function () {
      Route::middleware(['trash'])->group(function () {
          Route::get('/jadwal/trash', 'JadwalController@trash')->name('jadwal.trash');
          Route::get('/jadwal/restore/{id}', 'JadwalController@restore')->name('jadwal.restore');
          Route::delete('/jadwal/kill/{id}', 'JadwalController@kill')->name('jadwal.kill');
          Route::get('/ustadz/trash', 'UstadzController@trash')->name('ustadz.trash');
          Route::get('/ustadz/restore/{id}', 'UstadzController@restore')->name('ustadz.restore');
          Route::delete('/ustadz/kill/{id}', 'UstadzController@kill')->name('ustadz.kill');
          Route::get('/kelas/trash', 'KelasController@trash')->name('kelas.trash');
          Route::get('/kelas/restore/{id}', 'KelasController@restore')->name('kelas.restore');
          Route::delete('/kelas/kill/{id}', 'KelasController@kill')->name('kelas.kill');
          Route::get('/santri/trash', 'SantriController@trash')->name('santri.trash');
          Route::get('/santri/restore/{id}', 'SantriController@restore')->name('santri.restore');
          Route::delete('/santri/kill/{id}', 'SantriController@kill')->name('santri.kill');
          Route::get('/mapel/trash', 'MapelController@trash')->name('mapel.trash');
          Route::get('/mapel/restore/{id}', 'MapelController@restore')->name('mapel.restore');
          Route::delete('/mapel/kill/{id}', 'MapelController@kill')->name('mapel.kill');
          Route::get('/user/trash', 'UserController@trash')->name('user.trash');
          Route::get('/user/restore/{id}', 'UserController@restore')->name('user.restore');
          Route::delete('/user/kill/{id}', 'UserController@kill')->name('user.kill');
        }
        );

        Route::resource('kamar', 'KamarController');
        Route::get('/admin/home', 'HomeController@admin')->name('admin.home');
        Route::get('/admin/pengumuman', 'PengumumanController@index')->name('admin.pengumuman');
        Route::get('/admin/absensisantri', 'AbsensiSantriController@index')->name('admin.absensisantri');
        Route::post('/admin/pengumuman/simpan', 'PengumumanController@simpan')->name('admin.pengumuman.simpan');
        Route::get('/ustadz/absensi', 'UstadzController@absensi')->name('ustadz.absensi');
        Route::get('/ustadz/kehadiran/{id}', 'UstadzController@kehadiran')->name('ustadz.kehadiran');
        Route::get('/absen/json', 'UstadzController@json');
        Route::get('/ustadz/mapel/{id}', 'UstadzController@mapel')->name('ustadz.mapel');
        Route::get('/ustadz/ubah-foto/{id}', 'UstadzController@ubah_foto')->name('ustadz.ubah-foto');
        Route::post('/ustadz/update-foto/{id}', 'UstadzController@update_foto')->name('ustadz.update-foto');
        Route::post('/ustadz/upload', 'UstadzController@upload')->name('ustadz.upload');
        Route::get('/ustadz/export_excel', 'UstadzController@export_excel')->name('ustadz.export_excel');
        Route::post('/ustadz/import_excel', 'UstadzController@import_excel')->name('ustadz.import_excel');
        Route::delete('/ustadz/deleteAll', 'UstadzController@deleteAll')->name('ustadz.deleteAll');
        Route::resource('/ustadz', 'UstadzController');
        Route::get('/kelas/edit/json', 'KelasController@getEdit');
        Route::resource('/kelas', 'KelasController');
        Route::get('/santri/kelas/{id}', 'SantriController@kelas')->name('santri.kelas');
        Route::get('/santri/view/json', 'SantriController@view');
        Route::get('/listsantripdf/{id}', 'SantriController@cetak_pdf');
        Route::get('/santri/ubah-foto/{id}', 'SantriController@ubah_foto')->name('santri.ubah-foto');
        Route::post('/santri/update-foto/{id}', 'SantriController@update_foto')->name('santri.update-foto');
        Route::get('/santri/export_excel', 'SantriController@export_excel')->name('santri.export_excel');
        Route::post('/santri/import_excel', 'SantriController@import_excel')->name('santri.import_excel');
        Route::delete('/santri/deleteAll', 'SantriController@deleteAll')->name('santri.deleteAll');
        Route::resource('/santri', 'SantriController');
        Route::get('/mapel/getMapelJson', 'MapelController@getMapelJson');
        Route::resource('/mapel', 'MapelController');
        Route::get('/absen/santri', 'Absen@santri')->name('absen.santri');
        Route::get('/jadwal/view/json', 'JadwalController@view');
        Route::get('/jadwalkelaspdf/{id}', 'JadwalController@cetak_pdf');
        Route::get('/jadwal/export_excel', 'JadwalController@export_excel')->name('jadwal.export_excel');
        Route::post('/jadwal/import_excel', 'JadwalController@import_excel')->name('jadwal.import_excel');
        Route::delete('/jadwal/deleteAll', 'JadwalController@deleteAll')->name('jadwal.deleteAll');
        Route::resource('/jadwal', 'JadwalController');
        Route::get('/ulangan-kelas', 'UlanganController@create')->name('ulangan-kelas');
        Route::get('/ulangan-santri/{id}', 'UlanganController@edit')->name('ulangan-santri');
        Route::get('/ulangan-show/{id}', 'UlanganController@ulangan')->name('ulangan-show');
        Route::get('/sikap-kelas', 'SikapController@create')->name('sikap-kelas');
        Route::get('/sikap-santri/{id}', 'SikapController@edit')->name('sikap-santri');
        Route::get('/sikap-show/{id}', 'SikapController@sikap')->name('sikap-show');
        Route::get('/rapot-kelas', 'RapotController@create')->name('rapot-kelas');
        Route::get('/rapot-santri/{id}', 'RapotController@edit')->name('rapot-santri');
        Route::get('/rapot-show/{id}', 'RapotController@rapot')->name('rapot-show');
        Route::get('/predikat', 'NilaiController@create')->name('predikat');
        Route::resource('/user', 'UserController');
      }
      );
    });

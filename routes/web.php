<?php

use Illuminate\Support\Facades\Route;


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

    Route::get('/login', function () { return view('login'); })->name('login')->middleware('guest');
    Route::post('/login_process', 'App\Http\Controllers\UserController@loginWeb')->middleware('guest');

    Route::get('/', function () { return view('home'); })->name('home');

    Route::post('/all_kategori', 'App\Http\Controllers\KadoController@kategori');
    Route::post('/all_kado', 'App\Http\Controllers\KadoController@index');
    Route::post('/detail_kado/{id}/{slug}', 'App\Http\Controllers\KadoController@detailKado');

    Route::get('/rekomendasi-kado-{group}/{id}/{slug}', function () { return view('rekomendasi_kado'); });

    Route::get('/inspirasi-kado-{group}', 'App\Http\Controllers\KadoController@relatedKado');
    Route::post('/search_inspirasi_kado', 'App\Http\Controllers\KadoController@searchRelatedKado');

    Route::get('/blog', 'App\Http\Controllers\BlogController@index');
    Route::get('/blog/{id}/{slug}', 'App\Http\Controllers\BlogController@detailBlog');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/logout', 'App\Http\Controllers\UserController@logout');
        Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');

        // Master kategori
        Route::get('/master/kategori', 'App\Http\Controllers\Admin\MasterKategoriController@index');
        Route::post('/master/add_kategori', 'App\Http\Controllers\Admin\MasterKategoriController@addData');
        Route::post('/master/search_kategori', 'App\Http\Controllers\Admin\MasterKategoriController@searchData');
        Route::post('/master/edit_kategori', 'App\Http\Controllers\Admin\MasterKategoriController@editData');
        Route::post('/master/update_kategori', 'App\Http\Controllers\Admin\MasterKategoriController@updateData');
        Route::post('/master/delete_kategori', 'App\Http\Controllers\Admin\MasterKategoriController@deleteData');

        //Master Group
        Route::get('/master/group', 'App\Http\Controllers\Admin\MasterGroupController@index');
        Route::post('/master/search_group', 'App\Http\Controllers\Admin\MasterGroupController@searchData');
        Route::post('/master/add_group', 'App\Http\Controllers\Admin\MasterGroupController@addData');
        Route::post('/master/edit_group', 'App\Http\Controllers\Admin\MasterGroupController@editData');
        Route::post('/master/update_group', 'App\Http\Controllers\Admin\MasterGroupController@updateData');
        Route::post('/master/delete_group', 'App\Http\Controllers\Admin\MasterGroupController@deleteData');

        //Master Kado
        Route::get('/master/kado', 'App\Http\Controllers\Admin\MasterKadoController@index');
        Route::post('/master/search_kado', 'App\Http\Controllers\Admin\MasterKadoController@searchData');
        Route::post('/master/add_kado', 'App\Http\Controllers\Admin\MasterKadoController@addData');
        Route::get('/master/edit_kado/{id}', 'App\Http\Controllers\Admin\MasterKadoController@editData');
        Route::post('/master/update_detail_kado/{id}', 'App\Http\Controllers\Admin\MasterKadoController@updateDetailKado');
        Route::post('/master/add_kategori_kado', 'App\Http\Controllers\Admin\MasterKadoController@addKategoriKado');
        Route::post('/master/delete_kategori_kado', 'App\Http\Controllers\Admin\MasterKadoController@deleteKategoriKado');
        Route::post('/master/add_lokasi_kado', 'App\Http\Controllers\Admin\MasterKadoController@addLokasiKado');
        Route::post('/master/delete_lokasi_kado', 'App\Http\Controllers\Admin\MasterKadoController@deleteLokasiKado');
        Route::post('/master/add_foto_kado/{id}', 'App\Http\Controllers\Admin\MasterKadoController@addFotoKado');
        Route::post('/master/set_thumbnail', 'App\Http\Controllers\Admin\MasterKadoController@setThumbnail');
        Route::post('/master/set_fg_aktif', 'App\Http\Controllers\Admin\MasterKadoController@setFgAktif');

        // Master Blog
        Route::get('/master/blog', 'App\Http\Controllers\Admin\MasterBlogController@index');
        Route::post('/master/add_blog', 'App\Http\Controllers\Admin\MasterBlogController@addBlog');
        Route::get('/master/list_blog', 'App\Http\Controllers\Admin\MasterBlogController@listBlog')->name('list_blog');
        Route::post('/master/search_list_blog', 'App\Http\Controllers\Admin\MasterBlogController@searchListBlog');
        Route::get('/master/edit_blog/{id}', 'App\Http\Controllers\Admin\MasterBlogController@editBlog');
        Route::post('/master/update_blog/{id}', 'App\Http\Controllers\Admin\MasterBlogController@updateBlog');

        // CK Editor
        Route::post('ckeditor/upload', 'App\Http\Controllers\Admin\UploadController@upload')->name('upload.upload');
    });




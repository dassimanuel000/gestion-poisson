<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Auth;

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

//Auth::routes();

/*Route::get('/', function () {
    //return view('login');
    return ('login');
});*/

Route::redirect('/', 'login', 302);

Route::group(['middleware' => ['auth', 'admin']], function(){

    Route::get('/dashboard', function(){
        return view('index');
    });

    Route::view('/stat', 'stat')->name('stat.index');

    Route::get('/dashboard','dashboard_controller@index')->name('admin.dashboard');

    ///ELEVE

    Route::get('/add_eleve','dashboard_controller@add_eleve')->name('admin.add_eleve');

    Route::post('/form_add_eleve', 'dashboard_controller@form_add_eleve')->name('form_add_eleve');

    Route::post('/form_print_eleve', 'dashboard_controller@form_print_eleve')->name('form_print_eleve');

    Route::get('/print_eleve/{id}', 'dashboard_controller@print_eleve')->name('print_eleve');

    Route::get('/list_eleve', 'dashboard_controller@list_eleve')->name('list_eleve');

    Route::get('/search_eleve', 'dashboard_controller@search_eleve')->name('search_eleve');

    Route::get('/search','dashboard_controller@search')->name('search');    

    Route::get('/edit_eleve/{id}', 'dashboard_controller@edit_eleve')->name('edit_eleve');

    Route::put('/form_edit_eleve/{id}', 'dashboard_controller@form_edit_eleve')->name('form_edit_eleve');

    /////CLASSE

    Route::get('/add_classe','dashboard_controller@add_classe')->name('admin.add_classe');

    Route::get('/form_add_classe', 'dashboard_controller@form_add_classe')->name('form_add_classe');

    Route::get('/list_classe/{id}', 'dashboard_controller@list_classe')->name('list_classe');

    Route::get('/specific_classe/{id}', 'dashboard_controller@specific_classe')->name('specific_classe');

    Route::get('/delete_classe/{id}', function ($id) {
        $delete = DB::delete('delete FROM classe where id = '.$id.' ');
        return redirect()->back()->with('success', 'success');
    });

    Route::get('/form_edit_classe', 'dashboard_controller@form_edit_classe')->name('form_edit_classe');

    Route::get('/all_classe','dashboard_controller@all_classe')->name('admin.all_classe');

    Route::get('/edit_classe/{id}', 'dashboard_controller@edit_classe')->name('edit_classe.index');

    ////ENSEIGNANT

    Route::get('/list_enseignant','dashboard_controller@list_enseignant')->name('admin.list_enseignant');

    Route::get('/add_enseignant','dashboard_controller@add_enseignant')->name('admin.add_enseignant');

    Route::post('/form_add_enseignant', 'dashboard_controller@form_add_enseignant')->name('form_add_enseignant');

    Route::get('/voir_enseignant/{id}','dashboard_controller@voir_enseignant')->name('admin.voir_enseignant');

    Route::get('/edit_enseignant/{id}','dashboard_controller@edit_enseignant')->name('admin.edit_enseignant');

    Route::put('/form_edit_enseignant/{id}', 'dashboard_controller@form_edit_enseignant')->name('form_edit_enseignant');


    //////////SCOLARIETE

    Route::get('/add_scolarite/{id}','dashboard_controller@add_scolarite')->name('admin.add_scolarite');

    Route::get('/print_scolarite/{id}','dashboard_controller@print_scolarite')->name('admin.print_scolarite');

    Route::get('/form_add_scolarite', 'dashboard_controller@form_add_scolarite')->name('form_add_scolarite');

    Route::get('/list_scolarite','dashboard_controller@list_scolarite')->name('admin.list_scolarite');

    Route::get('/list_scolarite/{id}','dashboard_controller@list_scolarite_id')->name('admin.list_scolarite');

    Route::get('/red_list','dashboard_controller@red_list')->name('admin.red_list');


    ///////////BUS

    Route::get('/add_bus','dashboard_controller@add_bus')->name('admin.add_bus');

    Route::get('/list_bus','dashboard_controller@list_bus')->name('admin.list_bus');

    Route::get('/form_add_bus', 'dashboard_controller@form_add_bus')->name('form_add_bus');

    Route::get('/search_bus', 'dashboard_controller@search_bus')->name('search_bus');

    Route::get('/add_bus/{id}','dashboard_controller@add_bus_id')->name('admin.add_bus');

    Route::get('/print_bus','dashboard_controller@print_bus')->name('admin.print_bus');

    Route::get('/edit_bus/{id}','dashboard_controller@edit_bus')->name('admin.edit_bus');

    Route::get('/form_edit_bus','dashboard_controller@form_edit_bus')->name('admin.form_edit_bus');

    Route::get('/delete_bus/{id}', function ($id) {
        $delete = DB::delete('delete FROM bus_eleve where id = '.$id.' ');
        return redirect()->back()->with('success', 'success');
    });

    /////////////CRECHE

    Route::get('/add_creche','dashboard_controller@add_creche')->name('admin.add_creche');

    Route::get('/list_creche','dashboard_controller@list_creche')->name('admin.list_creche');

    Route::post('/form_add_creche', 'dashboard_controller@form_add_creche')->name('form_add_creche');

    Route::get('/print_creche/{id}','dashboard_controller@print_creche')->name('admin.print_creche');

    Route::get('/edit_creche','dashboard_controller@edit_creche')->name('admin.edit_creche');

    Route::get('/edit_creche_id/{id}','dashboard_controller@edit_creche_id')->name('admin.edit_creche_id');

    Route::post('/form_edit_creche', 'dashboard_controller@form_edit_creche')->name('form_edit_creche');
    
    Route::get('/delete_creche/{id}', function ($id) {
        $delete = DB::delete('delete FROM creche where id = '.$id.' ');
        return redirect()->back()->with('success', 'success');
    });


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

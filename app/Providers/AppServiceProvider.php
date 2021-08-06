<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();


        view()->composer('layouts.master', function($view)
        {
            $group = DB::table('kado_groups as a')->orderBy('a.nama_group')->get();
            $kategori = DB::table('kategori as a')->orderBy('a.nama_kategori')->get();
            $data['layout_kategori'] = $kategori;
            $data['layout_group'] = $group;

            $view->with($data);
        });
    }
}

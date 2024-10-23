<?php

namespace App\Http\Controllers;

use App\Models\Products\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index()
    {
        //        $routes = Route::getRoutes()->getRoutesByName();
        //
        //        $routeNames = array_keys($routes);
        //
        //        $remove = ['home', 'contact', 'shop', 'register', 'login'];
        //
        //        $routeNames = array_diff($routeNames, $remove);
        //
        //        $routeNames = array_values($routeNames);


        //        dd($routeNames);

        $members = User::count();
        $activeProducts = Products::where('status', 1)->count();
        $draftProducts = Products::where('status', 0)->count();
        return view('panel.dashboard', [
            'members' => $members,
            'activeProducts' => $activeProducts,
            'draftProducts' => $draftProducts
        ]);
    }
}

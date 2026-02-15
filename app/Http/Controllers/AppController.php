<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taches;

class AppController extends Controller
{
    public function dashbord(){
        $total_taches = Taches::count();
        return view('dashbord', compact('total_taches'));
    }


}

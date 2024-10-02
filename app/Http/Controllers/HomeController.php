<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Models\Services;
use App\Models\Blogs;

class HomeController extends Controller
{
    public function index(){
        $sliders=Sliders::get();
        $services=Services::get();
        $blog=Blogs::orderBy('id','asc')->limit(3)->get();
        return view('home',[
            'sliders'=>$sliders, 'services'=>$services, 'blog'=>$blog,
        ]);
    }
}

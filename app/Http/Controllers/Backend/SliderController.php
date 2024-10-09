<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $slider=Sliders::get();  
        return view('backend.sliders.index',['slider'=>$slider]);
    }
}

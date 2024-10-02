<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogController extends Controller
{
    public function blog(){
        $blog=Blogs::orderBy('id','desc')->get();
        $blog_terbaru=Blogs::orderBy('id','desc')->limit(2)->get();
        $blog_lainnya=Blogs::orderBy('id','asc')->get();
        return view('blog',[
            'blog'=>$blog,
            'blog_terbaru'=>$blog_terbaru,
            'blog_lainnya'=>$blog_lainnya,
        ]);
    }
    public function detail(){
        $detail=Blogs::orderBy('id','asc')->limit(1)->get();
        $detail_terbaru=Blogs::orderBy('id','desc')->limit(2)->get();
        return view('blog_detail',[
            'detail'=>$detail,
            'detail_terbaru'=>$detail_terbaru,
        ]);

    }
    
}

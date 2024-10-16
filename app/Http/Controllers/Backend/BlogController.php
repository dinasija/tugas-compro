<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    public function index(){
        $blog=Blogs::get();
        return view('backend.blog.index',['blog'=>$blog]);
    }

    public function tambah(){
        return view('backend.blog.tambah');
    }

    public function aksi_tambah(Request $request)
    {
        $request->validate([
            'tittle' => 'required',
            'description' => 'required',
            'file' => 'required|file|mimes:jpg,png|max:2048',
        ]);
        $data = [
            'tittle'=>$request->tittle,
            'description'=>$request->description,
            'slug'=>Str::slug($request->tittle),
            'created_by'=>0,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('blogs'), $filename);
        
            $data['file'] = 'blogs/' . $filename;
        }
        Blogs::insert($data);
        return redirect()->route('backend.blog')->with('success', 'blog berhasil ditambahkan');
    }
}

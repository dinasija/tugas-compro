<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $slider=Sliders::get();  
        return view('backend.sliders.index',['slider'=>$slider]);
    }

    public function tambah(){
        return view('backend.sliders.tambah');
    }

    public function edit($id){
        $slider = Sliders::where('id', $id)->first();
        return view('backend.sliders.edit',['sliders'=>$slider]);
    }
    public function aksi_edit(Request $request, $id){
        $request->validate([
            'tittle' => 'required',
            'description' => 'required',
            'file' => 'required|file|mimes:jpg,png|max:2048',
        ]);
        $data = [
            'tittle'=>$request->tittle,
            'description'=>$request->description,
            'slug'=>Str::slug($request->tittle),
        ];
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('sliders'), $filename);
            $data['file'] = 'sliders/' . $filename;
            $ambilDataBlog = Sliders::where('id', $id)->first();
            // $this->hapus_gambar($ambilDataBlog->file);
        }
        Sliders::where('id', $id)->update($data);
        return redirect()->route('backend.sliders')->with('success', 'slider berhasil diubah');
    }
}

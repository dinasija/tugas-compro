<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $service=Services::get();
        return view('backend.services.index',['service'=>$service]);
    }   

    public function tambah(){
        return view('backend.services.tambah');
    }

    // public function edit($id){
    //     $service = Services::where('id', $id)->first();
    //     return view('backend.services.edit',['services'=>$service]);
    // }
    // public function aksi_edit(Request $request, $id){
    //     $request->validate([
    //         'tittle' => 'required',
    //         'description' => 'required',
    //     ]);
    //     $data = [
    //         'tittle'=>$request->tittle,
    //         'description'=>$request->description,
    //         'slug'=>Str::slug($request->tittle),
    //     ];
        
    //    Services::where('id', $id)->update($data);
    //     return redirect()->route('backend.services')->with('success', 'blog berhasil diubah');
    // }
}

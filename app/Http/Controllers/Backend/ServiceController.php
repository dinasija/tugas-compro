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

    public function aksi_tambah(Request $request)
    {
        $request->validate([
            'tittle' => 'required',
            'description' => 'required',
        ]);
        $data = [
            'tittle'=>$request->tittle,
            'description'=>$request->description,
            'file' => '',
            // slug digunakan dalam proses penyimpanan data ke dalam basis data (database) untuk menghasilkan slug dari judul atau teks tertentu.
            'created_at' => date('Y-m-d h:i:s'),
        ];

       
        
        Services::insert($data);
        return redirect()->route('backend.services')->with('success', 'service berhasil ditambahkan');
    }

    public function aksi_hapus($id){
        $ambilDataService = Services::where('id', $id)->first();
        Services::where('id', $id)->delete();
        return redirect()->back(); 
    }

    public function edit($id){
        $service = Services::where('id', $id)->first();
        return view('backend.services.edit',['services'=>$service]);
    }
    public function aksi_edit(Request $request, $id){
        $request->validate([
            'tittle' => 'required',
            'description' => 'required',
        ]);
        $data = [
            'tittle'=>$request->tittle,
            'description'=>$request->description,
            
        ];
        
       Services::where('id', $id)->update($data);
        return redirect()->route('backend.services')->with('success', 'layanan berhasil diubah');
    }
}

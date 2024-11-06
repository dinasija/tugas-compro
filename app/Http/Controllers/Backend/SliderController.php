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
            // slug digunakan dalam proses penyimpanan data ke dalam basis data (database) untuk menghasilkan slug dari judul atau teks tertentu.
            
        ];

        if ($request->hasFile('file')) {
            // Memeriksa apakah dalam permintaan HTTP terdapat file dengan nama input
            $file = $request->file('file');
            // digunakan untuk mengambil file yang diunggah melalui form di Laravel
            $filename = time(). '.' .$file->getClientOriginalExtension();
            // digunakan untuk membuat nama file unik ketika file diunggah, dengan mempertahankan ekstensi asli file. Metode getClientOriginalExtension() dari objek UploadedFile mengembalikan ekstensi asli file yang diunggah oleh pengguna.
            $file->move(public_path('sliders'), $filename);
            // digunakan untuk memindahkan file yang diunggah ke direktori yang ditentukan (dalam hal ini, direktori 'blogs' di direktori public). Metode move() dari objek UploadedFile memindahkan file yang diunggah ke lokasi yang ditentukan dan memberikan nama file yang baru.
            $data['file'] = 'sliders/' . $filename;
            // digunakan untuk menyimpan path file yang baru dihasilkan ke dalam array $data, yang akan digunakan untuk menyimpan informasi file ke dalam basis data.   
        }
        Sliders::insert($data);
        return redirect()->route('backend.slider')->with('success', 'slider berhasil ditambahkan');
    }

    public function aksi_hapus($id){
        $ambilDataSlider = Sliders::where('id', $id)->first();
        Sliders::where('id', $id)->delete();
        $this->hapus_gambar($ambilDataSlider->file);
        return redirect()->back(); 
    }
    protected function hapus_gambar($gambar){
        if (file_exists($gambar)) {
            unlink($gambar);
        }
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
        ];
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('sliders'), $filename);
            $data['file'] = 'sliders/' . $filename;
            $ambilDataSlider = Sliders::where('id', $id)->first();
            $this->hapus_gambar($ambilDataSlider->file);
        }
        Sliders::where('id', $id)->update($data);
        return redirect()->route('backend.slider')->with('success', 'slider berhasil diubah');
    }
}

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
            // slug digunakan dalam proses penyimpanan data ke dalam basis data (database) untuk menghasilkan slug dari judul atau teks tertentu.
            'created_by'=>0,
        ];

        if ($request->hasFile('file')) {
            // Memeriksa apakah dalam permintaan HTTP terdapat file dengan nama input
            $file = $request->file('file');
            // digunakan untuk mengambil file yang diunggah melalui form di Laravel
            $filename = time(). '.' .$file->getClientOriginalExtension();
            // digunakan untuk membuat nama file unik ketika file diunggah, dengan mempertahankan ekstensi asli file. Metode getClientOriginalExtension() dari objek UploadedFile mengembalikan ekstensi asli file yang diunggah oleh pengguna.
            $file->move(public_path('blogs'), $filename);
            // digunakan untuk memindahkan file yang diunggah ke direktori yang ditentukan (dalam hal ini, direktori 'blogs' di direktori public). Metode move() dari objek UploadedFile memindahkan file yang diunggah ke lokasi yang ditentukan dan memberikan nama file yang baru.
            $data['file'] = 'blogs/' . $filename;
            // digunakan untuk menyimpan path file yang baru dihasilkan ke dalam array $data, yang akan digunakan untuk menyimpan informasi file ke dalam basis data.   
        }
        Blogs::insert($data);
        return redirect()->route('backend.blog')->with('success', 'blog berhasil ditambahkan');
    }

    public function aksi_hapus($id){
        $ambilDataBlog = Blogs::where('id', $id)->first();
        Blogs::where('id', $id)->delete();
        $this->hapus_gambar($ambilDataBlog->file);
        return redirect()->back(); 
    }
    protected function hapus_gambar($gambar){
        if (file_exists($gambar)) {
            unlink($gambar);
        }
    }

    public function edit($id){
        $blog = Blogs::where('id', $id)->first();
        return view('backend.blog.edit',['blog'=>$blog]);
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
            $file->move(public_path('blogs'), $filename);
            $data['file'] = 'blogs/' . $filename;
            $ambilDataBlog = Blogs::where('id', $id)->first();
            $this->hapus_gambar($ambilDataBlog->file);
        }
        Blogs::where('id', $id)->update($data);
        return redirect()->route('backend.blog')->with('success', 'blog berhasil diubah');
    }
}

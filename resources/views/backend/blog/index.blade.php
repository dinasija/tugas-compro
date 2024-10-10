@extends('backend.layouts.master')

@section('content')
<div class="container-fluid">

                    <div class="container">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Blog</h6>
                            </div>
                            <div class="card-body">
                                <a href="{{route('backend.blog.tambah')}}" class="btn btn-primary mb-2">Tambah</a>
                                <div class="table-responsive">
                                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Judul</th>
                                                <th>File</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                        @php 
                                        $no=1;
                                        @endphp 
                                            @foreach ($blog as $item)  
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$item->tittle}}</td>
                                                <td><img src="{{asset($item->file)}}" width="100" alt=""></td>
                                                <td><a href="" class="btn btn-warning">Edit</a>
                                                @csrf
                                                <button class="btn btn-danger">Hapus</button></td>                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

</div>
@endsection
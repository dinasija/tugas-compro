@extends('layouts.master')
@section('content')
<div id="content">
      <div class="container">
        <div class="row">
            <div class="col-8 p-4 ">
                @foreach ($blog as $item)
                <div class="row my-2">
                    <div class="col-5">
                        <img src="{{$item->file}}" alt="" class="images border-radius w-100 h-100">
                    </div>
                    <div class="col-7">
                        <h3>{{$item->tittle}}</h3>
                        <h6 class="mb-0">{{$item->description}}</h6>
                        <a href="{{route('blog_detail')}}" class="text-black">read more</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-4 ">
                <h3>Blog Terbaru</h3>
                @foreach ($blog_terbaru as $item)
                    <div class="row p-2 my-2">
                        <div class="col-6">
                            <img src="{{$item->file}}" alt="" class="border-radius w-100 ">
                        </div>
                        <div class="col-6">
                            <h5 class="card-title">{{$item->tittle}}</h5>
                            <h6 class="mb-0">{{$item->description}}</h6>
                        </div>                     
                    </div>
                @endforeach
            </div> 
        </div>
      </div>
      <div class="container">
        <h3>Blog Lainnya</h3>
        <div class="row my-2">
            @foreach ($blog_lainnya as $item)
            <div class="col-6">
                <div class="row my-2">
                    <div class="col-6 ">
                        <img src="{{$item->file}}" alt="" class="h-100 w-100 border-radius ">
                    </div>
                    <div class="col-6 ">
                        <h3>{{$item->tittle}}</h3>
                        <h6 class="mb-0">{{$item->description}}</h6>
                        <a href="{{route('blog_detail')}}" class="text-black">read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
</div>
@endsection
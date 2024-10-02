
@extends('layouts.master')
@section('content')
<div id="content">
    <div class="container">
      <div class="row">
        @foreach ($detail as $item)
          <div class="col-8 ">
              <img src="{{asset($item->file)}}" alt="" class="images border-radius w-100">
              <h1>{{$item->tittle}}</</h1>
              <h5>{{$item->description}}</h5>
              <p>{{$item->slug}}</p>
          </div>
        @endforeach
          <div class="col-4 ">
              <h3>Blog Terbaru</h3>
                @foreach ($detail_terbaru as $item)
                  <div class="row p-2 mt-2">
                      <div class="col-6 ">
                          <img src="{{asset($item->file)}}" alt="" class="images border-radius w-100 ">
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
</div>
@endsection

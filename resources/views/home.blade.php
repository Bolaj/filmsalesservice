@extends('layouts.app')

@section('content')
@foreach ($movie as $item)
    <div class="container col-6 col-sm-6">
        <div class="card mb-3" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="{{ asset('uploads/movies/'.$item->movie_cover) }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Title:{{ $item->title }}</h5>
                <p class="card-text">Description:{{ $item->description }}</p>
                <p class="card-text"><button class="btn btn-info btn-sm">Price:{{ $item->price }}</button></p>
                <p class="card-text"><small class="text-muted">Star:{{ $item->star }} | Genre:{{ $item->genre }} | Released Date: {{ $item->released_date }}</small></p>
                @guest
                @if (Route::has('readmore'))
                <a href="{{ url('readmore', $item->id ) }}" class="btn btn-danger btn-sm ">Read More..</a>
                @endif
                @else
                <a href="{{ url('admin/purchase-movie', $item->id ) }}" class="btn btn-primary btn-sm ">Purchase</a>
                <a href="{{ url('admin/watch-movie', $item->id ) }}" class="btn btn-danger btn-sm ">Watch Triller</a>
              
                @endguest
                
              </div>
            </div>
          </div>
        </div>
    </div>   
    @endforeach
@endsection
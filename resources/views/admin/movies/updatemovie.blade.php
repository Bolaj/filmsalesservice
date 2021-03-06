@extends('admin.layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            <h4>{{ session('status') }}</h4>
          </div>
          @endif
            <div class="card">
                <div class="card-header"><h5>Update Movie <a href="{{ route('admin.show.movies') }}" class="btn btn-danger float-end">Back</a></h5></div>
                <div class="card-body">
                    <form method="POST" action="/admin/edit-movie/{{ $movie->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                          <label for="title" class="col-sm-2 col-form-label">Title</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $movie->title }}" id="title" name="title">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="description" class="col-sm-2 col-form-label">Description</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" id="description" value="{{ $movie->description }}" name="description" rows="3"></textarea>
                          </div>
                        </div>
                        <div class="row mb-3">
                            <label for="star" class="col-sm-2 col-form-label">Star </label>
                            <div class="col-sm-10">
                                <select class="form-select form-select-sm" value="{{ $movie->star }}" id="star" name="star" aria-label=".form-select-sm example">
                                    <option selected>Select Star Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" value="{{ $movie->genre }}" id="genre" name="genre">
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="number" step="any" class="form-control" value="{{ $movie->price }}" id="price" name="price">
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="released_date" class="col-sm-2 col-form-label">Released Date </label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $movie->released_date }}" id="released_data" name="released_date" type="date"  placeholder="dd/mm/yyyy"> 
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="movie_cover" class="col-sm-2 col-form-label">Movie Cover </label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $movie->movie_cover }}" id="movie_cover" name="movie_cover" type="file"  placeholder="Select Movie Cover"> 
                                <img src="{{ asset('uploads/movies'.$movie->movie_cover) }}" width="80px" height="80px" alt="img">
                            </div>
                          </div>
                        
                        <button type="submit" class="btn btn-primary">Update Movie</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
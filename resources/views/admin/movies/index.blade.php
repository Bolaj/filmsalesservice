@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-header">
            <h5>All Movies
              <a href="{{ route('admin.add.movie') }}" class="btn btn-danger float-end">Back</a>
            </h5>
          </div>
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Star Ratings</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Released Date</th>
                    <th>Movie Cover</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($movie as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->star }}</td>
                    <td>{{ $item->genre }}</td>
                    <td>N{{ $item->price }}</td>
                    <td>{{ $item->released_date }}</td>
                    <td>
                      <img src="{{ asset('/uploads/movies/'.$item->movie_cover) }}" width="80px" height="80px" alt="img">
                    </td>
                    <td>
                      <a href="{{ url('admin/edit-movie', $item->id ) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                   <td>
                    <form action="{{ url('admin/delete-movie', $item->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                   </td>
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
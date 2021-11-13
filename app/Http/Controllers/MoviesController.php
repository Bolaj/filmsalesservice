<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie = Movie::all();
        return view('admin.movies.index', compact('movie'));
    }

    public function registerMovie()
    {
        return view('admin.movies.registermovie');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMovie(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'star'=>'required|integer',
            'genre'=>'required|string',
            'price'=>'required|string',
            'released_date'=>'required|date',
            'movie_cover'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->star= $request->input('star');
        $movie->genre = $request->input('genre');
        $movie->price = $request->input('price');
        $movie->released_date = $request->input('released_date');
        if($request->hasFile('movie_cover'))
        {
            $file = $request->file('movie_cover');
            
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('uploads/movies/', $filename);
            $movie->movie_cover = $filename;
        }
        $movie->save();
        return redirect()->back()->with('status', 'Movie Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purchaseMovie($id)
    {
        $movie = Movie::find($id);
        return view('admin.movies.purchasemovie', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMovie($id)
    {
        $movie = Movie::find($id);
        return view('admin.movies.updatemovie', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->star= $request->input('star');
        $movie->genre = $request->input('genre');
        $movie->price = $request->input('price');
        $movie->released_date = $request->input('released_date');

        if($request->hasFile('movie_cover'))
        {
            $destination = 'uploads/movies/'.$movie->movie_cover;
            if(File::exists($destination))
            {
                File::delete($destination);

            }
            $file = $request->file('movie_cover');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('uploads/movies/', $filename);
            $movie->movie_cover = $filename;
        }
        
        $movie->update();
        return redirect()->to('/admin/update/'.$id)->with('status', 'Movie Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMovie($id)
    {
        $movie = Movie::find($id);

        $destination = 'uploads/movies/'.$movie->movie_cover;
        if(File::exists($destination))
        {
             File::delete($destination);

        }
        $movie->delete();
        
        return redirect()->back()->with('status', 'Movie Deleted Successfully');
    }
}

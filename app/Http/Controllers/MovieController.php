<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * @var Movie
     */
    private $movie;

    public function __construct()
    {
        $this->movie = new Movie();
    }

    /**
     * Display all movies
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Movie::all();
        return response()->json($data);
    }

    /**
     * Sort movie by year.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sortByYear()
    {
        $data = $this->movie->selectionSort(Movie::all(), false);
        return response()->json($data);
    }

    /**
     * Search movie by year.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchByYear(Request $request)
    {
        $year   = $request->year;
        $id     = $this->movie->binarySearch(Movie::all(), $year);
        if($id == -1) {
            return response()->json("Movie not found", 404);
        } else {
            return response()->json(Movie::findOrFail($id));
        }
    }

    /**
     * Search movie by title
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchKeyword(Request $request)
    {
        $result = $this->movie->linearSearch(Movie::all(), $request->keyword);
        if($result == -1) {
            return response()->json("Movie not found", 404);
        } else {
            return response()->json(Movie::findOrFail($result));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}

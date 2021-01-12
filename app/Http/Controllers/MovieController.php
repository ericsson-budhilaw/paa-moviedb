<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function login(Request $request) {
        $validator  = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|string|min:6'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    public function verify() {
        return response()->json([
            'valid' => auth()->check(),
            'user'  => auth()->user()
        ]);
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

    public function createNewToken($token) {
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'user'          => Auth::user()
        ]);
    }

    public function webAdminInfo() {
        $maxMovies  = User::all()->count();
        $maxUsers   = Movie::all()->count();

        return response()->json([
            'movies'    => $maxMovies,
            'users'     => $maxUsers
        ]);
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

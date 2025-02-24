<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Http\Controllers\User;

class GameController extends Controller
{

    public function allgames(){
        $games = Game::all();
        return response()->json([
            'games' => $games
        ]);
    }

    public function  mygames(){
       
        $games = Game::where('id', auth()->id())->get();
        return response()->json([
            'games' => $games
        ]);
    }

    public function validation(Request $request){
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:50',
        ], [
            'title.required' => 'The game title is required.',
            'description.required' => 'The game description is required.',
            'release_date.date' => 'The release date must be a valid date.',
            'genre.required' => 'The game genre is required',
        ]
    );
    }

    public function newgame(Request $request){
        
       

            $validated = $this->validation($request);

            $game = new GAME();
            $game->title = $validated['title'];
            $game->description = $validated['description'];
            $game->release_date = $validated['release_date'];
            $game->genre = $validated['genre'];
         
            $game->user = auth()->id();
            $game->save();
        
        return response()->json([
            'games' => $game
        ], 201);

    }

    public function updategame(Request $request){
        
        $validated = $this->validation($request);
        
        $game = Game::find($request->get('id'));

        if($game->user == auth()->id()) {
            
        $game->title = $validated['title'];
        $game->description = $validated['description'];
        $game->release_date = $validated['release_date'];
        $game->genre = $validated['genre'];
        $game->user = $game->user;
            $game->save();
        }
        return response()->json([
            'games' => $game
        ], 201);
    }

    public function deletemygame(Request $request)
{

    $game = Game::find($request->get('id'));
    
    if($game->user == auth()->id()) {

    if (!$game) {
        return response()->json([
            'message' => 'Game not found.'
        ], 404); 
    }

    $game->delete();

    return response()->json([
        'message' => 'Game deleted successfully.'
    ], 200);
}
return ('/games');
} 

public function deletegame(Request $request)
{

    $game = Game::find($request->get('id'));
    
    if (!$game) {
        return response()->json([
            'message' => 'Game not found.'
        ], 404); 
    }

    $game->delete();

    return response()->json([
        'message' => 'Game deleted successfully.'
    ], 200);
} 


public function filterAndSort(Request $request)
{
    $query = Game::query();

    if ($request->has('genre')) {
        $query->where('genre', $request->get('genre'));
    }

    if ($request->has('sort_by')) {
        $sortDirection = $request->get('sort_direction', 'asc'); 
        $query->orderBy('release_date', $sortDirection);
    }

    $games = $query->get();

    return response()->json([
        'games' => $games
    ]);
}



}

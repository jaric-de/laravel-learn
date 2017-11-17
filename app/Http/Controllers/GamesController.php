<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests\GameUpdateForm;
use App\Mail\NewGame;
use App\Mail\NewGameMarkdown;
use App\User;
use Illuminate\Http\Request;
use PharIo\Manifest\Email;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::latest()->get();

        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create', [
            'game' => new Game(),
            'action' => 'games/store',
            'title' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        // validation before saving
        $this->validate(\request(), [
            'title' => 'required|unique:games,title,id|min:3',
            'platform' => 'required',
            'genre' => 'required',
            'price' => 'required',
            'description' => 'required|min:3',
            'duration' => 'required',
            'release_year' => 'required'
        ]);


        // saving
        $attributes = \request()->all();
        $attributes['user_id'] = auth()->id();
        Game::create($attributes);
        \Mail::to(auth()->user())->send(new NewGameMarkdown(auth()->user(),  \request('title')));


        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);

        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('games.create', [
            'game' => $game = Game::find($id),
            'action' => 'games/update/' . $game->id,
            'title' => 'Edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GameUpdateForm $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameUpdateForm $request, $id)
    {
        //get post data
        $postData = $request->all();

        //update post data
        Game::find($id)->update($postData);

        //store status message
        \Session::flash('success_msg', 'Game updated successfully!');

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Game::find($id)->delete();

        \Session::flash('success_msg', 'Game deleted successfully!');

        return redirect('/');
    }
}

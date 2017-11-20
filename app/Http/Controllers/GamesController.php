<?php

namespace App\Http\Controllers;

use App\Events\GameDeletingEvent;
use App\Game;
use App\Http\Requests\GameUpdateForm;
use App\Mail\NewGame;
use App\Mail\NewGameMarkdown;
use App\Notifications\GameSuccessCreating;
use App\User;
use Illuminate\Http\Request;
use PharIo\Manifest\Email;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.email');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $games = Game::filter(\request(['platform', 'price']))->get();

//        if (isset($request->all()['platform']) && isset($request->all()['price'])) {
//            $games = Game::where('platform', $request->all()['platform'])
//                ->orderBy('price', $request->all()['price'])
//                ->get();
//        } else {
//            $games = Game::latest()->get();
//
//        }

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
        $validator = \Validator::make(\request()->all(), [
            'title' => 'required|unique:games,title,id|min:3',
            'platform' => 'required',
            'genre' => 'required',
            'price' => 'required',
            'description' => 'required|min:3',
            'duration' => 'required',
            'release_year' => 'required'
        ]);

        if ($validator->fails()) {
            $errorMessages = $validator->errors()->getMessages();
            \Session::flash('validation_errors', $errorMessages);

            return redirect()->back();
        }

        // saving
        $attributes = \request()->all();
        $attributes['user_id'] = auth()->id();
        $result = Game::create($attributes);
//        \Mail::to(auth()->user())->send(new NewGameMarkdown(auth()->user(),  \request('title')));

        \Notification::send(auth()->user(), new GameSuccessCreating(\request('title'), $result->getAttribute('id')));

        \Session::flash('success_msg', 'Game created successfully!');

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
        \Event::fire(new GameDeletingEvent($id));
        \Session::flash('success_msg', 'Game deleted successfully!');

        return redirect('/');
    }

    public function test()
    {
    }
}

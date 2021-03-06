<?php

namespace App\Http\Controllers;

use App\Events\GameDeletingEvent;
use App\Models\Game;
use App\Http\Requests\GameUpdateForm;
use App\Mail\NewGame;
use App\Mail\NewGameMarkdown;
use App\Notifications\GameSuccessCreating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PharIo\Manifest\Email;

/**
 * Class GamesController
 * @package App\Http\Controllers
 */
class GamesController extends Controller
{

    const ITEMS_PER_PAGE = 3;

    /**
     * GamesController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'check.email']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $games = Game::platformFilter(\request('platform'))
            ->priceSort(\request('price'))
            ->paginate(static::ITEMS_PER_PAGE)
            ->appends(Input::except('page'));

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
            'title' => trans('games.create.title'),
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

        // Saving
        $attributes = \request()->all();
        $attributes['user_id'] = auth()->id();
        $result = \Auth::user()->games()->create($attributes);

        \Notification::send(auth()->user(), new GameSuccessCreating(\request('title'), $result->getAttribute('id')));

        \Session::flash('success_msg', trans('games.store.success_msg'));

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
        return view('games.edit', [
            'game' => $game = Game::find($id),
            'title' => trans('games.edit.title')
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
        // Get post data
        $postData = $request->all();

        // Update post data
        Game::find($id)->update($postData);

        // Store status message
        \Session::flash('success_msg', trans('games.update.success_msg'));

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        Game::find($id)->delete();
        \Event::fire(new GameDeletingEvent($id));
        \Session::flash('success_msg', 'Game deleted successfully!');

        return redirect('/');
    }
}

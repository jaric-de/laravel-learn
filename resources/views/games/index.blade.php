@extends('layouts.app')

@section('content')
    <div class="row">
        <h2>Games List</h2>
        @if(Session::has('success_msg'))
            <div class="alert alert-success alert-dismissible">{{ Session::get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Platform</th>
                <th>Genre</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Release</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($games as $game)
                <tr>
                    <td scope="row">{{ $game->id }}</td>
                    <td scope="row">{{ $game->title }}</td>
                    <td scope="row">{{ $game->platform }}</td>
                    <td scope="row">{{ $game->genre }}</td>
                    <td scope="row">{{ $game->price }}</td>
                    <td scope="row">{{ $game->duration }}</td>
                    <td scope="row">{{ $game->release_year }}</td>
                    <td scope="row">{{ $game->description }}</td>
                    <td scope="row">
                        <div class="row">
                            <a href='/games/{{ $game->id }}'><span class='glyphicon glyphicon-play'></span></a>
                            <a href='/games/edit/{{ $game->id }}'><span class='glyphicon glyphicon-edit'></span></a>
                            <a href='/games/delete/{{ $game->id }}'><span class='glyphicon glyphicon-trash'></span></a>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
    <br>
    <div class="row">
        <a class="btn btn-large btn-primary" href="/games/create">Create Game</a>
    </div>
@endsection()
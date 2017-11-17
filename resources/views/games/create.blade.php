@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="text-center">{{ $title }}</h2>

            <form method="post" action="/{{ $action }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $game->title }}">
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="price">Price:</label>
                        <input type="number" min="0.00" step="0.01" class="form-control" id="price" name="price" value="{{ $game->price }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="duration">Duration in hours:</label>
                        <input type="number" min="0" step="1" class="form-control" id="duration" name="duration" value="{{ $game->duration }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        {{ Form::label('genre', 'Select genre:') }}

                        {{ Form::select(
                            'platform',
                            ['action' => 'Action', 'strategy' => 'Strategy', 'quest' => 'Quest', 'sport_simulator' => 'Sport_simulator'],
                            $game->platform,
                            ['class' => 'form-control', 'id' => 'genre', 'name' => 'genre'])
                        }}
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-sm-4">
                        {{ Form::label('platform', 'Select platform:') }}
                        {{ Form::select(
                            'platform',
                            ['pc' => 'PC', 'ps4' => 'PS4', 'xbox' => 'Xbox'],
                            $game->platform,
                            ['class' => 'form-control', 'id' => 'platform', 'name' => 'platform'])
                        }}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="release_year">Release year:</label>
                        <input type="number" min="1950" max="{{ \Carbon\Carbon::now()->year }}" step="1" class="form-control" id="release_year" name="release_year" value="{{ $game->release_year }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="body">Description:</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter game description">{{ $game->description }}</textarea>
                </div>

                @include('layouts.form_errors')

                <div class="row">
                    <div class="form-group col-sm-4">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                    <div class="form-group col-sm-4">
                        <a class="btn btn-primary" href='/'><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Back</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection()
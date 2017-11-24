@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>{{ trans('games.show.title') }}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>{{ trans('games.show.form_title') }}</strong>
                {{ $game->title }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>{{ trans('games.show.form_price') }}</strong>
                {{ $game->price }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>{{ trans('games.show.form_genre') }}</strong>
                {{ $game->genre }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>{{ trans('games.show.form_duration') }}</strong>
                {{ $game->duration }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>{{ trans('games.show.form_release_year') }}</strong>
                {{ $game->release_year }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>{{ trans('games.show.form_description') }}</strong>
                {{ $game->description }}
            </div>
        </div>

        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <a class="btn btn-primary" href='/games'>
                    <span class='glyphicon glyphicon-arrow-left'></span>{{ trans('games.show.back_button') }}
                </a>
            </div>
        </div>
    </div>
@endsection
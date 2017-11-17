@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Game Details</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $game->title }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $game->price }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>Genre:</strong>
                {{ $game->genre }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>Duration:</strong>
                {{ $game->duration }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>Release year:</strong>
                {{ $game->release_year }}
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $game->description }}
            </div>
        </div>

        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <a class="btn btn-primary" href='/'><span class='glyphicon glyphicon-arrow-left'></span>&nbsp;Back</a>
            </div>
        </div>
    </div>
@endsection
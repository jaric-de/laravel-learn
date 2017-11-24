@extends('layouts.app')

@section('content')
    <div class="row">
        <h2>Games List</h2>
        @if(Session::has('success_msg'))
            <div class="alert alert-success alert-dismissible">{{ Session::get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label={{ trans('games.index.alert_close_button') }}>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{ Form::open(['url' => '/games', 'method' => 'get']) }}

        <div class="row">
            <div class="form-group col-sm-2">
                {{ Form::label('platform', trans('games.index.platform_label')) }}
                {{ Form::select(
                    'platform',
                    [
                        ''=> trans('games.index.platform_all'),
                        'pc' => trans('games.index.platform_pc'),
                        'ps4' => trans('games.index.platform_ps4'),
                        'xbox' => trans('games.index.platform_xbox')
                    ], [], ['id'=> 'platform', 'class' => 'platform form-control']) }}
            </div>
            <div class="form-group col-sm-3">
                {{ Form::label('price', trans('games.index.price_sort_label')) }}
                {{ Form::select('price', [''=> '', 'desc' => trans('games.index.opt_expensive_first'), 'asc' => trans('games.index.opt_cheap_first')], [], ['id'=> 'price', 'class' => 'price form-control']) }}
            </div>
            <div class="form-group col-sm-3" style="top: 28px">
                {{ Form::button(trans('games.index.price_sort_button'), ['type' => 'submit','class' => 'btn btn-primary form-control']) }}
            </div>
            <div class="form-group col-sm-3">
            </div>
        </div>
        {{ Form::close() }}
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('games.index.th_title') }}</th>
                <th>{{ trans('games.index.th_platform') }}</th>
                <th>{{ trans('games.index.th_genre') }}</th>
                <th>{{ trans('games.index.th_price') }}</th>
                <th>{{ trans('games.index.th_duration') }}</th>
                <th>{{ trans('games.index.th_release') }}</th>
                <th>{{ trans('games.index.th_description') }}</th>
                <th>{{ trans('games.index.th_actions') }}</th>
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
        <a class="btn btn-large btn-primary" href="/games/create">{{ trans('games.index.create_game_button') }}</a>
    </div>
@endsection()
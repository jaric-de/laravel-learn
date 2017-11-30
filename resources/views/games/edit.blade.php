@extends('layouts.app')


@section('content')

    {{-- Learning process. Errors through laravel automatic mechanism (all validation errors in $error var) --}}
    @include('layouts.form_errors')

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="text-center">{{ trans('games.common.games_title_page', ['title' => $title]) }}</h2>
            {!!
                Form::open([
                    'url' => '/games/update/' . $game->id,
                    'method' => 'patch',
                    'role' => 'form'
                ])
            !!}

            @include('games.partial._form_edit_create')

            {!! Form::close() !!}
        </div>
    </div>
@endsection()
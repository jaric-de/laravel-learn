@extends('layouts.app')

{{-- Learning process. First type for validation errors --}}
@section('content')
    @if(Session::has('validation_errors'))
        <div class="alert alert-danger">
            @foreach(Session::get('validation_errors') as $key => $value)
                <li>{{ $value[0] }}</li>
            @endforeach
        </div>
    @endif

    {{-- Second type for validation errors --}}
    @include('layouts.form_errors')

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h2 class="text-center">{{ trans('games.common.games_title_page', ['title' => $title]) }}</h2>
            {!!
                Form::open([
                    'url' => '/games',
                    'method' => 'post',
                    'role' => 'form'
                ])
            !!}

            @include('games.partial._form_edit_create')

            {!! Form::close() !!}
        </div>
    </div>
@endsection()
{{ csrf_field() }}

<div class="form-group">
    <label for="title">{{ trans('games.create.title_label') }}</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ $game->title }}">
</div>

<div class="row">
    <div class="form-group col-sm-4">
        <label for="price">{{ trans('games.create.price_label') }}</label>
        <input type="number" min="0.00" step="0.01" class="form-control" id="price" name="price" value="{{ $game->price }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-4">
        <label for="duration">{{ trans('games.create.duration_label') }}</label>
        <input type="number" min="0" step="1" class="form-control" id="duration" name="duration" value="{{ $game->duration }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-4">
        {{ Form::label('genre', trans('games.create.genre_label')) }}

        {{ Form::select(
            'platform',
            [
                'action' => trans('games.create.genre_action'),
                'strategy' => trans('games.create.genre_strategy'),
                'quest' => trans('games.create.genre_quest'),
                'sport_simulator' => trans('games.create.genre_sport_simulator')
            ],
            $game->platform,
            ['class' => 'form-control', 'id' => 'genre', 'name' => 'genre'])
        }}
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-4">
        {{ Form::label('platform', trans('games.create.platform_label')) }}
        {{ Form::select(
            'platform',
            [
                'pc' => trans('games.create.platform_pc'),
                'ps4' => trans('games.create.platform_ps4'),
                'xbox' => trans('games.create.platform_xbox')
            ],
            $game->platform,
            ['class' => 'form-control', 'id' => 'platform', 'name' => 'platform'])
        }}
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-4">
        <label for="release_year">{{ trans('games.create.release_label') }}</label>
        <input type="number" min="1950" max="{{ \Carbon\Carbon::now()->year }}" step="1" class="form-control" id="release_year" name="release_year" value="{{ $game->release_year }}">
    </div>
</div>

<div class="form-group">
    <label for="body">{{ trans('games.create.desc_label') }}</label>
    <textarea class="form-control" id="description" name="description" placeholder={{ trans('games.create.desc_placeholder') }}>
                        {{ $game->description }}
                    </textarea>
</div>

{{--@include('layouts.form_errors')--}}

<div class="row">
    <div class="form-group col-sm-4">
        <button type="submit" class="btn btn-primary btn-block">{{ trans('games.create.save_button') }}</button>
    </div>
    <div class="form-group col-sm-4">
        <a class="btn btn-primary" href='{{ route('game_list') }}'>
            <span class='glyphicon glyphicon-arrow-left'></span>{{ trans('games.create.back_button') }}
        </a>
    </div>

</div>
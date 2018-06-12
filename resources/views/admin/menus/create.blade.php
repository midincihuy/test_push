@extends('adminlte::page')

@section('content')
  <h3 class="page-title">Menu</h3>
  {!! Form::open(['method' => 'POST', 'route' => ['admin.menus.store']]) !!}
  <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('text', 'Text', ['class' => 'control-label']) !!}
                    {!! Form::text('text', old('text'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('text'))
                        <p class="help-block">
                            {{ $errors->first('text') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('label', 'Label', ['class' => 'control-label']) !!}
                    {!! Form::text('label', old('label'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('label'))
                        <p class="help-block">
                            {{ $errors->first('label') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('url', 'Url', ['class' => 'control-label']) !!}
                    {!! Form::text('url', old('url'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('url'))
                        <p class="help-block">
                            {{ $errors->first('url') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('can', 'Permission', ['class' => 'control-label']) !!}
                    {!! Form::text('can', old('can'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('can'))
                        <p class="help-block">
                            {{ $errors->first('can') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('icon', 'Icon', ['class' => 'control-label']) !!}
                    {!! Form::text('icon', old('icon'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('icon'))
                        <p class="help-block">
                            {{ $errors->first('icon') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
              <div class="col-xs-2 form-group">
                {!! Form::label('parent_id', 'Parent ID', ['class' => 'control-label']) !!}
                {!! Form::text('parent_id', old('parent_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('parent_id'))
                    <p class="help-block">
                        {{ $errors->first('parent_id') }}
                    </p>
                @endif
              </div>
            </div>

        </div>
    </div>

  {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
  {!! Form::close() !!}
@endsection

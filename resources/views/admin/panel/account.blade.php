@extends('adminlte::page')

@section('content')
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
  @endif
  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input.
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-md-offset-1">
        <h1>Account Details</h1>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => 'readonly']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                    {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => 'readonly']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('api_token', 'API Token', ['class' => 'control-label']) !!}
                    {!! Form::button('Show',['onclick' => "$('#api_token').toggle()"]) !!}
                    {!! Form::text('api_token', Auth::user()->api_token, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => 'readonly', 'style' => 'display:none;']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('api_token'))
                        <p class="help-block">
                            {{ $errors->first('api_token') }}
                        </p>
                    @endif
                </div>
                <form enctype="multipart/form-data" action="{{ route('admin.panel.update') }}" method="POST">
                  <div class="col-xs-12 form-group">
                    <img src="/uploads/avatar/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                    <h2>{{ $user->name }}'s Profile</h2>
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </div>
                  <div class="col-xs-12 form-group">
                    <a href="{{ route('admin.panel.change_password') }}" class="pull-left btn btn-sm btn-warning">Change Password</a>
                    <input type="submit" value="Save" class="pull-right btn btn-sm btn-primary">
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

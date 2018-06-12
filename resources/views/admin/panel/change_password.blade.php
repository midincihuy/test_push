@extends('adminlte::page')

@section('content')
  @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
  @endif
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
        <h1>Change Password</h1>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 form-group">
              {!! Form::open(['route' => 'admin.panel.change_passwd', 'method' => 'post']) !!}
              {!! Form::label('old_password', 'Old Password', ['class' => 'control-label']) !!}
              {!! Form::password('old_password', ['class' => 'form-control']); !!}
              {!! Form::label('new_password', 'New Password', ['class' => 'control-label']) !!}
              {!! Form::password('new_password', ['class' => 'form-control']); !!}
              {!! Form::label('new_password_confirmation', 'Confirm New Password', ['class' => 'control-label']) !!}
              {!! Form::password('new_password_confirmation', ['class' => 'form-control']); !!}
              <p class="help-block"></p>
              <input type="submit" value="Save Password" class="pull-right btn btn-sm btn-primary">
              @if($errors->has('old_password'))
                  <p class="help-block">
                      {{ $errors->first('old_password') }}
                  </p>
              @endif
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

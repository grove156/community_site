@extends('layouts.app')

@section('content')
  <form action="{{route('sessions.store')}}" method="POST" class="form__auth">
    {!! csrf_field() !!}
    @if($return = request('return'))
      <input type="hidden" name="return" value="{{ $return }}">
    @endif

    <div class="page-header">
      <h4>
          {{ trans('auth.session.title') }}
      </h4>
      <p class="text-muted">
          {{ trans('auth.sessions.description')}}
      </p>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input type="email" name="email" class="form-control" placeholder="{{ trans('auth.form.email') }}" value="{{ old('email') }}" autofocus/>
      {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}} ">
      <input type="password" name="password" class="form-control" placeholder="{{ trans('auth.form.password') }}">
      {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
    </div>

    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" value="{{ old('remember', 1) }}" checked>
          Login Remember <span class="text-danger">(NEVER use on public computer!)</span>
        </label>
      </div>
    </div>

    <div class="form-group">
      <button class="btn btn-primary btn-lg btn-block" type="submit">
          Login
      </button>
    </div>

    <div>
      <p class="text-center">If you not registered?
        <a href="{{ route('users.create') }}">
          Register now!
        </a>
      </p>
      <p class="text-center">
        <a href="{{ route('remind.create') }}">
          Forgot password?
        </a>
      </p>
    </div>
  </form>
@stop

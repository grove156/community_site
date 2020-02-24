@extends('layouts.app')

@section('content')
  <div class="text-center">
    <h2>Registration</h2>
  </div>
  <form action="{{ route('users.store') }}" method="POST" class="form__auth">
    {!! csrf_field() !!}
    <div class="form-group {{$errors->has('name') ? 'has-error':''}}">
      <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name')}}" autofocus/>
       {!! $errors->first('name', '<span class="form-error">:message</span>') !!}
     </div>

    <div class="form-group {{$errors->has('email') ? 'has-error':''}}">
      <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
      {!! $errors->first('email','<span class="form-error">:message</span>') !!}
    </div>

    <div class="form-group {{$errors->has('password') ? 'has-error':''}}">
      <input type="password" name="password" class="form-control" placeholder="Password" vlaue="{{old('email')}}">
      {!! $errors->first('password','<span class="form-error">:message</span>') !!}
    </div>

    <div class="form-group {{$errors->has('password') ? 'has-error':''}}">
      <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirm" value="{{old('password_confirm')}}">
      {!! $errors->first('passowrd_confirmation','<span class="form-error">:message</span>') !!}
    </div>

    <div class="form-group">
      <button class="btn btn-primary btn-lg btn-block">
        Register
      </button>
    </div>
  </form>
@stop

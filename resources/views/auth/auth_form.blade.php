@extends('layouts.app')

@section('title', 'Authentication')

@section('date')
    <form method="POST" action="{{route('login.auth')}}">
        @csrf
        @error('common_error')
        {{$message}}
        @enderror
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            @error('email')
            {{$message}}
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            @error('password')
            {{$message}}
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Authentificate</button>
    </form>
    <a href = "{{ $facebookAuthLink }}">Login through facebook</a></br>
    <a href = "{{route('register.index')}}">Registration</a>
@endsection

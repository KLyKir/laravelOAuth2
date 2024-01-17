@extends('layouts.app')

@section('title', 'Registration')

@section('date')
    <form method="POST" action="{{route('register.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            @error('name')
            {{$message}}
            @enderror
        </div>
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
        <div class="form-group">
            <label for="password_confirmation">Repeat password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeat password">
            @error('password')
            {{$message}}
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection

@extends('layouts.auth')
@section('title', 'Register')

@section('content')
    <div class="min-vh-100 row align-items-center justify-content-center text-black py-5">
        <div class="d-flex text-center row gap-5 col-5 border rounded-5 py-5 align-items-center justify-content-center">
            <h1 class="">Register</h1>
            <form class="d-flex row justify-content-center" method="POST" action="{{ url('/register') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">Usename</label>
                    <input type="text" class="form-control" name="name">
                    @if ($errors->has('name'))
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    @endif
                </div>
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    @if ($errors->has('email'))
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>
                <div class="mb-5 text-start">
                    <label for="inputPassword5" class="form-label">Password</label>
                    <input type="password" id="inputPassword5" name="password" class="form-control"
                        aria-describedby="passwordHelpBlock">
                    @if ($errors->has('password'))
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    @endif
                </div>
                <button type="submit" class="btn bg-black rounded-pill py-3 text-white">Submit</button>
            </form>
            <span class="text-dark">
                Sudah punya akun? <a class="text-black text-decoration-none fw-semibold" href="/login">Masuk.</a>
            </span>
        </div>
    </div>
@endsection

@extends('layouts.auth')
@section('title', 'Profile')

@section('content')
    <div class="min-vh-100 row align-items-center justify-content-center text-black py-5">
        <div class="d-flex text-center row gap-5 col-5 border rounded-5 py-5 align-items-center justify-content-center">
            <h1 class="">Profile</h1>
            <form class="d-flex row justify-content-center" action="{{ url('profile/' . Auth::user()->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 text-center">
                    <img src="{{ $profile->image ? asset('storage/' . $profile->image) : asset('assets/user.png') }}"
                        alt="Profile Image" class="rounded-circle mb-3"
                        style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="text-start">
                        <label for="image" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        @if ($errors->has('image'))
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                        @endif
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label for="exampleInputText1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="name" id="exampleInputText1"
                        aria-describedby="emailHelp" value="{{ $profile->name }}">
                    @if ($errors->has('name'))
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    @endif
                </div>
                @if (Auth::user()->role === 'volunteer')
                    <div class="mb-3 text-start">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $profile->email }}" readonly>
                        @if ($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="mb-5 text-start">
                        <label for="" class="form-label">Status</label>
                        <div class="form-control">
                            @if ($profile->expired_member === 'Premium')
                                <span class="badge text-bg-success">
                                    {{ $profile->expired_member }}
                                </span>
                            @else
                                <span class="badge text-bg-warning text-white">
                                    Basic
                                </span>
                            @endif
                        </div>
                        @if ($errors->has('expired_member'))
                            <small class="text-danger">{{ $errors->first('expired_member') }}</small>
                        @endif
                    </div>
                @else
                    <div class="mb-5 text-start">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $profile->email }}">
                        @if ($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                @endif
                <button type="submit" class="btn mb-3 bg-black rounded-pill py-3 text-white">Submit</button>
                @if (Auth::user()->role === 'volunteer')
                    <a href="/volunteer/dashboard" class="btn text-black border border-black rounded-pill py-3">Back</a>
                @else
                    <a href="/admin/dashboard" class="btn text-black border border-black rounded-pill py-3">Back</a>
                @endif
            </form>
        </div>
    </div>
@endsection

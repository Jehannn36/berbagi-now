@extends('layouts.app')
@section('title', 'Tambah Donasi')

@section('content')
    <div class="row align-items-center justify-content-center text-black py-5">
        <div class="d-flex text-center row gap-5 col-5 border rounded-5 py-5 align-items-center justify-content-center">
            <h1 class="">Tambah Donasi</h1>
            @if ($errors->any())
                <div class="alert alert-danger m-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif(session('failed'))
                <div class="alert alert-danger m-3">
                    {{ session('failed') }}
                </div>
            @else
            @endif
            <form action="{{ url('/volunteer/donasi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 text-start">
                    <label for="image" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                    @if ($errors->has('image'))
                        <small class="text-danger">{{ $errors->first('image') }}</small>
                    @endif
                </div>
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" id="exampleInputEmail1"
                        aria-describedby="emailHelp" required>
                    @if ($errors->has('judul'))
                        <small class="text-danger">{{ $errors->first('judul') }}</small>
                    @endif
                </div>
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="exampleInputEmail1" aria-describedby="emailHelp" required></textarea>
                    @if ($errors->has('deskripsi'))
                        <small class="text-danger">{{ $errors->first('deskripsi') }}</small>
                    @endif
                </div>
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">No Hp</label>
                    <input type="text" inputmode="numeric" class="form-control" name="nomor_hp" id="exampleInputEmail1"
                        aria-describedby="emailHelp" required></input>
                    @if ($errors->has('nomor_hp'))
                        <small class="text-danger">{{ $errors->first('nomor_hp') }}</small>
                    @endif
                </div>
                <div class="mb-3 text-start">
                    <label for="inputPassword5" class="form-label">Bank</label>
                    <select class="form-select" aria-label="Default select example" name="bank" required>
                        <option selected value="">Pilih Bank</option>
                        <option value="BCA" name="bank">BCA</option>
                        <option value="BRI" name="bank">BRI</option>
                        <option value="Mandiri" name="bank">Mandiri</option>
                        <option value="BNI" name="bank">BNI</option>
                    </select>
                    @if ($errors->has('bank'))
                        <small class="text-danger">{{ $errors->first('bank') }}</small>
                    @endif
                </div>
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">Nama Rekening</label>
                    <input type="text" inputmode="numeric" class="form-control" name="nama_rekening"
                        id="exampleInputEmail1" aria-describedby="emailHelp" required></input>
                    @if ($errors->has('nama_rekening'))
                        <small class="text-danger">{{ $errors->first('nama_rekening') }}</small>
                    @endif
                </div>
                <div class="mb-5 text-start">
                    <label for="exampleInputEmail1" class="form-label">No Rekening</label>
                    <input type="text" inputmode="numeric" class="form-control" name="nomor_rekening"
                        id="exampleInputEmail1" aria-describedby="emailHelp" required></input>
                    @if ($errors->has('nomor_rekening'))
                        <small class="text-danger">{{ $errors->first('nomor_rekening') }}</small>
                    @endif
                </div>
                <button type="submit" class="btn bg-black col-12 rounded-pill py-3 text-white">Submit</button>
            </form>
        </div>
    </div>
@endsection

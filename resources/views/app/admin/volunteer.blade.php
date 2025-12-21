@extends('layouts.app')
@section('title', 'Volunteer')

@section('content')
    <div class="h-100 gap-5 row justify-content-center text-black py-5">
        <h1 class="text-center">Volunteer</h1>
        <div class="d-flex justify-content-between">
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Open Donasi</th>
                        <th scope="col">Lihat Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endif
                    @foreach ($data as $volunteer)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $volunteer->name }}</td>
                            <td>{{ $volunteer->total_donation ?? 0 }}</td>
                            <td><a href="/admin/volunteer-detail/{{ $volunteer->id }}" class="text-black"><i
                                        class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

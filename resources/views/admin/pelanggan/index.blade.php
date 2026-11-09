@extends('layouts.admin.app')

@section('content')
    {{-- Header Halaman & Tombol Tambah --}}
    <div class="d-flex justify-content-between w-100 flex-wrap py-4">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Data Pelanggan</h1>
            <p class="mb-0">List data seluruh pelanggan</p>
        </div>
        <div>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-success text-white">
                Tambah Pelanggan
            </a>
        </div>
    </div>

    {{-- Alert Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Data Pelanggan --}}
   <div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow mb-4">
            <div class="card-body">

               {{-- Form Filter & Search --}}
<form method="GET" action="{{ route('pelanggan.index') }}">
    <div class="row mb-3">
        {{-- Filter Gender --}}
        <div class="col-md-2">
            <select name="gender" onchange="this.form.submit()" class="form-select">
                <option value="">All Genders</option>
                <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        {{-- Input Search & Clear Button --}}
        <div class="col-md-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">

                <button type="submit" class="btn btn-outline-secondary" id="basic-addon2">
                    <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                        <path fill-rule="evenodd" d="M8 4a4 4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                {{-- Fitur Clear Search --}}
                @if(request('search'))
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn btn-outline-danger">
                        Clear
                    </a>
                @endif
            </div>
        </div>
    </div>
</form>

{{-- Tabel Data Pelanggan --}}
<div class="table-responsive">
    <table id="table-pelanggan" class="table table-hover table-centered table-nowrap mb-0 rounded">
        <thead class="thead-light">
            <tr>
                <th class="border-0">FIRST NAME</th>
                <th class="border-0">LAST NAME</th>
                <th class="border-0">BIRTHDAY</th>
                <th class="border-0">GENDER</th>
                <th class="border-0">EMAIL</th>
                <th class="border-0">PHONE</th>
                <th class="border-0 rounded-end">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataPelanggan as $item)
                <tr>
                    <td>{{ $item->first_name }}</td>
                    <td>{{ $item->last_name }}</td>
                    <td>{{ $item->birthday }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $item->pelanggan_id) }}" class="btn btn-info btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('pelanggan.destroy', $item->pelanggan_id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    {{-- Tombol Pagination --}}
    <div class="mt-3">
        {{ $dataPelanggan->links('pagination::bootstrap-5') }}
    </div>

@endsection


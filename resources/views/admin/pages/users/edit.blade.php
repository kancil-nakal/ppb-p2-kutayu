@extends('admin.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ $data['title'] }}</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">{{ $data['title'] }}</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body ">
                    <a href="{{ route('users.index') }}" class="btn btn-sm  mt-3"><i class="bi bi-arrow-left "></i> Kembali</a>
                    <h5 class="card-title"><i class="bi bi-person-gear me-1"></i>Edit Penarik</h5>

                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="col-12 mt-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" id="name" value="{{ old('nama', $user->name) }}" class="form-control">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
                                </div>
                                @if (Auth::user()->id == $user->id)
                                    <div class="col-12 mt-3">
                                        <label for="role" class="form-label">Level</label>
                                        <input type="text" name="role" id="role" value="{{ old('role', $user->role) }}" class="form-control" readonly>
                                    </div>
                                @else
                                    <div class="col-12 mt-3">
                                        <label for="role" class="form-label">Level</label>
                                        <select class="form-select" name="role" id="role">
                                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>

                                @endif
                            </div>
                            <div class="col-lg-6">
                                <div class="col-12 mt-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy me-1"></i>Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="bi bi-floppy me-1"></i>Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush

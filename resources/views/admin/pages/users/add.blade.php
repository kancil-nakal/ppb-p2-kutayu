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
                <h5 class="card-title"><i class="bi bi-person-plus me-1"></i>Tambah Penarik</h5>

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="row g-3" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-12 mt-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name')
                                    border-danger
                                @enderror" name="name" id="name" value="{{ old('name') }}" class="form-control" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email')
                                    border-danger
                                @enderror" name="email" id="email" value="{{ old('email') }}" class="form-control" autocomplete="off">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="role" class="form-label">Level</label>
                                <select class="form-select @error('role')
                                    border-danger
                                @enderror"  name="role" id="role">
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-12 mt-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password')
                                    border-danger
                                @enderror" name="password" id="password"  class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password_confirmation')
                                    border-danger
                                @enderror" name="password_confirmation" id="password_confirmation"  class="form-control">
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy me-1"></i>Save</button>
                        <button type="reset" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                    </div>
                </form><!-- Vertical Form -->


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

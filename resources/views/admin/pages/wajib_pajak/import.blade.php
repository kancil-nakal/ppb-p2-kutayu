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
            <div class="card-body">
                <a href="{{ route('wajibpajak.index') }}" class="btn btn-sm  mt-3"><i class="bi bi-arrow-left "></i> Kembali</a>
                <h5 class="card-title"><i class="bi bi-person-plus me-1"></i>Import Data Wajib Pajak</h5>


                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                    <form action="{{ route('wajibpajak.import_data') }}" method="POST" enctype="multipart/form-data" class="py-4">
                        @csrf
                        <input type="file" name="file"  accept=".xls, .xlsx">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-upload me-1"></i>Import</button>
                    </form>
                    <small>download template import kilk <a href="{{ route('download.templatepbb') }}">di sini</a></small>

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

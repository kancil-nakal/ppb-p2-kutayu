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
            <div class="card-body py-4">
                <div class="row justify-content-between align-items-center mt-2">
                    <div class="col-lg-6">
                        <a href="{{ route('users.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-circle"></i> Tambah</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-end gap-2">
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari Nama" name="search" id="search">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mt-3">

                    <table class="table display nowrap mt-5" id="t_users" style="width: 100%">
                    </table>
                </div>


            </div>
          </div>

    </div>

    </div>
</section>
@endsection

@push('styles')
@endpush

@push('scripts')
<script type="text/javascript">
    $(function () {

    var table = $('#t_users').DataTable({
        processing: true,
        serverSide: true,
        length: false,
        scrollX: true,
        searching: false,
        lengthChange: false,
         ajax: {
            url: "{{ route('users.index') }}",
            method: "GET",
            data: function (d) {
                d.search = $('#search').val(); // Memperbarui nilai pencarian saat permintaan dikirimkan
            }
        },
        columns: [
            { title: 'No', data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { title: 'Nama', data: 'name', name: 'name'},
            { title: 'Username', data: 'username', name: 'username'},
            { title: 'Email', data: 'email', name: 'email'},
            { title: 'level', data: 'level', name: 'level', orderable: false, searchable: false},
            { title: 'Opsi', data: 'opsi', name: 'opsi', orderable: false, searchable: false},
        ]
    });

    $('#search').on('keyup', function () {
        table.ajax.reload();
    });

});
</script>
@endpush

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
                <div class="row justify-content-between  align-items-center mt-2">
                    <div class="col-lg-6">
                        <a href="{{ route('wajibpajak.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah</a>
                        <a href="{{ route('wajibpajak.export') }}" class="btn btn-success"><i class="bi bi-file-earmark-excel me-1"></i> Export</a>
                        <a href="{{ route('wajibpajak.import') }}" class="btn btn-info"><i class="bi bi-file-earmark-excel me-1"></i> Import</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-end gap-2">
                            <div class="col-4">
                                <select class="form-select" name="filter_tahun" id="filter_tahun">
                                    <option value="" >--Pilih Tahun--</option>
                                    @foreach ($data['tahun'] as $key => $item )
                                        <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari No SPPT / Nama" name="search" id="search" autocomplete="off">
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
                <!-- Table with stripped rows -->
                <div class="mt-5">
                    <table class="table display nowrap" style="width:100%" id="t_wajibpajak">
                    </table>

                </div>
                <!-- End Table with stripped rows -->

              {{-- {{ $data['wajib_pajak']->links() }} --}}

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

    var table = $('#t_wajibpajak').DataTable({
        processing: true,
        serverSide: true,
        length: false,
        scrollX: true,
        searching: false,
        lengthChange: false,
         ajax: {
            url: "{{ route('wajibpajak.index') }}",
            method: "GET",
            data: function (d) {
                d.tahun = $('#filter_tahun').val(); // Memperbarui nilai tahun saat permintaan dikirimkan
                d.search = $('#search').val(); // Memperbarui nilai pencarian saat permintaan dikirimkan
            }
        },
        columns: [
            { title: 'No', data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { title: 'No SPPT', data: 'no_sppt', name: 'no_sppt'},
            { title: 'Nama', data: 'nama', name: 'nama'},
            { title: 'Tahun', data: 'tahun', name: 'tahun'},
            { title: 'RT', data: 'rt', data: 'rt', name: 'rt',searchable: false},
            { title: 'RW', data: 'rw', data: 'rw', name: 'rw',searchable: false},
            { title: 'Alamat Pemilik', data: 'alamat_pemilik', name: 'alamat_pemilik',searchable: false},
            { title: 'Objek Pajak', data: 'objek_pajak', name: 'objek_pajak',searchable: false},
            { title: 'Luas Bumi', data: 'luas_bumi', name: 'luas_bumi',searchable: false},
            { title: 'Luas Bangunan', data: 'luas_bangunan', name: 'luas_bangunan',searchable: false},
            { title: 'Pagu Pajak', data: 'jumlah_setoran', name: 'jumlah_setoran',searchable: false},
            { title: 'Penarik', data: 'penarik', name: 'penarik'},
            { title: 'Keterangan', data: 'status', name: 'status', orderable: false, searchable: false},
            { title: 'Opsi', data: 'opsi', name: 'opsi', orderable: false, searchable: false},
        ]
    });
    $('#filter_tahun').on('change', function () {
        table.ajax.reload();
    });

    $('#search').on('keyup', function () {
        table.ajax.reload();
    });

});
</script>
@endpush

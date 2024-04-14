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

                {{-- <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah</a> --}}
                {{-- <h5 class="card-title">Bordered Table</h5> --}}
                {{-- <input type="text" name="Cari..."> --}}
                <!-- Bordered Table -->
                <div class="row justify-content-between  align-items-center mt-2">
                    <div class="col-lg-6">
                        <a href="{{ route('rekap.export') }}" class="btn btn-success"><i class="bi bi-file-earmark-excel me-1"></i> Export</a>
                    </div>
                    <div class="col-lg-6">
                        <form  class="d-flex justify-content-end gap-2" action="" method="get">
                            <div class="col-4 ">
                                <select class="form-select "  name="tahun" id="tahun">
                                    <option value="" >--Pilih Tahun--</option>
                                    @foreach ($data['tahun'] as $key => $item )
                                        <option value="{{ $item->tahun }}" {{ $data['value_tahun'] == $item->tahun ? 'selected' : '' }}>{{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="col-2 btn btn-info">Cari</button>
                            {{-- <div class="col-7">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari No SPPT / Nama">
                                    <button class="input-group-text btn btn-info text-white" id="basic-addon2"><i class="bi bi-search "></i></button>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive mt-4">

                    <table class=" table table-borderless table-striped display nowrap " id="t_rekap">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center align-middle">#</th>
                                <th rowspan="2" class="text-center align-middle">Nama</th>
                                <th colspan="2" class="text-center">Baku</th>
                                <th colspan="2" class="text-center">Realisasi</th>
                                <th colspan="2" class="text-center">Piutang</th>
                            </tr>
                            <tr>
                                <th class="text-center">Jumlah (Rp)</th>
                                <th class="text-center">SPPT</th>
                                <th class="text-center">Jumlah (Rp)</th>
                                <th class="text-center">SPPT</th>
                                <th class="text-center">Jumlah (Rp)</th>
                                <th class="text-center">SPPT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no =1
                            @endphp
                            @foreach ($data['penarik'] as $key => $value)
                                @unless($loop->first)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td >{{ $value->penarik }}</td>
                                        <td class="text-center">{{ number_format($value->jml_baku,'2',',','.') }} </td>
                                        <td class="text-center">{{ $value->jml_sppt_baku }}</td>
                                        <td class="text-center">{{ number_format($value->jml_setoran,'2',',','.') }} </td>
                                        <td class="text-center">{{ $value->jml_sppt_setoran }}</td>
                                        <td class="text-center">{{ number_format($value->selisih_jml_setoran,'2',',','.') }} </td>
                                        <td class="text-center">{{ $value->selisih_jml_sppt }}</td>
                                    </tr>
                                @endunless
                            @endforeach
                        </tbody>
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
<script>
   $('#t_rekap').DataTable({
    searching: false,
        lengthChange: false,
   })
</script>
@endpush

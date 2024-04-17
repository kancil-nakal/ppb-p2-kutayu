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
                <!-- Bordered Table -->
                <div class="row justify-content-between  align-items-center mt-2">
                    {{-- <div class="col-md-6">
                        <a href="{{ route('rekap.export') }}" class="btn btn-success"><i class="bi bi-file-earmark-excel me-1"></i> Export</a>
                    </div> --}}
                    <div class="col-md-4 ">
                        <select class="form-select "  name="tahun" id="tahun">
                            <option value="" >--Pilih Tahun--</option>
                            @foreach ($data['tahun'] as $key => $item )
                                <option value="{{ $item->tahun }}" {{ $data['value_tahun'] == $item->tahun ? 'selected' : '' }}>{{ $item->tahun }}</option>
                            @endforeach
                            <option value="2024" {{ $data['value_tahun'] == '2024' ? 'selected' : '' }}>2024</option>
                        </select>
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
                                <th colspan="3" class="text-center">Realisasi</th>
                                <th colspan="2" class="text-center">Piutang</th>
                            </tr>
                            <tr>
                                <th class="text-center">Jumlah (Rp)</th>
                                <th class="text-center">SPPT</th>
                                <th class="text-center">Jumlah (Rp)</th>
                                <th class="text-center">SPPT</th>
                                <th class="text-center">Persentase (%)</th>
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
                                        <td class="text-center">{{ number_format($value->jml_baku,'0',',','.') }} </td>
                                        <td class="text-center">{{ number_format($value->jml_sppt_baku,'0',',','.') }}</td>
                                        <td class="text-center">{{ number_format($value->jml_setoran,'0',',','.') }} </td>
                                        <td class="text-center">{{ number_format($value->jml_sppt_setoran,'0',',','.') }}</td>
                                        <td class="text-center">
                                            @if ($value->jml_sppt_baku != 0)
                                                {{ number_format(($value->jml_sppt_setoran / $value->jml_sppt_baku) * 100, 2, '.', '') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">{{ number_format($value->selisih_jml_setoran,'0',',','.') }} </td>
                                        <td class="text-center">{{ number_format($value->selisih_jml_sppt,'0',',','.') }}</td>
                                    </tr>
                                @endunless
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-center">Total</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </tfoot>
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
        paging:false,
        searching:false,
        layout: {
            topStart: {
                buttons: [ 'excel']
            }
        }
    });

    $(document).ready(function() {

        $('.buttons-excel').addClass('btn btn-success').html('<i class="bi bi-file-earmark-excel me-1"></i> Export');

        $('#tahun').on('change', function() {
            var tahun = $(this).val();
            if (tahun === '') {
                window.location.href = "{{ route('rekap.index') }}";
            } else {
                window.location.href = "{{ route('rekap.index') }}?tahun=" + tahun;
            }
        });

    });

</script>

<script>
    var total_jml_baku = 0;
    var total_jml_sppt_baku = 0;
    var total_jml_realisasi = 0;
    var total_jml_sppt_realisasi = 0;
    var total_jml_piutang = 0;
    var total_jml_sppt_piutang = 0;

    var rows = document.querySelectorAll("#t_rekap tbody tr");

    rows.forEach(function(row) {
        total_jml_baku += parseFloat(row.cells[2].textContent.replace(/\./g, '').replace(',', '.'));
        total_jml_sppt_baku += parseInt(row.cells[3].textContent);
        total_jml_realisasi += parseFloat(row.cells[4].textContent.replace(/\./g, '').replace(',', '.'));
        total_jml_sppt_realisasi += parseInt(row.cells[5].textContent);
        total_jml_piutang += parseFloat(row.cells[7].textContent.replace(/\./g, '').replace(',', '.'));
        total_jml_sppt_piutang += parseInt(row.cells[8].textContent);
    });

    var total_persentase_realisasi = (total_jml_realisasi / total_jml_baku) * 100;

    document.querySelector("#t_rekap tfoot th:nth-child(2)").textContent = total_jml_baku.toLocaleString('id-ID');
    document.querySelector("#t_rekap tfoot th:nth-child(3)").textContent = total_jml_sppt_baku.toLocaleString('id-ID');
    document.querySelector("#t_rekap tfoot th:nth-child(4)").textContent = total_jml_realisasi.toLocaleString('id-ID');
    document.querySelector("#t_rekap tfoot th:nth-child(5)").textContent = total_jml_sppt_realisasi.toLocaleString('id-ID');
    document.querySelector("#t_rekap tfoot th:nth-child(6)").textContent = total_persentase_realisasi.toFixed(2)
    document.querySelector("#t_rekap tfoot th:nth-child(7)").textContent = total_jml_piutang.toLocaleString('id-ID');
    document.querySelector("#t_rekap tfoot th:nth-child(8)").textContent = total_jml_sppt_piutang.toLocaleString('id-ID');
</script>
@endpush

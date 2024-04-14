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
                <h5 class="card-title"><i class="bi bi-calendar2-check me-2"></i>Setor Pajak</h5>

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

                @csrf
                    <div class="col-lg-6">
                        <div  class="mt-3" >
                            <label for="no_sppt" class="form-label">Masukan No SPPT</label>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-5">
                                    <input type="text" class=" form-control " name="input_no_sppt" id="input_no_sppt" autocomplete="off" autofocus>
                                </div>
                                <div class="col-md-4">
                                    <select name="input_tahun" id="input_tahun" class="form-select" >
                                        <option value="">--Pilih Tahun--</option>
                                        @foreach ($data['tahun'] as $key => $value)
                                            <option value="{{ $value->tahun }}"
                                                @if (date('Y') == $value->tahun)
                                                selected
                                            @endif
                                            >{{ $value->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex gap-2">
                                    <button class=" input-group-text btn btn-primary text-white" id="btn_cari"><i class="bi  bi-arrow-return-left me-1"></i></i>Submit</button>
                                    <button type="button" class=" input-group-text btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#m_wajibpajak"><i class="bi bi-search "></i></button>


                                </div>
                            </div>
                        </div>
                    </div>
                    <form  class="row g-3" action="{{ route('setoran.store') }}" method="POST" >
                        @csrf
                        <div class="col-12 mt-5">
                            <div class="row">
                                <div class="col-lg-6  d-flex flex-column gap-3">
                                    <div class="row mb-1 align-items-center">
                                        <label for="no_sppt" class="col-sm-4 col-form-label">No SPPT</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" class="form-control" name="id_wp" value="" readonly>
                                            <input type="text" class="form-control" name="no_sppt" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="jumlah_setoran" class="col-sm-4 col-form-label">Jumlah Setoran</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="jumlah_setoran" value="" readonly>
                                            <input type="hidden" class="form-control" name="pagu_pajak" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="id_user" class="col-sm-4 col-form-label">Nama Penarik</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="id_user" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row mb-1 align-items-center">
                                        <label for="tgl_setoran" class="col-sm-4 col-form-label">Tanggal Setoran</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control @error('tgl_setoran')
                                    border-danger
                                @enderror" name="tgl_setoran" id="tgl_setoran" value="{{ date('Y-m-d') }}" autocomplete="off" required>
                                            @error('tgl_setoran')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="text-end">
                            <button type="submit" class="btn btn-success"><i class="bi bi-send me-1"></i>Setor</button>
                            <button type="reset" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                        </div>
                    </form><!-- Vertical Form -->
            </div>
          </div>

        </div>
        <div class="col-12">
            <div class="card ">
              <div class="card-body mt-3">
                <table class="table mt-2" id="t_setoran" style="width: 100%">
                    <thead class="bg-light" >
                        <tr>
                            <th scope="col" class="text-center">Tanggal</th>
                            <th scope="col">No SPPT</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah Setoran</th>
                            <th scope="col">Penarik</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($data['setoran']) && $data['setoran']->count() > 0)
                            @foreach ($data['setoran'] as $key => $value)
                                    <tr>
                                        <td scope="row" class="text-center">{{ date('d/m/Y', strtotime($value->tgl_setoran)) }}</td>
                                        <td>{{ $value->no_sppt }}</td>
                                        <td>{{ $value->nama }}</td>
                                        <td>Rp. {{ number_format($value->pagu_pajak, 0, ',', '.') }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            <span class="badge bg-success">lunas</span>
                                        </td>
                                    </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
              </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('modal')
<div class="modal fade" id="m_wajibpajak" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless" id="t_m_wajibpajak" style="width: 100%">
                    <thead class="bg-light" >
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID</th>
                            <th scope="col">SPPT</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Penarik</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['wajibpajak'] as $key => $item )

                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->no_sppt }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info text-white btn_pilih"  type="button" data-id_wp="{{ $item->id }}" data-nama="{{ $item->nama }}" data-sppt="{{ $item->no_sppt }}" data-jumlah_setoran="Rp. {{ number_format($item->pagu_pajak, 0, ',', '.') }}" data-pagu_pajak="{{ $item->pagu_pajak }}" data-penarik="{{ $item->name }}" data-tahun={{ $item->tahun }} data-bs-dismiss="modal"><i class="bi bi-check2-square me-1"></i>pilih</button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{-- <div class="modal-footer ">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
        </div>
    </div>
</div><!-- End Vertically centered Modal-->


@endpush

@push('styles')
@endpush

@push('scripts')
<script type="text/javascript">

    $(document).on('click', '.btn_pilih', function(event) {
        var id = $(this).data('id_wp');
        var nama = $(this).data('nama');
        var sppt = $(this).data('sppt');
        var tahun = $(this).data('tahun');
        var jumlah_setoran = $(this).data('jumlah_setoran');
        var pagu_pajak = $(this).data('pagu_pajak');
        var penarik = $(this).data('penarik');
        console.log(id,nama,sppt,tahun,jumlah_setoran,pagu_pajak,penarik);
        $('input[name="id_wp"]').val(id);
        $('input[name="no_sppt"]').val(sppt);
        $('input[name="nama"]').val(nama);
        $('input[name="jumlah_setoran"]').val(jumlah_setoran);
        $('input[name="pagu_pajak"]').val(pagu_pajak);
        $('input[name="id_user"]').val(penarik);
        $('input[name="input_no_sppt"]').val(sppt);
        $('select[name="input_tahun"]').val(tahun);

        $('#m_wajibpajak').modal('hide');
    });

   $(function ()  {
        $('#t_setoran').DataTable({
            ordering: false,
            pageLength : 5,
            scrollX: true,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
        });

        $('#t_m_wajibpajak').DataTable({
            // pageLength : 5,
            // // scrollX:true,
            // lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
        });


        $('#input_no_sppt').on('keypress', function(event) {
            if (event.which == 13) {
                getDataSPPT();
            }
        })



        $('#btn_cari').on('click', function(event) {
            getDataSPPT();
        })

        function getDataSPPT(){
            var no_sppt = $('#input_no_sppt').val();
            var tahun = $('#input_tahun').val();

            if(no_sppt == '' || tahun == '') {
                alert('No SPPT dan Tahun harus diisi');
            } else {
                console.log(no_sppt,tahun);
                $.ajax({
                    url: '{{ route("setoran.__getSPPT") }}',
                    type: 'GET',
                    data: { no_sppt: no_sppt,tahun: tahun },
                    success: function(response) {
                        if(response.status == 'success') {
                            console.log(response.data);
                            alert(response.message);
                            // Tampilkan data ke dalam input
                            if(response.data !== null) {
                                $('input[name="id_wp"]').val(response.data.id);
                                $('input[name="no_sppt"]').val(response.data.no_sppt);
                                $('input[name="nama"]').val(response.data.nama);
                                $('input[name="jumlah_setoran"]').val(response.data.jumlah_setoran);
                                $('input[name="pagu_pajak"]').val(response.data.pagu_pajak);
                                $('input[name="id_user"]').val(response.data.penarik);
                            } else {

                                alert(response.message);
                            }
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        $('input[name="pagu_pajak"]').on('keyup', function() {
            var value = $(this).val();
            value = value.replace(/\D/g, '');
            value = new Intl.NumberFormat('id-ID').format(value);
            $(this).val(value);
        });

        // $('#form-setoran').submit(function(event) {
        //     event.preventDefault();

        //     var formData = $(this).serialize();

        //     $.ajax({
        //         url: $(this).attr('action'),
        //         type: 'POST',
        //         data: formData,
        //         success: function(response) {
        //             console.log(response);
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(xhr.responseText);
        //         }
        //     });
        // });
    })
</script>
@endpush

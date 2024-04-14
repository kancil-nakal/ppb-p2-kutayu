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
                {{-- <a href="{{ route('wajibpajak.index') }}" class="btn btn-sm  mt-3"><i class="bi bi-arrow-left "></i> Kembali</a> --}}
                <h5 class="card-title"><i class="bi bi-person-plus me-1"></i>Import Master Penarik</h5>

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

                    <form action="{{ route('penarik.import') }}" method="POST" enctype="multipart/form-data" class="py-4">
                        @csrf
                        <input type="file" name="file"  accept=".xls, .xlsx">
                        <button type="submit" class="btn btn-primary">Import Data</button>
                    </form>
                    <small>download template import kilk <a href="{{ route('download.templatemaster') }}">di sini</a></small>

            </div>
          </div>

        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-5">

                        <table class="table mt-2" id="t_masterpenarik" style="width: 100%">
                            {{-- <thead class="bg-light" >
                                <tr>
                                    <th scope="col">No SPPT</th>
                                    <th scope="col">Penarik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['penarik'] as $key => $value)
                                    <tr>
                                        <td>{{ $value->no_sppt }}</td>
                                        <td>{{ $value->name }}</td>
                                    </tr>
                                @endforeach

                            </tbody> --}}
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
     var table = $('#t_masterpenarik').DataTable({
        processing: true,
        serverSide: true,
        length: false,
        scrollX: true,
        searching: true,
        lengthChange: false,
         ajax: {
            url: "{{ route('penarik.index') }}",
            method: "GET",
        },
        columns: [
            { title: 'No', data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { title: 'No SPPT', data: 'no_sppt', name: 'no_sppt'},
            { title: 'Name', data: 'name', name: 'name'},
        ]
    });
</script>
@endpush

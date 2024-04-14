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
                <a href="{{ route('wajibpajak.index') }}" class="btn btn-sm  mt-3"><i class="bi bi-arrow-left "></i> Kembali</a>
                <h5 class="card-title"><i class="bi bi-person-plus me-1"></i>Edit Wajib Pajak</h5>

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="row g-3" action="{{ route('wajibpajak.update', $wajibpajak->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-12 mt-3">
                                <label for="no_sppt" class="form-label">No SPPT</label>
                                <input type="text" class="form-control @error('no_sppt')
                                    border-danger
                                @enderror" name="no_sppt" id="no_sppt" value="{{ old('no_sppt',$wajibpajak->no_sppt ) }}" class="form-control" autocomplete="off" readonly>
                                @error('no_sppt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama')
                                    border-danger
                                @enderror" name="nama" id="nama" value="{{ old('nama',$wajibpajak->nama) }}" class="form-control" autocomplete="off">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control @error('tahun')
                                    border-danger
                                @enderror" min="1900" max="2999" step="1" name="tahun" id="tahun" value="{{ old('tahun', $wajibpajak->tahun) }}" class="form-control" autocomplete="off">
                                @error('tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="rt" class="form-label">RT/RW</label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="number" class="form-control @error('rt')
                                        border-danger
                                    @enderror" min="000" max="999" step="1" name="rt" id="rt" value="{{ old('rt', $wajibpajak->rt) }}" class="form-control" autocomplete="off">
                                    @error('rt')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="number" class="form-control @error('rw')
                                        border-danger
                                    @enderror" min="000" max="999" step="1" name="rw" id="rw" value="{{ old('rw', $wajibpajak->rw) }}" class="form-control" autocomplete="off">
                                    @error('rw')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror


                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="alamat_pemilik" class="form-label">Alamat Pemilik</label>
                                <textarea  class="form-control @error('alamat_pemilik')
                                    border-danger
                                @enderror" name="alamat_pemilik" id="alamat_pemilik"  class="form-control" >{{ old('alamat_pemilik',$wajibpajak->alamat_pemilik) }}</textarea>
                                @error('alamat_pemilik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="objek_pajak" class="form-label">Objek Pajak</label>
                                <textarea  class="form-control @error('objek_pajak')
                                    border-danger
                                @enderror" name="objek_pajak" id="objek_pajak"  class="form-control" >{{ old('objek_pajak',$wajibpajak->objek_pajak) }}</textarea>
                                @error('objek_pajak')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="col-12 mt-3">
                                <label for="luas_bumi" class="form-label">Luas Bumi  (m2)</label>
                                <input type="number" class="form-control @error('luas_bumi')
                                    border-danger
                                @enderror" name="luas_bumi" id="luas_bumi"   class="form-control" value="{{ old('luas_bumi',$wajibpajak->luas_bumi )}}">
                                @error('luas_bumi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="luas_bangunan" class="form-label">Luas Bangunan (m2)</label>
                                <input type="number" class="form-control @error('luas_bangunan')
                                    border-danger
                                @enderror" name="luas_bangunan" id="luas_bangunan"  class="form-control" value="{{ old('luas_bangunan', $wajibpajak->luas_bangunan )}}">
                                @error('luas_bangunan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="pagu_pajak" class="form-label">Pagu Pajak (Rp)</label>
                                <input type="number" class="form-control @error('pagu_pajak')
                                    border-danger
                                @enderror" name="pagu_pajak" id="pagu_pajak"  class="form-control" value="{{ old('pagu_pajak', $wajibpajak->pagu_pajak )}}">
                                @error('pagu_pajak')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="id_user" class="form-label">Penarik</label>
                                <select class="form-select @error('id_user')
                                    border-danger
                                    @enderror"  name="id_user" id="id_user">

                                    <option value="">--pilih--</option>
                                    @foreach ($data['users'] as $key => $value )
                                        <option value="{{ $value->id }}" {{ old('id_user', $wajibpajak->id_user ) == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <label for="status" class="form-label">Keterangan</label>
                                <select class="form-select @error('status')
                                    border-danger
                                    @enderror"  name="status" id="status">

                                    <option value="0" {{ old('status', $wajibpajak->status ) == 0 ? 'selected' : '' }}>Belum Lunas</option>
                                    <option value="1" {{ old('status', $wajibpajak->status ) == 1 ? 'selected' : '' }}>Lunas</option>
                                </select>
                                @error('id_user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy me-1"></i>Update</button>
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

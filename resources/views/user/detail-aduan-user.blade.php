<x-app-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detial Laporan </h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> BUAT ADUAN</a> --}}
        </div>


        <div class="row">

            <div class="col-xl-4 col-lg-5">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            ISI LAPORAN
                        </h6>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="kode_laporan">Kode Laporan</label>
                                <input type="text" readonly class="form-control" id="kode_laporan"
                                    name="kode_laporan" value="{{ $laporan->kode_laporan }}">
                            </div>
                            <div class="form-group">
                                <label for="judul_laporan">Judul Laporan</label>
                                <input type="text" readonly class="form-control" id="judul_laporan"
                                    value="{{ $laporan->judul_laporan }}" name="judul_laporan">
                            </div>

                            <div class="form-group">
                                <label for="jenis_laporan">Jenis Laporan</label>
                                <input type="text" readonly class="form-control" id="jenis_laporan"
                                    value="{{ $laporan->jenis_laporan }}" name="jenis_laporan">
                            </div>
                            <div class="form-group">
                                <label for="isi_laporan">Isi Laporan</label>
                                <textarea name="isi_laporan" readonly class="form-control" rows="3">{{ $laporan->isi_laporan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="isi_laporan">Lampiran Laporan</label>
                                @if ($laporan->lampiran_laporan != null)
                                    <img class="img-thumbnail" width="120px"
                                        src="{{ asset("foto_lampiran/$laporan->lampiran_laporan") }}">
                                @else
                                    <p>
                                        tidak ada lampiran
                                    </p>
                                @endif
                                {{-- 
                                <img class="img-thumbnail"
                                    src="{{ asset("foto_lampiran/$laporan->lampiran_laporan") }}"> --}}
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            TANGGAPAN LAPORAN
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.data.aduan', $laporan) }}">
                            @csrf

                            <div class="form-group">
                                <label for="tanggapan_laporan">Tanggapan Laporan</label>
                                <textarea {{ auth()->user()->role != 'admin' ? 'readonly' : '' }} name="tanggapan_laporan" class="form-control"
                                    rows="3">{{ $laporan->tanggapan_laporan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status_laporan">Status Laporan</label>

                                <div class="custom-control custom-checkbox">
                                    <input {{ auth()->user()->role != 'admin' ? 'disabled' : '' }} type="checkbox"
                                        class="custom-control-input" @checked($laporan->status_laporan) id="status_laporan"
                                        name="status_laporan">
                                    <label class="custom-control-label" for="status_laporan">SELESAI </label>
                                </div>
                            </div>

                            @if (auth()->user()->role == 'admin')
                                <button type="submit" class="btn btn-primary">Update Laporan</button>
                            @endif


                        </form>
                    </div>
                </div>
            </div>


        </div>


    </div>
</x-app-layout>

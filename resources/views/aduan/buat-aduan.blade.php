<x-app-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Form Aduan Baru</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> BUAT ADUAN</a> --}}
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Buat Aduan Baru
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('simpan.data.aduan') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kode_laporan">Kode Laporan</label>
                        <input type="text" readonly class="form-control" id="kode_laporan" name="kode_laporan"
                            value="{{ $kodeLaporan }}">
                    </div>
                    <div class="form-group">
                        <label for="judul_laporan">Judul Laporan</label>
                        <input type="text" class="form-control" id="judul_laporan" name="judul_laporan">
                    </div>

                    <div class="form-group">
                        <label for="jenis_laporan">Jenis Laporan</label>
                        <select class="form-control" id="jenis_laporan" name="jenis_laporan">
                            <option value="pengaduan">Pengaduan</option>
                            <option value="informasi">Permintaan Informasi</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="isi_laporan">Isi Laporan</label>
                        <textarea name="isi_laporan" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="isi_laporan">Lampiran Laporan</label>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="lampiran_laporan">Lampiran</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" multiple class="custom-file-input" id="lampiran_laporan"
                                    name="lampiran_laporan" aria-describedby="lampiran_laporan">
                                <label class="custom-file-label" for="lampiran_laporan">Pilih Lampiran </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>


                </form>
            </div>
        </div>

    </div>
</x-app-layout>

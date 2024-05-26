<x-app-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">LIST ADUAN</h1>
            <a href="{{ route('buat.aduan') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> BUAT ADUAN</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    LIST ADUAN
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Laporan</th>
                                <th>Status</th>
                                <th>Tanggal Laporan</th>
                                <th>Lampiran </th>
                                <th>Opsi </th>

                            </tr>
                        </thead>
                        <tfoot>

                            <tr>
                                <th>#</th>
                                <th>Judul Laporan</th>
                                <th>Status</th>
                                <th>Tanggal Laporan</th>
                                <th>Lampiran </th>
                                <th>Opsi </th>

                            </tr>
                        </tfoot>
                        <tbody>


                            @forelse ($dataLaporan as $laporan)
                                <tr>
                                    <td>{{ $laporan->kode_laporan }}</td>
                                    <td>{{ $laporan->judul_laporan }}</td>
                                    <td>
                                        @if ($laporan->status_laporan)
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-warning">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\carbon::parse($laporan->created_at)->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                    <td>
                                        <div class="media">
                                            @if ($laporan->lampiran_laporan != null)
                                                <img class="img-thumbnail" width="120px"
                                                    src="{{ asset("foto_lampiran/$laporan->lampiran_laporan") }}">
                                            @else
                                                -
                                            @endif
                                        </div>

                                    </td>
                                    <td><a class="btn btn-md btn-primary"
                                            href="{{ route('user.aduan.detail', $laporan) }}">Detail</a></td>
                                </tr>
                            @empty

                                <tr class="text-center">
                                    <td colspan="5" class="tex-center">Belum ada laporan </td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

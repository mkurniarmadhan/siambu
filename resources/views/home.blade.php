<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SIPUMA</title>



    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">




    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /*
 * Globals
 */

        /* Links */
        a,
        a:focus,
        a:hover {
            color: #fff;
        }

        /* Custom default button */
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
            color: #333;
            text-shadow: none;

            background-color: #fff;
            border: .05rem solid #fff;
        }



        /*
 * Base structure
 */

        html,
        body {
            height: 100%;
            background-color: #333;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            color: #fff;
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }

        .cover-container {
            max-width: 42em;
        }


        /*
 * Header
 */
        .masthead {
            margin-bottom: 2rem;
        }

        .masthead-brand {
            margin-bottom: 0;
        }

        .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, .25);
        }

        .nav-masthead .nav-link+.nav-link {
            margin-left: 1rem;
        }

        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }

        @media (min-width: 48em) {
            .masthead-brand {
                float: left;
            }

            .nav-masthead {
                float: right;
            }
        }


        /*
 * Cover
 */
        .cover {
            padding: 0 1.5rem;
        }

        .cover .btn-lg {
            padding: .75rem 1.25rem;
            font-weight: 700;
        }


        /*
 * Footer
 */
        .mastfoot {
            color: rgba(255, 255, 255, .5);
        }
    </style>


</head>

<body class="text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Aduan Mercu Buana</h3>
                <nav class="nav nav-masthead justify-content-center">

                    @auth <h5 class="masthead-brand btn btn-primary btn-secondary  "><a href="{{ route('dashboard') }}"
                            class="text-dark">Beranda</a>
                    </h5>
                    @else
                    <h5 class="masthead-brand btn btn-primary btn-secondary  "><a href="/login"
                            class="text-dark">Masuk</a>
                    </h5>
                    @endauth


                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading">SISTEM
                INFORMASI ADUAN .</h1>
            <p class="lead"> Sistem ini dirancang untuk meningkatkan transparansi dan akuntabilitas universitas Mercu
                Buana.
            <p class="lead">
            <form id="searchForm">

                <div class="form-row">

                    <div class="col-9">
                        <input type="text" class="form-control" id="kode_laporan" name="kode_laporan"
                            placeholder="PM-xxxx-xxx" maxlength="15">

                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-md btn-secondary">Lacak Aduan</button>
                    </div>

                </div>



                <p class="text-center mt-3">

                <div id="result"> Pantau status terakhir aduan Anda dengan memasukkan nomor aduan.
                </div>

                </p>


            </form>

            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p> <a href="#">Sistem Informasi
                        aduan mercubuana</a>. @ 2024</p>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
        const prefix = "PM-";

        $('#kode_laporan').on('focus', function () {
            if (!$(this).val().startsWith(prefix)) {
                $(this).val(prefix);
            }
        });

        $('#kode_laporan').on('input', function () {
            const value = $(this).val().replace(prefix, "");
            const cleanValue = value.replace(/[^0-9]/g, "");

            const part1 = cleanValue.substring(0, 4); // 4 digit pertama
            const part2 = cleanValue.substring(4, 7); // 3 digit berikutnya

            let formattedValue = `${prefix}${part1}`;
            if (part2) {
                formattedValue += `-${part2}`;
            }

            $(this).val(formattedValue);
        });

        // Submit form untuk pencarian
        $('#searchForm').on('submit', function (e) {
            e.preventDefault();

            const kodeLaporan = $('#kode_laporan').val();

            const regex = /^PM-\d{4}-\d{3}$/;
            if (!regex.test(kodeLaporan)) {
                $('#result').html('<p>Format kode laporan tidak valid. Gunakan format: PM-xxxx-xxxx</p>');
                return;
            }

            $.ajax({
                url: '/cek-aduan',
                type: 'GET',
                data: { kode_laporan: kodeLaporan },
                success: function (response) {
                    if (response.data) {
                        const laporan = response.data;

                const statusBadge = laporan.status_laporan
                    ? '<span class="badge badge-success">Selesai</span>'
                    : '<span class="badge badge-warning">Menunggu</span>';

                const tableHtml = `
                    <table class="table table-dark mt-4">
                        <thead>
                            <tr>
                                <th>Judul Laporan</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active">
                                <td>${laporan.judul_laporan}</td>
                                <td>${statusBadge}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="/aduan/detail/${laporan.id}">Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>`;

                $('#result').html(tableHtml);
                    } else {
                        $('#result').html('<p class="text-warning">Laporan tidak ditemukan.</p>');

                    }
                },
                error: function () {
                    $('#result').html('<p class="text-warning">Laporan tidak ditemukan.</p>');
                }
            });
        });
    });
    </script>



</body>

</html>

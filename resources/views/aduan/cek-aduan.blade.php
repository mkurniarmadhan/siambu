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
            /* Prevent inheritance from `body` */
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
                <h3 class="masthead-brand">SIPUMA</h3>
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
            <p class="lead"> Sistem ini dirancang untuk meningkatkan transparansi dan akuntabilitas universitas dalam
                melayani stakeholdersnya.
            <p class="lead">
            <form action="{{ route('cek.aduan.post') }}" method="POST">
                @csrf
                <div class="form-row">

                    <div class="col-9">
                        <input type="text" class="form-control" placeholder="Masukan nomor Laporan">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-md btn-secondary">Lacak Aduan</button>
                    </div>

                </div>

                @if ($laporan)
                    <table class="table table-dark mt-4">
                        <thead>
                            <tr>
                                <th>Judul Laporan</th>
                                <th>Status</th>
                                <th>Opsi </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr class="table-active">
                                <td>{{ $laporan->judul_laporan }}</td>
                                <td>
                                    @if ($laporan->status_laporan)
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-warning">Menunggu</span>
                                    @endif
                                </td>

                                <td><a class="btn btn-sm btn-primary"
                                        href="{{ route('user.aduan.detail', $laporan) }}">Detail</a></td>
                            </tr>


                        </tbody>
                    </table>
                @endif

            </form>

            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p> <a href="https://twitter.com/mdo">Sistem Informasi
                        aduan mercubuana</a>. @ 2024</p>
            </div>
        </footer>
    </div>



</body>

</html>

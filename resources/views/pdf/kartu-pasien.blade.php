<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karu Pasien {{ $user->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .kartu-id {
            background-image: url(/kartu-id/img/bg.png);
            max-width: 630px;
            min-width: 630px;
            min-height: 368px;
            max-height: 368px;
        }

        body {
            background-color: #ffffff;

        }

        .bawah {
            height: 2.5rem;
        }

        .radius-atas {
            margin-top: 2px;
            border-radius: 50px 50px 0px 0px;
        }

        .radius-bawah {
            margin-top: 9px;
            border-radius: 0px 0px 100px 100px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- kartu pasien depan start -->
            <div class="col-5 kartu-id border mt-5 mx-auto">

                <div class="row bg-info text-white radius-atas pt-2 pb-2">
                    <div class="col-1"></div>
                    <div class="col-3">
                        <img src="{{ asset('/kartu-id') }}/img/logoo.png" width="100%" alt="">
                    </div>
                    <div class="col-6 text-center my-auto">
                        <h4>Kasih Ibu Surakarta</h4>
                        <p>Jl. Slamet Riyadi No.404, Purwosari, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57142</p>
                    </div>
                    <div class="col-2"></div>
                </div>

                <div class="row my-5">
                    <div class="col-3 text-center">
                        <img src="{{ asset('/kartu-id') }}/img/user.png" width="100%" alt="">
                    </div>

                    <div class="col-1"></div>

                    <div class="col-8 my-auto">
                        <p>Nama : {{ $user->name }}</p>
                        <p>Username : {{ $user->username }}</p>
                    </div>
                </div>

                <div class="bawah row bg-info radius-bawah"></div>

            </div>
            <!-- kartu pasien depan end -->
        </div>

        <div class="row">
            <!-- kartu pasien balakang start -->
            <div class="col-5 kartu-id border mt-5 mx-auto">

                <div class="row bg-info text-white radius-atas pt-2 pb-2">
                    <div class="col-1"></div>
                    <div class="col-3">
                        <img src="{{ asset('/kartu-id') }}/img/logoo.png" width="100%" alt="">
                    </div>
                    <div class="col-6 text-center my-auto">
                        <h4>Kasih Ibu Surakarta</h4>
                        <p>Jl. Slamet Riyadi No.404, Purwosari, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57142</p>
                    </div>
                    <div class="col-2"></div>
                </div>

                <div class="row my-1">
                    <div class="col-12 text-muted text-start">
                        <ul>
                            <li class="my-3">
                                kartu pasien diperuntukkan sebagai tanda bukti bahwa pasien telah melakukan pendaftaran.
                                Kartu ini sebagai identitas pasien yang berisi data data riwayat pasien dalam melakukan
                                diagnosa penyakit tuberkulosis
                            </li>
                            <li class="my-3">
                                jika pasien lupa dengan kata sandi, harap menghubungi bagian rekam medis untuk mengganti
                                kata sandi
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bawah row bg-info radius-bawah"></div>

            </div>
            <!-- kartu pasien balakang end -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        window.print();
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistem Pakar Tuberkulosis</title>
    <link href="{{ asset('dist/img/logo/logo.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    
  </head>
  <body>
    <div class="container-lg bg-primary text-white pt-3 pb-5">
      <div class="row">
        <!-- konten -->
        <div class="col-1"></div>
        <div class="col-md-4 text-center">
          <h1 class="display-4 mt-5 text-sm-start"><b class="">Sistem Pakar Diagnosa Pada Penyakit Tuberkulosis.</b></h1>
          <p>Silahkan login untuk menggunakan aplikasi.</p>
          <!-- kotak login -->
          <div class="row bg-dark bg-opacity-75 border border-success p-2 border-opacity-10 rounded-5 mx-1">
            <div class="col-12">
              <p class="lead text-center">Pilih tombol dibawah ini sesuai kebutuhan</p>
            </div>
            <div class="col-sm-12 col-md-4 text-center">
              <a href="{{ url('login') }}"><img src="img/Rekam Medis 1.png" alt="" class="img-fluid btn btn-outline-dark border border-0" /></a>
            </div>
            <div class="col-sm-12 col-md-4 text-center">
              <a href="{{ url('login2') }}"><img src="img/pasien 1.png" alt="" class="img-fluid btn btn-outline-dark border border-0" /></a>
            </div>
            <div class="col-sm-12 col-md-4 text-center">
              <a href="{{ url('diagnosa') }}"><img src="img/pasien 1.png" alt="" class="img-fluid btn btn-outline-dark border border-0" /></a>
            </div>
          </div>
        </div>

        <!-- gambar img -->
        <div class="col-md-7 my-auto text-center mt-3">
          <img src="img/tuberkulosis.png" alt="" class="img-fluid" />
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

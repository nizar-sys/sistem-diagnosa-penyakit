<x-app-layout>
    <x-slot name="title">
        Diagnosa Penyakit Tuberkulosis
    </x-slot>

    <x-slot name="head">
        <style>
            .red-border {
                border: 1px solid rgba(227, 39, 79, .8);
            }

            .green-border {
                border: 1px solid rgba(50, 179, 104, .8);
            }
        </style>
    </x-slot>

    <section class="row">
        @php
            $route = Auth::check() ? 'admin.diagnosa' : 'diagnosa';
        @endphp
        <form action="{{ route($route) }}" method="post">
            @csrf
            @if (!Auth::check())
                <div class="col-12 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- Name field -->
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <x-input required type="text" text="Nama" name="name" />
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <x-input required type="umur" text="Umur" name="umur" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <x-input required type="jenis_kelamin" text="Jenis Kelamin" name="jenis_kelamin" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <x-alert-error></x-alert-error>
                <div class="card">
                    <div class="card-body">


                        @if (Auth::check())
                            <label for=""><b><i class="fas fa-user mr-1 mb-2"></i> Nama :
                                    {{ Auth::user()->name }}
                                </b></label><br>
                        @else
                            <label for=""><b><i class="fas fa-user mr-1 mb-2"></i></b></label><br>
                        @endif
                        <hr>

                        {{-- <label for=""><b><i class="fas fa-thermometer-quarter mr-1"></i> Suhu Tubuh °C</b></label>
                    <input type="text" class="form-control mb-3 w-50" name="suhu_tubuh">

                    <label for=""><b><i class="fas fa-heartbeat mr-1"></i> Tensi</b></label>
                    <input type="text" class="form-control mb-3 w-50" name="tensi_darah"> --}}


                        <label for=""><b><i class="fas fa-th mr-1"></i> Gejala-gejala</b></label>
                        {{-- <a class="btn btn-primary ml-2 my-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        klik untuk melihat catatan
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body my-1 border border-4">
                            <p>Pilih jawaban dengan benar</p>  
                        </div>
                    </div> --}}
                        @foreach ($gejala as $key => $value)
                            @php
                                $mod = ($key + 1) % 2;
                            @endphp

                            @if ($mod == 1)
                                <div class="row">
                            @endif
                            <div class="col-md-6">
                                <div class="row d-flex align-items-center justify-content-between border mb-2 p-2">
                                    <div class="col-xl">
                                        <span class="">{{ $value->nama }}</span>
                                    </div>
                                    <div class="col-xl">
                                        <select name="diagnosa[]" id=""
                                            class="form-control form-control-sm red-border">
                                            <option value="{{ $value->id }}+-1">Pasti tidak</option>
                                            <option value="{{ $value->id }}+-0.8">Hampir pasti tidak</option>
                                            <option value="{{ $value->id }}+-0.6">Kemungkinan besar tidak</option>
                                            <option value="{{ $value->id }}+-0.4">Mungkin tidak</option>
                                            <option value="" selected>Tidak tahu</option>
                                            <option value="{{ $value->id }}+0.4">Mungkin</option>
                                            <option value="{{ $value->id }}+0.6">Sangat mungkin</option>
                                            <option value="{{ $value->id }}+0.8">Hampir pasti</option>
                                            <option value="{{ $value->id }}+1">Pasti</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            @if ($mod == 0)
                    </div>
                    @endif

                    @if ($key + 1 == \App\Models\Gejala::count() && $mod != 0)
                </div>
                @endif
                @endforeach
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Diagnosa sekarang</button>
                </div>
            </div>
        </form>
    </section>

    <x-slot name="script">
        <script>
            $('button[type="submit"]').click(function() {
                $(this).attr('disabled')
            })

            $('select[name="diagnosa[]"]').on('change', function() {
                if (this.value == "") {
                    $(this).attr('class', 'form-control form-control-sm red-border')
                } else {
                    $(this).attr('class', 'form-control form-control-sm green-border')
                }
            })
        </script>
    </x-slot>
</x-app-layout>

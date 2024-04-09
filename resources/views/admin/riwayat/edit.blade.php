<x-app-layout>
    <x-slot name="title">
        Edit riwayat diagnosa
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
        {{-- chart section --}}
        <div class="col-md-12">
            <x-alert-error></x-alert-error>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.riwayat.update', $riwayat->id) }}" method="post">
                        @csrf
                        @method('put')

                        @role('Rekam Medis')
                            <label for="">
                                <b>
                                    <i class="fas fa-user mr-1"></i> {{ old('nama', $riwayat->nama) }}
                                </b>
                            </label>
                            <input type="hidden" class="form-control mb-3 w-50" name="nama"
                                value="{{ old('nama', $riwayat->nama) }}">
                                <br>
                        @endrole

                        <label for=""><b><i class="fas fa-thermometer-quarter mr-1"></i> suhu tubuh</b></label>
                        <input type="text" class="form-control mb-3 w-50" name="suhu_tubuh"
                            value="{{ old('suhu_tubuh', $riwayat->suhu_tubuh) }}">

                        <label for=""><b><i class="fas fa-heartbeat mr-1"></i> tensi darah</b></label>
                        <input type="text" class="form-control mb-3 w-50" name="tensi_darah"
                            value="{{ old('tensi_darah', $riwayat->tensi_darah) }}">


                        <label for=""><b><i class="fas fa-th mr-1"></i> Gejala-gejala</b></label>
                        
                        @php
                            $gejalaTerpilih = collect(unserialize($riwayat->gejala_terpilih));
                            $kemungkinans = [['nama' => 'keyakinan 0%', 'kode_kemungkinan' => '+0'], 
                            ['nama' => 'keyakinan 20%', 'kode_kemungkinan' => '+0.1'], 
                            ['nama' => 'keyakinan 50%', 'kode_kemungkinan' => '+0.3'], 
                            ['nama' => 'keyakinan 80%', 'kode_kemungkinan' => '+0.8'], 
                            ['nama' => 'keyakinan 100%', 'kode_kemungkinan' => '+1']];
                        @endphp

                        <div class="row">
                            @foreach ($gejala as $key => $value)
                                @php
                                    $gejalaKey = $value->id;
                                    $gejalaData = $gejalaTerpilih->get($gejalaKey);
                                    $selectedKode = $gejalaData ? $gejalaKey . '+' . $gejalaData['cf_user'] : '';
                                @endphp
                                <div class="col-md-6">
                                    <div class="row d-flex align-items-center justify-content-between border mb-2 p-2">
                                        <div class="col-xl">
                                            <span class="">{{ $value->nama }}</span>
                                        </div>
                                        <div class="col-xl">
                                            <select name="diagnosa[]" class="form-control form-control-sm"
                                                onchange="changeDiagnosa(this)">
                                                @foreach ($kemungkinans as $kemungkinan)
                                                    @php
                                                        $kodeKemungkinan = $gejalaKey . $kemungkinan['kode_kemungkinan'];
                                                    @endphp
                                                    <option value="{{ $kodeKemungkinan }}"
                                                        {{ $selectedKode == $kodeKemungkinan ? 'selected' : '' }}>
                                                        {{ $kemungkinan['nama'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-warning">Simpan Diagnosa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="script">
        <script>
            function disableButton(button) {
                button.disabled = true;
            }

            function changeDiagnosa(select) {
                if (select.value == "") {
                    select.classList.add('red-border');
                    select.classList.remove('green-border');
                } else {
                    select.classList.add('green-border');
                    select.classList.remove('red-border');
                }
            }
        </script>
    </x-slot>
</x-app-layout>

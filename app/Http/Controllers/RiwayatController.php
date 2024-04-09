<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class RiwayatController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:riwayat-list', ['only' => ['index']]);
        // $this->middleware('permission:riwayat-show', ['only' => ['show']]);
    }

    public function tingkat_keyakinan($keyakinan)
    {
        switch ($keyakinan) {
            case 0:
                return 'keyakinan 0%';
                break;
            case 0.1:
                // return 'mungkin tidak';
                return 'keyakinan 20%';
                break;
            case 0.3:
                // return 'agak yakin';
                return 'keyakinan 50%';
                break;
            case 0.8:
                return 'keyakinan 80%';
                break;
            case 1:
                return 'keyakinan 100%';
                break;
        }
    }

    public function kalkulasi_cf($data)
    {
        $data_penyakit = [];
        $gejala_terpilih = [];
        foreach($data['diagnosa'] as $input) {
            if(!empty($input)) {
                $opts = explode('+', $input);
                $gejala = Gejala::with('penyakits')->find($opts[0]);

                foreach($gejala->penyakits as $penyakit) {
                    if(empty($data_penyakit[$penyakit->id])){
                        $data_penyakit[$penyakit->id] = [$penyakit, [$gejala, $opts[1], $penyakit->pivot->value_cf]];
                    } else {
                        array_push($data_penyakit[$penyakit->id], [$gejala, $opts[1], $penyakit->pivot->value_cf]);
                    }

                    if(empty($gejala_terpilih[$gejala->id])) {
                        $gejala_terpilih[$gejala->id] = [
                            'nama' => $gejala->nama,
                            'kode' => $gejala->kode,
                            'cf_user' => $opts[1],
                            'keyakinan' => $this->tingkat_keyakinan($opts[1])
                        ];
                    }
                }
            }
        }

        $hasil_diagnosa = [];
        $cf_max = null;
        foreach($data_penyakit as $final) {
            if(count($final) < 3) {
                continue;
            }

            $cf1 = null;
            $cf2 = null;
            $cf_combine = 0;
            $hasil_cf = null;
            foreach($final as $key => $value) {
                if($key == 0) {
                    continue;
                }

                if($key == 1) {
                    $cf1 = $final[$key][2] * $final[$key][1];
                } else {
                    if($cf_combine != 0) {
                        $cf1 = $cf_combine;
                        $cf2 = $final[$key][2] * $final[$key][1];

                        if($cf1 < 0 || $cf2 < 0) {
                            $cf_combine = ($cf1 + $cf2) / (1 - min($cf1, $cf2));
                        } else {
                            $cf_combine = $cf1 + ($cf2 * (1 - $cf1));
                        }

                        $hasil_cf = $cf_combine;
                    } else {
                        $cf2 = $final[$key][2] * $final[$key][1];

                        if($cf1 < 0 || $cf2 < 0) {
                            $cf_combine = ($cf1 + $cf2) / (1 - min($cf1, $cf2));
                        } else {
                            $cf_combine = $cf1 + ($cf2 * (1 - $cf1));
                        }

                        $hasil_cf = $cf_combine;
                    }

                }

                if(count($final) - 1 == $key) {
                    if($cf_max == null) {
                        $cf_max = [$hasil_cf, "{$final[0]->nama} ({$final[0]->kode})"];
                    } else {
                        $cf_max = ($hasil_cf > $cf_max[0])
                            ? [$hasil_cf, "{$final[0]->nama} ({$final[0]->kode})"]
                            : $cf_max;
                    }

                    $hasil_diagnosa[$final[0]->id]['hasil_cf'] = $hasil_cf;

                    $cf1 = null;
                    $cf2 = null;
                    $cf_combine = 0;
                    $hasil_cf = null;
                }



                if(empty($hasil_diagnosa[$final[0]->id])) {
                    $hasil_diagnosa[$final[0]->id] = [
                        'nama_penyakit' => $final[0]->nama,
                        'kode_penyakit' => $final[0]->kode,
                        'gejala' => [
                            [
                                'nama' => $final[$key][0]->nama,
                                'kode' => $final[$key][0]->kode,
                                'cf_user' => $final[$key][1],
                                'cf_role' => $final[$key][2],
                                'hasil_perkalian' => $final[$key][2] * $final[$key][1]
                            ]
                        ]
                    ];
                } else {
                    array_push($hasil_diagnosa[$final[0]->id]['gejala'], [
                        'nama' => $final[$key][0]->nama,
                        'kode' => $final[$key][0]->kode,
                        'cf_user' => $final[$key][1],
                        'cf_role' => $final[$key][2],
                        'hasil_perkalian' => $final[$key][2] * $final[$key][1]
                    ]);
                }
            }
        }

        return [
            'hasil_diagnosa' => $hasil_diagnosa,
            'gejala_terpilih' => $gejala_terpilih,
            'cf_max' => $cf_max
        ];
    }

    public function index(Request $request)
    {
        if (auth()->user()->hasRole('Rekam Medis')) {
            $riwayat = Riwayat::with('penyakit')
                ->latest()
                ->when($request->start_date && !$request->end_date, function ($query) use ($request) {
                    $query->whereDate('created_at', '>=', $request->start_date);
                })
                ->when($request->end_date && !$request->start_date, function ($query) use ($request) {
                    $query->whereDate('created_at', '<=', $request->end_date);
                })
                ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
                })
                ->paginate(10);
        } else {
            $riwayat = auth()->user()
                ->riwayats()
                ->with('penyakit')
                ->when($request->start_date && !$request->end_date, function ($query) use ($request) {
                    $query->whereDate('created_at', '>=', $request->start_date);
                })
                ->when($request->end_date && !$request->start_date, function ($query) use ($request) {
                    $query->whereDate('created_at', '<=', $request->end_date);
                })
                ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
                })
                ->latest()
                ->paginate(10);
        }

        return view('admin.riwayat.index', compact('riwayat'));
    }

    public function show(Riwayat $riwayat)
    {
        // $this->authorize('show', $riwayat);
        return view('admin.riwayat.show', compact('riwayat'));
    }

    public function edit(Riwayat $riwayat)
    {
        $gejala = Gejala::all();

        return view('admin.riwayat.edit', compact('riwayat', 'gejala'));
    }

    public function update(Request $request, Riwayat $riwayat)
    {
        $name = auth()->user()->name;
        // $username = auth()->user()->username;
        $no_hp = auth()->user()->no_hp;
        $alamat = auth()->user()->alamat;
        $jenis_kelamin = auth()->user()->jenis_kelamin;
        $umur = auth()->user()->umur;


        if (auth()->user()->hasRole('Rekam Medis')) {
            $request->validate(['nama' => 'string|max:100']);
            $name = $request->nama;
        }

        $data = $request->all();

        $result = $this->kalkulasi_cf($data);

        if ($result['cf_max'] == null) {
            return back()->with('error', 'Terjadi sebuah kesalahan');
        }

        $riwayat->update([
            'nama' => $name,
            // 'username' => $username,
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi_darah' => $request->tensi_darah,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'umur' => $umur,
            'hasil_diagnosa' => serialize($result['hasil_diagnosa']),
            'cf_max' => serialize($result['cf_max']),
            'gejala_terpilih' => serialize($result['gejala_terpilih']),
            'user_id' => auth()->id()
        ]);

        $path = public_path('storage/downloads');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $file_pdf = 'Diagnosa-' . $name . '-' . time() . '.pdf';

        PDF::loadView('pdf.riwayat', ['id' => $riwayat->id])
            ->save($path . "/" . $file_pdf);

        $riwayat->update(['file_pdf' => $file_pdf]);

        return redirect()->to(route('admin.riwayat', $riwayat->id));
    }

    public function destroy(Riwayat $riwayat)
    {
        $riwayat->delete();

        return redirect()->to(route('admin.riwayat.daftar'));
    }
}

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Routing\Redirector;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Halte;
use App\Model\Koridor;
use App\Model\Point;
use App\Model\Rute;
class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function koridor()
    {
        return view('information-koridor');
    }
    public function manajemen_point($id=1)
    {
        // $id = 1;
        $halte = Point::basisdata_point($id);
        // print_r($tmp);
        // $halte = $halte->merge($tmp);
         return view('manajemen_point', ['halte' => $halte,'id' => $id]);
    }
    public function manajemen_halte($id=1)
    {
        // $id = 1;
        $halte = Halte::basisdata_halte($id);
        // print_r($tmp);
        // $halte = $halte->merge($tmp);
        return view('manajemen_halte', ['halte' => $halte,'id' => $id]);
    }
    public function manajemen_koridor($id=1)
    {
        // $id = 1;
        $koridor = Koridor::basisdata_koridor($id);
        // print_r($tmp);
        // $halte = $halte->merge($tmp);
        return view('manajemen_koridor', ['koridor' => $koridor,'id' => $id]);
        // return view('manajemen_koridor')->with('halte',$halte);
    }
    public function manajemen_rute($id=1)
    {
        // $id = 1;
        $rute = Rute::basisdata_rute($id);
        // print_r($tmp);
        // $halte = $halte->merge($tmp);
        return view('manajemen_rute', ['rute' => $rute,'id' => $id]);
        // return view('manajemen_koridor')->with('halte',$halte);
    }
    public function testline()
    {
        return view('test-line');
    }
    public function ungroup()
    {
        return view('test_ungroup');
    }
    public function koridor_all()
    {
        return view('koridor_all');
    }
    public function k_all()
    {
        return view('k_all');
    }
    public function k1()
    {
        return view('k1');
    }
    public function k2()
    {
        return view('k2');
    }
    public function k3()
    {
        return view('k3');
    }
    public function k5()
    {
        return view('k5');
    }
    public function k6()
    {
        return view('k6');
    }
    public function delete_point($id)
    {
        $point = Point::delete_poin($id);
        return redirect()->action('HomeController@manajemen_point',[1]);
    }
    public function delete_halte($id)
    {
        $halte = Halte::delete_halte($id);
        return redirect()->action('HomeController@manajemen_halte',[1]);
    }
    public function delete_koridor($id)
    {
        $koridor = Koridor::delete_koridor($id);
        return redirect()->action('HomeController@manajemen_koridor',[1]);
    }
    public function delete_rute($id)
    {
        $rute = Rute::delete_rute($id);
        return redirect()->action('HomeController@manajemen_rute',[1]);
    }
    public function tambah_halte(Request $request)
    {
        if ($request->isMethod('get')) {
            $halte = Halte::get();
            $koridor = Koridor::get();
            return view('addhalte', ['halte' => $halte,'koridor' => $koridor]);
        }

        else if($request->isMethod('post'))
        {
            $halte = new Halte;
            $halte->nama = $request->input('Nama');
            $halte->longitude = $request->input('Longitude');
            $halte->latitude = $request->input('Latitude');
            $halte->keterangan = $request->input('Keterangan');
            $halte->warna = $request->input('Warna');
            $halte->save();
            // $halte = Halte::find($halte->id);
            // dd($halte);
        }
        return redirect()->action('HomeController@manajemen_halte',[1]);
        
    }
    public function tambah_point(Request $request)
    {
        if ($request->isMethod('get')) {
            $halte = Halte::get();
            $koridor = Koridor::get();
            return view('addpoint', ['halte' => $halte,'koridor' => $koridor]);
        }
        else if($request->isMethod('post'))
        {

            $jumlah = Point::jumlah_point($request->input('Koridor'),$request->input('Nomor'));
            $nomor_sementara = $request->input('Nomor');
            $jumlah--;
            $nomor_maksimal = $nomor_sementara+$jumlah;
            $point = new Point;
            $point->nomor = $request->input('Nomor');
            $point->longitude = $request->input('Longitude');
            $point->latitude = $request->input('Latitude');
            $point->keterangan = $request->input('Keterangan');
            $point->koridor_id = $request->input('Koridor');
            // print_r($nomor_maksimal);
            $point_sementara = Point::point_sementara($request->input('Koridor'),$nomor_sementara);
            if($point_sementara)
            {
                for ($i=0; $i < $jumlah; $i++) {
                    $nomor_sementara++;                       
                    $point_sementara[$i]->nomor=$nomor_sementara;
                                        
                    $point_sementara[$i]->save();
           
                }
            }
            
            // // $nomor= $request->input('Nomor');
            // // $point = new Point;
            // // $point->nomor = $nomor;
            // // dd($point);
            $point->save();
            return redirect()->action('HomeController@manajemen_point',[$request->input('Koridor')]);
            // $halte = Halte::find($halte->id);
        }

        
        // dd($halte);
    }
    public function tambah_koridor(Request $request)
    {
        if ($request->isMethod('get')) {
            // $halte = Halte::get();
            // $koridor = Koridor::get();
            return view('addkoridor');
        }
        else if($request->isMethod('post'))
        {
            $koridor = new Koridor;
            $koridor->Nomor = $request->input('Nomor');
            $koridor->Nama = $request->input('Nama');
            $koridor->Keterangan = $request->input('Keterangan');
            $koridor->Simbol = $request->input('Simbol');
            $koridor->Line = $request->input('Line');
            // $koridor->warna = $request->input('Warna');
            $koridor->save();
            return redirect()->action('HomeController@manajemen_koridor',[1]);
            // $koridor = Koridor::find($koridor->id);
            // dd($koridor);
        }

        
    }
    public function tambah_rute(Request $request)
    {
        if ($request->isMethod('get')) {
            $halte = Halte::get();
            $koridor = Koridor::get();
            return view('addrute', ['halte' => $halte,'koridor' => $koridor]);
        }
        else if($request->isMethod('post'))
        {

            // $nomor= $request->input('Nomor');
            $rute = new Rute;
            $rute->koridor_asal = $request->input('Koridor_Asal');
            $rute->koridor_tujuan = $request->input('Koridor_Tujuan');
            $rute->koridor_via = $request->input('Koridor_Via');
            $rute->halte_transisi = $request->input('Halte_Transisi');
            // $koridor->Line = $request->input('Line');
            $rute->save();
            return redirect()->action('HomeController@manajemen_koridor',[1]);
            // $halte = Halte::find($halte->id);
        }

        
        // dd($halte);
    }

        public function edit_halte(Request $request,$id)
    {
        if ($request->isMethod('get')) {
            $halte_terpilih = Halte::find($id);
            $halte = Halte::get();
            $koridor = Koridor::get();
            return view('edithalte', ['halte' => $halte,'halte_terpilih' => $halte_terpilih,'koridor' => $koridor]);
        }

        else if($request->isMethod('post'))
        {
            $halte = Halte::find($id);
            $halte->nama = $request->input('Nama');
            $halte->longitude = $request->input('Longitude');
            $halte->latitude = $request->input('Latitude');
            $halte->keterangan = $request->input('Keterangan');
            $halte->warna = $request->input('Warna');
            $halte->save();
            return redirect()->action('HomeController@manajemen_halte',[1]);
            // $halte = Halte::find($halte->id);
        }
        
    }
    public function edit_point(Request $request,$id)
    {
        if ($request->isMethod('get')) {
            $point_terpilih = Point::find($id);
            $halte = Halte::get();
            $koridor = Koridor::get();
            return view('editpoint', ['halte' => $halte,'point_terpilih' => $point_terpilih,'koridor' => $koridor]);
        }
        else if($request->isMethod('post'))
        {

            $point = Point::find($id);
            $point->nomor = $request->input('Nomor');
            $point->longitude = $request->input('Longitude');
            $point->latitude = $request->input('Latitude');
            $point->keterangan = $request->input('Keterangan');
            // $point->warna = $request->input('Warna');
            $point->koridor_id = $request->input('Koridor');
            $point->save();
            return redirect()->action('HomeController@manajemen_point',[1]);
            // $halte = Halte::find($halte->id);
        }

        
        // dd($halte);
    }
    public function edit_koridor(Request $request,$id)
    {
        if ($request->isMethod('get')) {
            $koridor_terpilih = Koridor::find($id);
            // $halte = Halte::get();
            // $koridor = Koridor::get();
            return view('editkoridor')->with('koridor_terpilih',$koridor_terpilih);
        }
        else if($request->isMethod('post'))
        {
            $koridor = Koridor::find($id);
            $koridor->Nomor = $request->input('Nomor');
            $koridor->Nama = $request->input('Nama');
            $koridor->Keterangan = $request->input('Keterangan');
            $koridor->Simbol = $request->input('Simbol');
            $koridor->Line = $request->input('Line');
            $koridor->save();
            return redirect()->action('HomeController@manajemen_koridor',[1]);
            // dd($koridor);
        }
        
    }
    public function edit_rute(Request $request,$id)
    {
        if ($request->isMethod('get')) {
            $rute_terpilih = Rute::find($id);
            $halte = Halte::get();
            $koridor = Koridor::get();
            return view('editrute', ['halte' => $halte,'koridor' => $koridor,'rute_terpilih' => $rute_terpilih]);
        }
        else if($request->isMethod('post'))
        {
            $rute = Rute::find($id);
            $rute->koridor_asal = $request->input('Koridor_Asal');
            $rute->koridor_tujuan = $request->input('Koridor_Tujuan');
            $rute->koridor_via = $request->input('Koridor_Via');
            $rute->halte_transisi = $request->input('Halte_Transisi');
            $rute->save();
            return redirect()->action('HomeController@manajemen_rute',[1]);
            // $halte = Halte::find($halte->id);
        }

        
        // dd($halte);
    }
    public function halte_form()
    {
       
        $halte = Halte::where('id','>',0)->get();
        // print_r($halte);
        return view("index")->with('halte',$halte);
       
        // return json_encode($halte);
    }
    public function halte()
    {
        $FeatureCollection = array();
        $FeatureCollection['type'] = "FeatureCollection";
        $FeatureCollection['crs'] = array();
        $FeatureCollection['crs']['type'] = "name";
        $FeatureCollection['crs']['properties'] = array();
        $FeatureCollection['crs']['properties']['name'] = "urn:ogc:def:crs:OGC:1.3:CRS84";
        $FeatureCollection['features'] = array();
        // $where = array('koridor_id' => 1);
        // $
        $halte = Point::with('Koridor')-> where('halte_id','>',0)->get();
        // return json_encode($halte);
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['properties'] = array();
            $feature['properties']['name'] = $value->nama;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            $feature['properties']['line'] = $value->koridor->line;
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            
            array_push($FeatureCollection['features'], $feature);
        }
        return json_encode($FeatureCollection);
    }
    /**
     * Dapetin jalan yang menghubungkan titik halte awal dan halte akhir. Algoritmanya:
     * dapetin halte awal dan halte akhir.
     * Masuk ke perulangan, sampai halte asal = halte tujuan
     */
    public function pencarian_optimal($awal, $akhir)
    {
        /* dapetin objek halte */
        $halte_awal = Halte::find($awal);
        $halte_akhir = Halte::find($akhir);
        if ($awal == $akhir) {
            return json_encode($halte_awal);
        }
        $halte_asal = $halte_awal;
        $halte_tujuan = $halte_akhir;
        $jalan = new Collection; // nyimpen poin poin jalan
        $halte_perpindahan = new Collection; // nyimpen halte perpindahan
        while ($halte_asal != $halte_tujuan) {
            /* dapetin objek poin, 1 halte bisa jadi ada byk point. pilih slh 1 */
            $point_awals = $halte_asal->Point;
            $point_akhirs = $halte_tujuan->Point;
            $point_awal = null;
            $point_akhir = null;
            if (count($point_awals) == 1) {
                $point_awal = $point_awals[0];
            }
            if (count($point_akhirs) == 1) {
                $point_akhir = $point_akhirs[0];
            }
            /* Jika poin awal ada banyak, pilih yg sama dgn poin akhir */
            if ($point_awal == null && $point_akhir != null) {
                foreach ($point_awals as $val) {
                    if ($point_akhir->koridor_id == $val->koridor_id) {
                        $point_awal = $val;
                        break;
                    } else if ($point_akhir->Koridor->nomor == $val->Koridor->nomor) {
                        $point_awal = $val;
                    }
                }
                if ($point_awal == null) {
                    $point_awal = $point_awals[0];
                }
            }
            /* Jika poin akhir ada banyak, pilih yg sama dgn poin awal */
            if ($point_akhir == null && $point_awal != null) {
                foreach ($point_akhirs as $val) {
                    if ($point_awal->koridor_id == $val->koridor_id) {
                        $point_akhir = $val;
                        break;
                    } else if ($point_awal->Koridor->nomor == $val->Koridor->nomor) {
                        $point_akhir = $val;
                    }
                }
                if ($point_akhir == null) {
                    $point_akhir = $point_akhirs[0];
                }
            }
            /* Jika poin awal dan poin akhir sama sama banyak, pilih yg koridornya sama */
            if ($point_awal == null && $point_akhir == null) {
                foreach ($point_awals as $iw) {
                    foreach ($point_akhirs as $ik) {
                        if ($iw->koridor_id == $ik->koridor_id) {
                            $point_awal = $iw;
                            $point_akhir = $ik;
                            break;
                        } else if ($iw->Koridor->nomor == $ik->Koridor->nomor) {
                            $point_awal = $iw;
                            $point_akhir = $ik;
                        }
                    }
                }
                if ($point_awal == null && $point_akhir == null) {
                    $point_awal = $point_awals[0];
                    $point_akhir = $point_akhirs[0];
                }
            }
            $nyebrang_asal = false;
            $nyebrang_tujuan = false;
            $nyebrang_halte_asal = null;
            $nyebrang_halte_tujuan = null;
            // dd($point_awal, $point_akhir);
            /* ************ MULAI NYARI JALAN ************ */
            /* Jika koridor aslinya sama, tinggal go aja, ga pake ganti ganti bis */
            if ($point_awal->Koridor->nomor == $point_akhir->Koridor->nomor) {
                $jalan->push($point_awal);
                /* Jika koridor sama */
                if ($point_awal->koridor_id == $point_akhir->koridor_id) {
                    /* Nomor poin awal itu sesudah nomor poin akhir */
                    if ($point_awal->nomor < $point_akhir->nomor) {
                        $tmp = Point::jalan_antara($point_awal, $point_akhir);
                        $jalan = $jalan->merge($tmp);
                    }
                    /* Nomor poin awal itu sblm nomor poin akhir */
                    else if ($point_awal->nomor > $point_akhir->nomor) {
                        if ($halte_asal->relasi > 0 && $halte_tujuan->relasi > 0) {
                            $halte_asal = $halte_asal->Relasi;
                            $nyebrang_asal = !$nyebrang_asal;
                            $nyebrang_halte_asal = $halte_asal;
                            $point_awal = $halte_asal->Point->first();
                            $halte_tujuan = $halte_tujuan->Relasi;
                            $nyebrang_tujuan = !$nyebrang_tujuan;
                            $nyebrang_halte_tujuan = $halte_tujuan;
                            $point_akhir = $halte_tujuan->Point->first();
                            $tmp = Point::jalan_antara($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        } else if ($halte_asal->relasi > 0) {
                            $halte_asal = $halte_asal->Relasi;
                            $nyebrang_asal = !$nyebrang_asal;
                            $nyebrang_halte_asal = $halte_asal;
                            $point_awal = $halte_asal->Point->first();
                            $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        } else if ($halte_tujuan->relasi > 0) {
                            $halte_tujuan = $halte_tujuan->Relasi;
                            $nyebrang_tujuan = !$nyebrang_tujuan;
                            $nyebrang_halte_tujuan = $halte_tujuan;
                            $point_akhir = $halte_tujuan->Point->first();
                            $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        } else {
                            $tmp = Point::jalan_mundur($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        }
                    }
                }
                /* Jika koridor beda, cari rute ke koridor tujuan */
                else {
                    if ($halte_asal->Relasi == null && $halte_tujuan->Relasi == null) {
                        $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                        $jalan = $jalan->merge($tmp);
                    } else {
                        /* Samain dulu koridornya */
                        if ($halte_asal->relasi > 0) {
                            $halte_asal = $halte_asal->Relasi;
                            $nyebrang_asal = !$nyebrang_asal;
                            $nyebrang_halte_asal = $halte_asal;
                            $point_awal = $halte_asal->Point->first();
                        } else if ($halte_tujuan->relasi > 0) {
                            $halte_tujuan = $halte_tujuan->Relasi;
                            $nyebrang_tujuan = !$nyebrang_tujuan;
                            $nyebrang_halte_tujuan = $halte_tujuan;
                            $point_akhir = $halte_tujuan->Point->first();
                        }
                        /* Nomor poin awal itu sesudah nomor poin akhir */
                        if ($point_awal->nomor < $point_akhir->nomor) {
                            $tmp = Point::jalan_antara($point_awal, $point_akhir);
                            $jalan = $jalan->merge($tmp);
                        }
                        /* Nomor poin awal itu sblm nomor poin akhir */
                        else if ($point_awal->nomor > $point_akhir->nomor) {
                            if ($halte_asal->relasi > 0 && $halte_tujuan->relasi > 0) {
                                $halte_asal = $halte_asal->Relasi;
                                $nyebrang_asal = !$nyebrang_asal;
                                $nyebrang_halte_asal = $halte_asal;
                                $point_awal = $halte_asal->Point->first();
                                $halte_tujuan = $halte_tujuan->Relasi;
                                $nyebrang_tujuan = !$nyebrang_tujuan;
                                $nyebrang_halte_tujuan = $halte_tujuan;
                                $point_akhir = $halte_tujuan->Point->first();
                                $tmp = Point::jalan_antara($point_awal, $point_akhir);
                                $jalan = $jalan->merge($tmp);
                            } else if ($halte_asal->relasi > 0) {
                                $halte_asal = $halte_asal->Relasi;
                                $nyebrang_asal = !$nyebrang_asal;
                                $nyebrang_halte_asal = $halte_asal;
                                $point_awal = $halte_asal->Point->first();
                                $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                                $jalan = $jalan->merge($tmp);
                            } else if ($halte_tujuan->relasi > 0) {
                                $halte_tujuan = $halte_tujuan->Relasi;
                                $nyebrang_tujuan = !$nyebrang_tujuan;
                                $nyebrang_halte_tujuan = $halte_tujuan;
                                $point_akhir = $halte_tujuan->Point->first();
                                $tmp = Point::jalan_seberang($point_awal, $point_akhir);
                                $jalan = $jalan->merge($tmp);
                            } else {
                                $tmp = Point::jalan_mundur($point_awal, $point_akhir);
                                $jalan = $jalan->merge($tmp);
                            }
                        }
                    }
                }
                /* Nyimpen halte perpindahannya, jika pindah */
                if ($nyebrang_asal) {
                    $halte_perpindahan->push($nyebrang_halte_asal);
                }
                if ($nyebrang_tujuan) {
                    $halte_perpindahan->push($nyebrang_halte_tujuan);
                }
                /* Pindah titik asal dan tujuan */
                $halte_asal = $halte_tujuan;
                $halte_tujuan = $halte_akhir;
                $jalan->push($point_akhir);
            } else {
                $route = Rute::where('koridor_asal', $point_awal->koridor_id)
                        ->where('koridor_tujuan', $point_akhir->koridor_id)
                        ->first();
                $halte_transisi = $route->halteTransisi;
                $halte_perpindahan->push($halte_transisi);
                /* Pindah titik tujuan ke halte transisi */
                $halte_tujuan = $halte_transisi;
                // dd(compact('halte_asal', 'halte_tujuan'));
            }
        }
        $poins = array();
        $list_halte = array(); // halte yang dilewati jalan
        $temp = null; // ini buat hapus poin yg dobel2.
        foreach ($jalan as $key => $value) {
            /* Hapus poin yg dobel dobel */
            if ($temp != null && $value->id == $temp->id) {
                unset($jalan[$key]);
                continue;
            }
            $temp = $value;
            if ($value->halte_id > 0) {
                $list_halte[] = $value;
            }
            $poin = array();
            array_push($poin, $value->latitude);
            array_push($poin, $value->longitude);
            
            array_push($poins, $poin);
        }
        /* Generate all halte markers */
        $halte_markers = [];
        foreach ($list_halte as $key => $value) {
            $warna = '#aaaaaa';
            if ($key == 0) {
                $warna = '#fc4353';
            } else if ($key == count($list_halte) - 1) {
                $warna = '#00ff00';
            } else if ($halte_perpindahan->contains('id', $value->halte_id)) {
                $warna = '#0000ff';
            }
            $marker = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value->longitude, $value->latitude],
                ],
                'properties' => [
                    'title' => $value->nama,
                    'description' => $value->keterangan,
                    'marker-color' => $warna,
                    'marker-size' => "medium",
                    'marker-symbol' => $value->Koridor->simbol,
                ]
            ];
            $halte_markers[] = $marker;
        }
        // dd($jalan);
        $output = array(
                'poins',
                'jalan',
                'list_halte',
                'halte_perpindahan',
                'halte_markers',
            );
        echo json_encode(compact($output));
    }
    public function pencarian($awal,$akhir)
    {
        $keberangkatan = array();
        $kedatangan = array();
        $halte_transisi = array();
        $via= array();
        $hasil = array();
        $hasil['berangkat'][0] = $awal;
        $hasil['kedatangan'][0] = $akhir;
       
        $poins = array();
        $where = array('halte_id' => $awal);
        $temp = Point::where($where)->first();
        $koridor_awal = $temp->koridor_id;
        $where = array('halte_id' => $akhir);
        $temp = Point::where($where)->first();
        $koridor_akhir = $temp->koridor_id;
        $nomor_akhir = $temp->nomor;
        $temp_asal = $koridor_awal;
        $tujuan_akhir = $koridor_akhir;
        $where = array('halte_id' => $awal);
        $temp = Point::where($where)->first();
        $temp_start = $temp->nomor;
        $temp_start = $awal;
        // print_r($koridor_awal." ".$koridor_akhir." ".$awal." ".$akhir);
        while(1)
        {   $halte_transisi = Point::where('koridor_id',$koridor_awal)->where('halte_id',$temp_start)->first();
            
            if($koridor_awal==$koridor_akhir){
                $halte_akhir = Point::where('koridor_id',$koridor_awal)->where('halte_id',$akhir)->first();
                $poin = Point::where('koridor_id',$koridor_awal)->whereBetween('nomor',array($halte_transisi->nomor,$halte_akhir->nomor))->get();
                
            }
            else $poin = Point::where('koridor_id',$koridor_awal)->where('nomor','>=',$halte_transisi->nomor)->get();
            foreach ($poin as $key => $value) {
                $coordinates = array();
                array_push($coordinates, $value->latitude);
                array_push($coordinates, $value->longitude);
                array_push($poins,$coordinates);
            }
            if($koridor_awal == $koridor_akhir){
                
                break;
            }
            $next = Rute::where('koridor_asal',$koridor_awal)->where('koridor_tujuan',$koridor_akhir)->first();
            $temp_start = $next->halte_transisi;
            $koridor_awal = $next->koridor_via;
            if($koridor_awal==0){
                $koridor_awal = $next->koridor_tujuan;
            }
        }
        
        return json_encode($poins);
    }
    public function pencarian_halte($awal,$akhir)
    {
        $FeatureCollection = array(); 
        $halte = Point::with('Halte')
                ->where('halte_id',$awal)
                ->orWhere('halte_id',$akhir)
                ->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            if ($value->halte_id==$akhir) {
                $feature['properties']['marker-color'] = '#fc4353';
            } else {
                $feature['properties']['marker-color'] = '#00ff00';
            }
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        return json_encode($FeatureCollection);
    }
    public function menampilkan_halte($awal,$akhir)
    {
        
       
        $FeatureCollection = array(); 
        $halte = Point::with('Halte')->get();
        foreach ($halte as $key => $value) {
            
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            if($value->halte_id==$akhir)$feature['properties']['marker-color'] = '#fc4353';
            else if($value->halte_id==$awal) $feature['properties']['marker-color'] = '#00ff00';
            else $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function halte_k1a()
    {
        $FeatureCollection = array();
        
        $halte = Point::with('Koridor')->get();
        foreach ($halte as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
       
        return json_encode($FeatureCollection);
    }
    public function halte_ungroup()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 3);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Koridor->color;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function halte_ka1a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 1);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function halte_k1b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 2);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function halte_k2a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 3);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        return json_encode($FeatureCollection);
    }
    public function halte_k2b()
    {
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 4);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        return json_encode($FeatureCollection);
    }
    public function halte_k3a()
    {
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 5);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function halte_k3b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 6);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function halte_k5a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 7);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function halte_k5b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 8);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function halte_k6a()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 9);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        return json_encode($FeatureCollection);
    }
    public function halte_k6b()
    {
        
       
        $FeatureCollection = array(); 
        $where = array('koridor_id' => 10);
        $halte = Point::with('Halte')-> where($where)->where('halte_id','>',0)->get();
        foreach ($halte as $key => $value) {
            $feature = array();
            $feature['type'] = "Feature";
            $feature['geometry'] = array();
            $feature['geometry']['type'] = "Point";
            $feature['geometry']['coordinates'] = array();
            array_push($feature['geometry']['coordinates'], $value->longitude);
            array_push($feature['geometry']['coordinates'], $value->latitude);
            $feature['properties'] = array();
            $feature['properties']['title'] = $value->nama;
            $feature['properties']['description'] = $value->keterangan;
            $feature['properties']['marker-color'] = $value->Halte->warna;
            $feature['properties']['marker-size'] = "medium";
            $feature['properties']['marker-symbol'] = $value->Koridor->simbol;
            
            array_push($FeatureCollection, $feature);
        }
        
        return json_encode($FeatureCollection);
    }
    public function rute1a()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 1);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }
    public function rute1b()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 2);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }
    public function rute2a()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 3);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }
    public function rute2b()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 4);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }
    public function rute3a()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 5);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    } 
    public function rute3b()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 6);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }
    public function rute5a()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 7);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }
    public function rute5b()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 8);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    }
    public function rute6a()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 9);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    } 
    public function rute6b()
    {
        $FeatureCollection = array();
      
        $where = array('koridor_id' => 10);
        $rute = Point::with('Koridor')->where($where)->orderBy('nomor', 'desc')->get();
        // return json_encode($rute);
        foreach ($rute as $key => $value) {
            $coordinate = array();
            array_push($coordinate, $value->latitude);
            array_push($coordinate, $value->longitude);
            array_push($FeatureCollection, $coordinate);
            // temp++;
        }
        
        return json_encode($FeatureCollection);
    } 
}
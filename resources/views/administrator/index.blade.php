@extends('layouts.mainlayout')

@section('content')

<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;
use App\Models\Province;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();
$regency = District::where('regency_id', $config['regencies_id'])->get();
$kota = Regency::where('id', $config['regencies_id'])->first();
$dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
$tps = Tps::count();
?>

<style>
    .open-desktop {
        display: block;
    }

    @media (max-width: 1680px) {

        .open-desktop {
            display: none;
        }

        .break-point-1 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .break-point-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 1024px) {

        .open-desktop {
            display: none;
        }

        .break-point-1 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .break-point-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

</style>

<div class="row mt-3">
    <div class="col-lg-6 col-md-6 break-point-1">
      

                <h1 class="page-title fs-2 mt-2">DASHBOARD PROVINSI
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">BANTEN
                        <!-- Kota -->
                    </li>
                </ol>
               <h1 class="fs-5 mt-1">
                 SUPER ADMINISTRATOR
                </h1>  
               
    </div>



    <div class="col-lg-6 col-xxl-0 justify-content-end mt-2 break-point-1">
        <div class="row">
            <div class="col-lg- col-md- justify-content-end  break-point-2">
                <div class="card" style="margin-bottom: 0px;">
                    <div class="card-body">
                        <div class="row mx-auto">
                            <div class="col-3 ">
                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white bg-danger"
                                    style="margin-bottom: 0;">
                                    0
                                </div>
                            </div>
                            <div class="col me-auto">
                                <h6 class="">Suara Tertinggi</h6>
                                <h3 class="mb-2 number-font">
                                    NA/N
                                    <!--{{$paslon_tertinggi['candidate']}} /-->
                                    <!--{{$paslon_tertinggi['deputy_candidate']}}-->
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="{{($config->otonom == 'yes')?'col-lg-12 col-md-12':'col-lg-6 col-md-12'}}">
        <div class="card">
            <div class="card-header bg-info-gradient">
                <h3 class="card-title text-white">Suara TPS Masuk (Provinsi Banten)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container" style="margin-left: 3%; margin-top: 10%;">
                            <div class="text-center fs-3 mb-3 fw-bold">SUARA MASUK</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div id="chart-pie" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <?php $i = 1; 
                        ?>
                        @foreach ($paslon as $pas)
                        <div class="row mt-2">
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row me-auto">
                                            <div class="col-4">
                                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white "
                                                    style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col me-auto">
                                                <h6 class="">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                <?php
                                                $voice = 0;
                                                ?>
                                                @foreach ($pas->saksi_data as $dataTps)
                                                <?php
                                                $voice += $dataTps->voice;
                                                ?>
                                                @endforeach
                                                <h3 class="mb-2 number-font">{{($pas->id == 0)?0:0 }} suara</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            <div class="card-header bg-secondary-gradient">
                <h3 class="card-title text-white">Suara TPS Terverifikasi (Provinsi Banten)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container" style="margin-left: 3%; margin-top: 10%;">
                            <div class="text-center fs-3 mb-3 fw-bold">SUARA TERVERIFIKASI</div>
                            <div class="text-center">Terverifikasi {{$saksi_terverifikasi}} TPS dari {{$saksi_masuk}}
                                TPS Masuk</div>
                            <div id="chart-donut" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <?php $i = 1; ?>
                        @foreach ($paslon_terverifikasi as $pas)
                        <div class="row mt-2">
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row me-auto">
                                            <div class="col-4">
                                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white ms-auto"
                                                    style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col me-auto">
                                                <h6 class="">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                <?php
                                                $voice = 0;
                                                ?>
                                                @foreach ($pas->saksi_data as $dataTps)
                                                <?php
                                                $voice += $dataTps->voice;
                                                ?>
                                                @endforeach
                                                <h3 class="mb-2 number-font">{{($pas->id == 0)?0:0 }} suara</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Perhitungan Setiap Kota/Kabupaten</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Kab. Pandeglang</div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div id="chart-1" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Kab. Lebak</div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div id="chart-2" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Kab. Tangerang</div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div id="chart-3" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Kab. Serang</div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div id="chart-4" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Kota Tangerang</div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div id="chart-5" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Kota Cilegon</div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div id="chart-6" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Kota Serang</div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div id="chart-7" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Kota Tangerang Selatan</div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div id="chart-8" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="{{($config->otonom == 'yes')?'col-lg-12 col-md-12':'col-lg-6 col-md-12'}}">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Suara TPS Masuk (Provinsi Banten)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white text-center align-middle">KOTA</th>
                            @foreach ($paslon as $item)
                            <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                                {{ $item['deputy_candidate']}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <!-- @foreach ($kec as $item)
    <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
        <td>{{$item['name']}}</td>
        @foreach ($paslon as $cd)
        <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->sum('voice'); ?>
        <td>{{$saksi_dataa}}</td>
        @endforeach
    </tr>
    @endforeach -->
                        <tr onclick="window.open(`https://pandeglang.pilpres.banten.rekapitung.id/`)">
                            <td>Kab. Pandeglang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr onclick="window.open(`https://lebak.pilpres.banten.rekapitung.id/`)">
                            <td>Kab. Lebak</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://kab-tanggerang.pilpres.banten.rekapitung.id/`)">
                            <td>Kab. Tangerang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://kab-serang.pilpres.banten.rekapitung.id/`)">
                            <td>Kab. Serang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://tanggerang.pilpres.banten.rekapitung.id/`)">
                            <td>Kota Tangerang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://cilegon.pilpres.banten.rekapitung.id/`)">
                            <td>Kota Cilegon</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://serang.pilpres.banten.rekapitung.id/`)">
                            <td>Kota Serang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://tangsel.pilpres.banten.rekapitung.id/`)">
                            <td>Kota Tangerang Selatan</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>


                    <script>
                        let check = function (id) {
                            window.location = `public/kecamatan/${id}`;
                        }

                    </script>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Suara TPS Terverifikasi (Provinsi Banten)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <td class="text-white text-center align-middle">KOTA</td>
                        @foreach ($paslon as $item)
                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                            {{ $item['deputy_candidate']}}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        <!-- @foreach ($kec as $item)
    <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
        <td>{{$item['name']}}</td>
        @foreach ($paslon as $cd)
        <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->sum('voice'); ?>
        <td>{{$saksi_dataa}}</td>
        @endforeach
    </tr>
    @endforeach -->
                        <tr onclick="window.open(`https://pandeglang.pilpres.banten.rekapitung.id/`)">
                            <td>Kab. Pandeglang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr onclick="window.open(`https://lebak.pilpres.banten.rekapitung.id/`)">
                            <td>Kab. Lebak</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://kab-tanggerang.pilpres.banten.rekapitung.id/`)">
                            <td>Kab. Tangerang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://kab-serang.pilpres.banten.rekapitung.id/`)">
                            <td>Kab. Serang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://tanggerang.pilpres.banten.rekapitung.id/`)">
                            <td>Kota Tangerang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://cilegon.pilpres.banten.rekapitung.id/`)">
                            <td>Kota Cilegon</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://serang.pilpres.banten.rekapitung.id/`)">
                            <td>Kota Serang</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr onclick="window.open(`https://tangsel.pilpres.banten.rekapitung.id/`)">
                            <td>Kota Tangerang Selatan</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Super Features (Provinsi Banten)</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total TPS</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header bg-danger">
                        <div class="card-title text-white">TPS Masuk</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">TPS Kosong</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header bg-cyan">
                        <div class="card-title text-white">Suara Masuk</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Suara Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

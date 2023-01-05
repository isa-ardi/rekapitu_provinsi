<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Tps;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();
$regency = District::where('regency_id', $config['regencies_id'])->get();
$kota = Regency::where('id', $config['regencies_id'])->first();
$dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
$tps = 2963;
?>
<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{url('/')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">
        <!--APP-SIDEBAR-->
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <aside class="app-sidebar">
            <div class="side-header">
                <a class="header-brand1" href="{{url('')}}/administrator/index">

                    <h3 class="text-dark">
                        <b>
                            PILPRES 2024
                        </b>
                    </h3>
                </a>
            </div>
            <ul class="side-menu">


                <li class="my-2">
                    &nbsp;
                </li>
                <li class="mt-5">
                    <center>
                        <img src="{{asset('assets/images/brand')}}/logo-2.png" style="width:120px;height:auto">
                    </center>
                </li>
                   <li>
                    <h3>Login Count</h3>
                </li>

                <?php
                    $props = Province::where('id',$kota['province_id'])->first();
                    $hehes = Province::get();
                    $cityProp = Regency::where('province_id',$kota['province_id'])->get();

                ?>

                <li class="slide is-expanded">

                    <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">PROVINSI
                            {{$props->name}}</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu open" style="display:block">
                        <li><a href="http://pilpres.banten.rekapitung.id/index"
                                class="slide-item fw-bolder text-danger">DASHBOARD {{$props->name}}</a></li>
                        <li><a href="http://pandeglang.pilpres.banten.rekapitung.id/login" class="slide-item">KABUPATEN
                                PANDEGLANG</a></li>
                        <li><a href="http://lebak.pilpres.banten.rekapitung.id/login" class="slide-item">KABUPATEN LEBAK</a>
                        </li>
                        <li><a href="http://kab-tanggerang.pilpres.banten.rekapitung.id/login" class="slide-item">KABUPATEN
                                TANGERANG</a></li>
                        <li><a href="http://kab-serang.pilpres.banten.rekapitung.id/login" class="slide-item">KABUPATEN
                                SERANG</a></li>
                        <li><a href="http://tanggerang.pilpres.banten.rekapitung.id/login" class="slide-item">KOTA
                                TANGERANG</a></li>
                        <li><a href="http://cilegon.pilpres.banten.rekapitung.id/login" class="slide-item">KOTA CILEGON</a>
                        </li>
                        <li><a href="http://serang.pilpres.banten.rekapitung.id/login" class="slide-item">KOTA SERANG</a></li>
                        <li><a href="http://tangsel.pilpres.banten.rekapitung.id/login" class="slide-item">KOTA TANGERANG
                                SELATAN</a></li>
                    </ul>
                </li>
                <li class="slide is-expanded">

                    <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">PERHITUNGAN NASIONAL</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu open" style="display:block">
                        <li><a href="http://pilpres.rekapitung.id/index"
                                class="slide-item fw-bolder text-danger">DASHBOARD NASIONAL</a></li>
                        <?php 
                      foreach($hehes as $hehe): ?>
                        <li><a href="
                        <?php
                                        if ($hehe->id == 36){
                                            echo "http://pilpres.banten.rekapitung.id";
                                        }
                                        else if ($hehe->id == 31){
                                            echo "http://pilpres.jakarta.rekapitung.id";
                                        }
                                        else if ($hehe->id == 32){
                                            echo "http://pilpres.jabar.rekapitung.id";
                                        }
                                        else if ($hehe->id == 13){
                                            echo "http://pilpres.sumbar.rekapitung.id";
                                        }
                                        else if ($hehe->id == 51){
                                            echo "http://pilpres.bali.rekapitung.id";
                                        }
                                        else if ($hehe->id == 11){
                                            echo "http://pilpres.aceh.rekapitung.id";
                                        }
                                        else if ($hehe->id == 12){
                                            echo "http://pilpres.sumut.rekapitung.id";
                                        }
                                        else if ($hehe->id == 14){
                                            echo "http://pilpres.riau.rekapitung.id";
                                        }
                                        else if ($hehe->id == 15){
                                            echo "http://pilpres.jambi.rekapitung.id";
                                        }
                                        else if ($hehe->id == 17){
                                            echo "http://pilpres.bengkulu.rekapitung.id";
                                        }
                                        else if ($hehe->id == 16){
                                            echo "http://pilpres.sumsel.rekapitung.id";
                                        }
                                        else if ($hehe->id == 18){
                                            echo "http://pilpres.lampung.rekapitung.id";
                                        }
                                        else if ($hehe->id == 19){
                                            echo "http://pilpres.babel.rekapitung.id";
                                        }
                                        else if ($hehe->id == 21){
                                            echo "http://pilpres.kepri.rekapitung.id";
                                        }
                                        else if ($hehe->id == 34){
                                            echo "http://pilpres.jogja.rekapitung.id";
                                        }
                                        else if ($hehe->id == 33){
                                            echo "http://pilpres.jateng.rekapitung.id";
                                        }
                                        else if ($hehe->id == 35){
                                            echo "http://pilpres.jatim.rekapitung.id";
                                        }
                                        else if ($hehe->id == 52){
                                            echo "http://pilpres.ntb.rekapitung.id";
                                        }
                                        else if ($hehe->id == 53){
                                            echo "http://pilpres.ntt.rekapitung.id";
                                        }
                                        else if ($hehe->id == 61){
                                            echo "http://pilpres.kalbar.rekapitung.id";
                                        }
                                        else if ($hehe->id == 62){
                                            echo "http://pilpres.kalteng.rekapitung.id";
                                        }
                                        else if ($hehe->id == 63){
                                            echo "http://pilpres.kalsel.rekapitung.id";
                                        }
                                        else if ($hehe->id == 64){
                                            echo "http://pilpres.kaltim.rekapitung.id";
                                        }
                                        else if ($hehe->id == 65){
                                            echo "http://pilpres.kalut.rekapitung.id";
                                        }
                                        else if ($hehe->id == 71){
                                            echo "http://pilpres.sulut.rekapitung.id";
                                        }
                                        else if ($hehe->id == 72){
                                            echo "http://pilpres.sulteng.rekapitung.id";
                                        }
                                        else if ($hehe->id == 73){
                                            echo "http://pilpres.sulsel.rekapitung.id";
                                        }
                                        else if ($hehe->id == 74){
                                            echo "http://pilpres.sultra.rekapitung.id";
                                        }
                                        else if ($hehe->id == 75){
                                            echo "http://pilpres.gorontalo.rekapitung.id";
                                        }
                                        else if ($hehe->id == 76){
                                            echo "http://pilpres.sulbar.rekapitung.id";
                                        }
                                        else if ($hehe->id == 81){
                                            echo "http://pilpres.maluku.rekapitung.id";
                                        }
                                        else if ($hehe->id == 82){
                                            echo "http://pilpres.malut.rekapitung.id";
                                        }
                                        else if ($hehe->id == 91){
                                            echo "http://pilpres.pabar.rekapitung.id";
                                        }
                                        else if ($hehe->id == 94){
                                            echo "http://pilpres.papua.rekapitung.id";
                                        }
                                    
                                        else { 
                                          }?> " class="slide-item">
                            
                            {{$hehe->name}}
                        </a></li>
                        <?php endforeach ?>
                     
                </li>
            </ul>
        </aside>
        <div class="modal fade" style="background-color: rgba(0, 0, 0, 0.5)" id="modalCommander" tabindex="-1"
            aria-labelledby="modalCommanderLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background-color: black; border-radius: 25px">
                    <div class="modal-header">
                        <div class="row w-100 justify-content-end  align-items-center">
                            <div class="col-md">
                                <!--<h5 class="modal-title text-white my-auto" id="modalCommanderLabel"></h5>-->
                                <span><img src="{{url('')}}/images/logo/rekapitung_gold.png" style="width:100px" alt="">
                                    <b class="text-white fs-3">COMMANDER MODE</b></span>
                            </div>
                            <div class="col-md-5">
                                <b class="text-white fs-5 d-flex justify-content-end align-items-center my-auto align-self-center"
                                    id="modalCommanderLabel"></b>
                            </div>
                        </div>

                    </div>
                    <form action="{{url('')}}/administrator/main-permission" id="form-izin" method="post">
                        @csrf
                        <input type="hidden" value="" name="izin">
                        <input type="hidden" value="" name="jenis">
                        <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        <div class="modal-body">
                            <p id="text-container" class="text-white">

                            </p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="number" class="form-control" name="kode" placeholder="kode">
                                </div>
                            </div>
                            <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn text-white" style="background-color: red;">Commander
                                Permission</button>
                            <button type="button" class="btn" style="background-color: white"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

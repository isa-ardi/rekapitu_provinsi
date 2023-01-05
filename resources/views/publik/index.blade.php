<?php

use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\SaksiData;
use App\Models\Paslon;
?>
@extends('layouts.mainpublic')
@section('content')


<?php
$saksidatai = SaksiData::sum("voice");
$dpt = District::where('regency_id', $config->regencies_id)->sum("dpt");
$data_masuk = (int)$saksidatai / (int)$dpt * 100;

?>
<style>
    .card-header {
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .card-title a:hover {
        color: #ebebeb;
    }
</style>
<div class="tab-content" id="pills-tabContent p-3">

    <!-- 1st card -->
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 text-center fs-4 fw-bold">
                Wilayah Pemilihan Prov. {{$data_prov->name}}
            </div>
            <div class="col-12">
                <div class="container">
                    <div id="chart-all" class="chartsh h-100 w-100"></div>
                </div>
            </div>
            <div class="col-12 text-center fs-5 fw-bold">
                @foreach ($paslon as $pas)

                    {{$pas->candidate}} {{$pas->deputy_candidate}} - 0 <br>
                    
                @endforeach
               
            </div>
            <div class="col-md-12 text-center mt-2 fs-6">
    <span class="badge bg-primary">Time Closed: - Progress 0% dari 100%</span>
</div>
        </div>
        <div class="row mt-3">
            
            <table class="table mt-2">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Wilayah</th>
      <th scope="col">Paslon 1</th>
      <th scope="col">Paslon 2</th>
      <th scope="col">Paslon 3</th>
    </tr>
  </thead>
  <tbody>
        <?php $i = 1; ?>
        <?php  
        $config = App\Models\Config::first();
    $kotas =App\Models\Regency::where('province_id',$config->provinces_id)->get();
        ?>
                <?php foreach ($kotas as $hehe) :  ?>
    <tr>
      <th scope="row">
            <a href="
            <?php 
                if ($hehe->id == 3601){ //pandeglang
                    echo "http://pandeglang.pilpres.banten.rekapitung.id";
                }
                else if ($hehe->id == 3602){
                    echo "http://lebak.pilpres.banten.rekapitung.id";
                }
                else if ($hehe->id == 3603){
                    echo "http://kab-tanggerang.pilpres.banten.rekapitung.id";
                }
                else if ($hehe->id == 3604){
                    echo "http://kab-serang.pilpres.banten.rekapitung.id";
                }
                else if ($hehe->id == 3671){
                    echo "http://tanggerang.pilpres.banten.rekapitung.id";
                }
                else if ($hehe->id == 3672){
                    echo "http://cilegon.pilpres.banten.rekapitung.id";
                }
                else if ($hehe->id == 3673){
                    echo "http://serang.pilpres.banten.rekapitung.id";
                }
                else if ($hehe->id == 3674){
                    echo "http://tangsel.pilpres.banten.rekapitung.id";
                }
                else { }
                  
            ?>">
                
                <?= $hehe->name  ?>
            </a>      
      </th>
      <td>0</td>
      <td>0</td>
      <td>0</td>
    </tr>
     <?php $i++ ?>
                <?php endforeach  ?>
  </tbody>
</table>

     <div class="card w-100 text-center py-1 mt-4 fs-5" style="font-weight: bold; background: #ff022d; color: #fff">
                Hasil Perhitungan Tingkat Kabupaten/Kota
            </div>
            
            <div class="col-lg-3">
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white"><a href="https://pandeglang.pilpres.banten.rekapitung.id/ceksetup?check=1">Kab. Pandeglang</a></div>
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
                        <div class="card-title text-white"><a href="https://lebak.pilpres.banten.rekapitung.id/ceksetup?check=1">Kab. Lebak</a></div>
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
                        <div class="card-title text-white"><a href="https://kab-tanggerang.pilpres.banten.rekapitung.id/ceksetup?check=1">Kab. Tangerang</a></div>
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
                        <div class="card-title text-white"><a href="https://kab-serang.pilpres.banten.rekapitung.id/ceksetup?check=1">Kab. Serang</a></div>
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
                        <div class="card-title text-white"><a href="https://tanggerang.pilpres.banten.rekapitung.id/ceksetup?check=1">Kota Tangerang</a></div>
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
                        <div class="card-title text-white"><a href="https://cilegon.pilpres.banten.rekapitung.id/ceksetup?check=1">Kota Cilegon</a></div>
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
                        <div class="card-title text-white"><a href="https://serang.pilpres.banten.rekapitung.id/ceksetup?check=1">Kota Serang</a></div>
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
                        <div class="card-title text-white"><a href="https://tangsel.pilpres.banten.rekapitung.id/ceksetup?check=1">Kota Tangerang Selatan</a></div>
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

    </div>
</div>
</div>
</div>

</div>






@endsection

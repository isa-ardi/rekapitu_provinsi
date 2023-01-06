
<?php  
        $config = App\Models\Config::first();
        $kotas =App\Models\Regency::join('regency_domains','regency_domains.regency_id','=','regencies.id')->where('regencies.province_id',$config->provinces_id)->get();

        ?>
                       
                       <?php  foreach ($kotas as $hehe) :  ?>
                                   <?php
                                       
                                       $client = new GuzzleHttp\Client(); //GuzzleHttp\Client
                                       $url = "https://".$hehe->domain."/api/public/get-voice?jenis=suara_terverifikasi";
                                       // $url = "https://".'pandeglang.pilpres.banten.rekapitung.id'."/api/public/get-voice?jenis=suara_masuk";
                                       $response = $client->request('GET', $url, [
                                           'verify'  => false,
                                       ]);
                                       $voices = json_decode($response->getBody());
                                  
                                       
                                       ?>
                           <tr onclick="window.open(`https://{{$hehe->domain}}`)">
                               <td>{{$hehe->name}}</td>
                               @foreach($voices as $vcs)
                           <td>{{$vcs->voice}}</td>
                           @endforeach
                           
                           </tr>
                           
                           <?php  endforeach ?>
                           

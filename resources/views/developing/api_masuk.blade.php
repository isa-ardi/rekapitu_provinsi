<?php 
$config = App\Models\Config::first();
$kotas = App\Models\Regency::join('regency_domains','regency_domains.regency_id','=','regencies.id')
    ->where('regencies.province_id', $config->provinces_id)
    ->get();

$client = new GuzzleHttp\Client();
$dataApi = [];
$i = 0;
foreach ($kotas as $hehe) : 
    $url = "https://".$hehe->domain."/api/public/get-voice?jenis=suara_masuk";
    $response = $client->request('GET', $url, ['verify' => false]);
    $voices = json_decode($response->getBody());
    array_push($dataApi, $voices);
?>
<tr>
    <th scope="row"> 
        <a href="https://{{$hehe->domain}}/ceksetup">
            <?= $hehe->name  ?>
        </a>      
    </th>
    @foreach($voices as $vcs)
    <td>{{$vcs->voice}}</td>
    @endforeach
</tr>
<?php endforeach; ?>
                

<script>
    
    /*chart-pie*/
   <?php
   $i = 1;
   foreach($dataApi as $pas): 
   ?>
   var chart = c3.generate({
        bindto: '#chart-{{$i}}', // id of chart wrapper
        data: {
            columns: [
                <?php  for($j = 0;$j<count($pas); $j++){ ?>
                    ['data{{$j}}', {{$pas[$j]->voice}}],
                    <?php  }?>
              


            ],
            type: 'pie', // default type of chart
            colors: {
                <?php  for($j = 0;$j<count($pas); $j++){ ?>
                'data{{$j}}': "{{$pas[$j]->color}}",
                <?php  }?>
                //  'data1': "rgb(7, 116, 248)",
                //  'data4': "rgb(226, 161, 23)",
            },
            names: {
               // name of each serie
               <?php  for($j = 0;$j<count($pas); $j++){ ?>
               'data{{$j}}': "{{$pas[$j]->candidate}} | {{$pas[$j]->deputy_candidate}} ",
               <?php  }?>
            }
        },
        axis: {},
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });
    
  
    
    <?php  $i++;
    endforeach ?>





</script>


<?php
   $i = 1;
   $paslonApi = [];
   foreach($dataApi as $past){
    $voice = 0;
    for($j = 0;$j<count($past); $j++){
        $paslonApi['namaPas'.$j] = $past[$j]->candidate.' | '.$past[$j]->deputy_candidate;
        $voice  += $past[$j]->voice;
        $paslonApi['color'.$j] = $past[$j]->color;
        $paslonApi['voice'.$j] =   $voice;
    }
    $i++;
    $voice = 0;
    }

?>


<script>
<?php $i = 0; ?>
@foreach ($paslon as $pas)
    $('span.voice<?=$i?>').html('<?=$paslonApi['voice'.$i]?>');
    <?php $i++; ?>
    /*chart-pie*/
    @endforeach
    
    var chart = c3.generate({
      bindto: '#chart-all', // id of chart wrapper
      data: {
          columns: [
            
            <?php $i = 0; ?>
            @foreach ($paslon as $pas)
            // each columns data
              ['data{{$i}}', <?=$paslonApi['voice'.$i]?>],
          
              <?php $i++; ?>
              @endforeach
    
              
          ],
          type: 'pie', // default type of chart
          colors: {
            <?php $i = 0; ?>
            @foreach ($paslon as $pas)

              'data{{$i}}': " <?=$paslonApi['color'.$i]?>",
             
               <?php $i++; ?>
               @endforeach
    
          },
          names: {
              // name of each serie
              <?php $i = 0; ?>
            @foreach ($paslon as $pas)

              'data{{$i}}': " <?=$paslonApi['namaPas'.$i]?>",
          
               <?php $i++; ?>
               @endforeach
          }
      },
      axis: {},
      legend: {
          show: true, //hide legend
      },
      padding: {
          bottom: 0,
          top: 0
      },
    });


    @foreach ($paslon as $i => $pas)
        $('span.voice<?=$i?>').html('<?=$paslonApi['voice'.$i]?>');
    @endforeach
</script>
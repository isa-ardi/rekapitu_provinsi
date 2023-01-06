<div class="container" style="margin-top: -25px;">
    <div class="card bg-primary rounded-0">
        <div class="card-body text-center">
            <h5 class="card-title"><img width="150px" src="../../assets/images/brand/logo.png" alt=""></h5>
            <div class="row no-gutters mx-auto mt-5" style="width: 350px;">
                <div class="col"><a href="https://www.facebook.com/sharer.php?u=https://pilpres.banten.rekapitung.id/index" type="button" class="rounded-0 btn btn-facebook"><i class="fa fa-facebook me-2"></i>Facebook</a></div>
                <div class="col"><a href="http://twitter.com/share?text=Hallo Saya Sudah Melihat Hasil Perhitungan Rekapitung Dan Mengajak Anda Untuk Mengawasi Jalannya Perhitungan Suara Salam Demokrasi Klik Tautan  &amp;url=https://pilpres.banten.rekapitung.id/index&amp;hashtags=survey" type="button" class="rounded-0 btn btn-twitter"><i class="fa fa-twitter me-2"></i>Twitter</a></div>
                <div class="col"><a href="https://api.whatsapp.com/send?text=Hallo%20Saya%20Sudah%20Melihat%20Hasil%20Perhitungan%20Rekapitung%20Dan%20Mengajak%20Anda%20Untuk%20Mengawasi%20Jalannya%20Perhitungan%20Suara%0ASalam%20Demokrasi%0AKlik%20Tautan%20https://pilpres.banten.rekapitung.id/index" type="button" class="rounded-0 btn btn-success"><i class="fa fa-whatsapp me-2"></i>Whatsapp</a></div>
            </div>

            <div class="row mt-5 text-white">
                <div class="col">
                    <a class="text-white fw-bold" href="{{url('')}}/login">Login</a> &nbsp;|&nbsp;
                    <a class="text-white fw-bold" href="{{url('')}}/public/disclaimer">Disclaimer</a>
                </div>
            </div>

            <div class="row mt-5 text-white">
                <div class="col">
                    <b>© PT. Mahadaya Swara Teknologi <br> All Rights Reserved 2022</b>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modal-id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="container-tps">

        </div>
    </div>
</div>

<div class="modal fade" id="modaltpsQuick" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="container-tps-quick">
        </div>
    </div>
</div>


<!-- JQUERY JS -->
<script src="../../assets/js/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- SPARKLINE JS-->
<script src="../../assets/js/jquery.sparkline.min.js"></script>

<!-- Select2 js-->
<script src="../../assets/plugins/select2/js/select2.min.js"></script>

<!-- SIDE-MENU JS -->
<script src="../../assets/plugins/sidemenu/sidemenu.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="../../assets/plugins/p-scroll/pscroll.js"></script>
<script src="../../assets/plugins/p-scroll/pscroll-1.js"></script>

<!-- SIDEBAR JS -->
<script src="../../assets/plugins/sidebar/sidebar.js"></script>

<!-- CUSTOM JS-->
<script src="../../assets/js/custom.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<!--- TABS JS -->
<script src="../../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
<script src="../../assets/plugins/tabs/tab-content.js"></script>

<!-- C3 CHART JS -->
<script src="../../assets/plugins/charts-c3/d3.v5.min.js"></script>
<script src="../../assets/plugins/charts-c3/c3-chart.js"></script>

<!-- INTERNAL SELECT2 JS -->
<script src="../../assets/plugins/select2/select2.full.min.js"></script>
<script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script>
    $('a.modaltpsQuick').on('click', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{url("/")}}/ajax/get_tps_quick',
            type: "GET",_
            data: {
                id
            },
            success: function(response) {
                if (response) {
                    $('#container-tps-quick').html(response);
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('[data-tooltip-toogle="tooltip"]').tooltip();
    });
</script>
<script>

    /*chart-pie*/
    var chart = c3.generate({
        bindto: '#chart-donut', // id of chart wrapper
        data: {
            columns: [
                // each columns data

                <?php foreach ($paslon_quick as $pas) :  ?>
                    <?php $voice = 0;  ?>
                    <?php foreach ($pas->saksi_data as $pak) :  ?>
                        <?php
                        $voice += $pak->voice;
                        ?>
                    <?php endforeach  ?>['data<?= $pas->id  ?>', <?= $voice ?>],

                <?php endforeach  ?>

            ],
            type: 'pie', // default type of chart
            colors: {
                <?php foreach ($paslon_quick as $pas) :  ?> 'data<?= $pas->id  ?>': "<?= $pas->color ?>",
                <?php endforeach  ?>

            },
            names: {
                // name of each serie
                <?php foreach ($paslon_quick as $pas) :  ?>

                    'data<?= $pas->id  ?>': " <?= $pas->candidate ?> | <?= $pas->deputy_candidate ?>",

                <?php endforeach  ?>
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
        size: {
            height: 350,
            width: 350
        }
    });
</script>

<script>
    /*chart-pie*/
    var chart = c3.generate({
        bindto: '#chart-verif', // id of chart wrapper
        data: {
            columns: [
                // each columns data

                <?php foreach ($paslon_terverifikasi as $pas) :  ?>
                    <?php $voice = 0;  ?>
                    <?php foreach ($pas->saksi_data as $pak) :  ?>
                        <?php
                        $voice += $pak->voice;
                        ?>
                    <?php endforeach  ?>['data<?= $pas->id  ?>', <?= $voice ?>],

                <?php endforeach  ?>

            ],
            type: 'pie', // default type of chart
            colors: {
                <?php foreach ($paslon_terverifikasi as $pas) :  ?> 'data<?= $pas->id  ?>': "<?= $pas->color ?>",
                <?php endforeach  ?>

            },
            names: {
                // name of each serie
                <?php foreach ($paslon_terverifikasi as $pas) :  ?>

                    'data<?= $pas->id  ?>': " <?= $pas->candidate ?> | <?= $pas->deputy_candidate ?>",

                <?php endforeach  ?>
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
        size: {
            height: 350,
            width: 350
        }
    });
</script>




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
    
  
    
    <?php 

     $i++;
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






    $('tr.modal-id').on('click', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '{{url("")}}/public/ajax/get_tps',
            type: "GET",
            data: {
                id
            },
            success: function(response) {
                if (response) {
                    $('#container-tps').html(response);
                }
            }
        });
    });



</script>
<script>
    setTimeout(function() {
        $('#marquee2').hide()
        $('#marquee3').hide()
    }, 10)

    let marquee1 = document.getElementById('cobamarq1');
    let marquee2 = document.getElementById('cobamarq2');
    let marquee3 = document.getElementById('cobamarq3');
    $('#pills-terverifikasi-tab').on('click', function() {
        $('#marquee1').hide()
        $('#marquee2').show()
        $('#marquee3').hide()
        marquee2.start()
        marquee1.stop()
        marquee3.stop()

    });

    $('#pills-home-tab').on('click', function() {
        $('#marquee1').show()
        $('#marquee2').hide()
        $('#marquee3').hide()
        marquee1.start()
        marquee2.stop()
        marquee3.stop()

    });
    $('#pills-profile-tab').on('click', function() {
        $('#marquee1').hide()
        $('#marquee2').hide()
        $('#marquee3').show()
        marquee3.start()
        marquee2.stop()
        marquee1.stop()

    });
</script>





<!-- DATA TABLE JS-->
<script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="../../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="../../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="../../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
<script src="../../assets/plugins/datatable/js/jszip.min.js"></script>
<script src="../../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="../../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="../../assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="../../assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="../../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="../../assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="../../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
<script src="../../assets/js/table-data.js"></script>
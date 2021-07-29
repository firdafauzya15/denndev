<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Grafik Penjualan Bulanan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penjualan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form action="#" method="get" class="form-horizontal">
              <input type="hidden" name="act" value="<?= md5("laporan_grafik_penjualan_bulanan");?>">
              <div class="row">
                <div class="col-md-2">
                  <select class="form-control" name="bulan" required>
                    <option value="">Pilih Bulan</option>
                      <?php 
                      $monthList = bulanIndo();
                      foreach ($monthList as $key => $value) {
                        $selected = "";
                        if ($_GET['bulan'] == $key) {
                            $selected = "selected";
                        }
                        echo "<option value='$key' $selected>$value</option>";
                      }
                      ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <select class="form-control" name="tahun" required>
                    <option value="">Pilih Tahun</option>
                      <?php 
                          $penjualans = mysqli_query($link,"SELECT year(penjualan.tanggal) AS tahun FROM penjualan GROUP BY tahun ORDER BY tahun DESC");
                          while ($penjualan = mysqli_fetch_array($penjualans)) {
                              $selected = "";
                              if ($_GET['tahun'] == $penjualan['tahun']) {
                                  $selected = "selected";
                              }
                              echo "<option value='$penjualan[tahun]' $selected>$penjualan[tahun]</option>";
                          }
                      ?>
                  </select>
                </div>
                <div class="col-md-1">
                  <input type="submit" class="btn btn-primary" value="cari">
                </div>
              </div>
            </form>
            <?php
            if ($_GET['bulan'] != "" AND $_GET['tahun'] != "") {
              $grandTotals = [];
              $bulanIndo = bulanIndo($_GET['tahun']."-".$_GET['bulan']."-01");
              $range = 31;
              for($currentDay = 1; $currentDay <= $range; $currentDay++) {
                  $total_omset = 0;
                  $penjualans = mysqli_query($link,"SELECT
                    penjualan.nota,
                    penjualan.pajak, 
                    penjualan.diskon
                    FROM
                    penjualan 
                    WHERE
                    year(penjualan.tanggal) = '$_GET[tahun]' AND
                    month(penjualan.tanggal) = '$_GET[bulan]' AND 
                    day(penjualan.tanggal) = '$currentDay'
                  ") or die (mysqli_error());
                  while ($penjualan = mysqli_fetch_array($penjualans)) {
                    $omset = 0;
                    $penjualanDetails = mysqli_query($link,"SELECT
                      penjualan_detail.harga_jual,
                      penjualan_detail.jumlah
                      FROM
                      penjualan_detail
                      WHERE penjualan_detail.nota = '$penjualan[nota]'
                    ") or die (mysqli_error());
                    while ($penjualanDetail = mysqli_fetch_array($penjualanDetails)) {
                      $subtotal = (lusin($penjualanDetail['jumlah']) * $penjualanDetail['harga_jual']) + (pcs($penjualanDetail['jumlah']) * ($penjualanDetail['harga_jual']/12));
                      $omset += $subtotal;
                    }
                    $pajak = ($omset*$penjualan['pajak'])/100;
                    $diskon = ($omset*$penjualan['diskon'])/100;
                    $omset_bersih = $omset + $pajak - $diskon;
                    $total_omset += $omset_bersih;
                  }
                  $grandTotals[] = round($total_omset, 0);
              }
            ?>
              <hr>
              <div class="penjualan" style="width: 100%; height: 350px;"></div> <br>
            <?php
            }
            ?>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript" src="plugins/highcharts/jquery.min.js"></script>
<script type="text/javascript" src="plugins/highcharts/highcharts.js"></script>
<script type="text/javascript" src="plugins/highcharts/modules/exporting.js"></script>
<script type="text/javascript">
// distribusi bulan
$('.penjualan').highcharts({
  colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
           '#FF9655', '#FFF263', '#6AF9C4'],
  chart: {
    type: 'column'
    //marginTop: 80
  },
  credits: {
    enabled: false
  }, 
  tooltip: {
    shared: true,
    crosshairs: true,
    headerFormat: '<b>{point.key}</b><br/>'
  },
  title: {
    text: 'GRAFIK PENJUALAN',
    style: {
        color: '#000',
        font: '18px Verdana, Geneva, sans-serif'
    }
  },
  subtitle: {
    text: '<?= $bulanIndo;?> <?= $_GET[tahun];?>',
    style: {
        color: '#666666',
        font: '14px Verdana, Geneva, sans-serif'
    }
  },
  xAxis: {
    categories: [
      <?php
      for ($currentDay = 1; $currentDay <= $range; $currentDay++) {
        echo $currentDay.",";
      }
      ?>
    ],
    labels: {
      rotation: 0,
      align: 'right',
      style: {
        fontSize: '10px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  },
  yAxis: {
      title: {
      text: 'Jumlah'
    }
  },
  legend: {
    enabled: true,
    itemStyle: {
        font: '9pt Verdana, Geneva, sans-serif',
        color: 'black'
    },
    itemHoverStyle:{
        color: 'gray'
    }   
  },
  series: [{
    "name":"Total",
    "data":[
            <?php
            foreach ($grandTotals as $grandTotal) {
              echo $grandTotal.",";
            }
            ?>
          ],
    "color": 'rgba(68, 204, 0, 0.53)'
  }]
});
</script>
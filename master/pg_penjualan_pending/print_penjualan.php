<?php
session_start();
include"../../lib/koneksi.php";
include"../function/convert_number.php";
$nota = base64_decode($_GET['id']);
$q = mysqli_query($link,"SELECT 
  penjualan.post_time, 
  penjualan.nota, 
  if(penjualan.total_retur IS NULL, '0', penjualan.total_retur) AS total_retur, 
  penjualan.tanggal, 
  penjualan.pajak, 
  penjualan.diskon, 
  penjualan.ongkir, 
  penjualan.bayar, 
  penjualan.keterangan, 
  user.username, 
  customer.nm_customer,
  customer.alamat AS alamat_customer,
  toko.file,
  toko.nm_toko,
  toko.alamat,
  _metode.nm_metode
  FROM 
  penjualan 
  Inner Join toko ON toko.id_toko = penjualan.id_toko 
  Inner Join customer ON customer.id_customer = penjualan.id_customer 
  Inner Join user ON user.id_user = penjualan.created_by 
  Inner Join _metode ON _metode.id_metode = penjualan.id_metode 
  WHERE penjualan.nota = '$nota'
") or die (mysqli_error());
$r = mysqli_fetch_array($q);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
  <script type="text/javascript">setTimeout("window.close();", 30000);</script>
  <style type="text/css">
    body {
      font-size: 7px;
      font-family: Arial, Helvetica, sans-serif; 
      font-weight: lighter;
    }
    .new-line {
      border-top: dotted 0.5px #000;
      margin-top: 5px;
      margin-bottom: 2px;
    }
  </style>
</head>
<body onload="window.print()">
  <table width="100%">
    <tr>
      <td align="center"><img src="../../upload/<?= $r['file'];?>" height="64" width="64"></td>
    </tr>
    <tr>
      <td align="center" style="font-size: 16px; font-weight: bold;"><?= $r['nm_toko'];?></td>
    </tr>
    <tr>
      <td align="center" style="font-weight: bold;"><?= nl2br($r['alamat']);?></td>
    </tr>
  </table>
  <table width="100%">
    <tr>
      <td>Tanggal : <?= $r['tanggal'];?></td>
      <td></td>
      <td width="20%"></td>
      <td></td>
      <td>Kasir : <?= $r['username'];?></td>
    </tr>
    <tr>
      <td>No. Nota : <?= $r['nota'];?></td>
      <td></td>
      <td width="20%"></td>
      <td></td>
      <td>Pembayaran : <?= $r['nm_metode'];?></td>
    </tr>
    <tr>
      <td>Customer : <?= $r['nm_customer'];?></td>
      <td></td>
      <td width="20%"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <div class="new-line"></div>
  <table width="100%" class="c">
    <?php
    $totalBrg = 0;
    $totalQty = 0;
    $total = 0;
    $sp = "SELECT 
            penjualan_detail.jumlah, 
            produk_size.kd_produk_size, 
            penjualan_detail.harga_jual, 
            penjualan_detail.harga_jual*penjualan_detail.jumlah AS subtotal,
            produk.nm_produk 
            FROM 
            penjualan_detail 
            Inner Join produk_size ON produk_size.kd_produk_size = penjualan_detail.kd_produk_size
            Inner Join produk ON produk.kd_produk = produk_size.kd_produk
            WHERE penjualan_detail.nota = '$nota'
            ";
    $qp = mysqli_query($sp) or die (mysqli_error());
    while ($rp = mysqli_fetch_array($qp)) {
      $subtotal = (lusin($rp['jumlah']) * $rp['harga_jual']) + (pcs($rp['jumlah']) * ($rp['harga_jual']/12));
      $total += $subtotal; 
      $totalBrg += 1;
      $totalQty += round($rp['jumlah']/12, 1);
    ?>
      <tr>
        <td colspan="2" width="50%"><?= $rp['kd_produk_size'];?></td>
        <td align="right" width="50%">LUSIN</td>
      </tr>
      <tr>
        <td width="30%"><?= number_format($rp['harga_jual']);?></td>
        <td> X <?= round($rp['jumlah']/12, 1);?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; = </td>
        <td align="right"><?= number_format($subtotal);?><br></td>
      </tr>
    <?php
    }
    $pajak = ($total * $r['pajak']) / 100;
    $diskon = $r['diskon'];
    $grandtotal = $total + $pajak - $diskon + $r['ongkir'];
    ?>
    <tr>
      <td colspan="3"><div class="new-line">&nbsp;</div></td>
    </tr>
    <tr>
      <td colspan="2">BRG = <?= $totalBrg;?>, QTY = <?= $totalQty;?></td>
      <td align="right"><?php echo number_format($grandtotal);?></td>
    </tr>
  </table>
  <br>
  <table width="100%">
    <tr>
      <td><?= $r['keterangan'];?></td>   
    </tr>
    <tr>
      <td>
        Barang yang telah dibeli tidak dapat dikembalikan kecuali ada perjanjian.
      </td>   
    </tr>
  </table>
</body>
</html>
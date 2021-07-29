 <?php
include"../../lib/koneksi.php";

$nota = base64_decode($_GET['id']);
$q = mysqli_query($link,"SELECT 
                      penjualan.post_time, 
                      penjualan.nota, 
                      penjualan.tanggal, 
                      penjualan.pajak, 
                      penjualan.diskon, 
                      penjualan.ongkir, 
                      penjualan.bayar, 
                      penjualan.nm_customer, 
                      penjualan.alamat_customer, 
                      penjualan.telp_customer, 
                      penjualan.status, 
                      penjualan.nm_pengirim, 
                      penjualan.bank, 
                      penjualan.total_transfer, 
                      penjualan.no_resi, 
                      user.username, 
                      toko.nm_toko,
                      toko.alamat
                      FROM 
                      penjualan 
                      Inner Join toko ON toko.id_toko = penjualan.id_toko 
                      Inner Join user ON user.id_user = penjualan.created_by 
                      WHERE penjualan.nota = '$nota'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">	
<style type="text/css">
    table.c td, table.c th {
      padding: 3px;
    }
    table.head {
      font-size: 16px;
    }
</style>

</head>
<body onload="window.print()" style="margin-top:-10px">
<center><br>
<div style="width: 95%; font-size: 9px; font-family: Arial, Helvetica, sans-serif; font-weight: lighter;">
  <table width="100%" >
	  <tr>
      <td align="center"><h1>Your Store</h1></td>
	  </tr>
	  <tr>
	    <td align="center"><?= $r['alamat'];?></td>
	  </tr>
  </table>
  <br>
  <table width="100%" class="head">
  	<tr>
  		<td width="80">Kepada</td>
  		<td>: <?= $r['nm_customer'];?></td>
  	</tr>
  	<tr>
  		<td>Alamat</td>
  		<td>: <?= $r['alamat_customer'];?></td>
  	</tr>
  	<tr>
  		<td>Telp.</td>
  		<td>: <?= $r['telp_customer'];?></td>
  	</tr>
  	<tr>
  		<td>No. Resi</td>
  		<td>: <?= $r['no_resi'];?></td>
  	</tr>
  </table>
  <table width="100%" style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
	  <tr>
		  <td><p style="font-size: 9px; font-weight: bold; padding: 0px; margin: 0px">Nota. <?= $r['nota'];?></p></td>
		  <td></td>
		  <td width="30%"></td>
		  <td></td>
		  <td align="right">Kasir : <?= $r['username'];?></td>
	  </tr>
  </table>

  <table width="100%" class="c">
  <tr>
      <td>Item</td>
      <td align="center">QTY</td>
      <td align="right">Harga</td>
      <td align="right">Sub Total</td>
  </tr>
  <?php
    $total = 0;
    $sp = "SELECT 
            penjualan_detail.jumlah, 
            produk_size.kd_produk_size, 
            produk.harga_jual, 
            produk.harga_jual*penjualan_detail.jumlah AS subtotal,
            produk.nm_produk 
            FROM 
            penjualan_detail 
            Inner Join produk_size ON produk_size.kd_produk_size = penjualan_detail.kd_produk_size
            Inner Join produk ON produk.kd_produk = produk_size.kd_produk
            WHERE penjualan_detail.nota = '$nota'
            ";
    $qp = mysqli_query($sp) or die (mysqli_error());
    $i = 0;
    while($rp = mysqli_fetch_array($qp)){
      $total += $rp['subtotal']; 
      $i++;
  ?>
  <tr>
    <td width="40%"><?= $rp['kd_produk_size'];?> - <?= $rp['nm_produk'];?></td>
    <td align="center" width="1%" ><?= number_format($rp['jumlah']);?></td>
    <td align="right" width="20%"><?= number_format($rp['harga_jual']);?></td>
    <td align="right" width="30%"><?= number_format($rp['subtotal']);?><br></td>
  </tr>
  <?php
  }
  $pajak = ($total*$r['pajak'])/100;
  $diskon = ($total*$r['diskon'])/100;
  $grandtotal = $total + $pajak - $diskon + $r['ongkir'];
  $kembalian = $r['bayar']-$grandtotal; 
  ?>
  <tr>
    <td colspan="2"></td>
    <td align="right">Total</td>
    <td align="right"><?php echo number_format($total);?></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right">Pajak (%)</td>
    <td align="right"><?= number_format($pajak);?> (<?php echo number_format($r['pajak']);?>)</td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right">Diskon (%)</td>
    <td align="right"><?= number_format($diskon);?> (<?php echo number_format($r['diskon']);?>)</td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right">Ongkir</td>
    <td align="right"><?= number_format($r['ongkir']);?></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right" style="border-top: 1px solid #000;">Grand Total</td>
    <td align="right" style="border-top: 1px solid #000;"><?php echo number_format($grandtotal);?></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right" style="border-top: 1px solid #000;">Bayar</td>
    <td align="right" style="border-top: 1px solid #000;"><?php echo number_format($r['bayar']);?></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right"><b>Kembalian</b></td>
    <td align="right"><b><?php echo number_format($kembalian);?></b></td>
  </tr>
  </table>
  <br />
  <table width="100%" style=" border-top: 1px solid #000;">
    <tr>
      <td><p>Tgl. <?= $r['post_time'];?></p></td>
      <td></td>
      <td width="30%"></td>
      <td></td>
      <td align="right"></td>
    </tr>
  </table>
  <table width="100%">
    <tr>
      <td align="center"><i>--Thanks for Shopping--</i></td>   
    </tr>  
  </table>
</div><br><br><br><br><br><br>
</center>           
</body>
</html>
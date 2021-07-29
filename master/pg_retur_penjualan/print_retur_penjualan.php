 <?php
include"../../lib/koneksi.php";
include"../function/convert_number.php";

$nota = base64_decode($_GET['id']);
$q = mysqli_query($link,"SELECT 
                      retur_penjualan.post_time, 
                      retur_penjualan.nota, 
                      retur_penjualan.tanggal, 
                      user.username, 
                      customer.nm_customer,
                      customer.alamat AS alamat_customer,
                      toko.file,
                      toko.nm_toko,
                      toko.alamat
                      FROM 
                      retur_penjualan 
                      Inner Join toko ON toko.id_toko = retur_penjualan.id_toko 
                      Inner Join customer ON customer.id_customer = retur_penjualan.id_customer 
                      Inner Join user ON user.id_user = retur_penjualan.created_by 
                      WHERE retur_penjualan.nota = '$nota'") or die (mysqli_error());
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
    table.c td, table.c th {
      padding: 1px;
    }
</style>

</head>
<body onload="window.print()" style="margin-top:-10px">
<center><br>
<div style="width: 95%; font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: lighter;">
  <table width="100%">
    <tr>
      <td width="1"><img src="../../upload/<?= $r['file'];?>" alt="" width="50" height="50"></td>
      <td><?= nl2br($r['alamat']);?></td>
    </tr>
  </table>
  <table width="100%" style="border-bottom: 1px solid #000;">
    <tr>
      <td colspan="5" align="center"><p style="font-size: 14px; font-weight: bold; padding: 0px; margin: 0px">NOTA RETUR PENJUALAN</p></td>
    </tr>
    <tr>
      <td><p style="font-size: 9px; font-weight: bold; padding: 0px; margin: 0px">Nota. <?= $r['nota'];?></p></td>
      <td></td>
      <td width="30%"></td>
      <td></td>
      <td>Customer : <?= $r['nm_customer'];?></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td width="30%"></td>
      <td></td>
      <td>Alamat : <?= $r['alamat_customer'];?></td>
    </tr>
  </table>
  <table width="100%" class="c">
  <tr>
      <td align="center">No.</td>
      <td>Item</td>
      <td align="center">Lusin</td>
      <td align="center">Pcs</td>
      <td align="right">Harga</td>
      <td align="right">Sub Total</td>
  </tr>
  <?php
    $i = 0;
    $total = 0;
    $sp = "SELECT 
            retur_penjualan_detail.jumlah, 
            produk_size.kd_produk_size, 
            retur_penjualan_detail.harga_jual, 
            produk.nm_produk 
            FROM 
            retur_penjualan_detail 
            Inner Join produk_size ON produk_size.kd_produk_size = retur_penjualan_detail.kd_produk_size
            Inner Join produk ON produk.kd_produk = produk_size.kd_produk
            WHERE retur_penjualan_detail.nota = '$nota'
            ";
    $qp = mysqli_query($link,$sp) or die (mysqli_error());
    while ($rp = mysqli_fetch_array($qp)) {
      $subtotal = (lusin($rp['jumlah']) * $rp['harga_jual']) + (pcs($rp['jumlah']) * ($rp['harga_jual']/12));
      $total += $subtotal; 
      $i++;
  ?>
  <tr>
    <td width="1%"><?= $i;?></td>
    <td width="40%"><?= $rp['kd_produk_size'];?> - <?= $rp['nm_produk'];?></td>
    <td align="center" width="1%" ><?= number_format(lusin($rp['jumlah']));?></td>
    <td align="center" width="1%" ><?= number_format(pcs($rp['jumlah']));?></td>
    <td align="right" width="20%"><?= number_format($rp['harga_jual']);?></td>
    <td align="right" width="30%"><?= number_format($subtotal);?><br></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td colspan="4"></td>
    <td align="right">Grand Total</td>
    <td align="right"><?php echo number_format($total);?></td>
  </tr>
  </table>
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
      <td align="center">TUKAR RETUR PALING LAMA 1 BULAN</td>   
    </tr>  
    <tr>
      <td align="center"><i>Printed By: <?= $r['username'];?></i></td>   
    </tr>  
  </table>
</div>
</center>           
</body>
</html>
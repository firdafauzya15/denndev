<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard<small>Control panel</small></h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <?php $jml_produk = mysqli_num_rows(mysqli_query($link,"SELECT produk.id_produk FROM produk")); ?>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner"><h3><?= $jml_produk;?></h3><p>Produk</p></div>
          <div class="icon"><i class="ion ion-tshirt"></i></div>
          <a href="?act=<?= md5('brand')?>" class="small-box-footer">Semua Produk <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>
</div>
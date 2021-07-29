<?php
$id_user = base64_decode($_GET['id_user']);
$q = mysqli_query($link,"SELECT * FROM user Inner Join _level On _level.id_level = user.id_level WHERE id_user = '$id_user'");
$r = mysqli_fetch_array($q);
?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'User', 'url' => 'home.php?act='.md5('user'), 'active' => '0');
	$bc[] = array('title' => 'User Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data User",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Ubah user</h3></div>
          <form action="home.php?act=<?= md5('user_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_user" value="<?= $id_user;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-6">
                  <input type="text" name="name" class="form-control" value="<?= $r['name'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Level</label>
                <div class="col-sm-6">
                  <input type="hidden" name="id_level" class="form-control" value="<?= $r['id_level'];?>" >
                  <input type="text" class="form-control" value="<?= $r['nm_level'];?>" readonly="readonly" >
                </div>
              </div>
              <?php 
              if ($r['id_level'] == '2') {
                $rT = mysqli_fetch_array(mysqli_query($link,"SELECT nm_toko FROM toko WHERE id_toko = '$r[id_toko]'"));
                echo "<div class='form-group'>";
                echo "<label class='col-sm-2 control-label'>Toko</label>";
                echo "<div class='col-sm-6'>";
                echo "<input type='text class='form-control' value='".$rT['nm_toko']."' readonly='readonly'>";
                echo " </div> </div>";
              }elseif($r['id_level'] == '3') {
                $rT = mysqli_fetch_array(mysqli_query($link,"SELECT nm_gudang FROM gudang WHERE id_gudang = '$r[id_gudang]'"));
                echo "<div class='form-group'>";
                echo "<label class='col-sm-2 control-label'>Gudang</label>";
                echo "<div class='col-sm-6'>";
                echo "<input type='text' class='form-control' value='".$rT['nm_gudang']."' readonly='readonly'>";
                echo " </div> </div>";
              }
              ?>
              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label"><i><u>Login Information</u></i></label>
                <div class="col-sm-6"></div>
              </div>
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-6">
                  <input type="text" name="username" value="<?= $r['username'];?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-6">
                  <input type="text" name="password" value="<?= $r['password_read'];?>" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a class="btn btn-danger" onclick="window.history.back()">Batal</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
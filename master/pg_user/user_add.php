<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'User', 'url' => 'home.php?act='.md5('user'), 'active' => '0');
	$bc[] = array('title' => 'User Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data User",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Tambah User</h3></div>
          <form action="home.php?act=<?= md5('user_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-6"><input type="text" name="name" class="form-control" required></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Level</label>
                <div class="col-sm-6">
                  <select class="form-control select2" name="id_level" id="level" required onchange="chosen_card()">
                    <option value="">.:: Pilih Level ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM _level Order By id_level ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_level]'>$r[nm_level]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group" id="gudang" style="display: none;">
                  <label class="col-sm-2 control-label">Gudang</label>
                  <div class="col-sm-6">
                    <select class="form-control select2 " name="id_gudang" required>
                      <option>.:: Pilih Gudang ::.</option>
                      <?php
                        $q = mysqli_query($link,"SELECT * FROM gudang Order By id_gudang ASC");
                        while ($r = mysqli_fetch_array($q)) {
                          echo "<option value='$r[id_gudang]'>$r[nm_gudang]</option>";
                        }
                      ?>
                    </select>
                  </div>
              </div>
              <div class="form-group" id="toko" style="display: none;">
                  <label class="col-sm-2 control-label">Toko</label>
                  <div class="col-sm-6">
                    <select class="form-control select2 " name="id_toko" required>
                      <option>.:: Pilih Toko ::.</option>
                      <?php
                        $q = mysqli_query($link,"SELECT * FROM toko Order By id_toko ASC");
                        while ($r = mysqli_fetch_array($q)) {
                          echo "<option value='$r[id_toko]'>$r[nm_toko]</option>";
                        }
                      ?>
                    </select>
                  </div>
              </div><hr>
              <div class="form-group">
                <label class="col-sm-2 control-label"><i><u>Login Information</u></i></label>
                <div class="col-sm-6"></div>
              </div>
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-6"><input type="text" name="username" class="form-control" required></div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-6"><input type="text" name="password" class="form-control" required></div>
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
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

<script>
function chosen_card() {
    var toko = document.getElementById('toko');
    var gudang = document.getElementById('gudang');
    var level = document.getElementById('level').value;
    if (level == '2') {
      toko.style.display = "block";
    } else {
      toko.style.display = "none";
    }

    if (level == '3') {
      gudang.style.display = "block";
    } else {
      gudang.style.display = "none";
    }
}
</script>
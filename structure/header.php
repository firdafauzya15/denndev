  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="home.php" class="logo">
          <span class="logo-mini"><b>D</b> D</span>
          <span class="logo-lg"><b>DennDev</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown tasks-menu">
                <a href="master/autoprint" target="blank" class="btn btn-warning" onclick="return confirm('Apakah anda ingin mengaktifkan autoprint ?')">
                  <i class="fa fa-print"></i> &nbsp; Auto Print
                </a>
              </li>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/avatar.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= $_SESSION['name'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
                    <p>
                      <small>Hello, Its me!</small>
                      <?= $_SESSION['name'];?>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="text-center">
                      <a href="structure/logout.php" class="btn btn-default btn-flat">Log out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
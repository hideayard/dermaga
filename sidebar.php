 <?php
function check_active($a,$b)
{
  if($a==$b)
  {
    return " active ";
  }
  else if($a == "home")
  {
    return " ";
  }
  // /$page
}
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
      <img src="assets/img/cargo1_50.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">E-Dermaga</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/<?=$result[0]['user_foto']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile" class="d-block"><?=$result[0]['user_nama']?></a>
          <!-- <br>
          <a href="#" class="d-block"><?=$result[0]['user_tipe']?></a> -->

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="home" class="nav-link <?=check_active($page,'home')?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>

          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-microchip"></i>
              <p>
                Node
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tablenode" class="nav-link<?=check_active($page,'tablenode')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Node</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addnode" class="nav-link<?=check_active($page,'addnode')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Node</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-microchip"></i>
              <p>
                Panel
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tablepanel" class="nav-link<?=check_active($page,'tablepanel')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Panel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addpanel" class="nav-link<?=check_active($page,'addpanel')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah panel</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-microchip"></i>
              <p>
                Sparepart
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tablesparepart" class="nav-link<?=check_active($page,'tablesparepart')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Sparepart</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addsparepart" class="nav-link<?=check_active($page,'addsparepart')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Sparepart</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tabledatasensor" class="nav-link<?=check_active($page,'tabledatasensor')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Data Sensor</p>
                </a>
              </li>
              
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="users" class="nav-link<?=check_active($page,'users')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar user</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adduser" class="nav-link<?=check_active($page,'adduser')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah User</p>
                </a>
              </li>
              
            </ul>
          </li>
   
          <!-- <li class="nav-item">
            <a href="gallery" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li> -->


          <li class="nav-header">Menu</li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Log Out</p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
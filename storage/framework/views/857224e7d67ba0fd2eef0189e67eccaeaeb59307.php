<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('admin')); ?>" class="brand-link">
      <img src="<?php echo e(asset('dsadmin/images/logo.png')); ?>"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">JSMT-Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset('dsadmin/images/admin.jpg')); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Jhoan Montenegro</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="<?php echo e(route('admin')); ?>" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Personal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('user-index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
            </ul>            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('customer-index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clientes</p>
                </a>
              </li>
            </ul>
          </li>      
          <li class="nav-item has-treeview">
            <a href="<?php echo e(route('admin')); ?>" class="nav-link">
              <i class="nav-icon fa fa-warehouse"></i>
              <p>
                Bodega
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('base-index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bases</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('product-index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
            </ul>            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('product-category-index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categoria de productos</p>
                </a>
              </li>
            </ul>              
          </li>          
          <li class="nav-item has-treeview">
            <a href="<?php echo e(route('admin')); ?>" class="nav-link">
              <i class="nav-icon fa fa-archive"></i>
              <p>
                Combo
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('combo-index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Combos</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('combo-type-index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipo de combos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo e(route('suggestions-index')); ?>" class="nav-link">
              <i class="nav-icon fa fa-list-alt"></i>
              <p>
                Sugerencias
              </p>
            </a>
          </li>   
          <li class="nav-item has-treeview">
            <a href="http://localhost/backup/php/" target="_bank" class="nav-link">
              <i class="nav-icon fa fa-database"></i>
              <p>
                DB
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="http://localhost/backup/php/Backup.php" target="_bank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Descargar</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="http://localhost/backup/php/" target="_bank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subir</p>
                </a>
              </li>
            </ul>
          </li>                                              
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/dsadmin/menu.blade.php ENDPATH**/ ?>
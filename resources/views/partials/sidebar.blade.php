<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="info">
        <!-- TODO: User's name -->
        <p>Loggedin as: {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</p>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li><a href="/"><i class="fa fa-money"></i> <span>Cashier</span></a></li>

      @if(Auth::user()->is_admin == 1)
        <li><a href="/staff"><i class="fa fa-user"></i> <span>Staff</span></a></li>
        <li><a href="/discounts"><i class="fa fa-percent"></i> <span>Discounts</span></a></li>
        <li><a href="/quantitytypes"><i class="fa fa-balance-scale"></i> <span>Quantity Type</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-coffee"></i> <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/categories"><i class="fa fa-list"></i> Categories</a></li>
            <li><a href="/ingredients"><i class="fa fa-flask"></i> Ingredients</a></li>
            <li><a href="/details"><i class="fa fa-info"></i> Product Details</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/sales"><i class="fa fa-money"></i> Sales</a></li>
            <li><a href="/items"><i class="fa fa-cutlery"></i> Items Sold</a></li>
          </ul>
        </li>
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
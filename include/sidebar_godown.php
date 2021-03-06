 <?php 

    require_once('../../functions.php'); 
    
    $sidebar_modules = getAllByOrder('tbl_modules','module_order','ASC');
    $sidebar_menus = getAllByOrder('tbl_menus','menu_order','ASC');
            
 ?>
 <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                           <li class="menu-title text-center">Godown</li>

                            <li>
                                <a href="../../modules/godown/dashboard.php" class="waves-effect"><i class="ti-dashboard"></i><span> Dashboard </span> </a>
                            </li>

                             <li class="has_sub">
                                <a href="../../modules/product/view.php" class="waves-effect"><i class="ti-view-list"></i><span> Products </span> </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-receipt"></i><span> Orders </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="../../modules/godown/orders.php"> View Orders</a></li>                          
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-plus"></i><span> Add Stock  </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="../../modules/godown/add_stock.php"> Add</a></li>                          
                                    <li><a href="../../modules/godown/stock_history.php"> Stock History</a></li>                          
                                </ul>
                            </li>


                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                   

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
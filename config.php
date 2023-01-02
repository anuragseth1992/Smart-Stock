<?php 
	include "db/connection.php";
	function getStyleSheets(){
		echo "<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
			<link rel='stylesheet' href='../plugins/fontawesome-free/css/all.min.css'>
			<link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
			<link rel='stylesheet' href='../dist/css/adminlte.min.css'>";
	}
	
	function getJSFiles(){
		echo "<script src='../plugins/jquery/jquery.min.js'></script>
			<script src='../plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
			<script src='../dist/js/adminlte.js'></script>";
	}
	
	function getTableJSFiles(){
		echo "<script src='../plugins/datatables/jquery.dataTables.min.js'></script>
			<script src='../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'></script>
			<script src='../plugins/datatables-responsive/js/dataTables.responsive.min.js'></script>
			<script src='../plugins/datatables-responsive/js/responsive.bootstrap4.min.js'></script>
			<script src='../plugins/datatables-buttons/js/dataTables.buttons.min.js'></script>
			<script src='../plugins/datatables-buttons/js/buttons.bootstrap4.min.js'></script>
			<script src='../plugins/jszip/jszip.min.js'></script>
			<script src='../plugins/pdfmake/pdfmake.min.js'></script>
			<script src='../plugins/pdfmake/vfs_fonts.js'></script>
			<script src='../plugins/datatables-buttons/js/buttons.html5.min.js'></script>
			<script src='../plugins/datatables-buttons/js/buttons.print.min.js'></script>
			<script src='../plugins/datatables-buttons/js/buttons.colVis.min.js'></script>";
	}
	
	function showNavbar(){
		echo "<nav class='main-header navbar navbar-expand navbar-white navbar-light'>
			<ul class='navbar-nav'>
				<li class='nav-item'>
					<a class='nav-link' data-widget='pushmenu' href='#' role='button'><i class='fas fa-bars'></i></a>
				</li>
			</ul>
			<ul class='navbar-nav ml-auto'>
				<li class='nav-item'>
					<a class='nav-link' data-widget='fullscreen' href='#' role='button'>
						<i class='fas fa-expand-arrows-alt'></i>
					</a>
			  </li>
			</ul>
		  </nav>";
	}
	
	function footerBar(){
		echo "
		  <footer class='main-footer'>
			<div class='float-right d-none d-sm-block'>
			  <b>Version</b> 1.0.0
			</div>
			<strong>Copyright &copy; 2021-2023 <a href='link'>InterviewTask</a>.</strong> Content for copyright.
		  </footer>";
	}
	
	function displaySideMenu($pageName){
	echo " <aside class='main-sidebar sidebar-dark-primary elevation-4'>
		<a href='../Home/' class='brand-link'>
		  <img src='../dist/img/AdminLTELogo.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
		  <span class='brand-text font-weight-light'>AdminLTE 3</span>
		</a>
		<div class='sidebar'>
		  <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
			<div class='image'>
			  <img src='../dist/img/avatar5.png' class='img-circle elevation-2' alt='User Image'>
			</div>
			<div class='info'>
			  <a href='#' class='d-block'>Admin</a>
			</div>
		  </div>

		  <nav class='mt-2'>
	      <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
          <li class='nav-item'>
            <a href='../StockAnalysis/' class='nav-link "; if($pageName == 'stockAnalysis'){ echo "active";} echo "'>
              <i class='nav-icon fas fa-tachometer-alt'></i>
              <p>
                Stock Analysis
              </p>
            </a>
          </li>
          <li class='nav-item "; if($pageName == 'addStocks' || $pageName == 'viewStocks' ){ echo "nav-item menu-is-opening menu-open";} echo "'>
            <a href='#' class='nav-link "; if($pageName == 'addStocks' || $pageName == 'viewStocks' ){ echo "active";} echo "'>
              <i class='nav-icon fas fa-table'></i>
              <p>
                Stocks Details
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='../AddStocks/' class='nav-link "; if($pageName == 'addStocks'){ echo "active";} echo "'>
                  <i class='nav-icon fas fa-solid fa-plus'></i>
                  <p>Add Stock Details</p>
                </a>
              </li>
              <li class='nav-item'>
                <a href='../ViewStocks/' class='nav-link "; if($pageName == 'viewStocks'){ echo "active";} echo "'>
                  <i class='nav-icon fas fa-solid fa-eye'></i>
                  <p>View Stock Details</p>
                </a>
              </li>
            </ul>
          </li>		  
		  <li class='nav-item "; if($pageName == 'buyStock' || $pageName == 'sellStock' ){ echo "nav-item menu-is-opening menu-open";} echo "'>
            <a href='#' class='nav-link "; if($pageName == 'buyStock' || $pageName == 'sellStock' ){ echo "active";} echo "'>
              <i class='nav-icon fas fa-wallet'></i>
              <p>
                Stock Transactions
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='../BuyStock/' class='nav-link "; if($pageName == 'buyStock'){ echo "active";} echo "'>
                  <i class='nav-icon fas fa-arrow-right'></i>
                  <p>Buy Stock</p>
                </a>
              </li>
              <li class='nav-item'>
                <a href='../SellStock/' class='nav-link "; if($pageName == 'sellStock'){ echo "active";} echo "'>
                  <i class='nav-icon fas fa-arrow-left'></i>
                  <p>Sell Stock</p>
                </a>
              </li>
            </ul>
          </li>	
		  <li class='nav-item "; if($pageName == 'inventoryReport' || $pageName == 'transactionReport' ){ echo "nav-item menu-is-opening menu-open";} echo "'>
            <a href='#' class='nav-link "; if($pageName == 'inventoryReport' || $pageName == 'transactionReport' ){ echo "active";} echo "'>
              <i class='nav-icon fas fa-book'></i>
              <p>
                Reports
                <i class='fas fa-angle-left right'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='../InventoryReport/' class='nav-link "; if($pageName == 'inventoryReport'){ echo "active";} echo "'>
                  <i class='nav-icon fas fa-solid fa-cubes'></i>
                  <p>Inventory Report</p>
                </a>
              </li>
              <li class='nav-item'>
                <a href='../TransactionReport/' class='nav-link "; if($pageName == 'transactionReport'){ echo "active";} echo "'>
                  <i class='nav-icon fas fa-solid fa-cash-register'></i>
                  <p>Transaction Report</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class='nav-item'>
            <a href='../Settings/' class='nav-link "; if($pageName == 'setting'){ echo "active";} echo "'>
              <i class='nav-icon fas fa-solid fa-toolbox'></i>
              <p>
                Setting
              </p>
            </a>
          </li>		  
        </ul>
      </nav>
	</div>
   </aside>";
	}
?>
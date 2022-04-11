		<aside id="left-panel" class="left-panel">
			<nav class="navbar navbar-expand-sm navbar-default">
				<div id="main-menu" class="main-menu collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"> <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a></li>
						
						<li class="menu-title">Penjualan</li><!-- /.menu-title -->
						<li>
							<a href="penjualan_input.php"> <i class="menu-icon fa fa-tag"></i>Jual Produk</a>
						</li>
			
						<li class="menu-title">Pembeliaan</li><!-- /.menu-title -->
						<li>
							<a href="pembelian_input.php"> <i class="menu-icon fa fa-shopping-cart"></i>Beli Bahan Baku</a>
						</li>
						
						<li class="menu-title">Data</li><!-- /.menu-title -->
							<li class="menu-item-has-children dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Master Data</a>
								<ul class="sub-menu children dropdown-menu">
									<li><i class="menu-icon fa fa-user"></i><a href="supplier.php">&nbsp;Supplier</a></li>
									<li><i class="menu-icon fa fa-archive"></i><a href="bahanbaku.php">&nbsp;Bahan Baku</a></li>
									<li><i class="menu-icon fa fa-home"></i><a href="produksi.php">&nbsp;Data Produksi</a></li>
									<li><i class="menu-icon fa fa-tag"></i><a href="penjualan.php">&nbsp;Data Penjualan</a></li>
									<li><i class="menu-icon fa fa-shopping-cart"></i><a href="pembelian.php">&nbsp;Data Pembelian</a></li>
								</ul>
							</li>
							
							<li class="menu-item-has-children dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-copy"></i>Laporan</a>
								<ul class="sub-menu children dropdown-menu">
									<li><i class="menu-icon fa fa-file-text"></i><a href="produksi_laporan.php">&nbsp;Laporan Produksi</a></li>
									<li><i class="menu-icon fa fa-file-text"></i><a href="penjualan_laporan.php">&nbsp;Laporan Penjualan</a></li>
									<li><i class="menu-icon fa fa-file-text"></i><a href="pembelian_laporan.php">&nbsp;Laporan Pembelian</a></li>
								</ul>
							</li>
					
						<li class="menu-title">Perencanaan Produksi</li><!-- /.menu-title -->
						<li>
							<a href="menu.php"> <i class="menu-icon fa fa-list"></i>Menu, BOM</a>
						</li>
						<li>
							<a href="controller/proses_mrp_tabel.php"> <i class="menu-icon fa fa-gear"></i>MRP (Porel)</a>
						</li>
						<li>
							<a href="produksi_input.php"><i class="menu-icon fa fa-home"></i>&nbsp;Produksi</a>
						</li>
						<li>
							<a href="schedule_receipt_input.php"><i class="menu-icon fa fa-bell-o"></i>&nbsp;Pre-Order</a>
						</li>
						
						<li class="menu-title">Peramalan</li><!-- /.menu-title -->
						<li class="menu-item-has-children dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart-o"></i>Peramalan</a>
							<ul class="sub-menu children dropdown-menu">
								<li><i class="menu-icon fa fa-edit"></i><a href="peramalan_input.php">&nbsp;Input Penjualan</a></li>
								<li><i class="menu-icon fa fa-clipboard"></i><a href="peramalan_hasil.php">&nbsp;Hasil Peramalan</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</aside>
		
		<header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="navbar-brand" href=""><img src="../images/ollanda2.png" height="43px" width="80px" alt="Logo"></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
						<a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<small>login sebagai <code><?php echo $_SESSION['nama'];?></code>&nbsp;</small><img class="user-avatar rounded-circle" src="../images/avatar/capture1.png" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="_logout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
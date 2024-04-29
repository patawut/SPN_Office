<?php 
$WEB_NAME = getenv('WEB_NAME');
$WEB_TOPIC= getenv('WEB_TOPIC');
$THEME_COLOR = getenv('THEME_COLOR');
//GET session 
$session = session();
$user=$session->get('username');
$fullname=$session->get('fullname');
$typeUser=$session->get('typeUser');
if($user==null || $fullname==null || $typeUser==null){
	header('Location: '.site_url('login'));
}

?>
<!doctype html>
<html lang="en" class="<?=$THEME_COLOR?>">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?=site_url('assets/images/favicon-32x32.png')?>" type="image/png"/>
	<!--plugins-->
	<link href="<?=site_url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')?>" rel="stylesheet"/>
	<link href="<?=site_url('assets/plugins/simplebar/css/simplebar.css')?>" rel="stylesheet" />
	<link href="<?=site_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')?>" rel="stylesheet" />
	<link href="<?=site_url('assets/plugins/metismenu/css/metisMenu.min.css')?>" rel="stylesheet"/>
	<link href="<?=site_url('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')?>" rel="stylesheet" />
	
	<!-- loader-->
	<link href="<?=site_url('assets/css/pace.min.css')?>" rel="stylesheet"/>
	<script src="<?=site_url('assets/js/pace.min.js')?>"></script>
	<!-- Bootstrap CSS -->
	<link href="<?=site_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=site_url('assets/css/bootstrap-extended.css')?>" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Noto Sans Thai' rel='stylesheet'>
	<link href="<?=site_url('assets/css/app.css')?>" rel="stylesheet">
	<link href="<?=site_url('assets/css/icons.css')?>" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="<?=site_url('assets/css/dark-theme.css')?>"/>
	<link rel="stylesheet" href="<?=site_url('assets/css/semi-dark.css')?>"/>
	<link rel="stylesheet" href="<?=site_url('assets/css/header-colors.css')?>"/>
	<script src="<?=site_url('assets/js/bootstrap.bundle.min.js')?>"></script>
	<!--plugins-->
	<script src="<?=site_url('assets/js/jquery.min.js')?>"></script>
	<script src="<?=site_url('assets/plugins/simplebar/js/simplebar.min.js')?>"></script>
	<script src="<?=site_url('assets/plugins/metismenu/js/metisMenu.min.js')?>"></script>
	<script src="<?=site_url('assets/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?=site_url('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')?>"></script>

	<script src="<?=site_url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')?>"></script>
	<script src="<?=site_url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')?>"></script>
    <script src="<?=site_url('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')?>"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
	

	<!--app JS-->
	<script src="<?=site_url('assets/js/app.js')?>"></script>
	<title><?=$WEB_NAME?> <?=$WEB_TOPIC?></title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header"> 
				<div class="text-center">
					<h4 class="logo-text"><?=$WEB_NAME?></h4>
					<small><?=$WEB_TOPIC?></small>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<li> <a href="<?=site_url('./')?>"><i class="bx bx-right-arrow-alt"></i>ภาพรวม</a> </li> 
					</ul>
				</li>
 
				<li class="menu-label">Orders</li> 
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">รายการสั่งซื้อ</div>
					</a>
					<ul>
						<li> <a href="ecommerce-products.html"><i class="bx bx-right-arrow-alt"></i>รายการสั่งซื้อ</a> </li>
						<li> <a href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>สมัครธุรกิจ</a> </li>
						<li> <a href="ecommerce-add-new-products.html"><i class="bx bx-right-arrow-alt"></i>รับชำระ</a> </li> 
					</ul>
				</li>    
				<li class="menu-label">Member</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-message-square-edit'></i>
						</div>
						<div class="menu-title">ข้อมูลสมาชิก</div>
					</a>
					<ul>
						<li> <a href="form-elements.html"><i class="bx bx-right-arrow-alt"></i>ค้นหาสมาชิก</a></li>
						<li> <a href="form-input-group.html"><i class="bx bx-right-arrow-alt"></i>ผังองค์กร</a> </li> 
						<li> <a href="form-input-group.html"><i class="bx bx-right-arrow-alt"></i>ลบคะแนนทั้งสาย</a> </li> 
						<li> <a href="form-validations.html"><i class="bx bx-right-arrow-alt"></i>ตรวจสอบ</a> </li> 
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-grid-alt"></i>
						</div>
						<div class="menu-title">ตำแหน่ง</div>
					</a>
					<ul>
						<li> <a href="table-basic-table.html"><i class="bx bx-right-arrow-alt"></i>จัดการตำแหน่ง</a> </li> 
					</ul>
				</li>
				<li class="menu-label">Contents</li> 
				<li>
					<a href="<?=site_url('./article')?>">
						<div class="parent-icon"><i class="bx bx-help-circle"></i> </div>
						<div class="menu-title">บทความ</div>
					</a>
				</li>
				<li>
					<a href="<?=site_url('./news')?>">
						<div class="parent-icon"><i class="bx bx-diamond"></i> </div>
						<div class="menu-title">ข่าวสาร</div>
					</a>
				</li>
				<li class="menu-label">Setting</li>
				<li>
					<a href="<?=site_url('./website')?>" >
						<div class="parent-icon"><i class="bx bx-support"></i> </div>
						<div class="menu-title">ข้อมูลเว็ปไซต์</div>
					</a>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-line-chart"></i> </div>
						<div class="menu-title">สินค้า</div>
					</a>
					<ul>
						<li>  <a href="<?=site_url('./product')?>"><i class="bx bx-right-arrow-alt"></i>สินค้า</a> </li>
						<li>  <a href="<?=site_url('./producttype')?>"><i class="bx bx-right-arrow-alt"></i>ประเภทสินค้า</a> </li> 
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-map-alt"></i> </div>
						<div class="menu-title">ธนาคาร</div>
					</a>
					<ul>
						<li>  <a href="<?=site_url('./bankaccount')?>"><i class="bx bx-right-arrow-alt"></i>ตั้งค่าบัญชีรับเงิน</a> </li> 
						<li>  <a href="<?=site_url('./banklist')?>"><i class="bx bx-right-arrow-alt"></i>ธนาคาร</a> </li>
					</ul> 
				</li> 
				<li>
					<a href="<?=site_url('./mlmplan')?>">
						<div class="parent-icon"><i class="bx bx-donate-blood"></i> </div>
						<div class="menu-title">ตั้งค่าแผนการตลาด</div>
					</a>
				</li>
				
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-grid-alt"></i> </div>
						<div class="menu-title">ผู้ใช้งาน</div>
					</a>
					<ul>
						<li> <a href="<?=site_url('./userlist')?>"><i class="bx bx-right-arrow-alt"></i>จัดการผู้ใช้งาน</a> </li>
						<li> <a href="<?=site_url('./userlog')?>"><i class="bx bx-right-arrow-alt"></i>ประวัติเข้าใช้งาน</a> </li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							 
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center"> 
						 
						</ul>
					</div>

					<div class="user-box dropdown text-center">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bx bx-user h4 ms-3 me-1 " alt="user avatar"></i>
							<div class="user-info  "> 
							<p class="user-name mb-0 ms-1"><?=$fullname?></p>
								<small class="designattion mb-0"> <?=$typeUser?></small>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<a class="dropdown-item" href="<?=site_url('./profile')?>"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>  
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="<?=site_url('logout')?>"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<?php
			print_r($user);
		?>
		<!--end header -->
		<!--start page wrapper -->
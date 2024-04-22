<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?=site_url('assets/images/favicon-32x32.png')?>" type="image/png" />
	<!--plugins-->
	<link href="<?=site_url('assets/plugins/simplebar/css/simplebar.css')?>" rel="stylesheet" />
	<link href="<?=site_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')?>" rel="stylesheet" />
	<link href="<?=site_url('assets/plugins/metismenu/css/metisMenu.min.css')?>" rel="stylesheet" />
	<!-- loader-->
	<link href="<?=site_url('assets/css/pace.min.css')?>" rel="stylesheet" />
	<script src="<?=site_url('assets/js/pace.min.js')?>"></script>
	<!-- Bootstrap CSS -->
	<link href="<?=site_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=site_url('assets/css/bootstrap-extended.css')?>" rel="stylesheet">
	<!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> -->
	<link href='https://fonts.googleapis.com/css?family=Noto Sans Thai' rel='stylesheet'>
	<link href="<?=site_url('assets/css/app.css')?>" rel="stylesheet">
	<link href="<?=site_url('assets/css/icons.css')?>" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
</head>
<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<!-- <img src="assets/images/logo-img.png" width="180" alt="" /> -->
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign in , เข้าสู่ระบบ</h3> 
									</div> 
									<div class="login-separater text-center mb-4"> <span>SIGN IN WITH Telephone</span>
										<hr/>
									</div>
									<div class="form-body">
										<form class="row g-3" id="loginform">
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">เบอร์โทรศัพท์</label>
												<input type="text" class="form-control" id="telephone" placeholder="เบอร์โทรศัพท์"  name="telephone">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">รหัสผ่าน</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="inputChoosePassword" name="inputChoosePassword"  placeholder="กรอกรหัสผ่าน"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div> 
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" id="loginbtn" name="loginbtn" class="btn btn-primary"><i class="bx bxs-lock-open"></i>เข้าสู่ระบบ</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
			$('#loginbtn').click(function (e) { 
				e.preventDefault();
				console.log('222');
				let formData = $('form#loginform').serialize();
				$.post("./login", formData,(data)=> {
					if(data.code==0){
						Swal.fire({
							icon: 'error',
							title: 'Username หรือ Password กรุณาลองใหม่อีกครั้ง',
							text: data.message,
					})
					}else if(data.code==1){
						Swal.fire({
							icon: 'success',
							title: 'เข้าสู่ระบบ',
							showConfirmButton: false,
							timer: 1500
							}).then(function() {
								window.location.href = './';
							});
					}
				},"json");
    });
		});
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>
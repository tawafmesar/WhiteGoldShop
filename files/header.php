<!doctype html>
<html lang="ar" dir="rtl">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title> وايت جولد</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="css/tiny-slider.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.3.js"
		integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="css/tiny-slider.css" rel="stylesheet">
    <link rel='stylesheet' href='css/aos.css'>

	<link rel="stylesheet" href="css/all.css" />
	<link href="css/style.css" rel="stylesheet">


</head>

<body>

	<nav dir="rtl" class="custom-navbar navbar navbar navbar-expand-md navbar-light bg-light rtll"
		arial-label="Furni navigation bar">

		<div class="container container-wa">
			<a class="navbar-brand" href="index.php">وايت جولد<span>.</span></a>

			<button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
				aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">الرئيسية</a>
					</li>
					<li><a class="nav-link" href="products.php">منتجاتنا</a></li>
					<li><a class="nav-link" href="contact.php"> <i class="fa-solid fa-envelope"
								style="margin-left:4px;"></i> تواصل معنا</a></li>
					<?php if (!isset($_SESSION['user'])) { ?>
						<li>
							<a class="nav-link" style="font-weight:bold;" href="login.php">
								<i class="fa fa-sign-in" aria-hidden="true" style="margin-left:4px;"></i> تسجيل دخول</a>
						</li>
					<?php } else { ?>
						<li>
							<a class="nav-link" style="font-weight:bold;" href="logout.php">
								<i class="fa-solid fa-right-from-bracket" style="margin-left:4px;"></i> تسجيل خروج</a>
						</li>
					<?php } ?>
					<li><a class="nav-link iconimg" href="favourite.php"><i style="  font-size: 20px;"
								class="fa-solid fa-heart"></i></a></li>
					<li><a class="nav-link iconimg" href="cart.php"><i style="  font-size: 20px;"
								class="fa-solid fa-cart-shopping"></i></a></li>

				</ul>
			</div>

			<div class="card">


				<div style="margin:10px;padding: 1px;">
						<h4 class="mb-3">توصل معنا</h4>

					<div style="text-align: center; font-size: 1.5em;letter-spacing: 10px;">
					
		
						<a href="https://wa.me/96655515515" target="_blank" rel="noopner"><i style="color:#18d45c"
							style="color:#18d45c"	class="fa-brands fa-whatsapp"></i></a>
										
							<a href="mailto:info@yourdomain.com" target="_blank" rel="noopner"><i style="color:red"
								class="fa fa-envelope"></i></a>
						
							<a  href="tel:+96655515515" target="_blank" rel="noopner"><i class="fa-solid fa-phone"></i></a>

						</div>
				</div>
				
			</div>
			<div class="floating-button">
				<i class="fa fa-comments icon wa"></i>
				<i style="color:#fff;" class="fa fa-times icon close"></i>

			</div>

		</div>
		<script>
			$(document).ready(function () {
				$('.custom-navbar-nav li a').click(function (e) {
					window.location.href = $(this).attr('href');
					$('.custom-navbar-nav li').removeClass('active');
					$(this).parent().addClass('active');
				});
			});
			$(".floating-button").click(function(){
					$(this).closest('.container-wa').toggleClass('is-opened');
				})
		</script>
	</nav>

<nav dir="rtl" class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark rtll"
		arial-label="Furni navigation bar">

		<div class="container container-wa">
			<a class="navbar-brand" href="homeitems.php"> إدارة موقع وايت جولد<span>.</span></a>

			<button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
				aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
				<li><a class="nav-link ml-1" href="homeitems.php">منتجات الرئيسية</a></li>

					<li><a class="nav-link ml-1" href="items.php">المنتجات</a></li>
					<li><a class="nav-link ml-1" href="orders.php">الطلبات</a></li>
					<li><a class="nav-link ml-1" href="users.php">المستخدمين</a></li>
					<li><a class="nav-link ml-1" href="../index.php">المتجر</a></li>

					<?php if (!isset($_SESSION['userses'])) { ?>
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


				</ul>
			</div>


		</div>
	</nav>
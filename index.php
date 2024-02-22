
<?php
session_start();

  include 'files/ini.php';?>

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>وايت جولد<span>.</span> <span clsas="d-block"></span></h1>
								<p class="mb-4">
								متجر وايت جولد لأجمل الاكسسوارات النسائية سلاسل ناعمة واكسسوارات بنات على الموضة بجودة عالية وبأقل الأسعار مع توصيل سريع لجميع مدن المملك.	
								
								</p>
								<p><a href="" class="btn btn-secondary me-2">تسوق الان</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="images\products\hero11.png"  class="img-fluid">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<!-- Start Product Section -->
		<div class="product-section">
			<div class="container">
				<div class="row">

					<!-- Start Column 1 -->
					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">مجموعة أطقم نسائية فاخرة.</h2>
						<p class="mb-4">    مجموعة  أطقم نسائية  متنوعة ملكية وفاخرة باللون الفضي ويتكون كل طقم من  سلسال وخاتم واسوارة وحلق. </p>
						<p><a href="shop.html" class="btn">المزيد... </a></p>
					</div> 
					<!-- End Column 1 -->

					<!-- Start Column 2 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
						<a class="product-item" href="cart.html">
							<img src="images\products\number2.jpeg" class="img-fluid product-thumbnail">
							<h3 class="product-title">طقم نسائي ملكي باللون الفضي</h3>
							<strong class="product-price">150.00</strong>

							<span class="icon-cross">
								<img src="images/cross.svg" class="img-fluid">
								
							</span>
						</a>
					</div> 
					<!-- End Column 2 -->

					<!-- Start Column 3 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
						<a class="product-item" href="cart.html">
							<img src="images\products\number1.jpeg" class="img-fluid product-thumbnail">
							<h3 class="product-title">طقم نسائي ملكي باللون الفضي</h3>
							<strong class="product-price">78.00</strong>

							<span class="icon-cross">
								<img src="images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
					<!-- End Column 3 -->

					<!-- Start Column 4 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
						<a class="product-item" href="cart.html">
						<img src="images\products\number3.jpeg" class="img-fluid product-thumbnail">
							<h3 class="product-title">
								طقم نسائي ملكي باللون الفضي
							</h3>
							<strong class="product-price">63.00</strong>

							<span class="icon-cross">
								<img src="images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
					<!-- End Column 4 -->

				</div>
			</div>
		</div>
		<!-- End Product Section -->

		<!-- Start We Help Section -->
		<div class="we-help-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-7 mb-5 mb-lg-0">
						<div class="imgs-grid">
							<div class="grid grid-1"><img src="images\products\number2.jpeg" alt="Untree.co"></div>
							<div class="grid grid-2"><img src="images\products\number4.jpeg" alt="Untree.co"></div>
							<div class="grid grid-3"><img src="images\products\number6.jpeg" alt="Untree.co"></div>
						</div>
					</div>
					<div class="col-lg-5 ps-lg-5">
						<h2 class="section-title mb-4">عليكِ اختيار وايت جولد لكي</h2>
						<p>
							
						تألقي بأناقة مع مجموعة الأطقم النسائية الفاخرة من متجر وايت جولد. اختري من بين مجموعة متنوعة من الأطقم الفاخرة باللون الفضي، واحصلي على إطلالة ملكية تليق بك					

					</div>
				</div>
			</div>
		</div>
		<!-- End We Help Section -->


<?php



  include 'files/footer.php';
  ob_end_flush();
  ?>


	</body>

</html>

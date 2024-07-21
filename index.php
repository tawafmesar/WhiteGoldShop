<?php
session_start();

include 'files/ini.php';



$stmt = $con->prepare("SELECT * FROM items WHERE items_homeorder != 0    ORDER BY
items_homeorder 
ASC");

// execute the statement

$stmt->execute();

// assign to variable


$stmt2 = $con->prepare("SELECT *
		FROM homepage");

$stmt2->execute();
$texts = $stmt2->fetchall();

$photos = $stmt->fetchall();
if (!empty($photos)) {
	$idarray = [];
	$photoarray = [];
	$namearray = [];
	$pricearray = [];


	foreach ($photos as $photo) {
		$idarray[] = $photo['items_id'];
		$photoarray[] = $photo['items_image'];
		$namearray[] = $photo['items_name'];
		$pricearray[] = $photo['items_price'];

	}

}

$title = [];
$subtext = [];

foreach ($texts as $text) {
	$title[] = $text['homepage_title'];
	$subtext[] = $text['homepage_text'];
}
?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Start Hero Section -->
<div class="hero">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1>
						<?php echo $title[0]; ?><span></span> <span clsas="d-block"></span>
					</h1>
					<p class="mb-4">
						<?php echo $subtext[0]; ?>
					</p>
					<p><a href="products.php" class="btn btn-secondary me-2">تسوق الان</a></p>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="hero-img-wrap">
					<div class="carousel">
						<ul class="carousel__list">
							<li class="carousel__item" data-pos="-2">1
																
							<div class='product-imgg'>
									<img src="./upload/items/<?php echo $photoarray[0]; ?>"
										class="img-fluid product-thumbnail">
								</div>
								<div class='product-infoo'>
									<h2 class="product-title">
										<?php echo $namearray[0]; ?>
									</h2>
									<h4 class="product-price">
										<?php echo $pricearray[0]; ?>
									</h4>
								</div>
								<div class='product-open'>
									<a href="details.php?itemid=<?php echo $idarray[0]; ?>">><img src="images/open.png"></a>
									
								</div>

							</li>
							<li class="carousel__item" data-pos="-1">2

															
							<div class='product-imgg'>
									<img src="./upload/items/<?php echo $photoarray[1]; ?>"
										class="img-fluid product-thumbnail">
								</div>
								<div class='product-infoo'>
									<h2 class="product-title">
										<?php echo $namearray[1]; ?>
									</h2>
									<h4 class="product-price">
										<?php echo $pricearray[1]; ?>
									</h4>
								</div>
								<div class='product-open'>
									<a href="details.php?itemid=<?php echo $idarray[1]; ?>">><img src="images/open.png"></a>
									
								</div>

							</li>
							<li class="carousel__item" data-pos="0">3
								
								<div class='product-imgg'>
									<img src="./upload/items/<?php echo $photoarray[2]; ?>"
										class="img-fluid product-thumbnail">
								</div>
								<div class='product-infoo'>
									<h2 class="product-title">
										<?php echo $namearray[2]; ?>
									</h2>
									<h4 class="product-price">
										<?php echo $pricearray[2]; ?>
									</h4>
								</div>
								<div class='product-open'>
									<a href="details.php?itemid=<?php echo $idarray[2]; ?>">><img src="images/open.png"></a>
									
								</div>
							</li>
							<li class="carousel__item" data-pos="1">4
								
							<div class='product-imgg'>
									<img src="./upload/items/<?php echo $photoarray[3]; ?>"
										class="img-fluid product-thumbnail">
								</div>
								<div class='product-infoo'>
									<h2 class="product-title">
										<?php echo $namearray[3]; ?>
									</h2>
									<h4 class="product-price">
										<?php echo $pricearray[3]; ?>
									</h4>
								</div>
								<div class='product-open'>
									<a href="details.php?itemid=<?php echo $idarray[3]; ?>">><img src="images/open.png"></a>
									
								</div>

							</li>
							<li class="carousel__item" data-pos="2">5

															
								<div class='product-imgg'>
									<img src="./upload/items/<?php echo $photoarray[4]; ?>"
										class="img-fluid product-thumbnail">
								</div>
								<div class='product-infoo'>
									<h2 class="product-title">
										<?php echo $namearray[4]; ?>
									</h2>
									<h4 class="product-price">
										<?php echo $pricearray[4]; ?>
									</h4>
								</div>
								<div class='product-open'>
									<a href="details.php?itemid=<?php echo $idarray[4]; ?>">><img src="images/open.png"></a>
									
								</div>
							</li>
						</ul>
					</div>



					<script>
						const state = {};
						const carouselList = document.querySelector('.carousel__list');
						const carouselItems = document.querySelectorAll('.carousel__item');
						const elems = Array.from(carouselItems);

						carouselList.addEventListener('click', function (event) {
							// Check if the clicked element is either the parent li or the nested img
							let newActive = event.target;
							while (newActive && !newActive.classList.contains('carousel__item')) {
								newActive = newActive.parentElement;
							}

							if (!newActive) {
								return; // Clicked outside of carousel items
							}

							if (newActive.classList.contains('carousel__item_active')) {
								return; // Clicked on already active item
							}

							update(newActive);
						});

						const update = function (newActive) {
							const newActivePos = newActive.dataset.pos;

							const current = elems.find((elem) => elem.dataset.pos == 0);
							const prev = elems.find((elem) => elem.dataset.pos == -1);
							const next = elems.find((elem) => elem.dataset.pos == 1);
							const first = elems.find((elem) => elem.dataset.pos == -2);
							const last = elems.find((elem) => elem.dataset.pos == 2);

							current.classList.remove('carousel__item_active');

							[current, prev, next, first, last].forEach(item => {
								var itemPos = item.dataset.pos;

								item.dataset.pos = getPos(itemPos, newActivePos)
							});
						};

						const getPos = function (current, active) {
							const diff = current - active;

							if (Math.abs(current - active) > 2) {
								return -current
							}

							return diff;
						}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Hero Section -->

<!-- Start Product Section -->
<div class="product-section">
	<div class="container">
		<div class="row " >

			<!-- Start Column 1 -->
			<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
				<h3 class="mb-4 ">
					<?php echo $title[1]; ?>
				</h3>
				<p class="mb-4">
					<?php echo $subtext[1]; ?>
				</p>
				<p><a href="products.php" class="btn">المزيد... </a></p>
			</div>
			<!-- End Column 1 -->

			<!-- Start Column 2 -->
			<div class="col-6 col-md-4 col-lg-3 col-sm-6 mb-5">
				<a data-aos="fade-down" class="product-item" href="details.php?itemid=<?php echo $idarray[5]; ?>" style="font-weight: bolder;font-size: 15px;">
					<img src="./upload/items/<?php echo $photoarray[5]; ?>" class="img-fluid product-thumbnail">
					<h3 class="product-title">
						<?php echo $namearray[5]; ?>
					</h3>
					<strong  class="product-price" >
						<?php echo $pricearray[5]; ?>
					</strong>

					<span class="icon-cross">
						<img src="images/cross.svg" class="img-fluid">
					</span>
				</a>
			</div>


			<!-- End Column 2 -->

			<!-- Start Column 3 -->
			<div class="col-6 col-md-4 col-lg-3 col-sm-6 mb-5">
				<a data-aos="fade-up" class="product-item" href="details.php?itemid=<?php echo $idarray[6]; ?>">
					<img src="./upload/items/<?php echo $photoarray[6]; ?>" class="img-fluid product-thumbnail">
					<h3 class="product-title">
						<?php echo $namearray[6]; ?>
					</h3>
					<strong class="product-price">
						<?php echo $pricearray[6]; ?>
					</strong>

					<span class="icon-cross">
						<img src="images/cross.svg" class="img-fluid">
					</span>
				</a>
			</div>
			<!-- End Column 3 -->

			<!-- Start Column 4 -->
			<div class="col-6 col-md-4 col-lg-3 col-sm-6 mb-5">
				<a data-aos="fade-up" class="product-item" href="details.php?itemid=<?php echo $idarray[7]; ?>">
					<img src="./upload/items/<?php echo $photoarray[7]; ?>" class="img-fluid product-thumbnail">
					<h3 class="product-title">
						<?php echo $namearray[7]; ?>
					</h3>
					<strong class="product-price">
						<?php echo $pricearray[7]; ?>
					</strong>

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
					<div data-aos="fade-up" class="grid grid-1"><img src="./upload/items/<?php echo $photoarray[8]; ?>" alt="Untree.co">
					</div>
					<div data-aos="fade-down" class="grid grid-2"><img src="./upload/items/<?php echo $photoarray[9]; ?>" alt="Untree.co">
					</div>
					<div data-aos="fade-up" class="grid grid-3"><img src="./upload/items/<?php echo $photoarray[10]; ?>" alt="Untree.co">
					</div>
				</div>
			</div>
			<div class="col-lg-5 ps-lg-5">
				<h2 class="section-title mb-4">
					<?php echo $title[2]; ?>
				</h2>
				<p>

					<?php echo $subtext[2]; ?>
			</div>
		</div>
	</div>
</div>
<div class="af-help-section">
	d
</div>

<!-- End We Help Section -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<?php



include 'files/footer.php';
ob_end_flush();
?>


</body>

</html>
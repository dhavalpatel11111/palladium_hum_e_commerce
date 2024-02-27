<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="../css/tiny-slider.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<title>Swift Cart E-commerce Developed By D/U</title>
</head>

<body>

	<!-- <h1>ijdfuhbghfjbknk</h1> -->
	<div class="container d-flex p-5">


		<div class="container  bg-dark mx-3 p-2 rounded" style="width: 300px; box-shadow: 0 0 50px white ;">
			<a href="/">
				<div class="row">
					<div class="col-sm-12 my-2">
						<div class="card">
							<div class="card-body">
								<h5>T-shirt</h5>
							</div>
						</div>
					</div>

					<div class="col-sm-12 my-2">
						<div class="card">
							<div class="card-body">
								<h5>T-shirt</h5>
							</div>
						</div>
					</div>

					<div class="col-sm-12 my-2">
						<div class="card">
							<div class="card-body">
								<h5>T-shirt</h5>
							</div>
						</div>
					</div>

					<div class="col-sm-12 my-2">
						<div class="card">
							<div class="card-body">
								<h5>T-shirt</h5>
							</div>
						</div>
					</div>

					<div class="col-sm-12 my-2">
						<div class="card">
							<div class="card-body">
								<h5>T-shirt</h5>
							</div>
						</div>
					</div>

					<div class="col-sm-12 my-2">
						<div class="card">
							<div class="card-body">
								<h5>T-shirt</h5>
							</div>
						</div>
					</div>

					<div class="col-sm-12 my-2">
						<div class="card">
							<div class="card-body">
								<h5>T-shirt</h5>
							</div>
						</div>
					</div>

				</div>

		</div>

		</a>

















		<div class="product-section">
			<div class="container d-flex align-items-center justify-content-center flex-wrap">
				<div class="row  w-100 bg-light p-3 mb-5 rounded">
					<div class="col-lg-7 mx-auto text-center">
						<h2 class="section-title ">
							<?php
							if (!empty($sub_category_data)) {
								echo $category[0]['category'];
							} else {
								echo "<h1 class='h1 text-center'>Sub-Category</h1>";
							}
							?>
						</h2>
					</div>
				</div>
				<div class="container d-flex align-items-center justify-content-center flex-wrap">
					<?php
					for ($i = 0; $i < count($sub_category_data); $i++) {

					?>


						<div class="card  mb-5  border-0" style="width: 200px; background: none;">
							<a class="product-item" href="/sub_category_data/<?php echo $sub_category_data[$i]['id']; ?>">
								<img src="<?php echo asset("/uploads/" . $sub_category_data[$i]['image']) ?>" height="250px" width="170px" class="rounded">
								<h4 class="product-title"><?php echo $sub_category_data[$i]['sub_category']; ?></h4>
								<!-- <strong class="product-price">$50.00</strong> -->

								<span class="icon-cross" style="width: 100px; border-radius: 10px;">
									<p style="color: white;">Explore</p>

								</span>
							</a>
						</div>



					<?php
					}
					?>
				</div>
			</div>
		</div>

























	</div>

</body>

</html>
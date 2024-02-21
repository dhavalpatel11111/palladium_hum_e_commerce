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
 
<h1>ijdfuhbghfjbknk</h1>

<div class="product-section">
		<div class="container">
			<div class="row">
				<?php
				for ($i = 0; $i < count($sub_category_data); $i++) {
			
				?>

					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
						<a class="product-item" href="/sub_category_data/<?php echo $sub_category_data[$i]['id']; ?>">
							<img src="../images/product-1.png" class="img-fluid product-thumbnail ">
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
</body>
</html>
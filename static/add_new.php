<!DOCTYPE html>
<html lang="en">

<head>
	<?php 
	require('head_link_content.php');
	//echo md5("admin");
	?>
</head>

<body>
	<div class="wrapper">
		<?php 
			require('body_nav.php');
			?>

		<div class="main">
			<?php 
			require('body_nav_top.php');
			?>

			<main class="content">

				<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Add New Vehicle</h1>
						<!-- <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
      Welcome Back, Mugiwara Luffy!
  </a> -->
					</div>

				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-xl-6 col-xxl-12 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title"></h5>
													</div>

													<div class="col-auto">
														<div class="col-12">
															<img src="img/vehicle/motor.png" class="avatar img-fluid " alt="Car">
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">My PCX 160</h1>
												<div class="mb-0">
													
													<span class="text-muted">Last check: 43 days ago (Odo: 3,418km)</span>
												</div>
											</div>
										</div>
										
										

									</div>
									
								</div>
							</div>
						</div>

					
					

				</div>
			</main>

			



			


			
			

			<?php 
			require('footer.php');
			?>
		</div>
	</div>

	<script src="js/app.js"></script>

	
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>
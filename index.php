
<!DOCTYPE html>
<html ng-app="app">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tools</title>

<!-- include material design CSS -->
<link rel="stylesheet" href="libs/css/bootstrap.css" />
<link rel="stylesheet" href="libs/css/font-awesome.css" />
<link rel="stylesheet" href="libs/css/style.css" />
<link rel="stylesheet" href="libs/materialize/css/materialize.min.css"
	media="screen,projection" />

<!-- include material design icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet" />

</head>
<body >
	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<strong>Email: </strong>info@yourdomain.com &nbsp;&nbsp; <strong>Support:
					</strong>+90-897-678-44
				</div>

			</div>
		</div>
	</header>
	<!-- HEADER END-->
	<div class="navbar navbar-inverse set-radius-zero">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>


			</div>

			<div class="left-div">
				<h1>
					<font color="#9d9d9d"><b>TOOL SYSTEM</b></font>
				</h1>

			</div>
		</div>
	</div>
	<!-- LOGO HEADER END-->
	<div>
		<!--  ng-controller="modalCtrl" -->
		<section class="menu-section">
			<div class="container" ng-controller="navCtrl">
				<div class="row">
					<div class="col-md-12">
						<div class="navbar-collapse collapse ">
							<ul id="menu-top" class="nav navbar-nav navbar-right">
								<li ng-class="navClass('home')"><a href="#/">Tools</a></li>
								<li ng-class="navClass('rented')"><a href="#/rented">Rented Tools</a></li>
								
							</ul>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- MENU SECTION END-->
		<!-- CONTENT-WRAPPER SECTION START-->

	</div>

	<!--  angular view -->
	<div  ng-view></div>

	<!-- CONTENT-WRAPPER SECTION END-->
	<!--    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2016 WebMaster 
                </div>

            </div>
        </div>
    </footer>-->

	<!-- include jquery -->
	<script type="text/javascript"
		src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="libs/js/bootstrap.js"></script>
	<script type="text/javascript"
		src="libs/materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="libs/js/FileSaver.js"></script>
	<!-- jquery code here -->
	<script>
	
	</script>

	<!-- include angular js -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
	<script
		src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-resource.min.js"></script>
	<script
		src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-route.min.js"></script>

	<script
		src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-messages.js"></script>
	<script src="https://code.angularjs.org/1.2.25/angular-sanitize.js"></script>	

	<!--angular chart  -->
	<script src="node_modules/chart.js/dist/Chart.min.js"></script>
	<script src="node_modules/angular-chart.js/dist/angular-chart.min.js"></script>
	
	<!-- angular PDF generator -->
	<script src="node_modules/pdfmake/build/pdfmake.min.js"></script>
	<script src="/node_modules/pdfmake/build/vfs_fonts.js"></script>
	<script src="libs/js/html2canvas.js"></script>
	
	
	<!-- angular public -->
	<script type="text/javascript" src="public/js/app.js"></script>
	<script type="text/javascript" src="public/controllers/projectsCtrl.js"></script>
	<script type="text/javascript" src="public/controllers/rentedCtrl.js"></script>
	<script type="text/javascript" src="public/controllers/navCtrl.js"></script>
	

</body>
</html>


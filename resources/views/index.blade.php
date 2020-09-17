<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>GSB LES POISSONS Admin.</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>
	<div class="wrapper">

        @include('topbar')
<!-- Sidebar -->
        @include('navbar')
<!-- End Sidebar -->
@php
	$eleve = DB::select('select id from eleve ');$eleve = count($eleve);
	$classe = DB::select('select id from classe ');$classe = count($classe);
	$enseignant = DB::select('select id from enseignant ');$enseignant = count($enseignant);
	$creche = DB::select('select id from creche ');$creche = count($creche);
@endphp
		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Les Poissons</h2>
								<h5 class="text-white op-7 mb-2">Groupe Scolaire bilingue</h5>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
								<a href="#" class="btn btn-secondary btn-round">Add Customer</a>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height shadow">
								<div class="card-body">
									<div class="card-title">Overall statistics</div>
									<div class="card-category">Daily information about statistics in system</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<h6 class="fw-bold mt-3 mb-0">New Students</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-2"></div>
											<h6 class="fw-bold mt-3 mb-0">Classes</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<h6 class="fw-bold mt-3 mb-0">Enseignants</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height shadow">
								<div class="card-body">
									<div class="card-title">Total statistics</div>
									<div class="row py-3">
										<div class="col-md-4 d-flex flex-column justify-content-around">
											<div>
												<h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
												<h3 class="fw-bold">$
													@php
														$it = 0;
														$t = DB::select('select montant from scolarite ');
														foreach ($t as $key) {
															$it += $key->montant;
														}
													@endphp
													{{ number_format($it) }} XAF
												</h3>
											</div>
											<div>
												<h6 class="fw-bold text-uppercase text-danger op-8">Total Depense </h6>
												<h3 class="fw-bold">$
													@php
														$de = 0;
														$d = DB::select('select salaire from enseignant ');
														foreach ($d as $key) {
															$de += $key->salaire;
														}
													@endphp
													{{ number_format($de) }} XAF
												</h3>
											</div>
										</div>
										<div class="col-md-8">
											<div id="chart-container">
												<canvas id="totalIncomeChart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row row-card-no-pd">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row card-tools-still-right">
										<h4 class="card-title">Users Geolocation</h4>
										<div class="card-tools">
											<button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-angle-down"></span></button>
											<button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span class="fa fa-sync-alt"></span></button>
											<button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
										</div>
									</div>
									<p class="card-category">
									Map of the distribution of users around the world</p>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-11">
											<div class="mapcontainer">
												<div id="map-example" class="vmap"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Top Eleves</div>
								</div>
								<div class="card-body pb-0">
									@php
										$best = DB::select('select * from eleve where tranche2 >= 10000 ');
									@endphp
									@foreach ($best as $item)
										<div class="d-flex">
											<div class="avatar">
												<img src="/uploads/enseignant/{{ $item->image }}" alt="..." class="avatar-img rounded-circle">
											</div>
											<div class="flex-1 pt-1 ml-2">
												<h6 class="fw-bold mb-1">{{ $item->name_eleve }} | {{ $item->prenom_eleve }}</h6>
												<small class="text-muted">{{ $item->age }}</small>
											</div>
											<div class="d-flex-1 ml-auto align-items-left">
												<h3 class="text-info fw-bold">{{ number_format($item->inscription) }} XAF</h3>
												<h3 class="text-info fw-bold">{{ number_format($item->tranche1) }} XAF</h3>
												<h3 class="text-info fw-bold">{{ number_format($item->tranche2) }} XAF</h3>
											</div>
										</div>
										<div class="separator-dashed"></div>	
									@endforeach
									
									<div class="pull-in">
										<canvas id="topProductsChart"></canvas>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="card card-primary bg-primary-gradient">
								<div class="card-body">
									<h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Les eleves</h4>
									<h1 class="mb-4 fw-bold">{{ $eleve }}</h1>
									<h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">---------------------</h4>
									<div id="activeUsersChart"></div>
									<h4 class="mt-5 pb-3 mb-0 fw-bold">Les enfants a la creche</h4>
									<ul class="list-unstyled">
										<li class="d-flex justify-content-between pb-1 pt-1"><small></small> <span>{{ $creche }}</span></li>
										<li class="d-flex justify-content-between pb-1 pt-1"><small></small> <span>{{ $creche }}</span></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-header bg-danger-gradient">
									<div class="body card-danger card-head-row">
										<div class="card-title">Les eleves dans le Rouge</div>
										<div class="card-tools">
											<a href="/red_list" class="btn btn-primary btn-block">IMPRIMER LA LISTE</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									@php
										$bad = DB::select('select * from eleve where inscription < 20000 OR tranche1 <= 20000');
									@endphp
									@if ($bad)
										@foreach ($bad as $item2)
										<div class="d-flex">
											<div class="avatar avatar-online">
												<img src="/uploads/enseignant/{{ $item2->image }}" alt="..." class="avatar-img rounded-circle">
											</div>
											<div class="flex-1 ml-3 pt-1">
												<h6 class="text-uppercase fw-bold mb-1">{{ $item2->name_eleve }} | {{ $item2->prenom_eleve }} <span class="text-warning pl-3">{{ $item2->inscription }} | {{ $item2->tranche1 }} | {{ $item2->tranche2 }}</span></h6>
												<span class="text-muted">{{ $item2->tel_parent }}</span>
											</div>
											<div class="float-right pt-1">
												<small class="text-muted">8:40 PM</small>
											</div>
										</div>
										<div class="separator-dashed"></div>
										@endforeach
									@else
										<button class="btn btn-block btn-success">AUCUN ENFANT</button>
									@endif
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@include('footer')
		</div>
		
        <!-- Custom template | don't include it in your project! -->
        @include('rightbar')
		
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	@include('script')

	
@php
	$ens = DB::select('select * from enseignant ');
@endphp
<script>
    Circles.create({
        id:'circles-1',
        radius:45,
        value:60,
        maxValue:100,
        width:7,
        text: {{ $eleve }},
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-2',
        radius:45,
        value:70,
        maxValue:100,
        width:7,
        text: {{ $classe }},
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-3',
        radius:45,
        value:40,
        maxValue:100,
        width:7,
        text: {{ $enseignant }},
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: [
				@php
				foreach ($ens as $items) {
					echo '"'.$items->name_enseignant.'",';
				}
				@endphp
			],
            datasets : [{
                label: "Salaires ",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [
					@php
					foreach ($ens as $items) {
						echo ''.$items->salaire.',';
					}
					@endphp
					0
				],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }],
                xAxes : [ {
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105,103,123,100,95,105,115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>
</body>
</html>
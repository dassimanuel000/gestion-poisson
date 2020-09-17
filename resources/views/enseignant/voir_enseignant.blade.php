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
<body onload="name()">
	<div class="wrapper">

        @include('topbar')
<!-- Sidebar -->
        @include('navbar')
<!-- End Sidebar -->

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
                        @if (session('success'))
                        <script>
                            function name() {
                                swal({
                                    title: "Good job!",
                                    text: "You clicked the button!",
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            text: "Confirm Me",
                                            value: true,
                                            visible: true,
                                            className: "btn btn-success",
                                            closeModal: true
                                        }
                                    }
                                });
                            }
                        </script>
                        <div class="col-md-12">
							<div class="card full-height shadow">
								<div class="card-body">
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                        <b> Bien Ajouter</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (session('error'))
                        <script>
                            function name() {
                                swal("Error!", "You clicked the button!", {
                                    icon : "error",
                                    buttons: {
                                        confirm: {
                                            className : 'btn btn-danger'
                                        }
                                    },
                                });
                            }
                        </script>
                        <div class="col-md-12">
							<div class="card full-height shadow">
								<div class="card-body">
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                        <b>Erreur</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col md-12 col-lg-12 responsive">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ $voir_enseignant->name_enseignant }}</h4>
                                            
                                        </div>
                                        <div class="card-body">
                                            <p class="demo">
                                                <center>
                                                    <div class="avatar avatar-xxl">
                                                        @if ($voir_enseignant->image)
                                                            <img src="../uploads/enseignant/{{ $voir_enseignant->image}}" alt="..." class="avatar-img rounded-circle">
                                                        @else
                                                            <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 m-b-0">
                                                        {{ $voir_enseignant->description }}
                                                    </div>
                                                </center>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="demo">
                                                <h4 class="page-title">Profile</h4>
                                            </p>
                                            <div class="col-md-12 pl-md-0 pr-md-0">
                                                <div class="card card-pricing card-pricing-focus card-">
                                                    <div class="card-header">
                                                        <h4 class="card-title">{{ $voir_enseignant->name_enseignant }}</h4>
                                                        <div class="card-price">
                                                            <span class="price">{{ $voir_enseignant->salaire }}</span>
                                                            <span class="text">/mois</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul class="specification-list">
                                                            <li>
                                                                <span class="name-specification">Classe</span>
                                                                <span class="status-specification">
                                                                    @php
                                                                        $classe = DB::select('select name_classe from classe where id = '.$voir_enseignant->id_classe.'')
                                                                    @endphp
                                                                    @foreach ($classe as $_classe)
                                                                        {{ $_classe->name_classe }}
                                                                    @endforeach
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="name-specification">Matricule</span>
                                                                <span class="status-specification">{{ $voir_enseignant->matricule }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="name-specification">Telephone</span>
                                                                <span class="status-specification">{{ $voir_enseignant->tel_enseignant }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="name-specification">Adresse</span>
                                                                <span class="status-specification">{{ $voir_enseignant->adresse_enseignant }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="name-specification">Salaire</span>
                                                                <span class="status-specification">{{ $voir_enseignant->salaire }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="name-specification">Sexe</span>
                                                                <span class="status-specification">{{ $voir_enseignant->sexe }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="name-specification">A appeler en cas d'urgence</span>
                                                                <span class="status-specification">{{ $voir_enseignant->tel_urgence }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="name-specification">Pret effectue</span>
                                                                <span class="status-specification">{{ $voir_enseignant->pret }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="name-specification">Remboursement vers&eacute;e</span>
                                                                <span class="status-specification">{{ $voir_enseignant->remboursement }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="card-footer">
                                                        <a href="/edit_enseignant/{{ $voir_enseignant->id }}" class="btn btn-primary btn-block"><b>Modifier</b></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="row">
						
                    </div>
                    <br>
					<div class="row row-card-no-pd">
						
					</div>
					<div class="row">
						
					</div>
					<div class="row">
                    </div>
				</div>
			</div>
			@include('footer')
		</div>
		
        <!-- Custom template | don't include it in your project! -->
        @include('rightbar')
		
		<!-- End Custom template -->
	</div>
	@include('script')
</body>
</html>
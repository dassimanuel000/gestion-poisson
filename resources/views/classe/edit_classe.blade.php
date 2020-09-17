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
                                        <b>CLASSE Bien Ajouter</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (session('error'))
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
                        
                        <div class="col-md-8">
							<div class="card full-height shadow">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-12">
                                            <div class="col-md-10">
                                                <center>
                                                    <a href="" class="logo">
                                                        <img src="../assets/img/logo2.svg" alt="navbar brand" height="120px" class="navbar-brand">
                                                    </a>
                                                </center>
                                                <p class="text-center">
                                                    <h3>AJOUTER UNE CLASSE</h3>
                                                </p>
                                            </div>
                                            <form action="{{ route('form_edit_classe') }}" method="GET" enctype="multipart/form-data" class="form-horizontal" role="form">
                                                <input type="hidden" name="id" value="{{ $edit_classe->id }}">
                                                <div class="form-group">
                                                    <label for="name_classe">Nom de la classe</label>
                                                    <input type="name_classe" class="form-control" value="{{ $edit_classe->name_classe }}" id="name_classe" name="name_classe" placeholder="Ex : Cours Prepatoire" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="initial_classe">Initial de la classe</label>
                                                    <input type="text" class="form-control" value="{{ $edit_classe->initial_classe }}" id="initial_classe" name="initial_classe" placeholder="Ex : CP" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pension">La pension totale de la classe</label>
                                                    <input type="number" class="form-control" value="{{ $edit_classe->pension }}" id="pension" name="pension" placeholder="Ex : 70 000" required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="titulaire_classe">Titulaire de la classe</label>
                                                    <select class="form-control form-control" id="titulaire_classe" name="titulaire_classe" required>
                                                            @php
                                                                $name_e = DB::select('select name_enseignant from enseignant where id = '.$edit_classe->titulaire_classe.' ');
                                                            @endphp
                                                            @foreach ($name_e as $item_ens)
                                                                <option value="{{ $item_ens->name_enseignant }}">{{ $item_ens->name_enseignant }}</option>
                                                            @endforeach
                                                        </option>
                                                        @php
                                                            $enseignant = DB::select('select * from enseignant ');
                                                        @endphp
                                                        @if ($enseignant)
                                                            @foreach ($enseignant as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name_enseignant }}</option>
                                                            @endforeach
                                                        @else
                                                        <option value="none">Pas defini</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="card-action">
                                                    <button type="submit" class="btn btn-success">Ajouter</button>
                                                    <button type="reset" class="btn btn-danger">Annuler</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height shadow">
                                <div class="card card-body">
                                    @php
                                        $list = DB::select('select * from classe ');
                                    @endphp
                                    @if ($list)
                                        <ol type="1">    
                                            @foreach ($list as $item)
                                                <li>{{ $item->name_classe}} | {{ $item->initial_classe }}</li>
                                            @endforeach
                                        </ol>
                                    @else
                                        <div class="alert-alert-danger">ERREUR</div>
                                    @endif
                                            
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
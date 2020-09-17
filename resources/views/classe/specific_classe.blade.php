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
                                        <b>Eleve Bien Ajouter</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if (session('error'))
                        <script>
                            function name() {
                                swal("{{ session('error') }}!", "You clicked the button!", {
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
                                    <div class="alert alert-success" role="alert">
                                        {{ session('error') }}
                                        <b>Eleve ete mal ou pas Ajouter</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                    
                        
                        @foreach ($specific_classe as $item)
                        <div class="col-md-4">
							<div class="card card-post card-round">
								<div class="card-body">
									<div class="d-flex">
										<div class="avatar">
											<img src="{{asset('uploads/enseignant/'.$item->image.'')}}" alt="..." class="avatar-img rounded-circle">
										</div>
										<div class="info-post ml-2">
											<p class="username">{{ $item->name_eleve}} | {{ $item->prenom_eleve}}</p>
											<p class="date text-muted">{{ date('d F Y', strtotime($item->age)) }} &agrave; {{ $item->lieu_naissance}}</p>
										</div>
									</div>
									<div class="separator-solid"></div>
									<p class="card-category text-info mb-1"><a href="/print_scolarite/{{ $item->id}}">Imprimer son etat financier</a></p>
									<h5 class="card-s">
                                        <ol type="none">
                                            <li>Nom du Parent : {{ $item->name_parent}}</li>
                                            <li>Telephone du Parent : {{ $item->tel_parent}}</li>
                                            <li>Classe : 
                                                @php
                                                    $id_classe = DB::select('select * from classe where id = '.$item->id_classe.'');
                                                @endphp
                                                @if ($id_classe)
                                                    @foreach ($id_classe as $_item)
                                                        {{ $_item->initial_classe }}
                                                    @endforeach
                                                @else
                                                    Creche
                                                @endif
                                            </li>
                                        </ol>
									</h5>
                                    <p class="card-text">{{ number_format($item->inscription)}}</p>
                                    <p class="card-text">{{ number_format($item->tranche1)}}</p>
                                    <p class="card-text">{{ number_format($item->tranche2)}}</p>
									<a href="/edit_eleve/{{ $item->id}}" class="btn btn-primary btn-rounded btn-block btn-sm">Editer cet &eacute;l&egrave;ve</a>
								</div>
							</div>
						</div>
                        @endforeach
					</div>
					<div class="row">
						
                    </div>
                    
					<div class="row">
						
					</div>
					<div class="row">
                    </div>
				</div>
			</div>
			@include('footer')
		</div>
        @include('rightbar')
		
	</div>
    @include('script')
    <script>
        function print() {
            document.getElementById('print').value = 1;
        }
    </script>
</body>
</html>
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
                                        <b>ok</b>
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
                        <div class="col-md-12">
							<div class="card full-height shadow">
                                <div class="card-header text">
                                    <h3>Listes de tous les entrees financieres</h3> 
                                </div>
								<div class="card-body">
									<div class="row">
                                        @php
                                            use App\scolarite;
                                            use Carbon\carbon;
                                            $all = DB::table('scolarite')
                                                    ->orderBy('updated_at', 'desc')
                                                    ->paginate(20);
                                        @endphp
                                        @if ($all)
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="table-responsive table-hover table-sales">
                                                    <table class="table">
                                                        <thead style="text-transform: uppercase;">
                                                            <tr>
                                                                <td>N*</td>
                                                                <td>Libelle </td>
                                                                <td>Montant </td>
                                                                <td>Date de l'operation</td>
                                                                <td>Depose Par </td>
                                                                <td>Recu Par </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($all as $item)
                                                                <tr>
                                                                    <td>{{ $item->id }}</td>
                                                                    <td>{{ $item->motif }}</td>
                                                                    <td><h6 class="text-uppercase fw-bold mb-1">{{ $item->montant }}</h6></td>
                                                                    <td>{{ date('d F Y H:i:s', strtotime($item->updated_at)) }}<br/>{{ Carbon::parse($item->updated_at)->diffforHumans()}}</td>
                                                                    <td>{{ $item->paiement }}</td>
                                                                    <td>{{ Auth::user()->name }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @else
                                                    <div class="alert alert-danger">AUCUNE</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{ $all->render() }}
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@include('footer')
		</div>
        @include('rightbar')
		
	</div>
    @include('script')
</body>
</html>
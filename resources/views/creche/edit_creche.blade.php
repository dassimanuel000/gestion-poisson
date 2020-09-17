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
                                        <b>Enfant Bien Ajouter</b>
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
                                        <b>Enfant ete mal ou pas Ajouter</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-8">
							<div class="card full-height shadow">
								<div class="card-body">
                                    <table class="table-responsive table" border="0,6" class="table-imprimer">
                                        <thead>
                                            <tr>
                                                <th class="text-center col-md-12" style="background-color:dodgerblue;color:white;width:44440px;" colspan="5">Listes des enfants a la creche </th>
                                            </tr>
                                            <tr>
                                                <td>N*</td>
                                                <td>Nom & Pr&eacute;noms</td>
                                                <td>Paiement </td>
                                                <td>Ann&eacute;e Scolaire</td>
                                                <input type="hidden" name="{{ $i = 1 }}">
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list_creche as $item)
                                                    <tr> 
                                                        <td> {{ $i }}</td>
                                                        <td><span style="text-transform: uppercase">
                                                            {{ $item->name }}
                                                        </span> </td>
                                                        <td> {{ $item->paiement }}</td>
                                                        <td> {{date('Y')}} / {{date('Y')+1}} </td>
                                                        <td> <a href="/edit_creche_id/{{ $item->id }}" class="btn btn-primary btn-block"></a>MODIFIER</td>
                                                        <td> <a href="/delete_creche/{{ $item->id }}" class="btn btn-primary btn-block" onclick="if(confirm('Are you sure ? Vous ne pourez rien modifier') == true){ return true; } else {return false}"></a>SUPPRIMER</td>
                                                    </tr>
                                                    @php $i = $i + 1 ;@endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height shadow">
								<div class="card-body">
									<div class="card-title">Ajouter Un Enfant</div>
									<div class="card-category">Les Ajouts recents</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<h6 class="fw-bold mt-3 mb-0">Nouveaux Enfant</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-2"></div>
											<h6 class="fw-bold mt-3 mb-0">Montant</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<h6 class="fw-bold mt-3 mb-0">Rendements</h6>
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
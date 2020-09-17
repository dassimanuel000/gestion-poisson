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
                        <div class="col-md-8">
							<div class="card full-height shadow">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-12">
                                            <div class="col-md-10">
                                                <center>
                                                    <a href="" class="logo">
                                                        <img src="{{asset('../assets/img/logo2.svg')}}" alt="navbar brand" height="120px" class="navbar-brand">
                                                    </a>
                                                </center>
                                                <p class="text-center">
                                                    <table class="table-responsive table" border="0,6" class="table-imprimer">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="background-color:dodgerblue;color:white;" colspan="5">Listes des eleves prenant le bus</th>
                                                            </tr>
                                                            <tr>
                                                                <td>N*</td>
                                                                <td>Nom & Pr&eacute;noms</td>
                                                                <td>Localisation </td>
                                                                <td>Ann&eacute;e Scolaire</td>
                                                                <td>Action</td>
                                                                <input type="hidden" name="{{ $i = 1 }}">
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($list_bus as $item)
                                                                    <tr> 
                                                                        <td> {{ $i }}</td>
                                                                        <td><span style="text-transform: uppercase">
                                                                            @php
                                                                                $name = DB::select('select name_eleve from eleve where id = '.$item->id_eleve.'', [1])
                                                                            @endphp
                                                                            @foreach ($name as $name_item)
                                                                                {{ $name_item->name_eleve }}
                                                                            @endforeach
                                                                        </span> </td>
                                                                        <td> {{ $item->position }}</td>
                                                                        <td> {{date('Y')}} / {{date('Y')+1}} </td>
                                                                        <td> 
                                                                            <a href="/edit_bus/{{ $item->id }}" class="btn btn-primary btn-block">MODIFIER</a>
                                                                        </td>
                                                                        <td> 
                                                                            <a href="/delete_bus/{{ $item->id }}" class="btn btn-danger btn-block" onclick="if(confirm('Are you sure ? Vous ne pourez rien modifier') == true){ return true; } else {return false}">SUPPRIMER</a>
                                                                        </td>
                                                                    </tr>
                                                                    @php $i = $i + 1 ;@endphp
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
                        </div>
                        <div class="col-md-4">
                            <div class="card full-height shadow">
								<div class="card-body">
									<div class="row col-md-11">
                                        <a href="/print_bus" class="btn btn-primary btn-block btn-lg">IMPRIMER LA LISTE</a>
                                    </div>
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
    <script>
        function print() {
            document.getElementById('print').value = 1;
        }
    </script>
</body>
</html>
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
                        <div class="col-md-8">
							<div class="card full-height shadow">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-12">
                                            <div class="col-md-10">
                                                <p class="text-center">
                                                    <h3>Modifer UN ENSEIGNANT</h3>
                                                </p>
                                                <center>
                                                    <a href="" class="logo">
                                                        <img src="../assets/img/logo2.svg" alt="navbar brand" class="navbar-brand">
                                                    </a>
                                                </center>
                                            </div>
                                            <form action="/form_edit_enseignant/{{ $edit_enseignant->id }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <div class="form-group">
                                                    <label for="name_enseignant">Nom de l'enseignant'</label>
                                                    <input type="name_enseignant" value="{{ $edit_enseignant->name_enseignant }}" class="form-control" id="name_enseignant" name="name_enseignant" placeholder="Nom et prenom" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_classe">Classe assign&eacute;e</label>
                                                    <select class="form-control form-control" id="id_classe" name="id_classe">
                                                        @php
                                                            $classe = DB::select('select * from classe where id = '.$edit_enseignant->id_classe.'');
                                                            $all_classe = DB::select('select * from classe');
                                                        @endphp
                                                        @if ($classe && $all_classe)
                                                            @foreach ($classe as $item)
                                                                <option value="{{ $item->id }}">{{ $item->initial_classe }} |   <pre>   </pre>{{ $item->name_classe }} </option>
                                                            @endforeach
                                                            @foreach ($all_classe as $_all_classe)
                                                            <option value="{{ $_all_classe->id }}">{{ $_all_classe->initial_classe }} |   <pre>   </pre>{{ $_all_classe->name_classe }} </option>
                                                            @endforeach
                                                        @else
                                                        <option value="none">Pas defini</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="age">Age de l'enseignant</label>
                                                    <input type="date"class="form-control" value="{{ $edit_enseignant->age }} name="age" id="age">
                                                </div>
                                                <div class="form-group">
                                                    <label for="matricule">Matricule de l'enseignant'</label>
                                                    <input type="text" class="form-control" id="matricule" value="{{ $edit_enseignant->matricule }}" name="matricule" placeholder="Numero CNI ou Permis" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel_enseignant">Telephone de l'enseignant</label>
                                                    <input type="tel" class="form-control" id="tel_enseignant" value="{{ $edit_enseignant->tel_enseignant }}" name="tel_enseignant" placeholder="+237" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adresse_enseignant">Adresse de l'enseignant'</label>
                                                    <input type="text" class="form-control" id="adresse_enseignant" value="{{ $edit_enseignant->adresse_enseignant }}" name="adresse_enseignant" placeholder="Lieu de residence" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="salaire">Montant du Salaire de Base</label>
                                                    <input type="number" class="form-control" id="salaire" name="salaire" value="{{ $edit_enseignant->salaire }}" placeholder="Montant convenu net" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" value="{{ $edit_enseignant->description }}" name="description" rows="5" placeholder="Facultatif">
                                                        
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sexe">Sexe de l'enseignant</label>
                                                    <select class="form-control form-control" id="defaultSelect" name="sexe">
                                                        <option value="{{ $edit_enseignant->sexe }}">{{ $edit_enseignant->sexe }}</option>
                                                        <option value="MASCULIN">MASCULIN</option>
                                                        <option value="FEMININ">FEMININ</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel_urgence">Telephone d'urgence</label>
                                                    <input type="text" class="form-control" value="{{ $edit_enseignant->tel_urgence }}" id="tel_urgence" name="tel_urgence" placeholder="Appeler en cas d'urgence" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Ajouter une image</label>
                                                    <input type="file" class="form-control-file" name="image" value="{{ $edit_enseignant->image }}" id="image" required>
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
								<div class="card-body">
									<div class="card-title">Ajouter Un enseignant</div>
									<div class="card-category">Les Ajouts recents</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										
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
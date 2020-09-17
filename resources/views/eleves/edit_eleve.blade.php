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
                                            <form action="/form_edit_eleve/{{ $edit_eleve->id }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <div class="form-group">
                                                    <label for="email2">Nom de l'eleve</label>
                                                    <input type="text" class="form-control" id="name_eleve" value="{{ $edit_eleve->name_eleve }}" name="name_eleve" placeholder="Nom de l'eleve" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom_eleve">Prenom de l'eleve</label>
                                                    <input type="text" class="form-control" id="prenom_eleve" value="{{ $edit_eleve->prenom_eleve }}" name="prenom_eleve" placeholder="Prenom de l'eleve" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name_parent">Nom du parent</label>
                                                    <input type="text" class="form-control" id="name_parent" value="{{ $edit_eleve->name_parent }}" name="name_parent" placeholder="Nom du parent" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel_parent">Telephone du Parent</label>
                                                    <input type="tel" class="form-control" id="tel_parent" value="{{ $edit_eleve->tel_parent }}"  name="tel_parent" placeholder="Telephone +237" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel_parent">Adresse de l'Eleve</label>
                                                    <input type="text" class="form-control" id="adresse" value="{{ $edit_eleve->adresse }}"   name="adresse" placeholder="Adresse de l'eleve" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sexe">Sexe de l'Eleve</label>
                                                    <select class="form-control form-control" id="" name="sexe" required>
                                                        <option value="{{ $edit_eleve->sexe }}" selected>{{ $edit_eleve->sexe }}</option>
                                                        <optgroup label="Modifier le sexe"></optgroup>
                                                        <option value="MASCULIN">MASCULIN</option>
                                                        <option value="FEMININ">FEMININ</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_classe">Classe de l'Eleve</label>
                                                    <select class="form-control form-control" id="" name="id_classe" required>
                                                        @php
                                                            $edit_eleve_id_classe = DB::select('select * from classe where id = '.$edit_eleve->id_classe.' ');
                                                        @endphp
                                                            @foreach ($edit_eleve_id_classe as $edit_eleve_id_classe_item)
                                                                <option selected value="{{ $edit_eleve_id_classe_item->id }}"> <div class="col-md-8" style="width: 5vh !important">{{ $edit_eleve_id_classe_item->initial_classe }}</div> | {{ $edit_eleve_id_classe_item->name_classe }}</option>
                                                            @endforeach
                                                        <optgroup label="Modifier la classe"></optgroup>
                                                        @php
                                                            $id_classe = DB::select('select * from classe ');
                                                        @endphp
                                                        @if ($id_classe)
                                                            @foreach ($id_classe as $item)
                                                                <option value="{{ $item->id }}"> <div class="col-md-8" style="width: 5vh !important">{{ $item->initial_classe }}</div> | {{ $item->name_classe }}</option>
                                                            @endforeach
                                                        @else
                                                        <option value="none">Pas defini</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="age">Age de l'Eleve</label>
                                                    <input type="date"class="form-control" value="{{ $edit_eleve->age }}" name="age" id="age" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lieu_naissance">Lieu de Naissance</label>
                                                    <input type="text" class="form-control" value="{{ $edit_eleve->lieu_naissance }}"  id="lieu_naissance" name="lieu_naissance" placeholder="Lieu de naissance de l'eleve">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="name_tuteur">Nom du Tuteur</label>
                                                    <input type="text" class="form-control" value="{{ $edit_eleve->name_tuteur }}"  name="name_tuteur" placeholder="Tuteur de l'eleve">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel_urgence">Telephone d'urgence</label>
                                                    <input type="text" class="form-control" value="{{ $edit_eleve->tel_urgence }}" name="tel_urgence" placeholder="Appeler en cas d'urgence" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">Ajouter une image</label>
                                                    <input type="file" class="form-control-file" value="{{ $edit_eleve->image }}"  name="image" id="exampleFormControlFile1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inscription">Montant de l'inscription</label>
                                                    <input type="number" class="form-control" id="inscription" value="{{ $edit_eleve->inscription }}" name="inscription" placeholder="Montant verse">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tranche1">Montant de la 1<sup>ere</sup> Tranche</label>
                                                    <input type="number" class="form-control" id="tranche1" value="{{ $edit_eleve->tranche1 }}"  name="tranche1" placeholder="Montant verse si y'en a">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tranche2">Montant de la 2<sup>eme</sup> Tranche</label>
                                                    <input type="number" class="form-control" id="tranche2" value="{{ $edit_eleve->tranche2 }}"  name="tranche2" placeholder="Montant verse si y'en a">
                                                </div>
                                                <div class="card-action">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <button type="submit" class="btn btn-success">Ajouter</button>
                                                            <button type="reset" class="btn btn-danger">Annuler</button>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input onclick="print()" class="form-check-input" id="print" name="print_eleve" type="checkbox" value="0">
                                                                    <span onclick="print()" class="form-check-sign">IMPRIMER MAINTENANT</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
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
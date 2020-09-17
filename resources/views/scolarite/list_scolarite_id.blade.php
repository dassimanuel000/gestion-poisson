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
							<div class="card full-height ">
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
							<div class="card full-height ">
								<div class="card-body">
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                        <b>Eleve ete mal ou pas Ajouter</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    <div class="col-md-12">    
                        <div class="row">
                            <div class="col-md-12">  
                                <div class="card body">
                                    <div class="card-body" style="list-style: none;">
                                        <div class="float-left col-md-6">
                                            <li>Noms & Pr&eacute;noms : {{ $list_scolarite_id->name_eleve }}   {{ $list_scolarite_id->prenom_eleve }}</li>
                                            <li>Matricule :  {{ $list_scolarite_id->matricule }}</li>
                                            <li>N&eacute;(e) le : {{ date('d F Y', strtotime($list_scolarite_id->age)) }} &agrave; {{ $list_scolarite_id->lieu_naissance }}</li>
                                            <li>Telephone : {{ $list_scolarite_id->tel_parent }}</li>
                                        </div>
                                        <div class="float-right col-md-6" style="list-style: none;">
                                            <li>
                                                Classe : 
                                                @php
                                                    $id_classe = DB::select('select * from classe where id = '.$list_scolarite_id->id_classe.'');
                                                @endphp
                                                @if ($id_classe)
                                                    @foreach ($id_classe as $_item)
                                                        {{ $_item->initial_classe }}
                                                    @endforeach
                                                @else
                                                    Creche
                                                @endif
                                            </li> 
                                            <li>
                                                Effectif : 
                                                @foreach ($id_classe as $_item)
                                                    {{ $_item->nbre_eleve }}
                                                @endforeach
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-9">    
                            <div class="card body">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="avatar avatar-online">
                                            <span class="avatar-title rounded-circle border border-white bg-info">{{ ($list_scolarite_id->inscription)[0] }}</span>
                                        </div>
                                        <div class="flex-1 ml-3 pt-1">
                                            <h6 class="text-uppercase fw-bold mb-1">Inscription<span class=" @if (($list_scolarite_id->inscription) > 20000 )text-success @else text-warning  @endif  pl-3">{{ number_format($list_scolarite_id->inscription) }}</span></h6>
                                            <span class="text-muted">
                                                @php
                                                    use Carbon\Carbon;
                                                @endphp
                                                {{ Carbon::parse($list_scolarite_id->creadet_at)->diffforHumans()}}
                                            </span>
                                        </div>
                                        <div class="float-right pt-1">
                                            <small class="text-muted">
                                                {{ Carbon::parse($list_scolarite_id->updated_at)->diffforHumans()}}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="avatar avatar-offline">
                                            <span class="avatar-title rounded-circle border border-white bg-secondary">{{ ($list_scolarite_id->tranche1)[0] }}</span>
                                        </div>
                                        <div class="flex-1 ml-3 pt-1">
                                            <h6 class="text-uppercase fw-bold mb-1">Tranche 1<span class=" @if (($list_scolarite_id->tranche1) > 20000 )text-success @else text-danger  @endif  pl-3">{{ number_format($list_scolarite_id->tranche1) }}</span></h6>
                                            <span class="text-muted">
                                                {{ Carbon::parse($list_scolarite_id->updated_at)->diffforHumans()}}
                                            </span>
                                        </div>
                                        <div class="float-right pt-1">
                                            <small class="text-muted">{{ Carbon::parse($list_scolarite_id->updated_at)->diffforHumans()}}</small>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="avatar avatar-away">
                                            <span class="avatar-title rounded-circle border border-white bg-danger">{{ ($list_scolarite_id->tranche2)[0] }}</span>
                                        </div>
                                        <div class="flex-1 ml-3 pt-1">
                                            <h6 class="text-uppercase fw-bold mb-1">Tranche 2<span class=" @if (($list_scolarite_id->tranche2) > 20000 )text-success @else text-danger  @endif  pl-3">{{ number_format($list_scolarite_id->tranche2) }}</span></h6>
                                            <span class="text-muted">{{ Carbon::parse($list_scolarite_id->updated_at)->diffforHumans()}}</span>
                                        </div>
                                        <div class="float-right pt-1">
                                            <small class="text-muted">{{ Carbon::parse($list_scolarite_id->updated_at)->diffforHumans()}}</small>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <p class="text title m-b-1"><b class="card-body">Bilan Financier</b></p>
                                <div class="card-body">
                                    <div class="separator-dashed"></div>
                                    @php
                                        $select = DB::select('select * from scolarite where id_eleve = '.$list_scolarite_id->id.'')
                                    @endphp
                                    @if ($select)
                                        @foreach ($select as $select_item)
                                            <div class="d-flex">
                                                <div class="avatar avatar-offline">
                                                    <span class="avatar-title rounded-circle border border-white bg-secondary">{{ ($select_item->montant)[0] }}</span>
                                                </div>
                                                <div class="flex-1 ml-3 pt-1">
                                                    <h6 class="text-uppercase fw-bold mb-1">{{ $select_item->motif  }} <span class=" @if (($select_item->montant) > 5000 )text-success @else text-danger  @endif  pl-3">{{ number_format($select_item->montant) }}</span></h6>
                                                    <span class="text-muted">Verse Par {{ $select_item->paiement  }} ,Pour {{ $select_item->motif  }} : {{ $select_item->montant  }}.</span>
                                                </div>
                                                <div class="float-right pt-1">
                                                    <small class="text-muted">{{ Carbon::parse($select_item->updated_at)->diffforHumans()}}</small>
                                                </div>
                                            </div>
                                            <div class="separator-dashed"></div>
                                        @endforeach
                                    @else
                                        <button class="btn btn-danger btn-block">AUCUN AUTRE VERSEMENT</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body body">
                                    <p class="title">TOUS LES VERSEMENTS EFFECTUEES PAR UN ELEVE</p>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
        @include('rightbar')
		
	</div>
    @include('script')
</body>
</html>
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
                                @foreach ($list_enseignant as $item)
                                <div class="col-md-4">
                                    <div class="card card-profile">
                                        <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                                            <div class="profile-picture">
                                                <div class="avatar avatar-xl">
                                                    @if ($item->image)
                                                        <img src="../uploads/enseignant/{{ $item->image}}" alt="..." class="avatar-img rounded-circle">
                                                    @else
                                                        <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="user-profile text-center">
                                                <div class="name">{{ $item->name_enseignant}}</div>
                                                <div class="job">
                                                    @php
                                                        $classe = DB::select('select name_classe from classe where id = '.$item->id_classe.'')
                                                    @endphp
                                                    @foreach ($classe as $_classe)
                                                        {{ $_classe->name_classe }}
                                                    @endforeach
                                                </div>
                                                <div class="desc">
                                                    @if ($item->description)
                                                        {{ $item->description}}
                                                    @else
                                                        Description
                                                    @endif
                                                </div>
                                                <div class="social-media">
                                                    <a class="btn btn-info btn-twitter btn-sm btn-link" href="#"> 
                                                        <span class="btn-label just-icon"><i class="flaticon-whatsapp"></i>+237  {{ $item->tel_enseignant}}</span>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
                                                        <span class="btn-label just-icon"><i class="flaticon-plus"></i> </span> 
                                                    </a>
                                                    <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#"> 
                                                        <span class="btn-label just-icon"><i class="flaticon-book"></i> </span> 
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
                                                        <span class="btn-label just-icon"><i class="flaticon-cold"></i>+237 {{ $item->tel_urgence}} </span> 
                                                    </a>
                                                </div>
                                                <div class="view-profile">
                                                    <a href="/voir_enseignant/{{ $item->id }}" class="btn btn-secondary btn-block">Voir Full Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row user-stats text-center">
                                                <div class="col">
                                                    <div class="number">
                                                        @php
                                                            //use Carbon\Carbon;
                                                        @endphp
                                                        {{ /*Carbon::parse*/($item->created_at[5]).($item->created_at[6])/*->diffforHumans()*/}}
                                                    </div>
                                                    <div class="title">Recruter il y'a</div>
                                                </div>
                                                <div class="col">
                                                    <div class="number">{{ $item->salaire}} </div>
                                                    <div class="title">Salaire</div>
                                                </div>
                                                <div class="col">
                                                    <div class="number">{{ ($item->salaire)-($item->salaire)}} </div>
                                                    <div class="title">Dette</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                @endforeach
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
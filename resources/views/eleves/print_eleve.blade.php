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

	<!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css">
    
    <style>
        .float-left{
            color: #000 !important;
            font-weight: 500;
            letter-spacing: normal;
            list-style: none;
        }
        .input-disappear{
            background: none;
            border: none;
            content: none;
        }
        #DataTable:hover .input-disappear{
            background: initial;
            border: 0.5px solid dimgray;
        }
        .nonen{
            background: none;
            border: none;
            content: none;
            display: none;
        }
    </style>
</head>
<body onload="name()">
    <div class="">
        @if (session('print_eleve'))
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
        @endif
        <div class="col-md-12">
            <div class="full-width">
                <div class="row">
                            @php
                                //$print_eleve = DB::select('select * from eleve ');
                                //$count = count($print_eleve);
                                $print_eleve = DB::select('select * from eleve where id = '.$last_id.'', [1])
                            @endphp
                        @foreach ($print_eleve as $item)
                            <section class="contain-imprimer">
                                <div class="div-cadre" style="font-family: Arial, Helvetica, sans-serif;">
                                    <div class="col-md-12 row text-center align-center" style="margin-left: 15%;">
                                        <center>
                                            <img src="{{asset('assets/cadre.jpg')}}" width="700px" height="130px" class="responsive img-responsive" style="background-size:cover;margin-left: 5%;"/>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="float-left col-md-6">
                                            <li>Noms & Pr&eacute;noms : {{ $item->name_eleve }}   {{ $item->prenom_eleve }}</li>
                                            <li>Matricule :  {{ $item->matricule }}</li>
                                            <li>N&eacute;(e) le : {{ date('d F Y', strtotime($item->age)) }} &agrave; {{ $item->lieu_naissance }}</li>
                                            <li>Telephone : {{ $item->tel_parent }}</li>
                                        </div>
                                        <div class="float-right col-md-6" style="list-style: none;">
                                            <li>
                                                Classe : 
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
                                            <li>
                                                Effectif : 
                                                @foreach ($id_classe as $_item)
                                                    {{ $_item->nbre_eleve }}
                                                @endforeach
                                            </li>
                                        </div>
                                        <br><br><br><br>
                                        <table class="table-responsive table" border="0,6" class="table-imprimer">
                                            <tr>
                                                <th class="text-center" style="background-color:dodgerblue;color:white;width:40000px !important;" colspan="9">RECU DE PAIEMENT</th>
                                            </tr>
                                            <tr border="1px">
                                                <th style="background-color:rgba(173, 216, 230, 0.534);">Inscription</th>
                                                <th style="background-color:rgba(173, 216, 230, 0.534);">1 <sup>&egrave;me </sup> Tranche</th>
                                                <th style="background-color:rgba(173, 216, 230, 0.534);">2 <sup>&egrave;me </sup> Tranche</th>
                                                <th style="background-color:rgba(173, 216, 230, 0.534);">Bilan Financier</th>
                                                <th style="background-color:rgba(173, 216, 230, 0.534);">Fait le | &agrave; </th>
                                            </tr>
                                            <tr>
                                                <th style="">{{ number_format($item->inscription) }}</th>
                                                <th style="">{{ number_format($item->tranche1) }} </th>
                                                <th style="">{{ number_format($item->tranche2) }} </th>
                                                <th style="">
                                                    @php
                                                        $select = DB::select('select * from scolarite where id_eleve = '.$item->id.'')
                                                    @endphp
                                                    @if ($select)
                                                        @foreach ($select as $select_item)
                                                            {{ $select_item->motif  }} : {{ $select_item->montant  }}
                                                            <br>
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </th>
                                                <th style="">{{ date('d F Y H:i:s', strtotime($item->updated_at)) }}</th>
                                            </tr>
                                        </table>
                                    </div>
                                    <ol type="none">
                                        <li>
                                            Reste a Payer : 
                                            @php
                                                $pension = DB::select('select * from classe where id = '.$item->id_classe.'');
                                            @endphp
                                            @if ($pension)
                                                @foreach ($pension as $pension_item)
                                                    {{ number_format( ($item->inscription)+($item->tranche1)+($item->tranche2) - ($pension_item->pension)) }} XAF
                                                @endforeach
                                            @else
                                                0
                                            @endif
                                        </li> 
                                    </ol>
                                    <div class="row">
                                        <div style="text-align:left;" class="col-md-8"> 
                                            <p class="text small">
                                                Nom et Signature du deposant :
                                            </p>
                                        </div>
                                        <div style="text-align:right;" class="col-md-4"> 
                                            <p class="text small">
                                                Signature et Cachet :
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="putain">
                <div class="row">
                    <div class="col-md-3" >
                        <button class="btn btn-primary" id="account_client" onclick="printF()">
                            IMPRIMER
                        </button>
                    </div>
                    <div class="col-md-5">
                        <a class="btn btn-danger" href="/dashboard">
                            BACK TO HOME
                        </a>
                    </div>
                </div>
            </div>
        </div>
	</div>
</body>


<script>
    function prins() {
        window.print();
    }
    function dispar() {
        var repar = document.getElementById('putain');
        repar.classList.remove("nonen");
        repar.classList.add("visiblese");
        document.getElementById("imprimt").style.display="none";
    }
    function printF() {
        var none = document.getElementById('putain');
        none.classList.add("nonen");

        if (confirm('Are you sure ? Vous ne pourez rien modifier') == true) {
            setTimeout(prins, 50);
        } else {
            setTimeout(dispar, 5000);
        }
        setTimeout(dispar, 50);
    }
</script>
</html>
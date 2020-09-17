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
                    <section class="contain-imprimer">
                        <div class="div-cadre" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="col-md-12 row text-center align-center" style="margin-left: 15%;">
                                <center>
                                    <img src="{{asset('assets/cadre.jpg')}}" width="700px" height="130px" class="responsive img-responsive" style="background-size:cover;margin-left: 5%;"/>
                                </center>
                            </div>
                        </div>
                                <div class="col-md-12">
                                    <div class="col">
                                        <div class="float-left col-md-6">
                                            <li>Noms & Pr&eacute;noms : <b style="text-transform: uppercase;">{{ $print_creche->name }} ,  {{ $print_creche->prenom }}</b> </li>
                                            <li>N&eacute;(e) le : {{ date('d F Y', strtotime($print_creche->age)) }} &agrave; {{ $print_creche->lieu_naissance }}</li>
                                            <li>Telephone : {{ $print_creche->tel_parent }}</li>
                                        </div>
                                        <div class="float-right col-md-6" style="list-style: none;">
                                            <li>
                                                Effectif : 
                                                @php
                                                    $count_creche = DB::select('select * from creche ');
                                                    $count_creche = count($count_creche);
                                                    echo $count_creche;
                                                @endphp
                                            </li>
                                            <li>Fait le : {{ date('d F Y', strtotime(date('Y-m-d'))) }} &agrave; {{ (date('H:i:s')) }}
                                                
                                            </li>
                                        </div>
                                        
                                       <table class="table-responsive table" border="0,6" class="table-imprimer">
                                        <tr>
                                            <th class="text-center" style="background-color:dodgerblue;color:white;width:40000px !important;" colspan="9">RECU DE PAIEMENT</th>
                                            </tr>
                                            <tr border="1px">
                                                <th style="background-color:rgba(173, 216, 230, 0.534);">Montant verse</th>
                                                <th style="background-color:rgba(173, 216, 230, 0.534);">{{ number_format($print_creche->paiement) }} XAF</th>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div style="text-align:left;" class="col-md-8"> 
                                            <p class="text small">
                                                Nom et Signature  :
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
                        <a class="btn btn-danger" href="/list_creche">
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
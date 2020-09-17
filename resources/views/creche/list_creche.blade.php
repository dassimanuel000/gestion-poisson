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
                                    <p class="text-center">
                                        <table class="table-responsive table" border="0,6" class="table-imprimer">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="background-color:dodgerblue;color:white;width:40000px !important;" colspan="9">Listes des enfants &agrave; la creche </th>
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
                                                        </tr>
                                                        @php $i = $i + 1 ;@endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </p>
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
                        <a class="btn btn-danger" href="/add_creche">
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
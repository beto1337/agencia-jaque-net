<head>
    <meta charset="UTF-8">
    <title> Agencia jaque - @yield('htmlheader_title', 'agencia jaque') </title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
<link rel='shortcut icon' type='image/x-icon' href='https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/Favicon-Jaque-01.png' />

<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css"/>

<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- datePicker-->


    <!--end datePicker-->

    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset('/css/skins/skin-purple.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.css')}}">
    <style>
    body{
    font-family: 'Open Sans', sans-serif !important;
    }
@media (min-width: 767px){
  .logo{
    height: 80px !important;
  }
  .navbar-static-top{
    background-color:black !important;
    height: 80px !important;
    padding-top: 15px !important;
    font-size: 15px !important;
;
  }
  .main-sidebar{
  padding-top: 80px;
  }
}
#pendientes{
  padding: 0px !important;
}
#espera{
  padding: 0px !important;
}
#proceso{
  padding: 0px !important;
}
#aprobacion{
  padding: 0px !important;
}
.content-wrapper{
  background-color: white;
}
.main-sidebar{
  background-color: #000000 !important;
}
.main-sidebar a:hover{
  color: #d91982 !important;
}
.navbar-static-top{
  background-color:black !important;
}
.logo{
  background-color:black !important;
  padding-top: 15px;
}
.logo-lg{
  padding-top: 15px;
}
.logo-mini{
  padding-top: 15px;
}


 table {
    border-collapse: collapse !important;
}

 table, th, td {
    border: 2px solid #D91982 ;
}

.user-header{
  background-color: black !important;
}
      .myButton {
      	-moz-box-shadow:inset 0px 1px 0px 0px #eb0cd1;
      	-webkit-box-shadow:inset 0px 1px 0px 0px #eb0cd1;
      	box-shadow:inset 0px 1px 0px 0px #eb0cd1;
      	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff00cc), color-stop(1, #5a0fa1));
      	background:-moz-linear-gradient(top, #ff00cc 5%, #5a0fa1 100%);
      	background:-webkit-linear-gradient(top, #ff00cc 5%, #5a0fa1 100%);
      	background:-o-linear-gradient(top, #ff00cc 5%, #5a0fa1 100%);
      	background:-ms-linear-gradient(top, #ff00cc 5%, #5a0fa1 100%);
      	background:linear-gradient(to bottom, #ff00cc 5%, #5a0fa1 100%);
      	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff00cc', endColorstr='#5a0fa1',GradientType=0);
      	background-color:#ff00cc;
      	-moz-border-radius:3px;
      	-webkit-border-radius:3px;
      	border-radius:3px;
      	border:1px solid #670280;

      	cursor:pointer;
      	color:#ffffff;
      	font-family:Arial;
      	font-size:13px;
      	font-weight:bold;
        margin-top:   5px;
      	padding:6px 24px;
      	text-decoration:none;
      	text-shadow:2px 2px 2px #200730;
      }
      .myButton:hover {
      	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #5a0fa1), color-stop(1, #ff00cc));
      	background:-moz-linear-gradient(top, #5a0fa1 5%, #ff00cc 100%);
      	background:-webkit-linear-gradient(top, #5a0fa1 5%, #ff00cc 100%);
      	background:-o-linear-gradient(top, #5a0fa1 5%, #ff00cc 100%);
      	background:-ms-linear-gradient(top, #5a0fa1 5%, #ff00cc 100%);
      	background:linear-gradient(to bottom, #5a0fa1 5%, #ff00cc 100%);
      	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5a0fa1', endColorstr='#ff00cc',GradientType=0);
      	background-color:#5a0fa1;
      }
      .myButton:active {
      	position:relative;
      	top:1px;
      }
      .labeltitle{
        padding:0px;
        margin:0px;
        font-size:14px;
        font-family: 'Open Sans', sans-serif !important;

      }
      .titulopanel{
        padding:5px !important;
        background-color:black !important;
        color:white !important;
        font-size: 14px;
        font-family: 'Open Sans', sans-serif !important;
      }
      #titulo{
        padding:10px !important;
        background-color: #D91982 !important;
        font-size: 22px !important;
      }
      .kv-file-upload{
        display: none !important;
      }
      .fileinput-upload{
        display: none !important;
      }
      thead tr {
        background-color:  #D91982 !important;
      }
      .table{
        margin-bottom: 0px !important;
      }
      table{
        margin-bottom: 0px !important;
      }
      </style>

</head>

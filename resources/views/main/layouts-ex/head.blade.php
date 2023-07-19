<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>{{ $company->name }} :. {{ $company->tagline }} </title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="{{ URL::to('/storage'); }}/{{ $company->icon_url  }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ URL::to('/assets/css/bootstrap.min.css'); }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{ URL::to('/assets/plugins/fontawesome/css/fontawesome.min.css'); }}">
		<link rel="stylesheet" href="{{ URL::to('/assets/plugins/fontawesome/css/all.min.css'); }}">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css'); }}">

		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="{{ URL::to('assets/plugins/fancybox/jquery.fancybox.min.css'); }}">

		<!-- Daterangepikcer CSS -->
		<link rel="stylesheet" href="{{ URL::to('assets/plugins/daterangepicker/daterangepicker.css'); }}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ URL::to('/assets/css/style.css'); }}">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
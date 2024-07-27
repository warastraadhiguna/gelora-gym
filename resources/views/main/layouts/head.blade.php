<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    {{-- particulary for ngrok thing --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">   
    <meta name="csrf-token" content="{{ csrf_token() }}">     
    {{-- --------------------- --}}
	  <title>{{ $company->name }} :. {{ $company->tagline }} </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ URL::to('/storage') }}/{{ $company->icon_url  }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/plugins/fontawesome/css/all.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/css/feather.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/css/owl.carousel.min.css">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/css/aos.css">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/plugins/fancybox/jquery.fancybox.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/css/bootstrap-datetimepicker.min.css">
    
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/plugins/select2/css/select2.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/plugins/fancybox/jquery.fancybox.min.css">    

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ URL::to('/')}}/assets/css/custom.css">
  <script src="{{ URL::to('/')}}/assets/js/sweetalert2.all.min.js"></script>

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
<!DOCTYPE html>
<html lang="en">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<head>
		<title>Dashboard Owner | Toko Seru</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Blazor, Django, Flask & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta property="og:locale" content="ID" />
		<meta property="og:type" content="content" />
		<meta property="og:title" content="Dashboard Owner| Toko Seru" />
		<meta property="og:site_name" content="Dashboard Owner| Toko Seru" />
		<link rel="shortcut icon" href="{{ asset('assets/images/logo_ts.png') }}" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
		<link href="{{ asset('assets/owner/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/owner/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/owner/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/owner/css/custom.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true" class="bg-white">
		@include('owner/layout-dashboard/header')

		@include('owner/layout-dashboard/footer')
	</body>
</html>
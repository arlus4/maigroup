<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
		<title>Dashboard MaiTea</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="ID" />
		<meta property="og:type" content="content" />
		<meta property="og:title" content="Dashboard Admin| MaiTea" />
		<meta property="og:site_name" content="Dashboard Admin| MaiTea" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="canonical" href="index.html" />
		<link rel="shortcut icon" href="{{ asset('assets/images/ic_maitea.png') }}" />
		<link href="{{ asset('assets/master/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/master/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/master/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/master/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/master/css/custom.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
	</head>
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<script>
			var defaultThemeMode = "light"; 
			var themeMode; 
			if ( document.documentElement ) { 
				if ( document.documentElement.hasAttribute("data-theme-mode")) { 
					themeMode = document.documentElement.getAttribute("data-theme-mode"); 
				} else { 
					if ( localStorage.getItem("data-theme") !== null ) { 
						themeMode = localStorage.getItem("data-theme"); 
					} else { 
						themeMode = defaultThemeMode; 
					} 
				} 
				if (themeMode === "system") { 
					themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; 
				} 
				document.documentElement.setAttribute("data-theme", themeMode); 
			}
		</script>
		
		@include('layout-master/header')

		@include('layout-master/footer')
	</body>
</html>
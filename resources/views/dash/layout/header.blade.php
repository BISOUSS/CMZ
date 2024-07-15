<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMZ</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('dash/images/logos/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('dash/css/styles.min.css')}}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include('dash.layout.aside')


        <div class="body-wrapper">
            @include('dash.layout.navbar')
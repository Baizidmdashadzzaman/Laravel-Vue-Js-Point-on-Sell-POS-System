<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name','Laravel Vue POS')  }}</title>

        <!-- Fonts -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/> 
        <link href="{{asset('assets/css/ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}" type="text/css" rel="stylesheet">
        <link href="{{asset('assets/css/OverlayScrollbars.css')}}" type="text/css" rel="stylesheet"/>
        <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
        <link href="{{asset('assets/css/asad.css')}}" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>

        
        <script src="{{asset('assets/js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/OverlayScrollbars.js')}}" type="text/javascript"></script>
        <script>
        	$(function() {
        	$("#items").height(552);
        	$("#items").overlayScrollbars({overflowBehavior : {
        		x : "hidden",
        		y : "scroll"
        	} });
        	$("#cart").height(445);
        	$("#cart").overlayScrollbars({ });
            });
        </script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</html>

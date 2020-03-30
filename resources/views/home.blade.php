<!DOCTYPE html>
<html>

<head>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title> Single Page Forum </title>
</head>

<body>
    <div id="app">
        <v-app>
            <v-content>
                <app-home></app-home>
            </v-content>
        </v-app>
    </div>

    <script src="{{asset('js/app.js')}}"></script>

</body>

</html>
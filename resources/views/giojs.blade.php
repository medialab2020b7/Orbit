<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <!-- Gio.js -->
        <script src="{{ asset('js/giojs/three.min.js')}}"></script>
        <script src="{{ asset('js/giojs/gio.min.js')}}"></script>
        <script src="{{ asset('js/giojs/sample-data.js')}}"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Gio.js
                </div>
                <div id="globeArea" style="width: 400px; height: 400px"></div>
            </div>
        </div>

        <script>
                var container = document.getElementById( "globeArea" );
                var controller = new GIO.Controller( container );
                controller.addData( data );
                controller.init();
        </script>
    </body>
</html>

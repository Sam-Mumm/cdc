<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
                CDC - 
            @show
        </title>
        @section('css')
            {{ HTML::style('_static/css/screen.css'); }}
        @show
    </head>
    <body>
        @yield('content')
        
        @section('javascript')
            <script data-id="App.Config">
                var App = {};
                var basePath = '',
                    commonPath = '{{ URL::to("/") }}/assets/',
                    rootPath = '{{ URL::to("/") }}/',
                    secureToken = '{{ csrf_token() }}';

                // this will setup the headers on every ajax request you make via jquery
                // we need a secure token here
                $(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': secureToken
                        }
                    });
                });
            </script>
            {{ HTML::script('_static/js/jquery.min.js'); }}
        @show
    </body>
</html>

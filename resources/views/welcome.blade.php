<!DOCTYPE html>
<html>
    <head>
        <title>Test App</title>
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    </head>
    <body>
        @include('_partials.language_switcher')

        <div class="card col-md-6 col-md-offset-1">
            <h1>{{ trans('app.test_heading') }}</h1>
        </div>
    </body>
</html>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <title>Laravel</title>
    </head>
    <body>
        <div class="container">

            <div class="repo-info">
                <a href="https://github.com/{{ $repository->owner }}" class="repo-owner" target="_blank">{{ $repository->owner }}</a> / <a href="https://github.com/{{ $repository->owner }}/{{ $repository->name }}" class="repo-name" target="_blank">{{ $repository->name }}</a>
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3>Visitors</h3>
                </div>

                <div class="panel-body">
                    <canvas id="trafficChart" width="300" height="80"></canvas>
                </div>

                <div class="panel-footer summary-stats" style="">
                    <ul>
                        <li><span class="num">{{ $views->sum('count') }}</span> Views</li>
                        <li><span class="num">{{ $views->sum('uniques') }}</span> Unique Visitors</li>
                    </ul>
                </div>

            </div>
        </div>

        <script>
            window.chartData = {
                labels: [
                    @foreach ($views->reverse() as $view)
                    '{{ $view->timestamp }}'@if (!$loop->last),@endif
                    @endforeach
                ],
                count: [
                    @foreach ($views->reverse() as $view)
                    {{ $view->count }}@if (!$loop->last),@endif
                    @endforeach
                ],
                uniques: [
                    @foreach ($views->reverse() as $view)
                    {{ $view->uniques }}@if (!$loop->last),@endif
                    @endforeach
                ],
                max: {{ $views->pluck('count')->max() }}
            };
        </script>

        <script src="{{ mix('/js/manifest.js') }}"></script>
        <script src="{{ mix('/js/vendor.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>

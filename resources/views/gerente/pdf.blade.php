<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    @yield('styles')
    <style>
        body {
            grid-template-areas:
            "body";
            grid-template-columns: 1fr;
        }
    </style>
    <title>Teste</title>
</head>
<body>
    <main>
        <div id="content">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Total de conversões</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuario as $u)
                    <tr>
                        <td>{{ $u->nome }}</td>
                        <td>{{ number_format($u->contratados / ($u->total == 0 ? 1 : $u->total) * 100, 0) }}%</td>
                    </tr>
                    @endforeach
                    @if (count($usuario) == 0)
                    <tr>
                        <td colspan="1">Nenhum dado registrado</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </main>
    <footer>

    </footer>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    @if (session('status'))
    <script>
        $.toast({
            heading: '{{ session('header') }}',
            text: '{{ session('message') }}',
            icon: '{{ session('status') }}',
            loader: true,        // Change it to false to disable loader
        })
    </script>
    @endif
    @yield('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <table style="border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; width: 100%; margin: 0 auto; position: relative; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                <thead style="height: 60px; background: #1B1717; color: #fff;">
                    <tr>
                        <th>Nome</th>
                        <th>Total de conversões</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach ($usuario as $u)
                    <tr style="font-family: OpenSans-Regular; font-size: 15px; color: gray; line-height: 1.2; font-weight: unset; height: 50px; border-bottom: 1px solid #f5f5f5;">
                        <td>{{ $u->nome }}</td>
                        <td>{{ number_format($u->contratados / ($u->total == 0 ? 1 : $u->total) * 100, 0) }}%</td>
                    </tr>
                    @endforeach
                    @if (count($usuario) == 0)
                    <tr style="font-family: OpenSans-Regular; font-size: 15px; color: gray; line-height: 1.2; font-weight: unset; height: 50px; border-bottom: 1px solid #f5f5f5;">
                        <td colspan="20">Nenhum dado registrado</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>

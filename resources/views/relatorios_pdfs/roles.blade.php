<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEAS - Relatório de funções</title>
</head>

<body>

    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="text-align: center !important">
        <tr>
            <td width="50%">
                <img src="{{ public_path('img/system/feas-logo.png') }}" style="width: 100px">
            </td>
            <td width="50%" style="font-size: 16px">
                <b>Rline Telecom LTDA</b><br>
                Rua Cinco - Área Industrial<br>
                CNPJ: 13.500.755/0001-05<br>
                46 3555-8000 / Matriz<br>
                suporte@rline.com.br<br>
            </td>
        </tr>
    </table>

    <div id="middle" style="text-align: center !important">
    <hr>
        <h3>Relatório de funções</h3>
        <hr>
        <span style="font-size: 12px">
            <a value="{{date_default_timezone_set('America/Sao_Paulo')}}"></a>
            Este relatório foi gerado dia {{ date('d/m/Y') }} às {{ date('H:i:s') }} por {{ Auth::user()->name }}
        </span><br><br>
    </div>

    <div class="container" style="text-align: left !important;">
        <table width="100%">
            <thead>
                <tr style="background-color: #F1F1F1 !important">
                    <th><b>#</b></th>
                    <th><b>Nome</b></th>
                    <th><b>Alterável?</b></th>
                    <th><b>Regras</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $role)
                <tr>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $role->id }}</td>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $role->name }}</td>
                    <td style="border-bottom: 1px solid #ddd !important;">
                        @if ($role->unalterable === 1)
                            Não
                        @else
                            Sim
                        @endif
                    </td>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $rules->where('role_id', $role->id)->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
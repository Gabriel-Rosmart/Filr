<!DOCTYPE html>
<html>
<head>
    <title>Permiso nº {{ $uuid }}</title>
    <style>
        .datatbl {
            border-collapse: collapse;
            width: 100%;
        }
        .datatbl td, .datatbl th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .datatbl tr:nth-child(even){background-color: #f2f2f2;}
        .datatbl tr:hover {background-color: #ddd;}
        .datatbl th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Permiso de ausencias e retrasos xustificados</h1>
    <table class="datatbl">
        <tr>
            <td>Nome e apelidos:</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td>DNI:</td>
            <td>{{ $dni }}</td>
        <tr>
            <td>Data:</td>
            <td>{{ $date }}</td>
        </tr>
        <tr>
            <td>Hora de entrada:</td>
            <td>{{ $entry }}</td>
        </tr>
        <tr>
            <td>Hora de saída:</td>
            <td>{{ $exit }}</td>
        </tr>
        <tr>
            <td>Tipo de Permiso</td>
            <td>{{ $type }}</td>
        </tr>
        <tr>
            <td>Documentación aportada</td>
            <td>{{ $documentation }}</td>
        </tr>
    </table>
</body>
</html>
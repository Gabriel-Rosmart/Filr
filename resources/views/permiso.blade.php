<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Anexo V - Concesión de Permisos e Licenzas</title>
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

            .container
            {
                height: 90%;
                border: 1px solid #1f1f1f;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Anexo V - Concesión de Permisos e Licenzas</h1>
            </div>
            <div class="row">
                <h2>1.- Solicitante</h2>
                <table class="datatbl">
                    <tr>
                        <td>Nome e apelidos</td>
                        <td>{{ $name }}</td>
                    </tr>
                    <tr>
                        <td>DNI</td>
                        <td>{{ $dni }}</td>
                    </tr>
                    <tr>
                        <td>Teléfono</td>
                        <td>{{ $phone }}</td>
                    </tr>
                    <tr>
                        <td>Enderezo electrónico</td>
                        <td>{{ $email }}</td>
                    </tr>
                    <tr>
                        <td>Corpo</td>
                        <td>{{ $body }}</td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <h2>2.- Permiso Solicitado</h2>
                <table class="datatbl">
                    <tr>
                        <td>Data de Inicio</td>
                        <td>{{ $date_st }}</td>
                    </tr>
                    <tr>
                        <td>Data de Fin</td>
                        <td>{{ $date_nd }}</td>
                    </tr>
                    <tr>
                        <td>Hora de entrada</td>
                        <td>{{ $entry }}</td>
                    </tr>
                    <tr>
                        <td>Hora de saída</td>
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
            </div>
        </div>
    </body>
</html>
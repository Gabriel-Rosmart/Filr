<!DOCTYPE html>

@php
$orderedDate = [];
$prevDate = '';
    foreach ($user->files as $file){
        if ($file->date != $prevDate){
            $prevDate = $file->date;
            array_push($orderedDate, ['date' => $file->date, 'timestamp' => [$file->timestamp]]);
        }else{
            foreach ($orderedDate as &$date){
                if ($date['date'] == $prevDate){
                    array_push($date['timestamp'], $file->timestamp);
                }
            }
        }
    }
    
@endphp

@php
if(!function_exists('entryFiles')){
    function entryFiles($files){
        $shifts = [];
        for ($i = 0; $i < count($files['timestamp']); $i++){
            if ($i % 2 == 0){
                array_push($shifts, $files['timestamp'][$i]);
            }
        }
        return $shifts;
    }
}
@endphp
    
@php
if(!function_exists('exitFiles')){
    function exitFiles($files){
        $shifts = [];
        for ($i = 0; $i < count($files['timestamp']); $i++){
            if ($i % 2 == 1){
                array_push($shifts, $files['timestamp'][$i]);
            }
        }
        return $shifts;
    }
}
@endphp
<html>
    <head>
        <style>
            table{
                width: 100%;
            }
            .title{
                width: 100%;
                text-align: center;
                text-transform: uppercase;
            }
            .filesTable, .filesTable  td, .filesTable tr{
                border: 1px solid black;
                padding: 2px;
                border-collapse: collapse;
                margin-left: 5px;
            }
            .tableTitle td{
                padding: 3px;
                text-align: center;
                font-weight: bolder;
                background-color: lightgray;
            }
        </style>
    </head>
    <body>
       <h1>Reporte de fichajes</h1>
       <p>Período {{ $period }}</p>

       <div>
        <table class="userData">
            <tr>
                <td><b>ID:</b></td>
                <td>{{ $user->id }}</td>
                <td><b>Empleado:</b></td>
                <td>{{ $user->name }}</td>
                <td><b>DNI:</b></td>
                <td>{{ $user->dni }}</td>
            </tr>
            <tr>
                <td><b>Email:</b></td>
                <td>{{ $user->email }}</td>
                <td><b>Teléfono:</b></td>
                <td>{{ $user->phone }}</td>
                <td><b>Puesto:</b></td>
                <td>
                    @if ($user->role->role_name == 'nonteacher')
                        No docente
                    @elseif ($user->role->role_name == 'teacher')
                        Docente
                    @endif
                </td>
            </tr>
        </table>
        <div>
            <p><b>Franjas comprendidas:</b></p>
            @foreach ($range as $rng)
                <p>{{ $rng->start_date }} a {{ $rng->end_date }}</p>
            @endforeach
        </div>
       </div>

       <br>
       <hr>
       <br>

       
       <div>
            <h4 class="title">INFORME DE FICHAJES</h4>
            <table class='filesTable'>
                <tr class='tableTitle'>
                    <td>Fecha</td>
                    <td>Hora de Entrada</td>
                    <td>Hora de Salida</td>
                    <td>Incidencia</td>
                </tr>
                @foreach ( $orderedDate as $file)
                    <tr>
                        <td>{{ $file['date'] }}</td>   
                        <td>
                            @foreach ( entryFiles($file) as $shift)
                                <p>
                                    {{ $shift }}
                                </p>
                            @endforeach
                        </td>                    
                        <td>
                            @foreach ( exitFiles($file) as $shift)
                                <p>
                                    {{ $shift }}
                                </p>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($user->incidences as $incidence)
                                <div>
                                    @if($incidence->date == $file['date'])
                                        <p>
                                        @if ($incidence->subject  == 'early')
                                            Salida anticipada por {{ $incidence->minutes }} minutos
                                        @elseif ($incidence->subject  == 'late')
                                            Retraso en entrada por {{ $incidence->minutes }} minutos
                                        @elseif ($incidence->subject  == 'absent')
                                            Ausente
                                        @endif
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </td>
                        
                    </tr>        
                @endforeach 
            </table>
       </div>
      
       
    </body>
</html>

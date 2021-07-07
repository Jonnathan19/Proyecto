<html>
    <head>
        <meta http-equiv="refresh" content="5">
    </head> 
    <body>
        <?php
        function conectarBD(){ 
                    $server = "127.0.0.1";
                    $usuario = "root";
                    $pass = "";
                    $BD = "realtime";
                    //variable que guarda la conexión de la base de datos
                    $conexion = mysqli_connect($server, $usuario, $pass, $BD); 
                    //Comprobamos si la conexión ha tenido exito
                    if(!$conexion){ 
                    echo 'Ha sucedido un error inexperado en la conexion de la base de  	       datos<br>'; 
                    } 
                    //devolvemos el objeto de conexión para usarlo en las consultas  
                    return $conexion; 
            }  
            /*Desconectar la conexion a la base de datos*/
            function desconectarBD($conexion){
                    //Cierra la conexión y guarda el estado de la operación en una variable
                    $close = mysqli_close($conexion); 
                    //Comprobamos si se ha cerrado la conexión correctamente
                    if(!$close){  
                    echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>'; 
                    }    
                    //devuelve el estado del cierre de conexión
                    return $close;         
            }

            //Devuelve un array multidimensional con el resultado de la consulta
            function getArraySQL($sql){
                //Creamos la conexión
                $conexion = conectarBD();
                //generamos la consulta
                if(!$result = mysqli_query($conexion, $sql)) die();

                $rawdata = array();
                //guardamos en un array multidimensional todos los datos de la consulta
                $i=0;
                while($row = mysqli_fetch_array($result))
                {   
                    //guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
                    $rawdata[$i] = $row;
                    $i++;
                }
                //Cerramos la base de datos
                desconectarBD($conexion);
                //devolvemos rawdata
                return $rawdata;
            }

            //Sentencia SQL


        $sql = "select *from senses order by id desc limit 1;";

        //Array Multidimensional
        $rawdata = getArraySQL($sql);
        $temperatura=$rawdata[0][1];
        echo $temperatura;
        ?>
    </body>
</html>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" >
                <h2>Sense</h2>
                </div>
                <div class="card-body">
                        <figure class="highcharts-figure">
                    
                            <div id="container-temperature" class="chart-container"></div>
                        </figure>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script type='text/javascript'>

        var gaugeOptions = {
          chart: {
            type: 'solidgauge'
          },
        
          title: "Sensor",
        
          pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
              backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
              innerRadius: '60%',
              outerRadius: '100%',
              shape: 'arc'
            }
          },
        
          exporting: {
            enabled: false
          },
        
          tooltip: {
            enabled: false
          },
        
          // the value axis
          yAxis: {
            stops: [
              [0.1, '#55BF3B'], // green
              [0.5, '#DDDF0D'], // yellow
              [0.9, '#DF5353'] // red
            ],
            lineWidth: 0,
            tickWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
              y: -70
            },
            labels: {
              y: 16
            }
          },
        
          plotOptions: {
            solidgauge: {
              dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
              }
            }
          }
        };
        
        // The speed gauge
        var chartSpeed = Highcharts.chart('container-temperature', Highcharts.merge(gaugeOptions, {
          yAxis: {
            min: 0,
            max: 35,
            title: {
              text: 'Temperatura'
            }
          },
        
          credits: {
            enabled: false
          },
        
          series: [{
            name: 'Temperatura',
            data: [0],
            dataLabels: {
              format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y}</span><br/>' +
                '<span style="font-size:12px;opacity:1">ºC</span>' +
                '</div>'
            },
            tooltip: {
              valueSuffix: 'ºC'
            }
          }]
        
        }));
        
        // Bring life to the dials
        setInterval(function () {
          // Temperature
          var point,
            newVal,
            tem,
            inc;
        
            if (chartSpeed) {
                point = chartSpeed.series[0].points[0];
            tem=<?php echo $temperatura;?>;
                newVal = tem;
        
                if (newVal < 2 || newVal > 200) {
                    newVal = point.y - inc;
                }
        
                point.update(newVal);
            }
        
        }, 2000);
        
        
    </script>

    
@endpush
   
  
    
   
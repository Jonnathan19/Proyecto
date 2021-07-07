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
               echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>'; 
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
$sql = "SELECT val,date from senses;";
//Array Multidimensional
$rawdata = getArraySQL($sql);

//Adaptar el tiempo
for($i=0;$i<count($rawdata);$i++){
    $time = $rawdata[$i]["date"];
    $data = new DateTime($time);
    $rawdata[$i]["date"]=$data->getTimestamp()*1000;
}
?>


<HTML>
    <BODY>
    
    <meta charset="utf-8"> 
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
    <script src="http://code.highcharts.com/stock/highstock.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    
    <div id="container">
    </div>
    
    
    <script type='text/javascript'>
$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: true
            }
        });
    
        var chart;
        $('#container').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
                        
                    }
                }
            },
            title: {
                text: 'Physical Variables'
            },
            xAxis: {
                title: {
                    text: 'Value'
                },
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Temperatura (°C)'
                },
                plotLines: [{
                    value: 5,
                    width: 5,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: true
            },
            exporting: {
                enabled: true
            },
            series: [{
                name: 'Temperatura',
                     data: (function() {
                         var data = [];
                    <?php
                        for($i = 0 ;$i<count($rawdata);$i++){
                    ?>
                    data.push([<?php echo $rawdata[$i]["date"];?>,<?php echo $rawdata[$i]["val"];?>]);
                    <?php } ?>
                return data;
                     })()     
            }]
        });
    });
    
});

</script>
    </html>
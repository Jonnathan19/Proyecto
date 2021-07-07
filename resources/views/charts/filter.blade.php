<?php

//Adaptar el tiempo
for($i=0;$i<count($rawdata);$i++){
    $time = $rawdata[$i]["date"];
    $data = new DateTime($time);
    $rawdata[$i]["date"]=$data->getTimestamp()*1000;
}
?>


@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" >
                    <h2>Filtro de grafica historica</h2>                    
                </div>
                <div class="card-body">                             
                    <figure class="highcharts-figure">                    
                        <div id="container" class="chart-container"></div>
                    </figure>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
    <script src="http://code.highcharts.com/stock/highstock.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

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
        credits: {
        enabled: false
        },
        title: {
            text: 'Filtro historico de temperatura'
        },
        xAxis: {
            title: {
                    text: 'Fecha'
                },
            type: 'datetime',
            tickPixelInterval: 50
        },
        yAxis: {
            title: {
                text: 'Temperatura (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
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
            enabled: false
        },
        exporting: {
            enabled: false
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


    
@endpush
<?php
session_start();
require_once("../../../../../conexion.php");
?> 
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Highcharts Example</title>

		<style type="text/css">
#container {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#sliders td input[type="range"] {
    display: inline;
}

#sliders td {
    padding-right: 1em;
    white-space: nowrap;
}

		</style>
	</head>
	<body>
<script src="../../code/highcharts.js"></script>
<script src="../../code/highcharts-3d.js"></script>
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>
<script src="../../code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <!--<p class="highcharts-description">
        <i>*OPPO includes OnePlus since Q3 2021</i><br><br>
        Chart demonstrating the use of a 3D pie layout.
        The "Xiaomi" slice has been selected, and is offset from the pie.
        Click on slices to select and unselect them.
        Note that 3D pies, while decorative, can be hard to read, and the
        viewing angles can make slices close to the user appear larger than they
        are.
    </p>-->
</figure>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Reporte Estadístico de Torta 3D',
        align: 'left'
    },
    /*subtitle: {
        text: 'Source: ' +
            '<a href="https://www.counterpointresearch.com/global-smartphone-share/"' +
            'target="_blank">Counterpoint Research</a>',
        align: 'left'
    },*/
    subtitle: {
        text: 'Elaborado por Ana Maria Cordero Sandoval',
        align: 'left'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        /*name: 'Share',*/
        name: 'Porcentaje de detalle',
        data: [
            /*['Samsung', 23],
            ['Apple', 18],
            {
                name: 'Xiaomi',
                y: 12,
                sliced: true,
                selected: true
            },
            ['Oppo*', 9],
            ['Vivo', 8],
            ['Others', 30]*/
            <?php
            $sql=$db->Prepare("SELECT * FROM terapeutas_pacientes WHERE estado='A'");
            $rs=$db->GetAll($sql);
            foreach($rs as $k=>$fila)
            {
            ?>
            ['<?php echo $fila["detalle"]; ?>', <?php echo $fila["precio"]; ?>],
            <?php
            }
            ?>
        ]
    }]
});

		</script>
	</body>
</html>

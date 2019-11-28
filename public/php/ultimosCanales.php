<script src="../grafica/highcharts.js"></script>
<script src="../grafica/modules/series-label.js"></script>
<script src="../grafica/modules/exporting.js"></script>
<script src="../grafica/modules/export-data.js"></script>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "laboratorio";

$conn = mysqli_connect($servername, $username, $password, $bdname);
// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 


    //petición sql para obbtener los dos últimos dos ingresos a través del uso de DESC LIMIT pasando el número de parametros que deseamos obtener
    $consulta = "SELECT * from canales ORDER BY fecha DESC LIMIT 2";

    if($resultado=mysqli_query($conn, $consulta)){
        if(mysqli_num_rows($resultado)){
            while($row = mysqli_fetch_assoc($resultado)){
                $idCanal = $row['id'];
                $nombreCanal = $row['nombreCanal'];
                $descripcion = $row['descripcion'];
                $url = $row['url'];
                $url=mysqli_real_escape_string($conn,$url);
               // $url [strlen($url)-2] = "\0";
                
                $fecha = $row['fecha'];

                $sql= "SELECT * from datossensores WHERE id_canal = '$idCanal'";

                $data = "[";
                $hora = "[";

                if($resultS=mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($resultS)){
                        while($row = mysqli_fetch_assoc($resultS)){
                            $data .= $row['dato'] .",";
                            $hora .= "'".$row['fecha']."',";
                        }
                    }
                }else{
                    echo "Error";
                }

                $data = $data."]";
                $hora = $hora."]";

                
                //$data [strlen($data)-1] = "]";
                //$hora [strlen($hora)-1] = "]";

                

                echo "
                <section id=\"grafica\">
                            <div id=\"".$url."\" style=\"margin: 0 auto\"></div>
                            <br>
                            <script type=\"text/javascript\">
Highcharts.chart('".$url."', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Datos del canal ".$nombreCanal."'
    },
    subtitle: {
        text: '".$descripcion."'
    },
    xAxis: {
        title: {
            text: 'Tiempo'
        },
        categories:".$hora."
    },
    yAxis: {
        title: {
            text: 'RSS'
        },
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: '".$url."',
        marker: {
            symbol: 'square'
        },
        data:".$data."

    }]
});
        </script>
                    </section>";






            }
        }
    }

?>
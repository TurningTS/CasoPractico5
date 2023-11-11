<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Rest</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fs-3 mb-4" style="color: white; font-size:large">
        <div>Caso Practico 5</div>
        <div>Equipo 4</div>
    </nav>
    <div class="container">
        <div class="mb-3">
            <h3>Datos meteorologicos</h3>
            <p class="text-muted">Introduce el nombre de una ciudad (en ingles)</p>
        </div>
        <form action="getWeather.php" method="post" style="width: 75vw;">
            <div class="row mb-3">
                <div class="col">
                <input type="text" name="ciudad" class="form-control">
                </div>
                <div class="col"></div>
            </div>
            <button type="submit" class="btn btn-success mb-3">Aceptar</button>
        </form>
        <?php
            if (empty($_POST)) {
                $ciudad="Tuxtla Gutierrez";
            }
            else {
                $ciudad = $_POST['ciudad'];
            }
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://weatherapi-com.p.rapidapi.com/current.json?q=".$ciudad,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: weatherapi-com.p.rapidapi.com",
                    "X-RapidAPI-Key: 629b9d72e7msh4e127d0741b9025p1941f5jsn49c7917c6816"
                ],
            ]);
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $datos = json_decode($response,true);
                ?>
                <table class="table table-dark table-striped" style="width: auto;">
                    <tbody>
                        <tr>
                            <td style="font-weight: bold;">Nombre de la ciudad</td>
                            <td><?php echo $datos['location']['name']; ?></td>
                            <td style="font-weight: bold;">Temperatura</td>
                            <td><?php echo $datos['current']['temp_c']; ?>°C</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Estado</td>
                            <td><?php echo $datos['location']['region']; ?></td>
                            <td style="font-weight: bold;">Velocidad del viento</td>
                            <td><?php echo $datos['current']['wind_kph']; ?>km/h</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">País</td>
                            <td><?php echo $datos['location']['country']; ?></td>
                            <td style="font-weight: bold;">Dirección del viento</td>
                            <td><?php echo $datos['current']['wind_dir']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Fecha y hora</td>
                            <td><?php echo $datos['location']['localtime']; ?></td>
                            <td style="font-weight: bold;">Precipitación</td>
                            <td><?php echo $datos['current']['precip_mm']; ?>mm</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Latitud</td>
                            <td><?php echo $datos['location']['lat']; ?></td>
                            <td style="font-weight: bold;">Humedad</td>
                            <td><?php echo $datos['current']['humidity']; ?>%</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Longitud</td>
                            <td><?php echo $datos['location']['lon']; ?></td>
                            <td style="font-weight: bold;">Día o noche</td>
                            <td><?php if($datos['current']['is_day'] == 1){ echo 'Día';}
                            else { echo 'Noche'; } ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
        ?>
        <a href="getResult.php" class="btn btn-warning">Cara o cruz</a>
        <a href="getSearch.php" class="btn btn-info">Busqueda</a>
    </div>
</body>
</html>
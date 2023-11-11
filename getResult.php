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
            <h3>Cara o cruz</h3>
            <p class="text-muted">Voltea la moneda</p>
        </div>
        <form action="getResult.php" method="post" style="width: 75vw;">
            <button type="submit" class="btn btn-success mb-3">Voltear</button>
        </form>
        <?php
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://coin-flip1.p.rapidapi.com/headstails",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: coin-flip1.p.rapidapi.com",
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
                    <div class="text-center">
                        <?php
                            if($datos['outcome']=="Heads"){
                                ?> <img src="img/cara.png" alt="" class="rounded">
                                <br><label class="text-muted">Cara</label><?php
                            }
                            else{
                                ?> <img src="img/cruz.png" alt="" class="rounded">
                                <br><label class="text-muted">Cruz</label><?php
                            }
                        ?>
                    </div>
                <?php
            }
        ?>
        <br>
        <a href="getWeather.php" class="mt-3 mb-3 btn btn-secondary">Clima</a>
        <a href="getSearch.php" class="btn btn-info">Busqueda</a>
    </div>
</body>
</html>
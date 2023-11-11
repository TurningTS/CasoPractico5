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
            <h3>Realiza una busqueda</h3>
            <p class="text-muted">Busca algo por internet</p>
        </div>
        <form action="getSearch.php" method="post" style="width: 75vw;">
            <div class="row mb-3">
                <div class="col">
                <input type="text" name="busqueda" class="form-control">
                </div>
                <div class="col"></div>
            </div>
            <button type="submit" class="btn btn-info mb-3">Buscar</button>
        </form>
        <table class="table table-dark table-striped" style="width: auto;">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descripción</th>
                <th scope="col">URL</th>
            </thead>
            <tbody>
                <?php
                    if (!(empty($_POST))){
                        $busqueda = $_POST['busqueda'];

                        $curl = curl_init();

                        curl_setopt_array($curl, [
                            CURLOPT_URL => "https://real-time-web-search.p.rapidapi.com/search?q=".$busqueda,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => [
                                "X-RapidAPI-Host: real-time-web-search.p.rapidapi.com",
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
                            for($x = 0; $x < 10; $x++) {
                                ?>
                                <tr>
                                    <td><?php echo $datos['data'][$x]['position']; ?></td>
                                    <td><?php echo $datos['data'][$x]['title']; ?></td>
                                    <td><?php echo $datos['data'][$x]['snippet']; ?></td>
                                    <td><a href="<?php echo $datos['data'][$x]['url'];?>">Link</a></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                ?>
            </tbody>
        </table>
        <br>
        <a href="getResult.php" class="btn btn-warning">Cara o cruz</a>
        <a href="getWeather.php" class="mt-3 mb-3 btn btn-secondary">Clima</a>
    </div>
</body>
</html>
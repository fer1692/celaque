<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <title>Cálculo</title>
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 mx-auto formulario">
                <div class="row">
                    <div class="col-12">
                        <h3 class="mt-3 text-center">Cálculo de la Cuota Mensual</h3>
                    </div>
                </div>
                <form action="" class="row" method="POST">
                    <div class="col-12">
                        <label>Monto del Préstamo</label> <br>
                        <input class="inputNumberBox" type="text" name="monto" id="monto" required maxlength="20" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                    <div class="col-12">
                        <label>Tasa de interés anual (en porcentaje)</label> <br>
                        <input class="inputNumberBox" type="text" name="interes" id="interes" required maxlength="20" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                    <div class="col-12">
                        <label>Plazo del préstamo en meses</label> <br>
                        <input class="inputNumberBox" type="text" name="plazo" id="plazo" required maxlength="20" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                    <div class="col-12 mt-2 text-center">
                        <input type="submit" name="calcular" value="Calcular">
                        <button id="limpiarCampos">Limpiar campos</button>
                    </div>
                </form>

                <?php
                    $monto = $_POST['monto'];
                    $interes = $_POST['interes'];
                    $plazo = $_POST['plazo'];
                    $calcular = $_POST['calcular'];

                    if (isset($calcular)) {

                        $cuota_mensual = (($monto * $interes * pow( (1 + $interes), $plazo )) / pow( (1 + $interes), $plazo ) - 1);
                        echo "La cuota mensual es de: L " . $english_format_number = number_format($cuota_mensual);
                        
                        $con = new mysqli('localhost', 'root', 'root', 'celaque');

                        if($con === false){
                            die("ERROR: No se pudo conectar la base de datos. " . mysqli_connect_error());
                        }
                        
                        $sql = "INSERT INTO cuotas VALUES (now(), '$cuota_mensual')";
                        
                        if(mysqli_query($con, $sql)){
                            echo "<p>Los datos han sido almacenados en la base de datos.</p>";
                        } else {
                            echo "ERROR: Los datos no han sido almacenados en una base de datos $sql. "
                                . mysqli_error($con);
                        }

                        echo "<hr>";
                        echo '<h4 class="text-center">Historial de Cuotas Ingresadas</h4>';

                        $sql_query = "SELECT * FROM cuotas";
                        $result = $con->query($sql_query);

                        if ($result->num_rows > 0) {
                            
                            echo '<table class="table">
                                    <tr>
                                        <th>Fecha de Cálculo</th>
                                        <th>Cuota Mensual</th>
                                    </tr>';

                            while($row = $result->fetch_assoc()) {
                            echo '
                                    <tr>
                                        <td>' . $row['fecha_de_calculo'] . '</td>
                                        <td>' . $row['cuota_mensual'] . '</td>
                                    </tr>
                                ';
                            }

                            echo '</table>';

                        } else {
                        echo "0 results";
                        }
                        
                        mysqli_close($con);
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="./js/scripts.js"></script>

</body>
</html>
<?php 
// Seleccionar mes actual
$monthList = ["Enero","Febrero","Marzo","Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
$month = $monthList[(int)date("m")-1];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Calendarios</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74e2cb 0%, #74e2a9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: linear-gradient(180deg, #ffffff 0%, #f5fffb 100%);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            max-width: 900px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #3ccbad 0%, #3ccb84 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            color: #666;
            font-size: 1em;
        }

        .form-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-field {
            display: flex;
            flex-direction: column;
        }

        .form-field label {
            font-weight: 600;
            color: #00CED1;
            margin-bottom: 8px;
            font-size: 0.95em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-field select,
        .form-field input {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1em;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-field select:focus,
        .form-field input:focus {
            outline: none;
            border-color: #00CED1;
            box-shadow: 0 0 0 3px rgba(0, 206, 209, 0.1);
        }

        .form-field select:hover,
        .form-field input:hover {
            border-color: #00CED1;
        }

        .form-field select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
            padding-right: 40px;
            color: #00CED1;
        }

        .form-field input[type="number"] {
            color: #00CED1;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn {
            padding: 14px 40px;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #49d6b8 0%, #49d690 100%);
            color: white;
            flex: 1;
            max-width: 300px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 206, 209, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .calendar-container {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        table {
            border-collapse: collapse;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .mes {
            font-size: 28px;
            font-weight: bold;
            padding: 20px;
            color: white;
            background: linear-gradient(135deg, #42ceaf 0%, #42ce87 100%);
            text-align: center;
        }

        .cabecera {
            padding: 15px;
            background: #40E0D0;
            color: white;
            text-align: center;
            font-weight: 600;
            min-width: 60px;
            font-size: 0.9em;
        }

        .celda {
            width: 60px;
            height: 60px;
            text-align: center;
            vertical-align: middle;
            padding: 8px;
            background: white;
            color: #333;
            font-weight: 500;
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
            cursor: default;
            font-size: 18px;
        }

        .celda:hover {
            background: #E0FFFF;
            box-shadow: 0 4px 12px rgba(0, 206, 209, 0.15);
        }

        .vacio {
            width: 60px;
            height: 60px;
            text-align: center;
            vertical-align: middle;
            background: #f8f9fa;
            border: 1px solid #f0f0f0;
        }

        .festivo {
            width: 60px;
            height: 60px;
            text-align: center;
            vertical-align: middle;
            padding: 8px;
            background: white;
            color: #d84949;
            font-weight: 700;
            border: 2px solid #ffebee;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .festivo:hover {
            background: #ffebee;
            box-shadow: 0 4px 12px rgba(216, 73, 73, 0.15);
        }

        .finde {
            width: 60px;
            height: 60px;
            text-align: center;
            vertical-align: middle;
            padding: 8px;
            background: #E0FFFF;
            color: #00CED1;
            font-weight: 600;
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .finde:hover {
            background: #B0E0E6;
            box-shadow: 0 4px 12px rgba(0, 206, 209, 0.15);
        }

        .festivo_y_finde {
            width: 60px;
            height: 60px;
            text-align: center;
            vertical-align: middle;
            padding: 8px;
            background: #ffebee;
            color: #d84949;
            font-weight: 700;
            border: 2px solid #ffcdd2;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .festivo_y_finde:hover {
            box-shadow: 0 4px 12px rgba(216, 73, 73, 0.25);
        }

        .legend {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px solid #e0e0e0;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9em;
            color: #666;
        }

        .legend-box {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7em;
            font-weight: 600;
        }

        .legend-box.dias-regulares {
            background: white;
            border: 1px solid #e0e0e0;
            color: #333;
        }

        .legend-box.fin-de-semana {
            background: #E0FFFF;
            border: 1px solid #e0e0e0;
            color: #00CED1;
        }

        .legend-box.festivo {
            background: white;
            border: 2px solid #ffebee;
            color: #d84949;
        }

        .legend-box.festivo-fin {
            background: #ffebee;
            border: 2px solid #ffcdd2;
            color: #d84949;
        }

        .error-message {
            background: #ffebee;
            border: 2px solid #ffcdd2;
            color: #d84949;
            padding: 15px 20px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .form-group {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .header h1 {
                font-size: 1.8em;
            }

            .container {
                padding: 25px;
            }

            .celda, .vacio, .festivo, .finde, .festivo_y_finde {
                width: 50px;
                height: 50px;
                font-size: 0.85em;
            }

            .cabecera {
                padding: 10px;
                font-size: 0.75em;
                min-width: 50px;
            }

            .mes {
                font-size: 20px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .celda, .vacio, .festivo, .finde, .festivo_y_finde {
                width: 40px;
                height: 40px;
                font-size: 0.75em;
                padding: 5px;
            }

            .cabecera {
                padding: 8px;
                font-size: 0.6em;
                min-width: 40px;
            }

            .mes {
                font-size: 18px;
                padding: 12px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-primary {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📅 Generador de Calendarios</h1>
            <p>Selecciona mes y año para generar tu calendario</p>
        </div>

        <form action="calendario.php" method="post">
            <div class="form-group">
                <div class="form-field">
                    <label for="mes">Mes</label>
                    <select name="mes" id="mes">
                        <option value=1 <?php echo ($month == 'Enero') ? 'selected' : ''; ?>>Enero</option>
                        <option value=2 <?php echo ($month == 'Febrero') ? 'selected' : ''; ?>>Febrero</option>
                        <option value=3 <?php echo ($month == 'Marzo') ? 'selected' : ''; ?>>Marzo</option>
                        <option value=4 <?php echo ($month == 'Abril') ? 'selected' : ''; ?>>Abril</option>
                        <option value=5 <?php echo ($month == 'Mayo') ? 'selected' : ''; ?>>Mayo</option>
                        <option value=6 <?php echo ($month == 'Junio') ? 'selected' : ''; ?>>Junio</option>
                        <option value=7 <?php echo ($month == 'Julio') ? 'selected' : ''; ?>>Julio</option>
                        <option value=8 <?php echo ($month == 'Agosto') ? 'selected' : ''; ?>>Agosto</option>
                        <option value=9 <?php echo ($month == 'Septiembre') ? 'selected' : ''; ?>>Septiembre</option>
                        <option value=10 <?php echo ($month == 'Octubre') ? 'selected' : ''; ?>>Octubre</option>
                        <option value=11 <?php echo ($month == 'Noviembre') ? 'selected' : ''; ?>>Noviembre</option>
                        <option value=12 <?php echo ($month == 'Diciembre') ? 'selected' : ''; ?>>Diciembre</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="anio">Año (1990 - 2030)</label>
                    <input type="number" name="anio" id="anio" value="<?php echo date("Y")?>" min="1990" max="2030">
                </div>
            </div>

            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-primary">Generar Calendario</button>
            </div>
        </form>

        <?php
        
        function obtener_dias_mes($mes, $anio) {
            $esBisiesto = date("L",strtotime("$anio-01-01"));
            
            if ($esBisiesto == 1 && $mes == "2") {
                return 29;
            }
            switch ($mes) {
                case '4':
                case '6':
                case '9':
                case '11':
                    return 30;
                    break;
                case '1':
                case '3':
                case '5':
                case '7':
                case '8':
                case '10':
                case '12':
                    return 31;
                    break;
                case '2':
                    return 28;
                    break;   
                default:
                    break;
            }
        }
        
        function obtener_primer_dia_semana($mes, $anio) {
            $diaSemana = date("l",strtotime("$anio-$mes-01"));
            
            switch ($diaSemana) {
                case 'Monday':
                    return 1;
                    break;
                case 'Tuesday':
                    return 2;
                    break;
                case 'Wednesday':
                    return 3;
                    break;
                case 'Thursday':
                    return 4;
                    break;
                case 'Friday':
                    return 5;
                    break;
                case 'Saturday':
                    return 6;
                    break;
                case 'Sunday':
                    return 7;
                    break;
                
                default:
                    break;
            }
        }
        
        function esFestivo($dia,$mes,$anio){
            $dias_festivos = ["1-1","6-1","3-4","1-5","15-8","12-10","8-12","25-12"];
            $dia_referencia = date("N",strtotime("$anio-$mes-$dia"));
            
            if (in_array(("$dia-$mes"), $dias_festivos, true) && ($dia_referencia == 6 || $dia_referencia == 7)) {
              return "festivo_y_finde";  
            } elseif ($dia_referencia == 6 || $dia_referencia == 7) {
              return "finde";
            } elseif (in_array(("$dia-$mes"), $dias_festivos, true)){
              return "festivo";
            }
        }
        
        if (isset($_POST["submit"])) {
            $mes = $_POST["mes"];
            $anio = $_POST["anio"];
            
            switch ($mes) {
                case '1':
                    $mesLetras = "Enero";
                    break;
                case '2':
                    $mesLetras = "Febrero";
                    break;
                case '3':
                    $mesLetras = "Marzo";
                    break;
                case '4':
                    $mesLetras = "Abril";
                    break;
                case '5':
                    $mesLetras = "Mayo";
                    break;
                case '6':
                    $mesLetras = "Junio";
                    break;
                case '7':
                    $mesLetras = "Julio";
                    break;
                case '8':
                    $mesLetras = "Agosto";
                    break;
                case '9':
                    $mesLetras = "Septiembre";
                    break;
                case '10':
                    $mesLetras = "Octubre";
                    break;
                case '11':
                    $mesLetras = "Noviembre";
                    break;
                case '12':
                    $mesLetras = "Diciembre";
                    break;
                
                default:
                    break;
            }
            
            if (isset($_POST["anio"]) === true && $_POST["anio"] >= 1990 && $_POST["anio"] <= 2030) {
        ?>
        <div class="calendar-container">
        <table>
            <tr>
                <th class="mes" colspan=7><?php echo $mesLetras." - ".$anio ?></th>
            </tr>
            <tr>
                <th class="cabecera">Lunes</th>
                <th class="cabecera">Martes</th>
                <th class="cabecera">Miércoles</th>
                <th class="cabecera">Jueves</th>
                <th class="cabecera">Viernes</th>
                <th class="cabecera">Sábado</th>
                <th class="cabecera">Domingo</th>
            </tr> 
            <?php 
            $dayCount = 1;
            echo "<tr>"; 
                 for ($i=1; $i < obtener_primer_dia_semana($mes,$anio); $i++) {  
                    echo "<td class='vacio'>  </td>";
                 }
                 for ($j=0; $j < 8-obtener_primer_dia_semana($mes,$anio); $j++) { 
                    if (esFestivo($dayCount,$mes,$anio)=="festivo_y_finde") {
                        echo "<td class='festivo_y_finde'> $dayCount </td>";
                    } elseif (esFestivo($dayCount,$mes,$anio)=="festivo") {
                        echo "<td class='festivo'> $dayCount </td>";
                    } elseif (esFestivo($dayCount,$mes,$anio)=="finde") {
                        echo "<td class='finde'> $dayCount </td>";
                    } else {
                        echo "<td class='celda'> $dayCount </td>";
                    }
                    $dayCount++;
                 }
            echo "</tr>";

            // Luego el resto de la tabla
            while ($dayCount <= obtener_dias_mes($mes,$anio)) {
                echo "<tr>"; 
                    for ($i=0; $i < 7; $i++) { 
                        if ($dayCount <= obtener_dias_mes($mes,$anio)) {
                            if (esFestivo($dayCount,$mes,$anio)=="festivo_y_finde") {
                            echo "<td class='festivo_y_finde'> $dayCount </td>";
                            } elseif (esFestivo($dayCount,$mes,$anio)=="festivo") {
                                echo "<td class='festivo'> $dayCount </td>";
                            } elseif (esFestivo($dayCount,$mes,$anio)=="finde") {
                                echo "<td class='finde'> $dayCount </td>";
                            } else {
                                echo "<td class='celda'> $dayCount </td>";
                            }
                            $dayCount++;
                        } else {
                            echo "<td class='vacio'>  </td>";
                        }
                    }
                echo "</tr>";
            }
        ?> </table>
        </div>

        <div class="legend">
            <div class="legend-item">
                <div class="legend-box dias-regulares">1</div>
                <span>Días regulares</span>
            </div>
            <div class="legend-item">
                <div class="legend-box fin-de-semana">1</div>
                <span>Fin de semana</span>
            </div>
            <div class="legend-item">
                <div class="legend-box festivo">1</div>
                <span>Festivos</span>
            </div>
            <div class="legend-item">
                <div class="legend-box festivo-fin">1</div>
                <span>Festivo y fin de semana</span>
            </div>
        </div>

        <?php
            } else {
        ?>
            <div class="error-message">
                ⚠️ Año inválido. Por favor selecciona un año entre 1990 y 2030.
            </div>
        <?php
            }
        }
        ?>
    </div>
</body>
</html>
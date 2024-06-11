<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h3>Leiber Mauricio Gomez Trejo</h3>
        <h3>9A DyGS</h3>
        <h1>Calculadora</h1>
        <form method="POST">
            <div class="input-group">
                <label for="valor1">Valor 1:</label>
                <input type="number" id="valor1" name="valor1" required>
            </div>
            <div class="input-group">
                <label for="valor2">Valor 2:</label>
                <input type="number" id="valor2" name="valor2" required>
            </div>
            <div class="button-group">
                <button type="submit" name="operacion" value="sumar">Sumar</button>
                <button type="submit" name="operacion" value="restar">Restar</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validación de datos
            $valor1 = filter_input(INPUT_POST, 'valor1', FILTER_VALIDATE_INT);
            $valor2 = filter_input(INPUT_POST, 'valor2', FILTER_VALIDATE_INT);
            $operacion = filter_input(INPUT_POST, 'operacion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $errores = [];

            if ($valor1 === false) {
                $errores[] = "El valor 1 no es un número válido.";
            }

            if ($valor2 === false) {
                $errores[] = "El valor 2 no es un número válido.";
            }

            if (empty($operacion) || !in_array($operacion, ['sumar', 'restar'])) {
                $errores[] = "Operación no válida.";
            }

            if (empty($errores)) {
                try {
                    $resultado = 0;

                    if ($operacion == "sumar") {
                        $resultado = $valor1 + $valor2;
                    } elseif ($operacion == "restar") {
                        $resultado = $valor1 - $valor2;
                    }

                    echo "<div class='result'>Resultado: " . htmlspecialchars($resultado) . "</div>";
                } catch (Exception $e) {
                    echo "<div class='error'>Se ha producido un error: " . htmlspecialchars($e->getMessage()) . "</div>";
                }
            } else {
                foreach ($errores as $error) {
                    echo "<div class='error'>" . htmlspecialchars($error) . "</div>";
                }
            }
        }
        ?>
    </div>
</body>
</html>

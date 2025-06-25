<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora IMC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .invalid-feedback {
            display: none;
        }
        input.is-invalid + .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body class="container mt-4">

<h4 class="alert alert-info text-center">Calculadora de IMC</h4>
<div class="row">
    <div class="col-md-4">
        <form method="GET" id="formIMC" novalidate>
            <div class="mb-3">
                <label for="height" class="form-label">Agrega tu altura (m)</label>
                <input type="text" name="height" id="height" class="form-control" required inputmode="decimal"
                    value="<?php echo isset($_GET['height']) ? htmlspecialchars($_GET['height']) : ''; ?>">
                <div class="invalid-feedback">Solo se permiten números positivos (ej. 1.65)</div>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Agrega tu peso (kg)</label>
                <input type="text" name="weight" id="weight" class="form-control" required inputmode="decimal"
                    value="<?php echo isset($_GET['weight']) ? htmlspecialchars($_GET['weight']) : ''; ?>">
                <div class="invalid-feedback">Solo se permiten números positivos (ej. 60.5)</div>
            </div>
            <div class="mb-3">
                <input type="submit" value="Calcular" class="btn btn-success w-100">
            </div>
        </form>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Resultados</div>
            <div class="card-body">
                <?php
                $mostrarImagen = false;
                $imgPath = "";
                if (isset($_GET["height"]) && isset($_GET["weight"])) {
                    $height = floatval($_GET["height"]);
                    $weight = floatval($_GET["weight"]);

                    if ($height > 0 && $weight > 0) {
                        $imc = round($weight / ($height * $height), 2);

                        $categorias = [
                            ['max' => 18.49, 'info' => 'Tu peso es bajo', 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-GlUlN5J7Ld6z1GGu6Xq8myCypFyi51ODww&s'],
                            ['max' => 24.99, 'info' => 'Tu peso es normal', 'img' => 'data:image/jpeg;base64,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'],
                            ['max' => 29.99, 'info' => 'Tienes sobrepeso', 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUyciAnQVy7zQIo5vIiv0wIMdmbN6TgxWqiQ&s'],
                            ['max' => 34.99, 'info' => 'Tienes obesidad nivel 1', 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKiZCxiRMzuV5yPuoFX9fUJiCRpiKISG9R7g&s'],
                        ];

                        $info = "Tienes obesidad nivel 3";
                        $imgPath = "img/ob3.png";

                        foreach ($categorias as $cat) {
                            if ($imc <= $cat['max']) {
                                $info = $cat['info'];
                                $imgPath = $cat['img'];
                                break;
                            }
                        }

                        echo "
                            <script>
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: '¡Cálculo generado!',
                                    icon: 'success'
                                });
                            </script>
                        ";

                        echo "<h5>Tu IMC es: <strong>$imc</strong></h5>";
                        echo "<p>$info</p>";
                        echo "<form method='GET'><button class='btn btn-secondary mt-3' type='submit'>Reiniciar</button></form>";

                        $mostrarImagen = true;
                    } else {
                        echo "<div class='alert alert-danger'>La altura y el peso deben ser mayores a 0.</div>";
                    }
                } else {
                    echo "<p>Introduce tus datos para calcular tu IMC.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-4 text-center">
        <?php
    
        ?>
        <div class="card">
            <div class="card-header">IMAGEN DE REFERENCIA DE ACUERDO AL IMC</div>
            <div class="card-body">
                <img src="<?php echo $mostrarImagen ? $imgPath : $imgProvisional; ?>" class="img-fluid rounded" alt="">
            </div>
        </div>
    </div>
</div>

<script>
function validarCampo(campo) {
    const valor = campo.value.trim();
    const esValido = /^[0-9]+(\.[0-9]+)?$/.test(valor);
    if (!esValido || parseFloat(valor) <= 0) {
        campo.classList.add('is-invalid');
        return false;
    } else {
        campo.classList.remove('is-invalid');
        return true;
    }
}

document.getElementById('height').addEventListener('input', function () {
    validarCampo(this);
});
document.getElementById('weight').addEventListener('input', function () {
    validarCampo(this);
});

document.getElementById('formIMC').addEventListener('submit', function (e) {
    const alturaValida = validarCampo(document.getElementById('height'));
    const pesoValido = validarCampo(document.getElementById('weight'));
    if (!alturaValida || !pesoValido) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Datos inválidos',
            text: 'Revisa que los campos sean números y superior a 0.'
        });
    }
});
</script>

</body>
</html>
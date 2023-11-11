<?php
include './templates/HeaderBlanco.php';
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
<link href="../assets/css/codigoAutenticacion.css" rel="stylesheet">

<body>
    <div class="CajaCodigo">
            <h2>Código de Autenticación</h2>
                <form action="codigoAutenticacion_process.php" method="post" id="codigoAutenticacionForm">
                    <p>Se ha enviado un código de autenticación a tu correo electrónico.</p>
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" required>
                    <input type="submit" value="Verificar Código">
            </form>
    </div>
</body>

</main>



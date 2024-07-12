<?php
include './templates/Header.php';
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])) {
//     header('Location: ../../');
//     exit();
// }

$apiUrl = 'https://tipodecambio.paginasweb.cr/api';
$apiResponse = file_get_contents($apiUrl);

$exchangeRateData = json_decode($apiResponse, true);

$compra = 'No disponible';
$venta = 'No disponible';
$fecha = 'No disponible';

if ($exchangeRateData && isset($exchangeRateData['compra'], $exchangeRateData['venta'], $exchangeRateData['fecha'])) {
    $compra = $exchangeRateData['compra'];
    $venta = $exchangeRateData['venta'];
    $fecha = $exchangeRateData['fecha'];
}

if (isset($_SESSION['Identificacion'])) {
    $userId = $_SESSION['Identificacion'];

    $userApiUrl = 'https://tiusr29pl.cuc-carrera-ti.ac.cr/Mybanco/api/Usuarios/' . $userId;

    $chUser = curl_init($userApiUrl);
    curl_setopt($chUser, CURLOPT_RETURNTRANSFER, true);
    $userApiResponse = curl_exec($chUser);

    if (curl_errno($chUser)) {
        echo 'Error cURL: ' . curl_error($chUser);
    }

    curl_close($chUser);

    $userData = json_decode($userApiResponse, true);

    if ($userData === null) {
        echo 'Error decodificando JSON para los datos del usuario';
    } else {
        $nombre = $userData['nombre'];
        $apellido1 = $userData['apellido1'];
        $apellido2 = $userData['apellido2'];
        $id = $userData['cedula'];
        $email = $userData['correo'];

        if (!empty($id)) {
          $saldoApiUrl = 'https://tiusr29pl.cuc-carrera-ti.ac.cr/Mybanco/api/Cuentas/GetNumeroCuenta/' . $id;
      
          $chSaldo = curl_init($saldoApiUrl);
          curl_setopt($chSaldo, CURLOPT_RETURNTRANSFER, true);
      
          // Deshabilita la verificación del certificado SSL (para desarrollo local)
          curl_setopt($chSaldo, CURLOPT_SSL_VERIFYPEER, false);
      
          $numeroCuenta = curl_exec($chSaldo);
      
          if (curl_errno($chSaldo)) {
              echo 'Error cURL: ' . curl_error($chSaldo);
          }
      
          $httpCode = curl_getinfo($chSaldo, CURLINFO_HTTP_CODE);
      
          if ($httpCode == 200) {

          } else {
              echo 'Error en la solicitud a la API de cuentas. Código de estado HTTP: ' . $httpCode;
          }
      
          curl_close($chSaldo);
      } else {
          echo 'Cédula no disponible para el usuario';
      }
      
      if (!empty($numeroCuenta)) {
        $saldoApiUrl = 'https://tiusr29pl.cuc-carrera-ti.ac.cr/Mybanco/api/Saldos/' . $numeroCuenta;
        
        $chSaldo = curl_init($saldoApiUrl);
        curl_setopt($chSaldo, CURLOPT_RETURNTRANSFER, true);
        
        // Deshabilita la verificación del certificado SSL (para desarrollo local)
        curl_setopt($chSaldo, CURLOPT_SSL_VERIFYPEER, false);
        
        $saldoApiResponse = curl_exec($chSaldo);
        
        if (curl_errno($chSaldo)) {
            echo 'Error cURL: ' . curl_error($chSaldo);
        }
        
        $httpCode = curl_getinfo($chSaldo, CURLINFO_HTTP_CODE);
        
        if ($httpCode == 200) {
            $saldoData = json_decode($saldoApiResponse, true);
    
            if ($saldoData === null) {
                echo 'Error decodificando JSON para los datos del saldo';
            } else {
                $saldo = isset($saldoData['saldo']) ? '₡' . $saldoData['saldo'] : 'No disponible';
                
            }
        } else {
            echo 'Error en la solicitud a la API de saldos. Código de estado HTTP: ' . $httpCode;
        }
        
        curl_close($chSaldo);
    } else {
        echo 'Número de Cuenta no disponible para el usuario';
    }
    }
} else {
    echo 'ID de usuario no establecido en la sesión';
}
?>

<!-- =========================Fin header ======= -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fondo animado</title>
    <link rel="stylesheet" href="../assets/css/Mybanco/myBanco.css">
</head>
<body>
  <header class="bg_animate">
    <br>
    <br>
        <section class="banner contenedor">
            <secrion class="banner_title">

                <div class="blog-card spring-fever">
                    <div class="title-content">
                        <p>Tipo de cambio</p>
                        <p><i class="fa-regular fa-sack-dollar fa-shake fa-lg" style="color: #ff7f5d; "> </i> </span><a for="tipoCambioCompra"> Compra: ₡</a><span id="tipoCambioCompra"><?php echo $compra;?><a for="tipoCambioVenta"> Venta: ₡</a><span id="tipoCambioVenta"><?php echo $venta;?></span></li> 
                        <p class="p" style="font-size: 14px;">Información del Tipo de Cambio es tomada del BCCR</p>
                        <p for="nombre"><span id="nombre"><?php echo $nombre; ?></span> <span id="apellidos"><?php echo $apellido1; ?><?php echo $apellido2; ?></span></p>
                        <p for="cedula">Cédula: <span id="cedula"><?php echo $id;?></span></p>
                        <p for="direccion">Correo: <span id="direccion"><?php echo $email;?></span></p>
                    </div>
                    <div class="card-info">
                         <button class="input" onclick="abrirNuevaVentana()">Ir a Mi Banco</button>
                    </div>
                    <div class="utility-info">
                        <ul class="utility-list">
                            <li><i class="fa-regular fa-sack-dollar fa-shake fa-lg" style="color: #ff7f5d; "> </i> </span><a for="Numero de cuenta "> Numero de cuenta: </a><span id="CuentaBancario"><?php echo $numeroCuenta;?></span></li>
                            <br>
                            <li><i class="fa-regular fa-sack-dollar fa-shake fa-lg" style="color: #ff7f5d; "> </i> </span><a for="saldo "> Saldo: </a><span id="saldo"><?php echo $saldo;?></span></li> 
                        </ul>
                    </div>
                    <div class="gradient-overlay"></div>
                    <div class="color-overlay"></div>
                </div> 
                </secrion>
                <div class="banner_img">
                    <img src="../assets/img/logo/Logo_blanco2.png" alt="">
                </div>     
        </section>
            <div class="burbujas">
                
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>
                <div class="burbuja"></div>

            </div>
    </header>

</body>

<script>
        function abrirNuevaVentana() {
            window.open('https://tiusr29pl.cuc-carrera-ti.ac.cr/MyBancoWeb/Default', '_blank');
        }
    </script>
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
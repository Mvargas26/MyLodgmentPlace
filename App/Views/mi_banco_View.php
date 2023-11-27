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

<!-- ==============================================Fin header ======= -->

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
                <div class="card">
                        <div class="head">
                            <div class="circle"></div>
                            <div class="img">
                                <img src="https://images.unsplash.com/photo-1493666438817-866a91353ca9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1049&q=80" alt="">
                            </div>
                        </div>
                        <div class="description">
                            <p for="nombre"><span id="nombre"><?php echo $nombre; ?></span> <span id="apellidos"><?php echo $apellido1; ?><?php echo $apellido2; ?></span></p>
                            <p for="cedula">Cédula: <span id="cedula"><?php echo $id;?></span></p>
                            <p for="direccion">Correo: <span id="direccion"><?php echo $email;?></span></p>
                            <p for="CuentaBancario">Numero de Cuenta Bancario: <span id="CuentaBancario"><?php echo $numeroCuenta;?></span></p>
                            <p for="saldo">Saldo: <span id="saldo"><?php echo $saldo;?></span> </p>
                            <br>
                            
                        </div>
                </div>


              <div  class="user-info-container">
                  <div class="contenedor" >
                    <div class="p"  >Tipo de Cambio Actual</div>
                    <p class="p" for="tipoCambioCompra">Tipo de Cambio de Compra: ₡<span id="tipoCambioCompra"><?php echo $compra;?></span></p>
                    <p class="p" for="tipoCambioVenta">Tipo de Cambio de Venta: ₡<span id="tipoCambioVenta"><?php echo $venta;?></span></p>
                    <p class="p" for="fechaTipoCambio">Fecha Actual: <span id="fechaTipoCambio"><?php echo $fecha; ?></span></p>
                    <p class="p" style="font-size: 14px;">Información del Tipo de Cambio es tomada del BCCR</p>
                    <button class="input" onclick="window.location.href='https://tiusr29pl.cuc-carrera-ti.ac.cr/MyBancoWeb/Default'">Ir a Mi Banco</button> 
                </div>
              </div>
            </secrion>
            <div class="banner_img">
                <img src="../assets/img/logo/logo.png" alt="">
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
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
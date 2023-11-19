<?php
include './templates/Header.php';
session_start();

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
                $saldo = isset($saldoData['saldo']) ? '₡: ' . $saldoData['saldo'] : 'No disponible';
                
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
<main id="main">

<link rel="stylesheet" href="../assets/css/Mybanco/myBanco.css">

<body id="cuerpo">

    <h1>Información del Usuario</h1>

      <ul class="cards">
          <li class="cards__item">
            <div class="card">
                <div class="card__image card__image--fence"></div>
                    <div class="card__content">
                    <div class="card__title">Tipo de Cambio</div>
                        <p for="tipoCambioCompra">Tipo de Cambio de Compra: <span id="tipoCambioCompra"><?php echo $compra; ?></span></p>
                        <p for="tipoCambioVenta">Tipo de Cambio de Venta: <span id="tipoCambioVenta"><?php echo $venta; ?></span></p>
                        <p for="fechaTipoCambio">Fecha Actual: <span id="fechaTipoCambio"><?php echo $fecha; ?></span></p>
                        <p style="font-size: 14px;">Información del Tipo de Cambio es tomada del BCCR</p>
                    </div>
                </div>
          </li>
        <li class="cards__item">
          <div class="card">
            <div class="card__image card__image--river"></div>
              <div class="card__content">
                <div class="card__title">Datos Personales</div>
                <p for="nombre">Nombre: <span id="nombre"><?php echo $nombre; ?></span></p>
                <p for="apellidos">Apellidos: <span id="apellidos"><?php echo $apellido1; ?> <?php echo $apellido2; ?></span></p>
                <p for="cedula">Cédula: <span id="cedula"><?php echo $id; ?></span></p>
                <p for="direccion">Correo Electrónico: <span id="direccion"><?php echo $email; ?></span></p>
              </div>
          </div>
        </li>
        <li class="cards__item">
          <div class="card">
            <div class="card__image card__image--record"></div>
              <div class="card__content">
                <div class="card__title">Saldo</div>
                <p for="CuentaBancario">Numero de Cuenta Bancario Actual: <span id="CuentaBancario"><?php echo $numeroCuenta; ?></span> </p>
                <p for="saldo">Saldo Bancario Actual: <span id="saldo"><?php echo $saldo; ?></span> </p>

              <button class="btn btn--block card__btn" onclick="window.location.href='https://tiusr29pl.cuc-carrera-ti.ac.cr/MyBancoWeb/Default'">Ir a Mi Banco</button>
            </div>
          </div>
        </li>
      </ul>
   

</main>




<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
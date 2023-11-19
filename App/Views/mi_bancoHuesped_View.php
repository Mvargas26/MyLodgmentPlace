<?php
include './templates/Header.php';
session_start();

// require_once '../Modules/consumoApiMybanco/tipoCambio_Negocios.php';

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

 // Verifica si se estableció el ID de usuario en la sesión
if (isset($_SESSION['Identificacion'])) {
  // Obtiene el ID de usuario de la sesión
  $userId = $_SESSION['Identificacion'];

  // Tu URL de punto final de la API con el ID de usuario
  $userApiUrl = 'https://tiusr29pl.cuc-carrera-ti.ac.cr/Mybanco/api/Usuarios/' . $userId;

  // Inicializa la sesión cURL para los datos del usuario
  $chUser = curl_init($userApiUrl);

  // Establece opciones de cURL para la solicitud de datos del usuario
  curl_setopt($chUser, CURLOPT_RETURNTRANSFER, true);

  // Ejecuta la sesión cURL y obtén la respuesta de la API de datos del usuario
  $userApiResponse = curl_exec($chUser);

  // Verifica errores de cURL
  if (curl_errno($chUser)) {
      echo 'Error cURL: ' . curl_error($chUser);
  }

  // Cierra la sesión cURL de datos del usuario
  curl_close($chUser);

  // Decodifica la respuesta JSON de datos del usuario
  $userData = json_decode($userApiResponse, true);

  // Verifica si la decodificación fue exitosa
  if ($userData === null) {
      echo 'Error decodificando JSON para los datos del usuario';
  } else {
    $nombre = $userData['nombre'];
    $apellido1 = $userData['apellido1'];
    $apellido2 = $userData['apellido2'];
    $cedula = $userData['cedula'];
    $email = $userData['correo'];
  }
} else {
  echo 'ID de usuario no establecido en la sesión';
}

if (isset($_SESSION['Identificacion'])) {
  // Obtiene el ID de usuario de la sesión
  $userId = $_SESSION['Identificacion'];

  // Tu URL de punto final de la API de saldos con el ID de usuario
  $saldoApiUrl = 'https://tiusr29pl.cuc-carrera-ti.ac.cr/Mybanco/api/Saldos/' . $userId;

  // Inicializa la sesión cURL para los datos del saldo
  $chSaldo = curl_init($saldoApiUrl);

  // Establece opciones de cURL para la solicitud de datos del saldo
  curl_setopt($chSaldo, CURLOPT_RETURNTRANSFER, true);

  // Ejecuta la sesión cURL y obtén la respuesta de la API de datos del saldo
  $saldoApiResponse = curl_exec($chSaldo);

  // Verifica errores de cURL
  if (curl_errno($chSaldo)) {
      echo 'Error cURL: ' . curl_error($chSaldo);
  }

  // Cierra la sesión cURL de datos del saldo
  curl_close($chSaldo);

  // Decodifica la respuesta JSON de datos del saldo
  $saldoData = json_decode($saldoApiResponse, true);

  // Verifica si la decodificación fue exitosa
  if ($saldoData === null) {
      echo 'Error decodificando JSON para los datos del saldo';
  } else {
      // Asigna el saldo a la variable correspondiente
      $saldo = isset($saldoData['saldo']) ? $saldoData['saldo'] : 'No disponible';
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

  <div class="DivCart" >
    <ul class="cards">
        <li class="cards__item">
          <div class="card">
              <div class="card__image card__image--fence"></div>
                  <div class="card__content">
                  <div class="card__title">Tipo de Cambio</div>
                      <label for="tipoCambioCompra">Tipo de Cambio de Compra: <span id="tipoCambioCompra"><?php echo $compra; ?></span></label>
                      <label for="tipoCambioVenta">Tipo de Cambio de Venta: <span id="tipoCambioVenta"><?php echo $venta; ?></span></label>
                      <label for="fechaTipoCambio">Fecha Actual: <span id="fechaTipoCambio"><?php echo $fecha; ?></span></label>
                      <p style="font-size: 14px;">Información del Tipo de Cambio es tomada del BCCR</p>
                  </div>
              </div>
        </li>
    </ul> 

    <ul class="cards">
      <li class="cards__item">
        <div class="card">
          <div class="card__image card__image--river"></div>
            <div class="card__content">
              <div class="card__title">Datos Personales</div>
              <label for="nombre">Nombre: <span id="nombre"><?php echo $nombre; ?></span></label>
              <label for="apellidos">Apellidos: <span id="apellidos"><?php echo $apellido1; ?> <?php echo $apellido2; ?></span></label>
              <label for="cedula">Cédula: <span id="cedula"><?php echo $cedula; ?></span></label>
              <label for="direccion">Correo Electrónico: <span id="direccion"><?php echo $email; ?></span></label>
            </div>
        </div>
      </li>
    </ul>
    <ul class="cards">
      <li class="cards__item">
        <div class="card">
          <div class="card__image card__image--record"></div>
          <div class="card__content">
            <div class="card__title">Saldo</div>
            <label for="saldo">Saldo Bancario Actual: <span id="saldo"><?php echo $saldo; ?></span> </label>
            <button class="btn btn--block card__btn" onclick="window.location.href='https://tiusr29pl.cuc-carrera-ti.ac.cr/MyBancoWeb/Default'">Ir a Mi Banco</button>
          </div>
        </div>
      </li>
    </ul>

  </div>
  
</body>



</main>




<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
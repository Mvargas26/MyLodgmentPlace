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


 $nombre = "Juan";
 $apellidos = "Pérez Gómez";
 $cedula = "123456789";
 $direccion = "Calle 123, Ciudad";
 $saldo = "$5,000.00";

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
            <label for="apellidos">Apellidos: <span id="apellidos"><?php echo $apellidos; ?></span></label>
            <label for="cedula">Cédula: <span id="cedula"><?php echo $cedula; ?></span></label>
            <label for="direccion">Dirección: <span id="direccion"><?php echo $direccion; ?></span></label>
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
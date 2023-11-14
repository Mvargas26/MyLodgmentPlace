<?php
include './templates/Header.php';
session_start();
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <link href="../assets/css/cupones.css" rel="stylesheet">
    <body id="body">
        
        <div class="contener"> 

            <div id="seccionCupon">
                <h2>Cupon de descuento</h2>
                <form action="process_coupon.php" method="post" onsubmit="return showCouponAppliedAlert();">
                    <label for="codigoCupon">Codigo del cupon:</label>
                    <input type="text" id="codigoCupon" name="codigoCupon" required><br>
                    <button type="submit">Aplicar Cupón</button>
                </form>
            </div>

            <div id="seccionTarjeta">
                <h2>Tarjeta de regalo</h2>
                <form action="process_gift_card.php" method="post" onsubmit="return showGiftCardAppliedAlert();">
                    <label for="codigoTarjeta">Codigo de la tarjeta de regalo:</label>
                    <input type="text" id="codigoTarjeta" name="codigoTarjeta" required><br>
                    <button type="submit">Aplicar Tarjeta de Regalo</button>
                </form>
            </div>
            <br>
            <br>
        </div>
        </body>

        <script>
            function showCouponAppliedAlert() {
                alert("El cupón se aplicó correctamente");
                return true; 
            }

            function showGiftCardAppliedAlert() {
                alert("La tarjeta de regalo se aplicó correctamente");
                return true; 
            }
        </script>
</main>


<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
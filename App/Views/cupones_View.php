<?php
include './templates/Header.php';
session_start();
if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=2) {
    header('Location: ../../');
    exit();
}
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <link href="../assets/css/cupones.css" rel="stylesheet">
    <body id="body">
        
        <div class="contener"> 

            <div id="seccionCupon">
                <h2>Cupon de descuento</h2>
                <form action="" method="post" onsubmit="return showCouponAppliedAlert();">
                    <label for="codigoCupon">Codigo del cupon:</label>
                    <input type="text" id="codigoCupon" name="codigoCupon" required><br>
                    <button type="submit">Aplicar Cupón</button>
                </form>
            </div>

            <div id="seccionTarjeta">
                <h2>Tarjeta de regalo</h2>
                <form action="" method="post" onsubmit="return showGiftCardAppliedAlert();">
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
                showAndHideAlert("El cupón se aplicó correctamente", "alert-success");
                return true; 
            }

            function showGiftCardAppliedAlert() {
                showAndHideAlert("La tarjeta de regalo se aplicó correctamente", "alert-success");
                return true; 
            }

            function showAndHideAlert(message, alertClass) {
                var alertDiv = document.createElement("div");
                alertDiv.className = "alert " + alertClass;
                alertDiv.appendChild(document.createTextNode(message));

                // Append the alert to the body
                document.body.appendChild(alertDiv);

                // Show the alert
                alertDiv.style.display = "block";

                // Hide the alert after 3 seconds
                setTimeout(function () {
                    alertDiv.style.display = "none";
                    // Remove the alert from the DOM
                    alertDiv.parentNode.removeChild(alertDiv);
                }, 10000000);
            }
        </script>

</main>


<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
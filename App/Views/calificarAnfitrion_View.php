<?php include './templates/Header.php'; 
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=3) {
//     header('Location: ../../');
//     exit();
// }
?>
<link href="../assets/css/calificarAnfitrion.css" rel="stylesheet">

<main id="mainA">
    <br><br><br>
    <div class="calificar-anfitrion-container">
        <h2>Calificar Anfitrión</h2>
        <div class="star-ratingA">
            <input type="radio" id="star1" name="rating" value="1" />
            <label for="star1"></label>
            <input type="radio" id="star2" name="rating" value="2" />
            <label for="star2"></label>
            <input type="radio" id="star3" name="rating" value="3" />
            <label for="star3"></label>
            <input type="radio" id="star4" name="rating" value="4" />
            <label for="star4"></label>
            <input type="radio" id="star5" name="rating" value="5" />
            <label for="star5"></label>
        </div>
        <textarea id="comment" placeholder="Agregar comentario..."></textarea>
        <button onclick="submitRating()">Enviar Calificación</button>
    </div>
</main>

<?php include './templates/Footer.php'; ?>
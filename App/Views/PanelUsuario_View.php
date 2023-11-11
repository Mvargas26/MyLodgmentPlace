<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->
<main id="main">

<head>
    <style>
        .cards-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 200px;
            height: 150px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            margin: 10px;
            text-align: center;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="cards-container">
        <div class="card">
            <a href="panel_usuario.php">Inicio</a>
        </div>
        <div class="card">
            <a href="perfil.php">Perfil</a>
        </div>
        <div class="card">
            <a href="reservas.php">Mis Reservas</a>
        </div>
        <div class="card">
            <a href="mensajes.php">Mensajes</a>
        </div>
        <div class="card">
            <a href="ajustes.php">Ajustes</a>
        </div>
        <div class="card">
            <a href="cerrar_sesion.php">Cerrar Sesión</a>
        </div>
    </div>
</body>

</main>
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
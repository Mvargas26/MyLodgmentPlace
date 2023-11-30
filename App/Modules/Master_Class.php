<?php
require_once(__DIR__ . '/../../app//libs/PHPMAILER/autoload.php');

date_default_timezone_set("America/Costa_Rica");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Master_Class
{
    ////Plesk Remoto
    // private $server = "tiusr29pl.cuc-carrera-ti.ac.cr";
    // private $username = "sitios";
    // private $password = "Sitios2023*";
    // private $db = "mylodgmentplace";
    ////----------------------------------------------------------------
    //pleskLocal
    // private $server = "localhost:3306";
    // private $username = "sitios";
    // private $password = "Sitios2023*";
    // private $db = "mylodgmentplace";
    private $conn;
    ////Plesk 
    private $server = "185.211.7.52";
    private $username = "u538860919_sitios";
    private $password = "Sitios2023*";
    private $db = "u538860919_mylodgmentplac";

    function __construct()
    {
        try {

            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
            if ($this->conn->connect_error) {
                die("Error en la conexión a la base de datos: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "connection failed" . $e->getMessage();
        }
    } //fin constructor
    /*-----------------------------------------------GETS--------------------------------------------------*/
    function GetConexion()
    {
        return $this->conn;
    }
    /*-----------------------------------------------FUNCTIONS--------------------------------------------------*/
    /*----------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------USUARIOS--------------------------------------------------*/

    function ConsultarUsuario()
    {
        $arry_Datos = func_get_args();

        try {
            $identificacion = intval($this->GetConexion()->real_escape_string($arry_Datos[0]));
            $password = $this->GetConexion()->real_escape_string($arry_Datos[1]);

            $query = " SELECT * FROM `tbusuario` WHERE `idUser` = '$identificacion' AND `contrasenna` ='$password';";

            $result = $this->getConexion()->query($query);

            if ($result) {
                return $result;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return $e->getMessage();
        }
    } //fn ConsultarUsuario

    function InsertarUsuario()
    {
        $arry_Datos = func_get_args();

        try {
            $img = $this->GetConexion()->real_escape_string($arry_Datos[0]);
            $identificacion = intval($this->GetConexion()->real_escape_string($arry_Datos[1]));
            $Clave = $this->GetConexion()->real_escape_string($arry_Datos[2]);
            $nombre = $this->GetConexion()->real_escape_string($arry_Datos[3]);
            $primerApellido = $this->GetConexion()->real_escape_string($arry_Datos[4]);
            $segundoApellido = $this->GetConexion()->real_escape_string($arry_Datos[5]);
            $email = $this->GetConexion()->real_escape_string($arry_Datos[6]);
            $telefono = intval($this->GetConexion()->real_escape_string($arry_Datos[7]));
            $edad = intval($this->GetConexion()->real_escape_string($arry_Datos[8]));
            $idRol = intval($this->GetConexion()->real_escape_string($arry_Datos[9]));
            $direccion = $this->GetConexion()->real_escape_string($arry_Datos[10]);

            $query = "INSERT INTO `tbusuario` (`idUser`,`nombre`, `apellido1`, `apellido2`, `correo`, `fotoperfil`, `telefono`, `idRol`, `contrasenna`,
                `edad`, `estado`, `direccion`)
                 VALUES ($identificacion, '$nombre', '$primerApellido', '$segundoApellido', '$email', '$img', $telefono, $idRol, '$Clave', $edad, 1, '$direccion')";

            if ($this->getConexion()->query($query)) {
                return true;
            } else {
                throw new Exception("Error en la inserción: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function insertarImagenPerfil($nombreImagen)
    {
        try {
            // Escapa los datos para evitar inyección SQL
            $nombreImagen = $this->getConexion()->real_escape_string($nombreImagen);

            // Prepara la consulta SQL para el INSERT
            $insertQuery = "INSERT INTO `tbvalidacionperfil` (`nombreImagenUsuario`, `estadoValidacion`) VALUES (?, 'pendiente')";
            $stmtInsert = $this->getConexion()->prepare($insertQuery);
            $stmtInsert->bind_param("s", $nombreImagen);

            // Ejecuta el INSERT
            if ($stmtInsert->execute()) {
                // Obtiene el ID recién insertado
                $idValidacionPerfil = $this->getConexion()->insert_id;

                // Prepara la consulta SQL para el UPDATE
                $updateQuery = "UPDATE tbusuario SET idValidacionPerfil = ? WHERE idUser = ?";
                $stmtUpdate = $this->getConexion()->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $idValidacionPerfil, $nombreImagen);

                // Ejecuta el UPDATE
                if ($stmtUpdate->execute()) {
                    return true;
                } else {
                    throw new Exception("Error en la actualización del usuario: " . $stmtUpdate->error);
                }
            } else {
                throw new Exception("Error en la inserción de la imagen de perfil: " . $stmtInsert->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    function ConsultarValidacionUsuario($identificacion)
    {
        try {
            $query = " SELECT * FROM `tbvalidacionperfil` WHERE `nombreImagenUsuario` = '$identificacion';";

            $result = $this->getConexion()->query($query);

            if ($result) {
                return $result;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return $e->getMessage();
        }
    }

    function informacionUsuarios()
    {
        $arry_Datos = func_get_args();

        try {
            $identificacion = intval($this->GetConexion()->real_escape_string($arry_Datos[0]));

            $query = "SELECT * FROM `tbusuario` WHERE `idUser` = '$identificacion';";

            $result = $this->getConexion()->query($query);

            if ($result && $result->num_rows > 0) {
                // Obtener los datos del usuario
                $userData = $result->fetch_assoc();
                return $userData;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function actualizaNombreApellido($cedula, $nombre, $apellido1, $apellido2, $direccion, $telefono, $email)
    {

        $stmt = $this->conn->prepare("UPDATE tbusuario SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, telefono = ?, correo = ? WHERE idUser = ?");

        // Verifica si la preparación fue exitosa
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("ssssssi", $nombre, $apellido1, $apellido2, $direccion, $telefono, $email, $cedula);


        $resultado = $stmt->execute();

        // Cierra la declaración
        $stmt->close();

        // Retorna true si la actualización fue exitosa, de lo contrario, false
        return $resultado;
    }

    /* --------------------------- Obtener Usuarios --------------------------- */

    function GetUsuarios()
    {
        $sql = "SELECT idUser, nombre, apellido1, apellido2, correo
        FROM tbusuario";

        $users = array();

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Manejo de valores nulos: Si un valor es nulo, se establece como null en el array
                    foreach ($row as $key => $value) {
                        if ($value === null) {
                            $row[$key] = null;
                        }
                    }
                    $users[] = $row;
                }
            }
        } catch (Exception $e) {
            // Manejo de errores: Aquí puedes registrar o notificar el error
            // Por ejemplo: error_log($e->getMessage());
            return array(); // Devuelve un array vacío si ocurre un error
        }

        return $users;
    }

    /* --------------------------- Otras funciones --------------------------- */

    function GetUsuarioDetails($idUser)
    {
        if ($idUser === null) {
            return array();
        }

        $sql = "SELECT * FROM tbusuario WHERE idUser = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idUser);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }

        return array();
    }

    function obtenerParametroUrl($parametro)
    {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $parametros);

        return isset($parametros[$parametro]) ? $parametros[$parametro] : null;
    }

    function getValidacionPerfil($idUser)
    {
        // Lógica para obtener detalles de validación del perfil basados en $idUser
        $consulta = "SELECT nombreImagenUsuario FROM tbvalidacionperfil WHERE idUser = ?";

        // Ejecutar la consulta con $idUser como parámetro
        // Aquí asumo que tienes una conexión PDO llamada $pdo
        $stmt = $this->conn->prepare($consulta);
        $stmt->execute([$idUser]);

        // Obtener los resultados
        $resultados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultados;
    }

    function activarEstadoValidacion($idValidacionPerfil)
    {
        // Lógica para activar el estado en la base de datos
    }


    /*-----------------------------------------------IMAGENES--------------------------------------------------*/


    function InsertarImagen()
    {
        $arry_Datos = func_get_args();

        $img = $this->GetConexion()->real_escape_string($arry_Datos[0]);
        $nombre = $this->GetConexion()->real_escape_string($arry_Datos[1]);

        $query = "INSERT INTO `imagenes`(`Nombre`,`Imagen`) VALUES ('$nombre','$img')";

        if ($this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    } //fin InsertarImagen

    function CargarImagenesInmuebles()
    {
        $arry_Datos = func_get_args();

        $idInmueble = $this->GetConexion()->real_escape_string($arry_Datos[0]);

        $data = null;

        $query = "SELECT * FROM `tbfotoinmueble`;";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    } //cargarImagenes


    /*D----------------------------------------------------------------------------------------------D*/
    /*D-------PUBLICAR INMUEBLE----------PUBLICAR INMUEBLE-----------PUBLICAR INMUEBLE---------------D*/
    /*D----------------------------------------------------------------------------------------------D*/

    function Insertar_Inmueble(
        $nombreEspacio,
        $disponibilidad,
        $valorDiario,
        $estadoLugar,
        $Propietario,
        $estrellas,
        $direccion,
        $capacidadPersonas,
        $costoPersonaExtra,
        $fechaLimiteDisponible,
        $nombresImagenes,
        $categoria
    ) {

        $query = "INSERT INTO `tbinmueble`(`nombre`, `disponibilidad`, 
        `valorDiario`, `estadoLugar`, `Propietario`, `estrellas`, `direccion`, 
        `capacidadPersonas`, `costoPersonaExtra`, `fechaLimiteDisponibilidad`) 
        VALUES ('$nombreEspacio', '$disponibilidad', '$valorDiario', '$estadoLugar','$Propietario',
        '$estrellas','$direccion','$capacidadPersonas','$costoPersonaExtra','$fechaLimiteDisponible')";

        if ($this->getConexion()->query($query)) {

            // AHORA ENCUENTRA EL ID DEL INMUEBLE QUE SE ACABA DE INSERTAR
            $query = "SELECT `id` FROM `tbinmueble` WHERE 
                        `nombre` = '$nombreEspacio' AND 
                        `Propietario` = '$Propietario' AND 
                        `capacidadPersonas` = '$capacidadPersonas' AND 
                        `costoPersonaExtra` = '$costoPersonaExtra' AND
                        `estadoLugar` = '$estadoLugar'
                        LIMIT 1";

            // Ejecutar la consulta
            $result = $this->GetConexion()->query($query);

            // Verificar si la consulta fue exitosa
            if ($result) {
                // Obtener el ID si hay resultados
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $idInmuebleNuevo = $row['id'];
                } else {
                    // No se encontraron resultados
                    $idInmuebleNuevo = null;
                }
            } else {
                // Hubo un error en la consulta
                $idInmuebleNuevo = null;
            }

            if ($idInmuebleNuevo !== null) {

                // $_SESSION['idInmueble'] = $idInmuebleNuevo;

                $query = "INSERT INTO `tbfotoinmueble` (`idInmueble`, `nombreImagen`) VALUES ";

                // uno por cada foto
                foreach ($nombresImagenes as $nombreImagen) {

                    $nombreImagen = $this->GetConexion()->real_escape_string($nombreImagen);

                    $query .= "('$idInmuebleNuevo', '$nombreImagen'),";
                }

                $query = rtrim($query, ',');


                if ($this->GetConexion()->query($query)) {

                    $query = "INSERT INTO `tbcategoriainmueble`(`idCategoria`, `idInmueble`) 
                    VALUES ('$categoria','$idInmuebleNuevo')";

                    if ($this->GetConexion()->query($query)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    } //fin Insertar Inmueble



    function Insertar_ServiciosInmueble($ArrayServicios)
    {
        // Obtener el último ID de la tabla tbinmueble
        $query = "SELECT id FROM tbinmueble ORDER BY id DESC LIMIT 1;";
        $result = $this->GetConexion()->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idInmuebleNuevo = $row['id'];
        } else {
            // Manejar el caso cuando no se encuentra ningún ID
            return false;
        }

        // Construir la consulta para insertar servicios
        $query = "INSERT INTO `tbinmuebleservicio` (`idServicio`, `idInmueble`, `disponibilidad`) VALUES ";

        // Uno por cada servicio
        foreach ($ArrayServicios as $idServicio) {
            $idServicio = $this->GetConexion()->real_escape_string($idServicio);
            // Añadir un valor fijo para 'disponibilidad', puedes ajustarlo según tus necesidades
            $query .= "('$idServicio', '$idInmuebleNuevo', 'disponible'),";
        }
        $query = rtrim($query, ',');

        // Ejecutar la consulta para insertar servicios
        if ($this->GetConexion()->query($query)) {
            return true;
        } else {
            // Manejar el caso cuando la inserción falla
            return false;
        }
    }


    function Insertar_PoliticasInmueble(
        $cancelacion,
        $reembolso,
        $horario,
        $cargos
    ) {
        // Obtener el último ID de la tabla tbinmueble
        $query = "SELECT id FROM tbinmueble ORDER BY id DESC LIMIT 1;";
        $result = $this->GetConexion()->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idInmuebleNuevo = $row['id'];
        } else {
            // Manejar el caso cuando no se encuentra ningún ID
            return false;
        }

        // Construir la consulta para insertar servicios
        $query = "INSERT INTO `tbpoliticaespacio` (`idInmueble`, `politica`, `tipo`) VALUES ";

        $query .= "('$idInmuebleNuevo', '$cancelacion', 'Cancelacion'),";
        $query .= "('$idInmuebleNuevo', '$reembolso', 'Reembolso'),";
        $query .= "('$idInmuebleNuevo', '$horario', 'Horario'),";
        $query .= "('$idInmuebleNuevo', '$cargos', 'Cargos')";

        // Ejecutar la consulta para insertar servicios
        if ($this->GetConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    /*----------------------------------------END PUBLICAR INMUEBLE------------------------------------------------------*/




    /*-----------------------------------------------sERVICIOS--------------------------------------------------*/

    function CargarServicios()
    {
        try {
            $query = "SELECT id, icono, nombre FROM `tbservicio`;";
            $this->conn->set_charset("utf8"); // Establecer la codificación a UTF-8
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();

                // Iterar sobre los resultados y construir el array asociativo
                while ($row = $result->fetch_assoc()) {
                    $row['id'] = (int) $row['id'];
                    $data[] = $row;
                }

                return $data;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    // function InsertarServicios()
    // {
    //     $arry_Datos = func_get_args();

    //     $listaIdServicios = $this->GetConexion()->real_escape_string($arry_Datos[0]);
    //     $idInmueble = $this->GetConexion()->real_escape_string($arry_Datos[1]);

    //     $success = true;

    //     foreach ($listaIdServicios as $idServicio) {
    //         $query = "INSERT INTO `tbinmuebleservicio`(`idServicio`, `idInmueble`, `disponibilidad`)
    //             VALUES ('$idServicio', '$idInmueble', 'disponible')";

    //         if (!$this->getConexion()->query($query)) {
    //             $success = false;
    //             break;
    //         }
    //     }

    //     return $success;
    // }
    /*-----------------------------------------------Politicas--------------------------------------------------*/

    function CargarPoliticas()
    {
    } //end politicas




    /*-----------------------------------------------AUNTETINTIFICACION--------------------------------------------------*/


    function generarCodigoAleatorio($longitud)
    {
        $caracteres = "0123456789";
        $codigo = "";

        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        return $codigo;
    }

    function almacenarCodigoAutenticacion($identificacion, $codigo_autenticacion)
    {
        try {
            $identificacion = $this->GetConexion()->real_escape_string($identificacion);
            $codigo_autenticacion = $this->GetConexion()->real_escape_string($codigo_autenticacion);

            $query = "UPDATE tbusuario SET codigoAutenticacion = '$codigo_autenticacion' WHERE idUser = '$identificacion'";
            $this->GetConexion()->query($query);

            if ($this->GetConexion()->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("Error al almacenar código de autenticación: " . $e->getMessage());
            return false;
        }
    }


    function enviarCodigoAutenticacionCorreo($destinatario, $codigo_autenticacion)
    {
        $mail = new PHPMailer(true);

        try {

            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));


            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.titan.email';
                $mail->SMTPAuth = true;
                $mail->Username = 'pruebas@tritechno.net';
                $mail->Password = 'Pruebas1234*';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('pruebas@tritechno.net', 'My Lodgment Place');
                $mail->addAddress($destinatario);
                $mail->isHTML(true);
                $mail->Subject = 'Este es tu codigo de autenticacion para el inicio de sesion';
                $mail->Body = $codigo_autenticacion;
                //$mail->send();

                if (!$mail->send()) {
                    echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;
                } else {
                }
            } catch (\Exception $th) {
                echo 'MEnsaje de Error: ' . $mail->ErrorInfo;
            }

            return true;
        } catch (Exception $e) {
            error_log("Error al enviar el correo: {$mail->ErrorInfo}");
            return false;
        }
    }


    function enviarMensajesCorreo($destinatario, $accion)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.titan.email';
                $mail->SMTPAuth = true;
                $mail->Username = 'pruebas@tritechno.net';
                $mail->Password = 'Pruebas1234*';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('pruebas@tritechno.net', 'My Lodgment Place');
                $mail->addAddress($destinatario);
                $mail->isHTML(true);
                $mail->Subject = 'Notificaciones del Equipo de MyLogment Place';

                // Asignar el cuerpo del correo según la acción
                switch ($accion) {
                    case 'denunciaAn':
                        $mail->Body = "Se a realizado correctamente la respuesta a una denuncia sobre uno de sus inmuebles";
                        break;

                    case 'denunciaHu':
                        $mail->Body = "Se a realizado correctamente la denuncia hacia una reserva";
                        break;

                    case 'registro':
                        $mail->Body = "Usted ha creado una cuenta con exito en la pagina de My Lodgment Place";
                        break;

                    case 'a':
                        $mail->Body = "";
                        break;

                    default:
                        break;
                }

                // Intenta enviar el correo
                if (!$mail->send()) {
                    // Si hay un error al enviar, lanza una excepción
                    error_log('Error al enviar el correo electrónico: ' . $mail->ErrorInfo);
                    return false;
                }
                // Si todo fue exitoso, retorna true
                return true;
            } catch (\Exception $th) {
                // Si hay una excepción, imprime el mensaje de error y retorna false
                echo 'Mensaje de Error: ' . $th->getMessage();
                return false;
            }
        } catch (Exception $e) {
            // Si hay una excepción, imprime el mensaje de error y retorna false
            error_log("Error al enviar el correo: {$e->getMessage()}");
            return false;
        }
    }


    function verificarCodigoAutenticacion($identificacion, $codigo_ingresado)
    {
        try {
            $identificacion = $this->GetConexion()->real_escape_string($identificacion);
            $codigo_ingresado = $this->GetConexion()->real_escape_string($codigo_ingresado);

            $query = "SELECT * FROM tbusuario WHERE idUser = '$identificacion' AND codigoAutenticacion = '$codigo_ingresado'";
            $result = $this->getConexion()->query($query);

            if ($result && $result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("Error al verificar código de autenticación: " . $e->getMessage());
            return false;
        }
    }

    function eliminarCodigoAutenticacion($identificacion)
    {
        try {
            $identificacion = $this->GetConexion()->real_escape_string($identificacion);

            $query = "UPDATE tbusuario SET codigoAutenticacion = NULL WHERE idUser = '$identificacion'";
            $this->getConexion()->query($query);

            if ($this->getConexion()->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("Error al eliminar código de autenticación: " . $e->getMessage());
            return false;
        }
    }


    function calcularValorTotal($cantidadDias)
    {
        $valorDiario = 20000;
        $valorTotal = $valorDiario * $cantidadDias;
        return $valorTotal;
    }

    public function obtenerHistorialReservasUsuario($idUser)
    {

        $idUser = $this->GetConexion()->real_escape_string($idUser);

        $query = "SELECT r.fechaInicio, r.fechaFin, r.montoTotal, r.montoTotalImpuesto, i.nombre as nombreInmueble
          FROM tbreserva r
          INNER JOIN tbinmueble i ON r.idInmueble = i.id
          WHERE r.idUsuario = '$idUser'";

        $resultado = $this->GetConexion()->query($query);

        $historialReservas = array();

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $historialReservas[] = array(
                    'fechaInicio' => $fila['fechaInicio'],
                    'fechaFin' => $fila['fechaFin'],
                    'montoTotal' => $fila['montoTotal'],
                    'montoTotalImpuesto' => $fila['montoTotalImpuesto'],
                    'nombreInmueble' => $fila['nombreInmueble']
                );
            }
        }

        return $historialReservas;
    }
    //fin funcion Historial de reservas

    //Inicio funcion ReservaLugar

    public function ReservaLugar($idUsuario, $idInmueble, $fechaInicio, $fechaFin, $Cupon, $montoTotal, $montoTotalImpuesto, $personasExtra, $cantPersonas)
    {

        if (!$Cupon == '') {

            $query = "SELECT idCupon, Monto, CantidadCupones From tbdescuento where idCupon = '$Cupon'";

            $resultado = $this->GetConexion()->query($query);

            if ($resultado) {
                $nuevoTotal = $montoTotal - ($montoTotal * ($resultado[1] / 100));
                $nuevoTotalImpuesto = $montoTotalImpuesto - ($montoTotalImpuesto * ($resultado[1] / 100));

                $query2 = "INSERT INTO tbReserva (idUsuario, idInmueble, fechaInicio, fechaFin, montoTotal, montoTotalImpuesto, personasExtra, cantPersonas, colorEvento) VALUES ('$idUsuario', '$idInmueble', '$fechaInicio', '$fechaFin', '$nuevoTotal', '$nuevoTotalImpuesto', '$personasExtra', '$cantPersonas', '#FFFFFF')";

                $resultado2 = $this->GetConexion()->query($query2);

                return true;
            }
            else
            {
                return false;
            }
        } else {

            $query3 = "INSERT INTO tbReserva (idUsuario, idInmueble, fechaInicio, fechaFin, montoTotal, montoTotalImpuesto, personasExtra, cantPersonas, colorEvento) VALUES ('$idUsuario', '$idInmueble', '$fechaInicio', '$fechaFin', '$montoTotal', '$montoTotalImpuesto', '$personasExtra', '$cantPersonas', '#FFFFFF')";

            $resultado3 = $this->GetConexion()->query($query3);

            return true;
        }
    }

    //fin funcion ReservaLugar

    public function crearCupon($nombreCupon, $montoDescuento, $cantidadCupones, $fechaVencimiento, $tipoDescuento, $idInmueble)
    {
        $query = "INSERT INTO tbdescuento (idCupon, Monto, CantidadCupones, tipoDescuento) VALUES ('$nombreCupon', '$montoDescuento', '$cantidadCupones', '$tipoDescuento')";

        $resultado = $this->GetConexion()->query($query);

        $query2 = "INSERT INTO tbinmueblecupon (idInmueble, idCupon, fechaVencimiento, Validez) VALUES ('$idInmueble', '$nombreCupon', '$fechaVencimiento', '1')";

        $resultado2 = $this->GetConexion()->query($query2);

        return true;
    }

    public function obtenerNombresInmuebles($idPropietario)
    {
        $idPropietario = $this->GetConexion()->real_escape_string($idPropietario);

        $query = "SELECT id, nombre FROM tbinmueble WHERE Propietario = '$idPropietario'";

        $resultado = $this->GetConexion()->query($query);

        $nombresInmuebles = array();

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $nombresInmuebles[] = array(
                    'id' => $fila['id'],
                    'nombre' => $fila['nombre']
                );
            }
        }

        return $nombresInmuebles;
    }

    //fin funcion obtener nombres de inmuebles

    /*----------------------------------------------- INMUEBLES --------------------------------------------------*/

    function ConsultarInmuebles()
    {

        try {

            $query = "SELECT
                    mu.id,
                    mu.nombre AS nombre_inmueble,
                    mu.valorDiario,
                    mu.capacidadPersonas,
                    mu.costoPersonaExtra,
                    mu.direccion,
                    mu.disponibilidad,
                    mu.estrellas,
                    mu.fechaLimiteDisponibilidad,
                    CONCAT(us.nombre, ' ', us.apellido1, ' ', us.apellido2) AS nombre_propietario,
                    ca.categoria AS Categoria_Inmueble,
                    ft.nombreImagen AS nameImagen
                FROM tbinmueble AS mu
                INNER JOIN tbusuario AS us ON mu.Propietario = us.idUser
                INNER JOIN tbcategoriainmueble ON mu.id = tbcategoriainmueble.idInmueble
                INNER JOIN tbcategorias AS ca ON tbcategoriainmueble.idCategoria = ca.idcategoria
                LEFT JOIN (
                    SELECT idInmueble, nombreImagen
                    FROM tbfotoinmueble
                    GROUP BY idInmueble
                    LIMIT 1
                ) AS ft ON mu.id = ft.idInmueble;";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();

                while ($row = $result->fetch_assoc()) {
                    $item = array(
                        "id" => $row['id'],
                        "Nombre_Inmueble" => $row["nombre_inmueble"],
                        "valorDiario" => $row["valorDiario"],
                        "capacidadPersonas" => $row["capacidadPersonas"],
                        "costoPersonaExtra" => $row["costoPersonaExtra"],
                        "direccion" => $row["direccion"],
                        "disponibilidad" => $row["disponibilidad"],
                        "estrellas" => $row["estrellas"],
                        "fechaLimiteDisponibilidad" => $row["fechaLimiteDisponibilidad"],
                        "nombre_propietario" => $row["nombre_propietario"],
                        "Categoria_Inmueble" => $row["Categoria_Inmueble"],
                        "nameImagen" => $row["nameImagen"],
                    );
                    $data[] = $item;
                }

                return json_encode($data);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    } //fn ConsultarInmueble

    function ConsultarInmuebles_porID($idInmueble)
    {

        try {
            $query = "SELECT
                mu.id, 
                mu.nombre AS nombre_inmueble, 
                mu.valorDiario, 
                mu.capacidadPersonas, 
                mu.costoPersonaExtra, 
                mu.direccion, 
                mu.disponibilidad, 
                mu.estrellas, 
                mu.fechaLimiteDisponibilidad, 
                CONCAT(us.nombre, ' ', us.apellido1, ' ', us.apellido2) AS nombre_propietario,
                ca.categoria as Categoria_Inmueble,
                ft.nombreImagen as nameImagen,
                tc.cantidadCuartos,
                tc.cantidadCamas,
                tc.cantidadBanos,
                tc.cantidadPatios,
                tc.cantidadVehiculos,
                tc.cantidadPlantas
            FROM tbinmueble as mu
            INNER JOIN tbusuario as us ON mu.Propietario = us.idUser
            INNER JOIN tbcategoriainmueble ON mu.id = tbcategoriainmueble.idInmueble
            INNER JOIN tbcategorias ca ON tbcategoriainmueble.idCategoria = ca.idcategoria
            INNER JOIN tbfotoinmueble ft ON mu.id = ft.idInmueble
            LEFT JOIN tbcaracteristicasinmueble tc ON mu.id = tc.idInmueble
            WHERE mu.id = $idInmueble;";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();

                while ($row = $result->fetch_assoc()) {
                    $item = array(
                        "id" => $row['id'],
                        "Nombre_Inmueble" => $row["nombre_inmueble"],
                        "valorDiario" => $row["valorDiario"],
                        "capacidadPersonas" => $row["capacidadPersonas"],
                        "costoPersonaExtra" => $row["costoPersonaExtra"],
                        "direccion" => $row["direccion"],
                        "disponibilidad" => $row["disponibilidad"],
                        "estrellas" => $row["estrellas"],
                        "fechaLimiteDisponibilidad" => $row["fechaLimiteDisponibilidad"],
                        "nombre_propietario" => $row["nombre_propietario"],
                        "Categoria_Inmueble" => $row["Categoria_Inmueble"],
                        "nameImagen" => $row["nameImagen"],
                        "cantidadCuartos" => $row["cantidadCuartos"],
                        "cantidadCamas" => $row["cantidadCamas"],
                        "cantidadBanos" => $row["cantidadBanos"],
                        "cantidadPatios" => $row["cantidadPatios"],
                        "cantidadVehiculos" => $row["cantidadVehiculos"],
                        "cantidadPlantas" => $row["cantidadPlantas"],
                    );
                    $data[] = $item;
                }

                return json_encode($data);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    } //fn ConsultarInmueble POR ID

// =========================================================================================================
// ============RESEÑAS============RESEÑAS=============RESEÑAS==============RESEÑAS==========================
// =========================================================================================================



function ConsultarResenas_porID($idInmueble)
{
    
    try {
        $query = "SELECT 
                    tbresenalugar.Descripcion, 
                    tbresenalugar.fechaResena, 
                    tbresenalugar.estrellas, 
                    tbusuario.Nombre AS NombreUsuarioResena, 
                    tbusuario.fotoperfil
                    FROM 
                        tbresenalugar
                    JOIN 
                        tbusuario ON tbresenalugar.idUsuarioResena = tbusuario.idUser
                    WHERE 
                        tbresenalugar.idLugarDirigido = $idInmueble;";

$this->conn->set_charset("utf8");
$result = $this->getConexion()->query($query);

if ($result) {
            $data = array();
            
            while ($row = $result->fetch_assoc()) {
                // Suponiendo que $row["fotoperfil"] contiene la ruta de la imagen
                $imagenPath = $row["fotoperfil"];
                $imagenData = file_get_contents($imagenPath);
                $imagenBase64 = base64_encode($imagenData);
                
                $urlImagen = "data:image/jpeg;base64," . $imagenBase64;
                
                $item = array(
                    "Descripcion" => $row['Descripcion'],
                    "fechaResena" => $row["fechaResena"],
                    "estrellas" => $row["estrellas"],
                    "NombreUsuarioResena" => $row["NombreUsuarioResena"],
                    "fotoperfil" => $urlImagen,
                    // Aquí se guarda la imagen en formato base64
                );
                
                $data[] = $item;
            }
            return json_encode($data);
            

        } else {
            throw new Exception("Error en la consulta: " . $this->getConexion()->error);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return null; // Retorna null en caso de error
    }
    // $this->conn->close();
} //fn ConsultarResenias POR id


function CalcularTotalDeResenas($identificacion)
{
    try {
        $query = "SELECT COUNT(*) as `CantidadResenasTotales`
                  FROM `tbresenalugar` AS `r`
                  INNER JOIN `tbinmueble` AS `i` ON r.idLugarDirigido = i.id
                  WHERE i.Propietario = $identificacion";

$this->conn->set_charset("utf8");
$result = $this->getConexion()->query($query);

if ($result) {
    $count = $result->fetch_assoc()["CantidadResenasTotales"];
    return $count;
} else {
    throw new Exception("Error en la consulta: " . $this->getConexion()->error);
}
} catch (Exception $e) {
    error_log($e->getMessage());
    return null; // Retorna null en caso de error
}
}

function CalcularCalificacion_totalResenias($identificacion)
{
    try {
        $query = "SELECT AVG(r.estrellas) as `promedio`
                  FROM `tbresenalugar` AS `r`
                  INNER JOIN `tbinmueble` AS `i` ON r.idLugarDirigido = i.id
                  WHERE i.Propietario = $identificacion";

        $this->conn->set_charset("utf8");
        $result = $this->getConexion()->query($query);

        if ($result) {
            $promedio = $result->fetch_assoc()["promedio"];
            return $promedio;
        } else {
            throw new Exception("Error en la consulta: " . $this->getConexion()->error);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return null; // Retorna null en caso de error
    }
}

function CalcularTotalDeResenasYPromedio_PorInmueble($idInmueble)
{
    try {
        $query = "SELECT COUNT(*) as `CantidadResenasTotales`, 
                         AVG(estrellas) as `PromedioEstrellas`                
                  FROM `tbresenalugar` AS `r`
                  WHERE r.idLugarDirigido = $idInmueble";

        $this->conn->set_charset("utf8");
        $result = $this->getConexion()->query($query);

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Crear un array asociativo con ambos valores
                $resenasData = array(
                    "CantidadResenasTotales" => $row["CantidadResenasTotales"],
                    "PromedioEstrellas" => $row["PromedioEstrellas"]
                );

                return $resenasData;
            } else {
                return array("error" => "No hay resultados para el ID de inmueble proporcionado");
            }
        } else {
            throw new Exception("Error en la consulta: " . $this->getConexion()->error);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return null; // Retorna null en caso de error
    }
}




function ConsultarInmuebles_ConResenias()
{
    $arry_Datos = func_get_args();
    
    $idAnfitrion = $this->GetConexion()->real_escape_string($arry_Datos[0]);
    
    try {
        $query = " SELECT id, nombre AS nombre_inmueble,Estado,
                CASE disponibilidad
                       WHEN 1 THEN 'Disponible'
                       ELSE 'No Disponible' 
                   END AS disponibilidad
               FROM tbinmueble INNER JOIN tbestadolugar ON
               tbinmueble.estadoLugar = tbestadolugar.idEstado
               WHERE Propietario = $idAnfitrion
               AND EXISTS (
                   SELECT 1
                   FROM tbresenalugar
                   WHERE tbresenalugar.idLugarDirigido = tbinmueble.id
               )";


$this->conn->set_charset("utf8");
$result = $this->getConexion()->query($query);

if ($result) {
    $data = array();
    
    while ($row = $result->fetch_assoc()) {
        $item = array(
            "id" => $row['id'],
            "Nombre_Inmueble" => $row["nombre_inmueble"],
            "Estado" => $row["Estado"],
            "Disponibilidad" => $row["disponibilidad"]
        );
        $data[] = $item;
    }
    // $this->getConexion()->close();
    
    
    return json_encode($data);
} else {
    throw new Exception("Error en la consulta: " . $this->getConexion()->error);
}
} catch (Exception $e) {
    error_log($e->getMessage());
    return json_encode(array("error" => "Error en la consulta"));
    }
}
// =========================================================================================================
// ============FIN RESEÑAS============FIN RESEÑAS=============FIN RESEÑAS==============FINRESEÑAS===========
// =========================================================================================================


function ConsultaMultipleEspacios()
{
    $arry_Datos = func_get_args();
    
    $idAnfitrion = $this->GetConexion()->real_escape_string($arry_Datos[0]);
    
    try {
        $query = " SELECT id, nombre AS nombre_inmueble,Estado,
                    CASE disponibilidad
                           WHEN 1 THEN 'Disponible'
                           ELSE 'No Disponible'
                       END AS disponibilidad
                   FROM tbinmueble INNER JOIN tbestadolugar ON
                   tbinmueble.estadoLugar = tbestadolugar.idEstado
                   WHERE Propietario = $idAnfitrion;";

$this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);
            
            if ($result) {
                $data = array();
                
                while ($row = $result->fetch_assoc()) {
                    $item = array(
                        "id" => $row['id'],
                        "Nombre_Inmueble" => $row["nombre_inmueble"],
                        "Estado" => $row["Estado"],
                        "Disponibilidad" => $row["disponibilidad"]
                    );
                    $data[] = $item;
                }
                // $this->getConexion()->close();
                
                
                return json_encode($data);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    }
    
    

    function ConsultarCategorias()
    {

        try {
            $query = " Select * FROM tbcategorias ";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();

                while ($row = $result->fetch_assoc()) {
                    $item = array(
                        "idCat" => $row['idcategoria'],
                        "Nombre_Cat" => $row["categoria"],
                    );
                    $data[] = $item;
                }
                return json_encode($data);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    }

    function ConsultarListafavoritosPorUser($UserID)
    {
        try {
            $query = "SELECT idLista,nombreLista FROM `tblista` WHERE idusuario = $UserID;";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();

                while ($row = $result->fetch_assoc()) {
                    $item = array(
                        "idLista" => $row['idLista'],
                        "nombreLista" => $row["nombreLista"]
                    );
                    $data[] = $item;
                }

                return json_encode($data);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    } //fin  ConsultarListafavoritosPorUser

    function insertarFavoritoEnListadeUsuario()
    {

        $arry_Datos = func_get_args();

        $idInmueble = $this->GetConexion()->real_escape_string($arry_Datos[0]);
        $idLista = $this->GetConexion()->real_escape_string($arry_Datos[1]);
        $idusuario = $this->GetConexion()->real_escape_string($arry_Datos[2]);

        $query = "INSERT INTO `tbinmueblefavorito` (`idInmueble`, `idLista`, `idusuario`) VALUES ($idInmueble,  $idLista,  $idusuario)";

        if ($this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    function addNuevaLista($idusuario, $nombreLista)
    {

        $query = "INSERT INTO `tblista` (`idusuario`, `nombreLista`) VALUES ($idusuario,'$nombreLista');";

        if ($this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }


    /*----------------------------------------------- Notificaciones --------------------------------------------------*/
    /*----------------------------------------------- Notificaciones --------------------------------------------------*/
    
    function ConsultaNotificaciones()
    {
        $arry_Datos = func_get_args();
        
        $idAnfitrion = $this->GetConexion()->real_escape_string($arry_Datos[0]);
        
        try {
            $query = " SELECT descripcion, fecha
                    FROM tbnotificaciones
                    WHERE idUser = $idAnfitrion;";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();
                
                while ($row = $result->fetch_assoc()) {
                    $item = array(
                        "descripcion" => $row['descripcion'],
                        "fecha" => $row["fecha"],
                    );
                    $data[] = $item;
                }

                return json_encode($data);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    }

    function InsertarNotificacion_Registro($idusuario)
    {
        $fecha = date("Y-m-d"); 
        $query = "INSERT INTO `tbnotificaciones` (`descripcion`, `idusuario`, `fecha`)
        VALUES ('¡Bienvenido a My Lodgment Place! Has creado una cuenta en nuestro sitio.',  
        '$idusuario', '$fecha')";

        if ($this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    

    function InsertarNotificacion_Reserva($idInmueble, $idusuario)
    {
        $fecha = date("Y-m-d"); 

        // Consulta para obtener el nombre del inmueble
        $queryNombre = "SELECT `nombre` FROM `tbinmueble` WHERE id = $idInmueble"; 

        $resultadoNombre = $this->getConexion()->query($queryNombre);

        if ($resultadoNombre) {
            // Obtener el nombre del inmueble
            $fila = $resultadoNombre->fetch_assoc();
            $nombreInmueble = $fila['nombre'];

            // Consulta de inserción con el nombre del inmueble
            $query = "INSERT INTO `tbnotificaciones` (`descripcion`, `idusuario`, `fecha`)
                    VALUES ('Has realizado una Reserva en $nombreInmueble',  
                            '$idusuario', '$fecha')";

            if ($this->getConexion()->query($query)) {
                // Verificar si algún registro fue afectado
                if ($this->getConexion()->affected_rows > 0) {
                    return true;  // Éxito
                } else {
                    return false; // No se insertaron filas (puede ser una inserción duplicada)
                }
            } else {
                return false; // Error en la ejecución de la consulta
            }
        } else {
            return false; // Error en la consulta para obtener el nombre del inmueble
        }
    }

    function InsertarNotificacion_PagoAlAnfitrion($idInmueble, $idusuario)
    {
        $fecha = date("Y-m-d"); 

        // Consulta para obtener el nombre del inmueble
        $queryNombre = "SELECT `nombre` FROM `tbinmueble` WHERE id = $idInmueble"; 

        $resultadoNombre = $this->getConexion()->query($queryNombre);

        if ($resultadoNombre) {
            // Obtener el nombre del inmueble
            $fila = $resultadoNombre->fetch_assoc();
            $nombreInmueble = $fila['nombre'];

            // Consulta de inserción con el nombre del inmueble
            $query = "INSERT INTO `tbnotificaciones` (`descripcion`, `idusuario`, `fecha`)
                    VALUES ('Has realizado una Reserva en $nombreInmueble',  
                            '$idusuario', '$fecha')";

            if ($this->getConexion()->query($query)) {
                // Verificar si algún registro fue afectado
                if ($this->getConexion()->affected_rows > 0) {
                    return true;  // Éxito
                } else {
                    return false; // No se insertaron filas (puede ser una inserción duplicada)
                }
            } else {
                return false; // Error en la ejecución de la consulta
            }
        } else {
            return false; // Error en la consulta para obtener el nombre del inmueble
        }
    }

    function InsertarNotificacion_RealizadaUnaresenia()
    {
        $arry_Datos = func_get_args();

        $fecha = date("Y-m-d"); 

        $idInmueble = $this->GetConexion()->real_escape_string($arry_Datos[0]);
        $idusuario = $this->GetConexion()->real_escape_string($arry_Datos[1]);

        $query = "INSERT INTO `tbnotificaciones` (`descripcion`, `$idusuario`, `$fecha`)
            VALUES ('¡Bienvenido a My Lodgment Place! Has creado una cuenta en nuestro sitio.',  
            $idusuario,  $fecha)";

        if ($this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }



/*----------------------------------------------- FIN Notificaciones --------------------------------------------------*/
/*----------------------------------------------- FIN Notificaciones --------------------------------------------------*/
    
    //METODOS DE DENUNCIAS
    function ConsultarReservasPorUsuario($identificacion)
    {
        try {
            $query = "SELECT
            r.idUsuario,
            r.idInmueble,
            r.idReserva,
            CONCAT(r.fechaInicio, ' / ', r.fechaFin) AS fecha,
            CONCAT(u.nombre, ' ', u.apellido1, ' ', u.apellido2) AS nombre_completo,
            i.Propietario,
            i.nombre AS nombre_inmueble
        FROM tbreserva r
        INNER JOIN tbusuario u ON r.idUsuario = u.idUser
        INNER JOIN tbinmueble i ON r.idInmueble = i.id
        WHERE r.idUsuario = '$identificacion';";

            $result = $this->getConexion()->query($query);
            $reservas = array();

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $reserva = array(
                        "idReserva" => $row["idReserva"],
                        "idUsuario" => $row["idUsuario"],
                        "fecha" => $row["fecha"],
                        "nombreC" => $row["nombre_completo"],
                        "idInmueble" => $row["idInmueble"],
                        "id_propietarioI" => $row["Propietario"],
                        "nombre_inmueble" => $row["nombre_inmueble"],
                    );
                    $reservas[] = $reserva;
                }
                return $reservas;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    function ConsultarTipoDenuncias()
    {
        try {
            $query = "SELECT * FROM `tbtipodenuncia`";
            $result = $this->getConexion()->query($query);
            $tiposDenuncias = array();

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    // Almacena toda la fila en el array de tipos de denuncias
                    $tiposDenuncias[] = $row;
                }
                return json_encode($tiposDenuncias);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    function insertarDenuncia($idUsuario, $detalleDenuncia, $idUsuarioADenunciar, $estado, $tipoDenuncia)
    {
        try {
            $conexion = $this->getConexion();

            // Preparar la sentencia SQL
            $query = "INSERT INTO tbdenuncia (IdUsuarioQD, detalleDenuncia, idUsuarioADenunciar, estado, tipoDenuncia) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $stmt->bind_param("issis", $idUsuario, $detalleDenuncia, $idUsuarioADenunciar, $estado, $tipoDenuncia);

            // Ejecutar la consulta
            $resultado = $stmt->execute();

            // Verificar si la inserción fue exitosa
            if ($resultado) {
                return true;
            } else {
                throw new Exception("Error en la inserción: " . $stmt->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        } finally {
            $stmt->close();
        }
    }

    function modificarDenuncia($idDenuncia, $respuestaDenunciado)
    {
        try {
            $conexion = $this->getConexion();

            // Preparar la sentencia SQL
            $query = "UPDATE tbdenuncia SET RespuestaUsuarioDenunciado = ? WHERE idDenuncia = ?";
            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $stmt->bind_param("si", $respuestaDenunciado, $idDenuncia);

            // Ejecutar la consulta
            $resultado = $stmt->execute();

            // Verificar si la actualización fue exitosa
            if ($resultado) {
                return true;
            } else {
                throw new Exception("Error en la actualización: " . $stmt->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        } finally {
            $stmt->close();
        }
    }

    function modificarDenunciaAdm($idDenuncia, $identificacion, $respuestaDenunciaAdm, $estadoNuevo)
    {
        try {
            // Obtener la conexión
            $conexion = $this->getConexion();

            // Verificar si la conexión es válida
            if (!$conexion) {
                throw new Exception("Error al obtener la conexión.");
            }

            // Preparar la sentencia SQL
            $query = "UPDATE tbdenuncia SET RespuestaDenunciaAdmin = ?, idAdminAtiende = ?, estado = ? WHERE idDenuncia = ?";
            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $stmt->bind_param("sssi", $respuestaDenunciaAdm, $identificacion, $estadoNuevo, $idDenuncia);

            // Ejecutar la consulta
            $resultado = $stmt->execute();

            // Verificar si la actualización fue exitosa
            if ($resultado) {
                return true;
            } else {
                throw new Exception("Error en la actualización: " . $stmt->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        } finally {
            // Cerrar la declaración
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }


    function ConsultarDenunciasPorCedula($identificacion)
    {
        try {
            $query = "SELECT tbdenuncia.*, 
            CONCAT(tbusuario.nombre, ' ', tbusuario.apellido1, ' ', tbusuario.apellido2) AS nombreC_Usu, 
            CONCAT(usuariosADenunciar.nombre, ' ', usuariosADenunciar.apellido1, ' ', usuariosADenunciar.apellido2) AS nombreC_Denunciado,  
            tbtipodenuncia.tipoDenuncia
            FROM tbdenuncia
            JOIN tbusuario ON tbdenuncia.IdUsuarioQD = tbusuario.idUser
            JOIN tbusuario AS usuariosADenunciar ON tbdenuncia.idUsuarioADenunciar = usuariosADenunciar.idUser
            JOIN tbtipodenuncia ON tbdenuncia.tipoDenuncia = tbtipodenuncia.id
            WHERE tbdenuncia.IdUsuarioQD = '$identificacion' OR tbdenuncia.idUsuarioADenunciar = '$identificacion' AND tbdenuncia.estado = 'Proceso'";
            $result = $this->getConexion()->query($query);
            $DenunciasxID = array();

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    // Almacena toda la fila en el array de tipos de denuncias
                    $DenunciasxID[] = $row;
                }
                return json_encode($DenunciasxID);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    function TodasDenuncias()
    {
        try {
            $query = "SELECT tbdenuncia.*, 
            CONCAT(tbusuario.nombre, ' ', tbusuario.apellido1, ' ', tbusuario.apellido2) AS nombreC_Usu, 
            CONCAT(usuariosADenunciar.nombre, ' ', usuariosADenunciar.apellido1, ' ', usuariosADenunciar.apellido2) AS nombreC_Denunciado,  
            tbtipodenuncia.tipoDenuncia
            FROM tbdenuncia
            JOIN tbusuario ON tbdenuncia.IdUsuarioQD = tbusuario.idUser
            JOIN tbusuario AS usuariosADenunciar ON tbdenuncia.idUsuarioADenunciar = usuariosADenunciar.idUser
            JOIN tbtipodenuncia ON tbdenuncia.tipoDenuncia = tbtipodenuncia.id";
            $result = $this->getConexion()->query($query);
            $DenunciasxID = array();

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    // Almacena toda la fila en el array de tipos de denuncias
                    $DenunciasxID[] = $row;
                }
                return json_encode($DenunciasxID);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    // --------------------------------------------------------------- RESERVAS -------------------------------------

    function consultaInfoparaCalificarHuesped($identificacion)
    {
        try {
            $query = "SELECT 
                    tbreserva.idReserva as reserva,
                    tbinmueble.nombre AS inmueble_reservado,
                    tbreserva.idUsuario as ced_huesped,
                    CONCAT(tbusuario.nombre, ' ', tbusuario.apellido1, ' ', tbusuario.apellido2) AS nombre_huesped
                FROM 
                    `tbreserva`
                INNER JOIN 
                    `tbinmueble` ON tbreserva.idInmueble = tbinmueble.id
                INNER JOIN 
                    `tbusuario` ON tbreserva.idUsuario = tbusuario.idUser
                    where tbinmueble.Propietario = $identificacion;";

            $result = $this->getConexion()->query($query);
            $arrayData = array();

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $arrayData[] = $row;
                }
                return json_encode($arrayData);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    } //fin consultaInfoparaCalificarHuesped

    function consultaInfoparaCalificarAnfitrion($identificacion)
    {
        try {
            $query = "SELECT 
            tbreserva.idReserva as reserva,
            tbinmueble.nombre AS inmueble_reservado,
           tbinmueble.Propietario as ced_anfitrion,
            CONCAT(tbusuario.nombre, ' ', tbusuario.apellido1, ' ', tbusuario.apellido2) AS nombre_anfitrion
        FROM 
            `tbreserva`
        INNER JOIN 
            `tbinmueble` ON tbreserva.idInmueble = tbinmueble.id
        INNER JOIN 
            `tbusuario` ON tbinmueble.Propietario = tbusuario.idUser
            where tbreserva.idUsuario = $identificacion;";

            $result = $this->getConexion()->query($query);
            $arrayData = array();

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $arrayData[] = $row;
                }
                return json_encode($arrayData);
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    } //fin consultaInfoparaCalificarHuesped

    //----------------------------------------------------------CALIFICACIONES ------------------------------------------
    function InsertarCalificacion($reservaBase, $comentario, $estrellas, $cedulacalificador, $tipoCalificacion)
    {
        try {
            $conexion = $this->getConexion();

            // Utilizar una consulta preparada para evitar la inyección de SQL
            $query = "INSERT INTO `tbcalificaciones` (`idReservaBase`, `comentario`, `estrellas`, `idCalificador`, `idTipoCalificacion`) 
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);

            // Vincular parámetros (significa integer,string,integer,integer,integer)
            $stmt->bind_param("isiii", $reservaBase, $comentario, $estrellas, $cedulacalificador, $tipoCalificacion);

            // Ejecutar la consulta preparada
            $stmt->execute();

            // Verificar si la inserción fue exitosa
            if ($stmt->affected_rows > 0) {
                // Devolver el ID de la fila insertada (si es relevante para tu aplicación)
                return $stmt->insert_id;
            } else {
                throw new Exception("Error en la inserción: " . $stmt->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        } finally {
            // Cerrar la consulta preparada y la conexión
            $stmt->close();
            $conexion->close();
        }
    }

    //----------------------------------------------------------Validar Perfil ------------------------------------------

    // función para actualizar el estado en la base de datos
    function actualizarEstado($idUser, $nuevoEstado)
    {
        try {
            $conn = $this->GetConexion();

            $idUser = $conn->real_escape_string($idUser);
            $nuevoEstado = $conn->real_escape_string($nuevoEstado);

            $sql = "UPDATE tbvalidacionperfil SET estadoValidacion = '$nuevoEstado' WHERE nombreImagenUsuario = '$idUser'";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // función para Validar la identidad

    function validarIdentidad($idUser)
    {
        try {
            return $this->actualizarEstado($idUser, 'Activado');
        } catch (Exception $e) {
            echo "Error al validar la identidad: " . $e->getMessage();
            return false; // Error general
        }
    }
    // función para obtener el estado del usuario
    function obtenerEstadoUsuario($idUser)
    {
        try {
            $conn = $this->GetConexion();

            // Escapar los datos para prevenir inyecciones SQL
            $idUser = $conn->real_escape_string($idUser);

            // Consulta SQL para obtener el estado del usuario
            $sql = "SELECT estadoValidacion FROM tbvalidacionperfil WHERE nombreImagenUsuario = '$idUser' limit 1";

            // Ejecutar la consulta
            $resultado = $conn->query($sql);

            // Verificar si se obtuvieron resultados
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                return $fila['estadoValidacion'];
            } else {
                return "El usuario no se encuentra validado";
            }
        } catch (Exception $e) {
            echo "Error al obtener el estado del usuario: " . $e->getMessage();
            return "Error"; // Puedes manejar el error de la manera que prefieras
        }
    }




    /* ----------------------- Obtener Inmuebles por Propietario ----------------------- */

    function GetInmueblesByPropietario($idUser)
    {
        $sql = "SELECT * FROM tbinmueble WHERE Propietario = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idUser);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $inmuebles = array();
                while ($row = $result->fetch_assoc()) {
                    $inmuebles[] = $row;
                }
                return $inmuebles;
            }
        }

        return array();
    }
} //fn cl_masterClass
$ObjMaster = new Master_Class();

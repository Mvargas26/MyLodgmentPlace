<?php
require_once(__DIR__ . '/../libs/PHPMAILER/autoload.php');

date_default_timezone_set("America/Costa_Rica");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Master_Class
{
    private $conn;
    //******Local
    private $server = "";
    private $username = "";
    private $password = "";
    private $db = "";

  
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


    function Insertar_Caracteristicas(
        $cantCuartosU,
        $cantCamasU,
        $cantBaniosU,
        $cantPatiosU,
        $cantCocherasU,
        $cantPlantasU,
        $idInmueble
    ) {

        $query = "SELECT `id` FROM `tbinmueble` WHERE 
        Order By id DESC 
        LIMIT 1";

        // Ejecutar la consulta
        $result = $this->GetConexion()->query($query);

        // Verificar si la consulta fue exitosa
        if ($result) {
        // Obtener el ID si hay resultados
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idInmueble = $row['id'];
        } else {
            // No se encontraron resultados
            $idInmueble = null;
        }
        } else {
        // Hubo un error en la consulta
        $idInmueble = null;
        }

        if($idInmueble !== null){
            
            $query = "INSERT INTO `tbcaracteristicasinmueble`(`cantidadCuartos`, `cantidadCamas`, 
            `cantidadBanos`, `cantidadPatios`, `cantidadVehiculos`, `cantidadPlantas`, `idInmueble`) 
            VALUES ('$cantCuartosU', '$cantCamasU', '$cantBaniosU', '$cantPatiosU','$cantCocherasU',
            '$cantPlantasU','$idInmueble')";
    
            if ($this->getConexion()->query($query)) {

                return true;
    
            } else {
                return false;
            }

        }
        else{
            return false; 
        }

    } //fin Insertar Inmueble



    function Insertar_ServiciosInmueble($ArrayServicios , $idInmueble)
    {
        // Obtener el último ID de la tabla tbinmueble
        // $query = "SELECT id FROM tbinmueble ORDER BY id DESC LIMIT 1;";
        // $result = $this->GetConexion()->query($query);

        // if ($result && $result->num_rows > 0) {
        //     $row = $result->fetch_assoc();
        //     $idInmuebleNuevo = $row['id'];
        // } else {
        //     // Manejar el caso cuando no se encuentra ningún ID
        //     return false;
        // }

        // Construir la consulta para insertar servicios
        $query = "INSERT INTO `tbinmuebleservicio` (`idServicio`, `idInmueble`, `disponibilidad`) VALUES ";

        // Uno por cada servicio
        foreach ($ArrayServicios as $idServicio) {
            $idServicio = $this->GetConexion()->real_escape_string($idServicio);
            // Añadir un valor fijo para 'disponibilidad', puedes ajustarlo según tus necesidades
            $query .= "('$idServicio', '$idInmueble', 'disponible'),";
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
                $mail->Host = 'smtp.hostinger.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'noreply@varsot.com';
                $mail->Password = 'Pruebas1234*';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('noreply@varsot.com', 'My Lodgment Place');
                $mail->addAddress($destinatario);
                $mail->isHTML(true);
                $mail->Subject = 'Codigo de autenticacion para el inicio de sesion';
                $mail->Body = 'Bienvenido a My Lodgment Place, este es tu codigo de autenticacion: ' . $codigo_autenticacion;
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

    /*
           METODOS PARA ENVIAR CORREO Y MANTENIMIENTO DEL CORREO
   */
    function gestionarCorreo($accion, $datos)
    {
        try {
            $idCorreo = isset($datos['Id']) ? $datos['Id'] : null;
            $host = isset($datos['Host']) ? $datos['Host'] : null;
            $usuario = isset($datos['Usuario']) ? $datos['Usuario'] : null;
            $contra = isset($datos['Contra']) ? $datos['Contra'] : null;
            $puerto = isset($datos['Puerto']) ? $datos['Puerto'] : null;
            switch ($accion) {
                case 'insertar':
                    $query = "INSERT INTO tbcorreo (Host, Usuario, Password, Puerto) VALUES ('$host', '$usuario', '$contra', '$puerto')";
                    break;

                case 'modificar':
                    $query = "UPDATE tbcorreo SET Host = '$host', Usuario = '$usuario', Password = '$contra', Puerto = '$puerto' WHERE IdEmail = '$idCorreo'";
                    break;

                case 'consultar':
                    $query = "SELECT * FROM tbcorreo";
                    if (!empty($idCorreo)) {
                        $query .= " WHERE IdEmail = '$idCorreo'";
                    }
                    $result = $this->GetConexion()->query($query);

                    if ($result) {
                        $data = array();

                        while ($row = $result->fetch_assoc()) {
                            $item = array(
                                "idCorreo" => $row['IdEmail'],
                                "Host" => $row['Host'],
                                "Usuario" => $row['Usuario'],
                                "Contra" => $row['Contrasenna'],
                                "Puerto" => $row['Puerto'],
                            );
                            $data[] = $item;
                        }

                        return json_encode($data);
                    } else {
                        throw new Exception("Error en la consulta: " . $this->GetConexion()->error);
                    }
                    break;

                case 'eliminar':
                    $query = "DELETE FROM tbcorreo WHERE IdEmail = '$idCorreo'";
                    break;

                default:
                    throw new Exception("Acción no válida: $accion");
            }

            $this->GetConexion()->query($query);

            return $this->GetConexion()->affected_rows > 0;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function gestionarMensajes($accion, $datos)
    {
        try {
            $idM = isset($datos['ID']) ? $datos['ID'] : null;
            $Mensaje = isset($datos['Mensaje']) ? $datos['Mensaje'] : null;
            $TipoM = isset($datos['TipoM']) ? $datos['TipoM'] : null; 
            switch ($accion) {
                case 'insertar':
                    $query = "INSERT INTO tbmensajescorreo (Mensaje, TipoMensaje) VALUES ('$Mensaje', '$TipoM')";
                    break;

                case 'modificar':
                    $query = "UPDATE tbmensajescorreo SET Mensaje = '$Mensaje', TipoMensaje = '$TipoM' WHERE ID = '$idM'";
                    break;

                case 'consultar':
                    $query = "SELECT * FROM tbmensajescorreo";
                    if (!empty($idCorreo)) {
                        $query .= " WHERE TipoM = '$TipoM'";
                    }
                    $result = $this->GetConexion()->query($query);

                    if ($result) {
                        $data = array();

                        while ($row = $result->fetch_assoc()) {
                            $item = array(
                                "Id" => $row['ID'],
                                "Mensaje" => $row['Mensaje'],
                                "TipoM" => $row['TipoMensaje'],
                            );
                            $data[] = $item;
                        }

                        return json_encode($data);
                    } else {
                        throw new Exception("Error en la consulta: " . $this->GetConexion()->error);
                    }
                    break;

                case 'eliminar':
                    $query = "DELETE FROM tbmensajescorreo WHERE ID = '$idM'";
                    break;

                default:
                    throw new Exception("Acción no válida: $accion");
            }

            $this->GetConexion()->query($query);

            return $this->GetConexion()->affected_rows > 0;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    function enviarMensajesCorreo($destinatario, $accion)
    {
        $mail = new PHPMailer(true);
        // $datosCorreo = $this->gestionarCorreo('consultar', ['idCorreo' => 1]); // Cambia '1' por el ID del correo que necesitas
        // if ($datosCorreo) {
        //     $host = $datosCorreo[0]['Host'];
        //     $usuario = $datosCorreo[0]['Usuario'];
        //     $contra = $datosCorreo[0]['Password']; // Asegúrate de usar la clave correcta
        //     $puerto = $datosCorreo[0]['Puerto'];

            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.titan.email';
                $mail->SMTPAuth = true;
                $mail->Username = 'pruebas@tritechno.net';
                $mail->Password = 'Pruebas1234*';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // $mail->isSMTP();
                // $mail->Host = $host;
                // $mail->SMTPAuth = true;
                // $mail->Username = $usuario;
                // $mail->Password = $contra;
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                // $mail->Port = $puerto;

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
        // } else {
        // }
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
            } else {
                return false;
            }
        } else {

            $query3 = "INSERT INTO tbReserva (idUsuario, idInmueble, fechaInicio, fechaFin, montoTotal, montoTotalImpuesto, personasExtra, cantPersonas, colorEvento) VALUES ('$idUsuario', '$idInmueble', '$fechaInicio', '$fechaFin', '$montoTotal', '$montoTotalImpuesto', '$personasExtra', '$cantPersonas', '#FFFFFF')";

            $resultado3 = $this->GetConexion()->query($query3);

            return true;
        }
    }

    //fin funcion ReservaLugar

    //inicio funcion crearCupon

    public function crearCupon($nombreCupon, $montoDescuento, $cantidadCupones, $fechaVencimiento, $tipoDescuento, $idInmueble)
    {
        $query = "INSERT INTO tbdescuento (idCupon, Monto, CantidadCupones, tipoDescuento) VALUES ('$nombreCupon', '$montoDescuento', '$cantidadCupones', '$tipoDescuento')";

        $resultado = $this->GetConexion()->query($query);

        $query2 = "INSERT INTO tbinmueblecupon (idInmueble, idCupon, fechaVencimiento, Validez) VALUES ('$idInmueble', '$nombreCupon', '$fechaVencimiento', '1')";

        $resultado2 = $this->GetConexion()->query($query2);

        return true;
    }

    //fin funcion crearCupon

    //inicio funcion modificarCupon

    public function modificarCupon($nombreCupon, $montoDescuento, $cantidadCupones, $fechaVencimiento, $tipoDescuento, $idInmueble)
    {
        // Implementa aquí la lógica para modificar el cupón en la base de datos
        $query = "UPDATE tbdescuento 
              SET Monto = '$montoDescuento', CantidadCupones = '$cantidadCupones', tipoDescuento = '$tipoDescuento'
              WHERE idCupon = '$nombreCupon'";

        $resultado = $this->GetConexion()->query($query);

        $query2 = "UPDATE tbinmueblecupon 
               SET fechaVencimiento = '$fechaVencimiento' 
               WHERE idInmueble = '$idInmueble' AND idCupon = '$nombreCupon'";

        $resultado2 = $this->GetConexion()->query($query2);

        return true; // Cambiar si necesitas retornar otra cosa para confirmar la modificación
    }
    //fin funcion modificarCupon

    //inicio funcion obtenerInmueblesConCupon

    public function obtenerInmueblesConCupon($idPropietario)
    {
        $query = "SELECT DISTINCT i.id, i.nombre 
              FROM tbinmueble i 
              INNER JOIN tbinmueblecupon c ON i.id = c.idInmueble 
              WHERE i.Propietario = $idPropietario";

        $result = $this->GetConexion()->query($query);

        $inmuebles = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $inmueble = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre']
                );
                $inmuebles[] = $inmueble;
            }
        }

        return $inmuebles;
    }
    //fin funcion obtenerInmueblesConCupon

    //inicio funcion obtenerInmueblesporIdDuenno
    public function obtenerInmueblesporIdDuenno($idPropietario)
    {
        $query = "SELECT DISTINCT i.id, i.nombre 
              FROM tbinmueble i 
              WHERE i.Propietario = $idPropietario";

        $result = $this->GetConexion()->query($query);

        $inmuebles = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $inmueble = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre']
                );
                $inmuebles[] = $inmueble;
            }
        }

        return $inmuebles;
    }
    //fin funcion obtenerInmueblesporIdDuenno

    //inicio funcion obteneridDuenno
    public function obteneridDuenno($espacio)
    {
        $query = "SELECT `Propietario` FROM `tbinmueble` WHERE id = $espacio";

        $result = $this->GetConexion()->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Propietario'];
        }

        return false;
    }
    //fin funcion obteneridDuenno

    //inicio funcion VerificarCupon
    public function VerificarCupon($idInmueble, $CuponDescuento, $fechaInicio)
    {
        // Consulta para verificar el cupón y obtener su descuento
        $query = "SELECT d.Monto AS Descuento
        FROM tbdescuento d
        INNER JOIN tbinmueblecupon ic ON d.idCupon = ic.idCupon
        WHERE ic.idInmueble = $idInmueble
        AND ic.idCupon = '$CuponDescuento'
        AND ic.fechaVencimiento >= '$fechaInicio'
        AND d.CantidadCupones > 1
        AND ic.validez = 1;";

        $result = $this->GetConexion()->query($query);

        if ($result->num_rows > 0) {
            // El cupón es válido, se puede aplicar, se devuelve el porcentaje de descuento
            $row = $result->fetch_assoc();
            return $row['Descuento'];
        } else {
            // El cupón no es válido para el inmueble o no cumple con las condiciones
            return false;
        }
    }
    //fin funcion VerificarCupon

    //inicio funcion insertarReserva
    public function insertarReserva($idUsuario, $idInmueble, $fechaInicio, $fechaFin, $montoTotal, $montoTotalImpuesto, $personasExtra, $cantPersonas)
    {
        $query = "INSERT INTO tbreserva (idUsuario, idInmueble, fechaInicio, fechaFin, montoTotal, montoTotalImpuesto, personasExtra, cantPersonas) VALUES ('$idUsuario', '$idInmueble', '$fechaInicio', '$fechaFin', '$montoTotal', '$montoTotalImpuesto', '$personasExtra', '$cantPersonas')";

        $result = $this->GetConexion()->query($query);

        if ($result) {
            return "Reserva creada correctamente";
        } else {
            return "Error al realizar la reserva: " . $this->GetConexion()->error;
        }
    }
    //fin funcion insertarReserva


    //inicio funcion obtenerCuponesPorInmueble
    public function obtenerCuponesPorInmueble($idInmueble)
    {
        $query = "SELECT idCupon FROM tbinmueblecupon WHERE idInmueble = '$idInmueble'";
        $result = $this->GetConexion()->query($query);

        $cupones = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cupones[] = $row['idCupon'];
            }
        }

        return $cupones;
    }
    //fin funcion obtenerCuponesPorInmueble

    //inicio funcion obtenerNombresInmuebles
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

    //fin funcion obtener obtenerNombresInmuebles

    //inicio funcion obtenerDatosCupon
    public function obtenerDatosCupon($nombreCupon) {
        $query = "SELECT d.Monto, d.CantidadCupones, d.TipoDescuento, c.fechaVencimiento 
                  FROM tbdescuento d
                  JOIN tbinmueblecupon c ON c.idCupon = d.idCupon
                  WHERE d.idCupon = '$nombreCupon'";
    
        $result = $this->GetConexion()->query($query);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return array(
                'monto' => $row['Monto'],
                'cantidad' => $row['CantidadCupones'],
                'nombre' =>$nombreCupon,
                'fecha' => $row['fechaVencimiento']
            );
        } else {
            return null;
        }
    }
    //fin funcion obtenerDatosCupon

    //inicio funcion obtenerCaracteristicasInmueble
    public function obtenerCaracteristicasInmueble($idInmueble)
    {
        $query = "SELECT cantidadCuartos, cantidadCamas, cantidadBanos, cantidadPatios, cantidadVehiculos, cantidadPlantas
              FROM tbcaracteristicasinmueble
              WHERE idInmueble = '$idInmueble'";

        $result = $this->GetConexion()->query($query);

        if ($result->num_rows > 0
        ) {
            $row = $result->fetch_assoc();
            return array(
                'cantidadCuartos' => $row['cantidadCuartos'],
                'cantidadCamas' => $row['cantidadCamas'],
                'cantidadBanos' => $row['cantidadBanos'],
                'cantidadPatios' => $row['cantidadPatios'],
                'cantidadVehiculos' => $row['cantidadVehiculos'],
                'cantidadPlantas' => $row['cantidadPlantas']
            );
        } else {
            return null;
        }
    }
        //fin funcion obtenerCaracteristicasInmueble

    //inicio funcion modificarDatosCupon
    public function modificarDatosCupon($idInmueble, $idCuponActual, $nuevoNombre, $nuevoMonto, $nuevaCantidad, $nuevaFechaVencimiento)
    {
        $conexion = $this->GetConexion();
    
        // Verificar si el nombre del cupón ha cambiado
        if ($idCuponActual !== $nuevoNombre) {
            // Obtener los datos del cupón actual en tbinmueblecupon
            $querySelectOldCupon = "SELECT fechaVencimiento, validez FROM tbinmueblecupon WHERE idInmueble = ? AND idCupon = ?";
            $stmtSelectOldCupon = $conexion->prepare($querySelectOldCupon);
            $stmtSelectOldCupon->bind_param("ss", $idInmueble, $idCuponActual);
            $stmtSelectOldCupon->execute();
            $resultSelect = $stmtSelectOldCupon->get_result();
    
            // Almacenar los datos del cupón actual antes de eliminarlos
            $oldCuponData = $resultSelect->fetch_assoc();
    
            // Eliminar el registro antiguo en tbinmueblecupon
            $queryDeleteOldCupon = "DELETE FROM tbinmueblecupon WHERE idInmueble = ? AND idCupon = ?";
            $stmtDeleteOldCupon = $conexion->prepare($queryDeleteOldCupon);
            $stmtDeleteOldCupon->bind_param("ss", $idInmueble, $idCuponActual);
            $resultDelete = $stmtDeleteOldCupon->execute();
    
            // Si se eliminó correctamente, proceder a actualizar los datos
            if ($resultDelete) {
                // Actualizar el nombre del cupón, monto y cantidad en tbdescuento
                $queryUpdateDescuento = "UPDATE tbdescuento SET idCupon = ?, Monto = ?, CantidadCupones = ? WHERE idCupon = ?";
                $stmtUpdateDescuento = $conexion->prepare($queryUpdateDescuento);
                $stmtUpdateDescuento->bind_param("sdis", $nuevoNombre, $nuevoMonto, $nuevaCantidad, $idCuponActual);
                $resultUpdateDescuento = $stmtUpdateDescuento->execute();
    
                // Insertar los nuevos datos del cupón en tbinmueblecupon
                $queryInsertNewCupon = "INSERT INTO tbinmueblecupon (idInmueble, idCupon, fechaVencimiento, validez) VALUES (?, ?, ?, ?)";
                $stmtInsertNewCupon = $conexion->prepare($queryInsertNewCupon);
                $validez = ($nuevaFechaVencimiento >= date('Y-m-d')) ? 1 : 2;
                $stmtInsertNewCupon->bind_param("sssi", $idInmueble, $nuevoNombre, $nuevaFechaVencimiento, $validez);
                $resultInsertNew = $stmtInsertNewCupon->execute();
    
                // Verificar si las consultas se ejecutaron correctamente
                if ($resultUpdateDescuento && $resultInsertNew) {
                    return true; // Todo se actualizó correctamente
                } else {
                    return false; // Hubo un error al actualizar los datos
                }
            } else {
                return false; // Hubo un error al eliminar el registro antiguo
            }
        } else {
            // Actualizar otros datos sin cambiar el idCupon
            $queryUpdateOnlyDescuento = "UPDATE tbdescuento SET Monto = ?, CantidadCupones = ? WHERE idCupon = ?";
            $stmtUpdateOnlyDescuento = $conexion->prepare($queryUpdateOnlyDescuento);
            $stmtUpdateOnlyDescuento->bind_param("dis", $nuevoMonto, $nuevaCantidad, $idCuponActual);
    
            $queryUpdateOnlyInmuebleCupon = "UPDATE tbinmueblecupon SET fechaVencimiento = ?, validez = ? WHERE idCupon = ?";
            $stmtUpdateOnlyInmuebleCupon = $conexion->prepare($queryUpdateOnlyInmuebleCupon);
            $validez = ($nuevaFechaVencimiento >= date('Y-m-d')) ? 1 : 2;
            $stmtUpdateOnlyInmuebleCupon->bind_param("sii", $nuevaFechaVencimiento, $validez, $idCuponActual);
    
            // Ejecutar las consultas
            $resultUpdateOnlyDescuento = $stmtUpdateOnlyDescuento->execute();
            $resultUpdateOnlyInmuebleCupon = $stmtUpdateOnlyInmuebleCupon->execute();
    
            // Verificar si las consultas se ejecutaron correctamente
            if ($resultUpdateOnlyDescuento && $resultUpdateOnlyInmuebleCupon) {
                return true; // Todo se actualizó correctamente
            } else {
                return false; // Hubo un error al actualizar los datos
            }
        }
    }
    //fin funcion modificarDatosCupon

//inicio funcion eliminarCupon

public function eliminarCupon($idInmueble, $idCupon) {
    $conexion = $this->GetConexion();

    // Eliminar el cupón de la tabla tbinmueblecupon
    $queryDeleteInmuebleCupon = "DELETE FROM tbinmueblecupon WHERE idInmueble = ? AND idCupon = ?";
    $stmtDeleteInmuebleCupon = $conexion->prepare($queryDeleteInmuebleCupon);
    $stmtDeleteInmuebleCupon->bind_param("ss", $idInmueble, $idCupon);
    $resultDeleteInmuebleCupon = $stmtDeleteInmuebleCupon->execute();

    // Eliminar el cupón de la tabla tbdescuento
    $queryDeleteDescuento = "DELETE FROM tbdescuento WHERE idCupon = ?";
    $stmtDeleteDescuento = $conexion->prepare($queryDeleteDescuento);
    $stmtDeleteDescuento->bind_param("s", $idCupon);
    $resultDeleteDescuento = $stmtDeleteDescuento->execute();

    // Verificar si se eliminó correctamente de ambas tablas
    if ($resultDeleteInmuebleCupon && $resultDeleteDescuento) {
        return true; // Cupón eliminado correctamente
    } else {
        return false; // Hubo un problema al eliminar el cupón
    }
}

//fin funcion eliminarCupon

    //Inicio funcion ObtenerCantidadReservas
    public function ObtenerCantidadReservas()
    {
        $query = "SELECT COUNT(*) as total_reservas FROM tbreserva";
        $result = $this->GetConexion()->query($query);
        $row = $result->fetch_assoc();
        return $row['total_reservas'];
    }

    //fin funcion ObtenerCantidadReservas

    //Inicio funcion ObtenerCantidadEspacios

    public function ObtenerCantidadEspacios()
    {
        $query = "SELECT COUNT(*) as total_espacios FROM tbinmueble";
        $result = $this->GetConexion()->query($query);
        $row = $result->fetch_assoc();
        return $row['total_espacios'];
    }


    //fin funcion ObtenerCantidadEspacios

    //Inicio funcion ObtenerCantidadAnfitriones

    public function ObtenerCantidadAnfitriones()
    {
        $query = "SELECT COUNT(*) as total_anfitriones FROM tbusuario WHERE idrol = 2";
        $result = $this->GetConexion()->query($query);
        $row = $result->fetch_assoc();
        return $row['total_anfitriones'];
    }

    //fin funcion ObtenerCantidadAnfitriones

    //Inicio funcion ObtenerCantidadUsuarios

    public function ObtenerCantidadUsuarios()
    {
        $query = "SELECT COUNT(*) as total_usuarios FROM tbusuario WHERE idrol = 3";
        $result = $this->GetConexion()->query($query);
        $row = $result->fetch_assoc();
        return $row['total_usuarios'];
    }

    //fin funcion ObtenerCantidadUsuarios

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
                ) AS ft ON mu.id = ft.idInmueble
                where mu.estadoLugar=1;";

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

    function ConsultarInmueblesSinValidar(){
        try {
            $query = "SELECT id,i.nombre AS nombreInm,Propietario,  CONCAT(u.nombre, ' ', u.apellido1) AS nombrePropietario
            FROM tbinmueble i
            inner Join tbusuario u ON
            i.Propietario = u.idUser 
            WHERE estadoLugar =2;";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();

                while ($row = $result->fetch_assoc()) {
                    $item = array(
                        "id" => $row['id'],
                        "nombreInm" => $row["nombreInm"],
                        "Propietario" => $row["Propietario"],
                        "nombrePropietario" => $row["nombrePropietario"],
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

    // =========================================================================================================
// ============RESEÑAS============RESEÑAS=============RESEÑAS==============RESEÑAS==========================
// =========================================================================================================

    // anfitrion
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


    //huesped
    function ConsultarResenas_porID_Huesped($idInmueble, $idHuesped)
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
                        tbresenalugar.idLugarDirigido = $idInmueble 
                        AND tbresenalugar.idUsuarioResena = $idHuesped";

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
                // header('Content-Type: application/json; charset=utf-8');
                return $data;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    } //fn ConsultarResenias POR id


    function CalcularTotalDeResenas_Anfitrion($identificacion)
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
    } //end consultar resenas por id


    //HUEsPED
    function ConsultarTUSResenas_porID_Huesped($idHuesped)
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
                    tbusuario.idUser = $idHuesped;";

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
    } //fn ConsultarResenias POR id Huesped


    function ConsultarTUSResenasRecibidas_porID_Huesped($idHuesped)
    {
        try {
            $query = "SELECT 
                c.comentario,
                CONCAT(u.nombre, ' ', u.apellido1) AS nombreAnfitrion,
                u.fotoPerfil AS fotoPerfilCalificador,
                c.estrellas,
                i.nombre AS nombreInmueble
            FROM
                tbcalificaciones c
            JOIN
                tbreserva r ON c.idReservaBase = r.idReserva
            JOIN
                tbinmueble i ON r.idInmueble = i.id
            JOIN
                tbusuario u ON c.idCalificador = u.idUser
            WHERE
                r.idUsuario = $idHuesped";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();

                while ($row = $result->fetch_assoc()) {
                    // Suponiendo que $row["fotoPerfilCalificador"] contiene la ruta de la imagen
                    $imagenPath = $row["fotoPerfilCalificador"];
                    $imagenData = file_get_contents($imagenPath);
                    $imagenBase64 = base64_encode($imagenData);

                    $urlImagen = "data:image/jpeg;base64," . $imagenBase64;

                    $item = array(
                        "comentario" => $row['comentario'],
                        "nombreAnfitrion" => $row["nombreAnfitrion"],

                        // Aquí se guarda la imagen en formato base64
                        "fotoPerfilCalificador" => $urlImagen,
                        "estrellas" => $row["estrellas"],
                        "nombreInmueble" => $row["nombreInmueble"],
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
    } //fn ConsultarResenias recibidas POR id Huesped 






    function VERTODAS_RESENAS($idHuesped)
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
                    tbusuario.idUser = $idHuesped;";

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
                return $data;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
        // $this->conn->close();
    } //fn ConsultarResenias POR id Huesped






    function CalcularCalificacion_totalResenias_Anfitrion($identificacion)
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
    } //end metodo calcular resenas y promedio anfitrion


    // Huesped_Indicadores
    function CalcularPromedioCalificacionRecibida_Huesped($idHuesped)
    {
        try {
            $query = "SELECT AVG(c.estrellas) AS `promedio_estrellas`
                FROM `tbcalificaciones` c
                JOIN `tbreserva` r ON c.idReservaBase = r.idReserva
                WHERE r.idUsuario = $idHuesped";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    return $row["promedio_estrellas"];
                } else {
                    return null;
                }
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    } //end metodo calcular promedio HUESPED


    // CALCULA TODAS LAS RESENAS: ENVIAS + RECIBIDAS
    function CalcularTotalDeResenas_Huesped($idHuesped)
    {
        try {
            $query_ResenasEnviadas = "SELECT COUNT(*) as `CantidadResenasEnviadas`
                  FROM tbresenalugar AS r
                  WHERE r.idUsuarioResena = $idHuesped";

            $query_ResenasRecibidas = "SELECT COUNT(c.comentario) as `CantidadResenasRecibidas`
                FROM `tbcalificaciones` AS `c`
                INNER JOIN `tbreserva` AS `r` ON c.idReservaBase = r.idReserva 
                WHERE r.idUsuario = $idHuesped";

            $this->conn->set_charset("utf8");

            $resultEnviadas = $this->getConexion()->query($query_ResenasEnviadas);
            $resultRecibidas = $this->getConexion()->query($query_ResenasRecibidas);

            if ($resultEnviadas && $resultRecibidas) {
                $count_Enviadas = $resultEnviadas->fetch_assoc()["CantidadResenasEnviadas"];
                $count_Recibidas = $resultRecibidas->fetch_assoc()["CantidadResenasRecibidas"];

                $Totalresenas = $count_Enviadas + $count_Recibidas;

                return $Totalresenas;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    } // end calcular resenas totales huesped


    function CalcularResenasEnviadas_Huesped($idHuesped)
    {
        try {
            $query_ResenasEnviadas = "SELECT COUNT(*) as `CantidadResenasEnviadas`
                  FROM tbresenalugar AS r
                  WHERE r.idUsuarioResena = $idHuesped";

            $this->conn->set_charset("utf8");

            $resultEnviadas = $this->getConexion()->query($query_ResenasEnviadas);

            if ($resultEnviadas) {
                $count_Enviadas = $resultEnviadas->fetch_assoc()["CantidadResenasEnviadas"];

                return $count_Enviadas;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    } // end calcualr resenas enviadas huesped


    function CalcularResenasRecibidas_Huesped($idHuesped)
    {
        try {

            $query_ResenasRecibidas = "SELECT COUNT(c.comentario) as `CantidadResenasRecibidas`
                FROM `tbcalificaciones` AS `c`
                INNER JOIN `tbreserva` AS `r` ON c.idReservaBase = r.idReserva 
                WHERE r.idUsuario = $idHuesped";

            $this->conn->set_charset("utf8");

            $resultRecibidas = $this->getConexion()->query($query_ResenasRecibidas);

            if ($resultRecibidas) {
                $count_Recibidas = $resultRecibidas->fetch_assoc()["CantidadResenasRecibidas"];

                return $count_Recibidas;
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    } //end calcular resenas recibidas huesped






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

    function ConsultarInmuebles_ConResenias_Huesped()
    {
        $arry_Datos = func_get_args();

        $idHuesped = $this->GetConexion()->real_escape_string($arry_Datos[0]);

        try {
            $query = "SELECT i.id AS idInmueble,
         i.nombre AS nombreInmueble, 
         i.estadoLugar AS estadoInmueble, 
         CASE i.disponibilidad
            WHEN 1 THEN 'Disponible'
            ELSE 'No Disponible'
        END AS disponibilidadInmueble
         FROM tbresenalugar r JOIN tbinmueble i ON r.idLugarDirigido = i.id
          WHERE r.idUsuarioResena = $idHuesped";


            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $data = array();

                while ($row = $result->fetch_assoc()) {
                    $item = array(
                        "id" => $row['idInmueble'],
                        "Nombre_Inmueble" => $row["nombreInmueble"],
                        "Estado" => $row["estadoInmueble"],
                        "Disponibilidad" => $row["disponibilidadInmueble"]
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

    
    
    // =======================CALIFICACIONES===================================================================
    
    
    
    
    // =========================================================================================================
    // ============FIN RESEÑAS============FIN RESEÑAS=============FIN RESEÑAS==============FINRESEÑAS===========
    // =========================================================================================================

// =========================================================================================================    
// ============MENSAJES============MENSAJES=============MENSAJES==============MENSAJES===========
// =========================================================================================================

function ConsultarlistaDeContactosDisponible_Huesped($idHuesped)
{
    try {
        $query = "SELECT 
                i.Propietario,
                CONCAT(u.nombre, ' ', u.apellido1) AS nombreAnfitrion,
                u.fotoPerfil AS fotoPerfilAnfitrion,
                i.nombre AS nombreInmueble
            FROM
                tbreserva r
            JOIN
                tbinmueble i ON r.idInmueble = i.id
            JOIN
                tbusuario u ON i.Propietario = u.idUser
            WHERE
                r.idUsuario = $idHuesped";            

        $this->conn->set_charset("utf8");
        $result = $this->getConexion()->query($query);

        if ($result) {
                    $data = array();
                    
                    while ($row = $result->fetch_assoc()) {
                        // Suponiendo que $row["fotoPerfilCalificador"] contiene la ruta de la imagen
                        $imagenPath = $row["fotoPerfilAnfitrion"];
                        $imagenData = file_get_contents($imagenPath);
                        $imagenBase64 = base64_encode($imagenData);
                        
                        $urlImagen = "data:image/jpeg;base64," . $imagenBase64;
                        
                        $item = array(
                            "idPropietario" => $row['Propietario'],
                            "nombreAnfitrion" => $row["nombreAnfitrion"],
                            // Aquí se guarda la imagen en formato base64
                            "fotoPerfilAnfitrion" => $urlImagen,
                            "nombreInmueble" => $row["nombreInmueble"],
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
} //fn ConsultarResenias recibidas POR id Huesped     

function ConsultarlistaDeContactosDisponible_Anfitrion($idAnfitrion)
{
    try {
        $query = "    SELECT 
                h.idUser AS idHuesped,
                CONCAT(h.nombre, ' ', h.apellido1) AS nombreHuesped,
                h.fotoPerfil AS fotoPerfilHuesped,
                i.nombre AS nombreInmueble
            FROM
                tbreserva r
            JOIN
                tbinmueble i ON r.idInmueble = i.id
            JOIN
                tbusuario u ON i.Propietario = u.idUser
            JOIN
                tbusuario h ON r.idUsuario = h.idUser  
            WHERE
               i.Propietario = $idAnfitrion";            

        $this->conn->set_charset("utf8");
        $result = $this->getConexion()->query($query);

        if ($result) {
                    $data = array();
                    
                    while ($row = $result->fetch_assoc()) {
                        // Suponiendo que $row["fotoPerfilCalificador"] contiene la ruta de la imagen
                        $imagenPath = $row["fotoPerfilHuesped"];
                        $imagenData = file_get_contents($imagenPath);
                        $imagenBase64 = base64_encode($imagenData);
                        
                        $urlImagen = "data:image/jpeg;base64," . $imagenBase64;
                        
                        $item = array(
                            "idHuesped" => $row['idHuesped'],
                            "nombreHuesped" => $row["nombreHuesped"],
                            // Aquí se guarda la imagen en formato base64
                            "fotoPerfilHuesped" => $urlImagen,
                            "nombreInmueble" => $row["nombreInmueble"],
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
} //fn ConsultarResenias recibidas POR id Huesped    



public function ObtenerChatsHuesped($idUsuarioElegido, $idUsuarioLogueado)
{
    $output = "";
    // $idUsuarioElegido = $this->conn->real_escape_string($idUsuarioElegido);
    // $idUsuarioLogueado = $this->conn->real_escape_string($idUsuarioLogueado);

    $sql = "SELECT m.idUsuarioEnvia, m.Mensaje, u.fotoperfil , m.hora
            FROM tbmensajes m
            LEFT JOIN tbusuario u ON u.idUser = m.idUsuarioEnvia
            WHERE (m.idUsuarioEnvia = $idUsuarioLogueado AND m.idUsuarioRecibe = $idUsuarioElegido)
            OR (m.idUsuarioEnvia = $idUsuarioElegido AND m.idUsuarioRecibe = $idUsuarioLogueado)
            ORDER BY m.idmensaje";
    
    $query = $this->conn->query($sql);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {

            $imagenPath = $row['fotoperfil'];
            $imagenData = file_get_contents($imagenPath);
            $imagenBase64 = base64_encode($imagenData);

            $urlImagen = "data:image/jpeg;base64," . $imagenBase64;

            if ($row['idUsuarioEnvia'] != $idUsuarioLogueado) {
                $output .= '<div class="mensaje">
                                <br>
                                <div class="avatar">
                                    <img src="'.$urlImagen.'" alt="img">
                                </div>
                                <div class="cuerpo">
                                    <div class="texto">
                                        '.$row['Mensaje'].'
                                        <span class="tiempo hidden-span">
                                            <i class="far fa-clock"></i>
                                            '.$row['hora'].'
                                        </span>
                                        <span class="tiempo other-span">
                                            <i class="far fa-clock"></i>
                                            '.date('H:i:s', strtotime($row['hora'])).'
                                        </span>
                                    </div>            
                                </div>
                            </div>';

                            // $output .= '<div class="chat outgoing">
                            //                 <div class="details">
                            //                     <p>' . $row['msg'] . '</p>
                            //                 </div>
                            //             </div>';
                        } else {
                $output .= '<div class="mensaje left">
                                <div class="cuerpo">
                                    <div class="texto">
                                    '.$row['Mensaje'].'
                                        <span class="tiempo hidden-span">
                                            <i class="far fa-clock"></i>
                                            '.$row['hora'].'
                                        </span>
                                        <span class="tiempo other-span">
                                            <i class="far fa-clock"></i>
                                            '.date('H:i:s', strtotime($row['hora'])).'
                                        </span>
                                    </div>
                                </div>
                                <div class="avatar">
                                    <img src="'.$urlImagen.'" style="margin-top:5px;" alt="img">
                                </div>
                            </div>';

                // $output .= '<div class="chat incoming">
                //                 <img src="php/images/' . $row['img'] . '" alt="">
                //                 <div class="details">
                //                     <p>' . $row['msg'] . '</p>
                //                 </div>
                //             </div>';
            }
        }
    } else {
        $output .= '<div class="text">No hay mensajes disponibles MASTER CLASS. Una vez que envíe el mensaje, aparecerán aquí.</div>';
    }

    return $output;
} 



public function ObtenerChatsAnfitrion($idUsuarioElegido, $idUsuarioLogueado)
{
    $output = "";
    // $idUsuarioElegido = $this->conn->real_escape_string($idUsuarioElegido);
    // $idUsuarioLogueado = $this->conn->real_escape_string($idUsuarioLogueado);

    $sql = "SELECT m.idUsuarioEnvia, m.Mensaje, u.fotoperfil , m.hora
            FROM tbmensajes m
            LEFT JOIN tbusuario u ON u.idUser = m.idUsuarioEnvia
            WHERE (m.idUsuarioEnvia = $idUsuarioLogueado AND m.idUsuarioRecibe = $idUsuarioElegido)
            OR (m.idUsuarioEnvia = $idUsuarioElegido AND m.idUsuarioRecibe = $idUsuarioLogueado)
            ORDER BY m.idmensaje";
    
    $query = $this->conn->query($sql);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {

            $imagenPath = $row['fotoperfil'];
            $imagenData = file_get_contents($imagenPath);
            $imagenBase64 = base64_encode($imagenData);

            $urlImagen = "data:image/jpeg;base64," . $imagenBase64;

            if ($row['idUsuarioEnvia'] != $idUsuarioLogueado) {
                $output .= '<div class="mensaje">
                                <br>
                                <div class="avatar">
                                    <img src="'.$urlImagen.'" alt="img">
                                </div>
                                <div class="cuerpo">
                                    <div class="texto">
                                        '.$row['Mensaje'].'
                                        <span class="tiempo hidden-span">
                                            <i class="far fa-clock"></i>
                                            '.$row['hora'].'
                                        </span>
                                        <span class="tiempo other-span">
                                            <i class="far fa-clock"></i>
                                            '.date('H:i:s', strtotime($row['hora'])).'
                                        </span>
                                    </div>            
                                </div>
                            </div>';
                        } else {
                $output .= '<div class="mensaje left">
                                <div class="cuerpo">
                                    <div class="texto">
                                        '.$row['Mensaje'].'
                                        <span class="tiempo hidden-span">
                                            <i class="far fa-clock"></i>
                                            '.$row['hora'].'
                                        </span>
                                        <span class="tiempo other-span">
                                            <i class="far fa-clock"></i>
                                            '.date('H:i:s', strtotime($row['hora'])).'
                                        </span>
                                    </div> 
                                </div>
                                <div class="avatar">
                                    <img src="'.$urlImagen.'" style="margin-top:5px;" alt="img">
                                </div>
                            </div>';

                // $output .= '<div class="chat incoming">
                //                 <img src="php/images/' . $row['img'] . '" alt="">
                //                 <div class="details">
                //                     <p>' . $row['msg'] . '</p>
                //                 </div>
                //             </div>';
            }
        }
    } else {
        $output .= '<div class="text">Se el primero en enviar un mensaje.</div>';
    }
    return $output;
}


function InsertarMensajes($idEmisor, $idReceptor, $mensaje)
{
    try {
        // Utiliza consultas preparadas para prevenir inyecciones SQL
        $query = "INSERT INTO `tbmensajes` (`Mensaje`, `idUsuarioEnvia`, `idUsuarioRecibe`, `hora`) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->getConexion()->prepare($query);
        
        if ($stmt) {
            // Utiliza el objeto DateTime para obtener la fecha y hora actual
            $currentDateTime = new DateTime();
            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

            // Vincula los parámetros
            $stmt->bind_param("ssss", $mensaje, $idEmisor, $idReceptor, $formattedDateTime);

            // Ejecuta la consulta
            $stmt->execute();

            // Verifica si la inserción fue exitosa
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                // Si no se afectaron filas, algo salió mal
                throw new Exception("Error al insertar mensaje en la base de datos");
            }
        } else {
            // Si la preparación de la consulta falla, lanza una excepción
            throw new Exception("Error al preparar la consulta");
        }
    } catch (Exception $e) {
        // Captura y maneja cualquier excepción lanzada
        error_log("Error en InsertarMensajes: " . $e->getMessage());
        return false;
    }
}





// ==================================================================================================
    // FIN MENSAJES==========FIN MENSAJES=======================FIN MENSAJES=================
// ==================================================================================================    

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
                        "icono" => $row["nombreFavicon"],
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
            $query = "SELECT descripcion, fecha
            FROM tbnotificaciones
            WHERE idUser = $idAnfitrion
            ORDER BY fecha DESC;";

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
        $query = "INSERT INTO `tbnotificaciones` (`descripcion`, `idUser`, `fecha`)
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

        // obtiene el nombre del inmueble
        $queryNombre = "SELECT `nombre` FROM `tbinmueble` WHERE id = $idInmueble";

        $resultadoNombre = $this->getConexion()->query($queryNombre);

        if ($resultadoNombre) {

            $fila = $resultadoNombre->fetch_assoc();
            $nombreInmueble = $fila['nombre'];


            $query = "INSERT INTO `tbnotificaciones` (`descripcion`, `idusuario`, `fecha`)
                    VALUES ('Has realizado una Reserva en $nombreInmueble',  
                            '$idusuario', '$fecha')";

            if ($this->getConexion()->query($query)) {


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
        // EN PROCESO ........ 


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

    // function InsertarNotificacion_CuandoCalificaElAnfitrion($idAnfitrion , $idReserva)
    // {

    //     $fecha = date("Y-m-d"); 

    //     $queryNombreHuesped_NombreInmueble = "SELECT i.nombre as `NombreInmueble` ,
    //     CONCAT(u.nombre, ' ', u.apellido1, ' ', u.apellido2) as `NombreHuesped`
    //     FROM `tbreserva` r 
    //     JOIN `tbusuario` u ON r.idUsuario = u.idUser 
    //     JOIN `tbinmueble` i ON i.id = r.idInmueble
    //     WHERE idReserva = $idReserva";

    //     $stmt = $this->getConexion()->query($queryNombreHuesped_NombreInmueble);

    //     if ($stmt) {
    //         $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //         if ($result) {
    //             $NombreInmueble = $result['NombreInmueble'];
    //             $NombreHuesped = $result['NombreHuesped'];
    //         }else{
    //             $NombreInmueble = "";
    //             $NombreHuesped = "";
    //         }

    //     }else{
    //         $NombreInmueble = "";
    //         $NombreHuesped = "";
    //     }

    //     // NOTIFICACION QUE SE ENVIA AL ANFITRION  
    //     $queryEnvioNotificacionAnfitrion = "INSERT INTO `tbnotificaciones` (`descripcion`, `idusuario`, `fecha`)
    //         VALUES ('Hiciste una calificación para la reserva en $NombreInmueble
    //         alquilado por $NombreHuesped.',  
    //         `$idAnfitrion`, `$fecha`)";

    //     if ($this->getConexion()->query($queryEnvioNotificacionAnfitrion)) {

    //         $queryNombreAnfitriron = "SELECT CONCAT(`nombre`, ' ', `apellido1`, ' ', `apellido2`) 
    //         FROM `tbusuario` WHERE idUser = $idAnfitrion";

    //         $NombreAnfitrion = $this->getConexion()->query($queryNombreAnfitriron);




    //         $queryEnvioNotificacionHuesped = "INSERT INTO `tbnotificaciones` (`descripcion`, `idusuario`, `fecha`)
    //         VALUES ('El Anfitrion $NombreAnfitrion ha hecho una calificacion sobre tu estadia 
    //         en $nombreInmueble.',  
    //         `$idAnfitrion`, `$fecha`)";

    //         $stmt2 = $this->getConexion()->query($queryEnvioNotificacionHuesped);

    //         if($stmt2){
    //             return true;
    //         }else{
    //             return false;
    //         }




    //     } else {

    //         return false;
    //     }

    // }
    function InsertarNotificacion_CuandoCalificaElAnfitrion($idAnfitrion, $idReserva)
    {

        $fecha = date("Y-m-d");
        $NombreInmueble = "";
        $NombreHuesped = "";

        // nombres de inmueble y huésped
        $queryNombreHuesped_NombreInmueble = "SELECT i.nombre as `NombreInmueble`,
        CONCAT(u.nombre, ' ', u.apellido1, ' ', u.apellido2) as `NombreHuesped`
        FROM `tbreserva` r 
        JOIN `tbusuario` u ON r.idUsuario = u.idUser 
        JOIN `tbinmueble` i ON i.id = r.idInmueble
        WHERE idReserva = $idReserva";

        $stament = $this->getConexion()->query($queryNombreHuesped_NombreInmueble);

        if ($stament) {
            $result = $stament->fetch_assoc();

            if ($result) {
                $NombreInmueble = $result['NombreInmueble'];
                $NombreHuesped = $result['NombreHuesped'];
            }
        }

        // NOTIFICACION QUE SE ENVÍA AL ANFITRIÓN
        $queryEnvioNotificacionAnfitrion = "INSERT INTO `tbnotificaciones` (`descripcion`, `idUser`, `fecha`)
        VALUES ('Hiciste una calificación para la reserva en $NombreInmueble
        alquilado por $NombreHuesped.',  
        '$idAnfitrion', '$fecha')";

        if ($this->getConexion()->query($queryEnvioNotificacionAnfitrion)) {

            // Obtener nombre del anfitrión
            $queryNombreAnfitrion = "SELECT CONCAT(`nombre`, ' ', `apellido1`, ' ', `apellido2`) as `NombreAnfitrion`
        FROM `tbusuario` WHERE idUser = $idAnfitrion";

            $queryObtenerIdHuesped = "SELECT r.idUsuario as `idUsuario`
        FROM `tbreserva` r 
        WHERE r.idReserva = $idReserva";

            $stmtNombreAnfitrion = $this->getConexion()->query($queryNombreAnfitrion);
            $stmtidHuesped = $this->getConexion()->query($queryObtenerIdHuesped);

            if ($stmtNombreAnfitrion && $stmtidHuesped) {
                $nombreAnfitrion = $stmtNombreAnfitrion->fetch_assoc()['NombreAnfitrion'];
                $idHuesped = $stmtidHuesped->fetch_assoc()['idUsuario'];

                // NOTIFICACION QUE SE ENVÍA AL HUÉSPED
                $queryEnvioNotificacionHuesped = "INSERT INTO `tbnotificaciones` (`descripcion`, `idUser`, `fecha`)
                VALUES ('El Anfitrion $nombreAnfitrion ha hecho una calificación sobre tu estadia en $NombreInmueble.',  
                '$idHuesped', '$fecha')";

                if ($this->getConexion()->query($queryEnvioNotificacionHuesped)) {
                    return true;
                }
            }
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

    function modificarDenunciaAdm($idDenuncia, $identificacion, $respuestaDenunciaAdm, $estadoNuevo, $veredicto)
    {
        try {
            // Obtener la conexión
            $conexion = $this->getConexion();

            // Verificar si la conexión es válida
            if (!$conexion) {
                throw new Exception("Error al obtener la conexión.");
            }

            // Preparar la sentencia SQL
            $query = "UPDATE tbdenuncia SET RespuestaDenunciaAdmin = ?, idAdminAtiende = ?, estado = ?, AFavorDe = ? WHERE idDenuncia = ?";
            $stmt = $conexion->prepare($query);

            // Vincular parámetros
            $stmt->bind_param("sssi", $respuestaDenunciaAdm, $identificacion, $estadoNuevo, $veredicto, $idDenuncia);

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
            tbtipodenuncia.tipoDenuncia, AFavorDe
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
            // $stmt->close();
            // $conexion->close();
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


    
    //----------------------------------------------------------Validar imueble ------------------------------------------

    // función para actualizar el estado en la base de datos
    function actualizarEstadoimueble($idValidacionimueble, $nuevoEstado)
    {
        try {
            $conn = $this->GetConexion();

            $idValidacionimueble = $conn->real_escape_string($idValidacionimueble);
            $nuevoEstado = $conn->real_escape_string($nuevoEstado);

            $sql = "UPDATE tbinmueble SET estadoLugar = '$nuevoEstado' WHERE id = '$idValidacionimueble'";

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

    // función para validar el inmueble
    // function validarInmueble($idValidacionimueble)
    // {
    //     try {
    //         return $this->actualizarEstadoimueble($idValidacionimueble, 'Aprobado');
    //     } catch (Exception $e) {
    //         echo "Error al validar el inmueble: " . $e->getMessage();
    //         return false; // Error general
    //     }
    // }


    // función para obtener el estado del usuario
    // function obtenerEstadoUsuario($idUser)
    // {
    //     try {
    //         $conn = $this->GetConexion();

    //         // Escapar los datos para prevenir inyecciones SQL
    //         $idUser = $conn->real_escape_string($idUser);

    //         // Consulta SQL para obtener el estado del usuario
    //         $sql = "SELECT estadoValidacion FROM tbvalidacionperfil WHERE nombreImagenUsuario = '$idUser' limit 1";

    //         // Ejecutar la consulta
    //         $resultado = $conn->query($sql);

    //         // Verificar si se obtuvieron resultados
    //         if ($resultado->num_rows > 0) {
    //             $fila = $resultado->fetch_assoc();
    //             return $fila['estadoValidacion'];
    //         } else {
    //             return "El usuario no se encuentra validado";
    //         }
    //     } catch (Exception $e) {
    //         echo "Error al obtener el estado del usuario: " . $e->getMessage();
    //         return "Error"; // Puedes manejar el error de la manera que prefieras
    //     }
    // }




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

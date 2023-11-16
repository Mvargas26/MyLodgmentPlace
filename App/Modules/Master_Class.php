<?php
require_once(__DIR__ . '/../../app//libs/PHPMAILER/autoload.php');

date_default_timezone_set("America/Costa_Rica");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Master_Class
{
    // private $server = "tiusr29pl.cuc-carrera-ti.ac.cr";
    // private $username = "sitios";
    // private $password = "Sitios2023*";
    // private $db = "mylodgmentplace";
    private $conn;

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
        $sql = "SELECT * FROM tbusuario";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $users = array();
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return array();
        }
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
    /*-----------------------------------------------sERVICIOS--------------------------------------------------*/

    function CargarServicios()
    {
        try {
            $query = "SELECT id, nombre FROM `tbservicio`;";
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

    /*-----------------------------------------------AUNTETINTIFICACION--------------------------------------------------*/


    function generarCodigoAleatorio($longitud)
    {
        $caracteres = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
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

    //fin funcion para enviar correo de autenticacion

    //inicio  funciones para codigos de autenticacion

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

    //fin  funciones para codigos de autenticacion

    //Inicio  funcion para calculo previo reserva

    function calcularValorTotal($cantidadDias)
    {
        $valorDiario = 20000;
        $valorTotal = $valorDiario * $cantidadDias;
        return $valorTotal;
    }



    //fin funcion para calculo previo reserva

    //fin funcion Historial de reservas

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

    /*----------------------------------------------- INMUEBLES --------------------------------------------------*/

    function ConsultarInmuebles()
    {

        try {
            $query = "SELECT         mu.id, 
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
               ft.nombreImagen as nameImagen
            FROM tbinmueble as mu
            INNER JOIN tbusuario as us ON mu.Propietario = us.idUser
            INNER JOIN tbcategoriainmueble ON mu.id =tbcategoriainmueble.idInmueble
            INNER JOIN tbcategorias ca ON tbcategoriainmueble.idCategoria = ca.idcategoria
            INNER JOIN tbfotoinmueble ft ON mu.id = ft.idInmueble;";

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
                ft.nombreImagen as nameImagen
            FROM tbinmueble as mu
            INNER JOIN tbusuario as us ON mu.Propietario = us.idUser
            INNER JOIN tbcategoriainmueble ON mu.id = tbcategoriainmueble.idInmueble
            INNER JOIN tbcategorias ca ON tbcategoriainmueble.idCategoria = ca.idcategoria
            INNER JOIN tbfotoinmueble ft ON mu.id = ft.idInmueble
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

    function ConsultarResenas_porID($idInmueble)
    {

        try {
            $query = "SELECT 
                    tbresenalugar.Descripcion, 
                    tbresenalugar.fechaResena, 
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
    function ConsultarInmueblePorId($nombreInmueble)
    {
        try {
            $query = "SELECT 
            mu.id, 
            mu.nombre AS nombre_inmueble,
            mu.capacidadPersonas,  
            mu.direccion, 
            mu.disponibilidad, 
            mu.estrellas, 
            mu.fechaLimiteDisponibilidad, 
            CONCAT(us.nombre, ' ', us.apellido1, ' ', us.apellido2) AS nombre_propietario,
            -- tc.caracteristica1,
            -- tc.caracteristica2,
            -- tc.caracteristica3
        FROM tbinmueble mu
        INNER JOIN tbusuario us ON mu.Propietario = us.idUser
        -- LEFT JOIN tbinmuebleservicio tis ON mu.id = tis.id
        -- LEFT JOIN tbcaracteristicas tc ON mu.id = tc.idInmueble
        WHERE mu.id = '$nombreInmueble';";

            $this->conn->set_charset("utf8");
            $result = $this->getConexion()->query($query);

            if ($result) {
                $row = $result->fetch_assoc();

                if ($row) {
                    $inmueble = array(
                        "id" => $row['id'],
                        "Nombre_Inmueble" => $row["nombre_inmueble"],
                        "capacidadPersonas" => $row["capacidadPersonas"],
                        "direccion" => $row["direccion"],
                        "disponibilidad" => $row["disponibilidad"],
                        "estrellas" => $row["estrellas"],
                        "fechaLimiteDisponibilidad" => $row["fechaLimiteDisponibilidad"],
                        "nombre_propietario" => $row["nombre_propietario"],

                        // "caracteristica1" => $row["caracteristica1"],
                        // "caracteristica2" => $row["caracteristica2"],
                        // "caracteristica3" => $row["caracteristica3"]
                    );

                    return json_encode($inmueble);
                } else {
                    // No se encontró un inmueble con ese ID
                    return json_encode(array("error" => "No se encontró el inmueble con ID $nombreInmueble"));
                }
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
                $row = $result->fetch_assoc();

                if ($row) {
                    $arrayListaFavoritos = array(
                        "idLista" => $row['idLista'],
                        "nombreLista" => $row["nombreLista"],
                    );

                    return json_encode($arrayListaFavoritos);
                } else {
                    // No se encontró un inmueble con ese ID
                    return json_encode(array("error" => "No hay listas para $UserID"));
                }
            } else {
                throw new Exception("Error en la consulta: " . $this->getConexion()->error);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // Retorna null en caso de error
        }
    } //fin  ConsultarListafavoritosPorUser



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


} //fn cl_masterClass
$ObjMaster = new Master_Class();
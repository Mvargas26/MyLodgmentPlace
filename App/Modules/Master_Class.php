<?php
require_once(__DIR__ . '/../../app//libs/PHPMAILER/autoload.php');

date_default_timezone_set("America/Costa_Rica");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Master_Class{
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
    }//fin constructor
        /*-----------------------------------------------GETS--------------------------------------------------*/
        function GetConexion()
        {
            return $this->conn;
        }
        /*-----------------------------------------------FUNCTIONS--------------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/
              /*-----------------------------------------------USUARIOS--------------------------------------------------*/

        function ConsultarUsuario() {
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
        }//fn ConsultarUsuario

        function InsertarUsuario() {
            $arry_Datos = func_get_args();
            
            try {
                $img = $this->GetConexion()->real_escape_string($arry_Datos[0]);
                $identificacion = intval($this->GetConexion()->real_escape_string($arry_Datos[1]));
                $Clave = $this->GetConexion()->real_escape_string($arry_Datos[2]);
                $nombre = $this->GetConexion()->real_escape_string($arry_Datos[3]);
                $primerApellido = $this->GetConexion()->real_escape_string($arry_Datos[4]);
                $segundoApellido= $this->GetConexion()->real_escape_string($arry_Datos[5]);
                $email= $this->GetConexion()->real_escape_string($arry_Datos[6]);
                $telefono= intval($this->GetConexion()->real_escape_string($arry_Datos[7]));
                $edad= intval($this->GetConexion()->real_escape_string($arry_Datos[8]));
                $idRol= intval($this->GetConexion()->real_escape_string($arry_Datos[9]));
                $direccion = $this->GetConexion()->real_escape_string($arry_Datos[10]);
        
                $query ="INSERT INTO `tbusuario` (`idUser`,`nombre`, `apellido1`, `apellido2`, `correo`, `fotoperfil`, `telefono`, `idRol`, `contrasenna`,
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

                /*-----------------------------------------------IMAGENES--------------------------------------------------*/

        
        function InsertarImagen(){
            $arry_Datos = func_get_args();
            
            $img = $this->GetConexion()->real_escape_string($arry_Datos[0]);
            $nombre = $this->GetConexion()->real_escape_string($arry_Datos[1]);

            $query ="INSERT INTO `imagenes`(`Nombre`,`Imagen`) VALUES ('$nombre','$img')"; 

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

            $query = "SELECT * FROM `tbfotoinmueble` where idInmueble = $idInmueble;";
            
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return false;
            }
        }//cargarImagenes
        /*-----------------------------------------------sERVICIOS--------------------------------------------------*/

        function CargarServicios() {
            try {
                $query = "SELECT id, nombre FROM `tbservicio`;";
                $this->conn->set_charset("utf8"); // Establecer la codificación a UTF-8
                $result = $this->getConexion()->query($query);
        
                if ($result) {
                    $data = array();
        
                    // Iterar sobre los resultados y construir el array asociativo
                    while ($row = $result->fetch_assoc()) {
                        $row['id'] = (int)$row['id'];
                        $data[] = $row;
                    }
        
                    return $data;
                } else {
                    throw new Exception("Error en la consulta: " . $this->getConexion()->error);
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
                return null; // Retorna null en caso de error
            }
        }
        /*-----------------------------------------------AUNTETINTIFICACION--------------------------------------------------*/

//Funciones de prueba (inicio)

//inicio Funcion para codigo aleatorio

function generarCodigoAleatorio($longitud) {
    $caracteres = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $codigo = "";

    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}

//fin Funcion para codigo aleatorio

//Inicio funcion para guardar codigo aleatorio de autenticacion

function almacenarCodigoAutenticacion($identificacion, $codigo_autenticacion) {
    try {
        // Escapa los valores para prevenir SQL injection
        $identificacion = $this->GetConexion()->real_escape_string($identificacion);
        $codigo_autenticacion = $this->GetConexion()->real_escape_string($codigo_autenticacion);

        // Ejecuta la consulta SQL para actualizar el código de autenticación
        $query = "UPDATE tbusuario SET codigoAutenticacion = '$codigo_autenticacion' WHERE idUser = '$identificacion'";
        $this->GetConexion()->query($query);

        // Verifica si la actualización fue exitosa
        if ($this->GetConexion()->affected_rows > 0) {
            // Actualización exitosa
            return true;
        } else {
            // No se realizó ninguna actualización
            return false;
        }
    } catch (Exception $e) {
        // Manejo de errores (puedes personalizar según tus necesidades)
        error_log("Error al almacenar código de autenticación: " . $e->getMessage());
        return false;
    }
}

//fin funcion para guardar codigo aleatorio de autenticacion

//inicio funcion para enviar correo de autenticacion

function enviarCodigoAutenticacionCorreo($destinatario, $codigo_autenticacion)
    {
        $mail = new PHPMailer(true);

        try {

            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
     
     
            try {
                //$mail -> SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host       = 'smtp.titan.email';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'pruebas@tritechno.net';
                $mail->Password   = 'Pruebas1234*';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
     
                $mail->setFrom('pruebas@tritechno.net', 'My Lodgment Place');
                 $mail->addAddress($destinatario);
                $mail->isHTML(true);
                $mail->Subject = 'Este es tu codigo de autenticacion para el inicio de sesion';
                $mail->Body    = $codigo_autenticacion;
                //$mail->send();
     
                if (!$mail->send()) {
                    echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;
                } else {
                    // echo 'Correo electrónico enviado correctamente.';
                }
            } catch (\Exception $th) {
                echo 'MEnsaje de Error: ' . $mail->ErrorInfo;
            }

            // Enviar el correo
            //$mail->send();
            
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar el correo: {$mail->ErrorInfo}");
            return false;
        }
    }

//fin funcion para enviar correo de autenticacion


//Funciones de prueba(fin)
        /*----------------------------------------------- INMUEBLES --------------------------------------------------*/

        function ConsultarInmuebles() {

            try {
                $query = " SELECT 
                mu.id, 
                mu.nombre AS nombre_inmueble, 
                mu.valorDiario, 
                mu.capacidadPersonas, 
                mu.costoPersonaExtra, 
                mu.direccion, 
                mu.disponibilidad, 
                mu.estrellas, 
                mu.fechaLimiteDisponibilidad, 
               CONCAT(us.nombre, ' ', us.apellido1, ' ', us.apellido2) AS nombre_propietario
            FROM tbinmueble mu
            INNER JOIN tbusuario us ON mu.Propietario = us.idUser;";

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

        }//fn ConsultarUsuario

        function ConsultaMultipleEspacios(){
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
            
                        return json_encode($data);
    
                    } else {
                        throw new Exception("Error en la consulta: " . $this->getConexion()->error);
                    }
                } catch (Exception $e) {
                    error_log($e->getMessage());
                    return null; // Retorna null en caso de error
                }
        }







}//fn cl_masterClass

$ObjMaster = new Master_Class();
?>
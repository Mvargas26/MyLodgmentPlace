<?php
date_default_timezone_set("America/Costa_Rica");

class Master_Class{
    private $server = "tiusr29pl.cuc-carrera-ti.ac.cr";
    private $username = "sitios";
    private $password = "Sitios2023*";
    private $db = "mylodgmentplace";
    private $conn;

    function __construct()
    {
        try {
            
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);

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

        function CargarImagenes()
        {
            $data = null;
            $query = "SELECT * FROM `tb_imagenes`";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return false;
            }
        }//cargarImagenes
}//fn cl_masterClass

$ObjMaster = new Master_Class();
?>
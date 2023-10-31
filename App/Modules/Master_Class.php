<?php
date_default_timezone_set("America/Costa_Rica");

class Master_Class{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "pruebaimg";
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
        function InsertarImagen(){
            $arry_Datos = func_get_args();
            
            $img = $this->GetConexion()->real_escape_string($arry_Datos[0]);
            $nombre = $this->GetConexion()->real_escape_string($arry_Datos[1]);

            $query ="INSERT INTO `tb_imagenes`(`nombre`,`imagenGuardar`) VALUES ('$nombre','$img')"; 

            if ($this->getConexion()->query($query)) {
                echo json_encode(array('response' => true));
            } else {
                echo json_encode(array('response' => false));
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
<?php

    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();

     try {
        if (isset($_POST['nombreEspacio'])) {

            try {
                $nombreEspacio = $_POST['nombreEspacio'];
                $disponibilidad = $_POST['disponibilidad'];
                $valorDiario = $_POST['valorDiario'];
                $estadoLugar = $_POST['estadoLugar'];
                $Propietario = $_POST['Propietario'];
                $estrellas = $_POST['estrellas'];
                $direccion = $_POST['direccion'];
                $capacidadPersonas = $_POST['capacidadPersonas'];
                $costoPersonaExtra = $_POST['costoPersonaExtra'];
                $fechaLimiteDisponible = $_POST['fechaLimiteDisponible'];
                $inputImagen = $_FILES['inputImagen']; // Cambia a $_FILES para manejar archivos
                $categoria = $_POST['categoria'];

                // Array para almacenar los nombres de las imágenes
                $nombresImagenes = array();

                // ruta a carpeta de imagenes
                $directorioDestino = '../../assets/img/ImagenesInmuebles/';

                for ($i = 0; $i < count($inputImagen['name']); $i++) {
                    $nombreArchivo = $inputImagen['name'][$i];
                    $rutaTemporal = $inputImagen['tmp_name'][$i];
                    
                    // Crear un nombre único para la imagen para evitar conflictos
                    $nombreUnico = uniqid() . '_' . $nombreArchivo;
                    
                    // Ruta armada con el nombre
                    $rutaCompleta = $directorioDestino . trim($nombreUnico);
                
                    // Mover la imagen al directorio de destino
                    if (move_uploaded_file($rutaTemporal, $rutaCompleta)) {
                        // Agregar el nombre único al array de nombres de imágenes
                        $nombresImagenes[] = $nombreUnico;
                    } else {
                        // Manejar el error si la carga de la imagen falla
                        echo json_encode(array('exito' => false, 'mensaje' => 'Error al subir la imagen'));
                        // Puedes agregar un return o un exit aquí si deseas salir del script en caso de error
                    }
                }

                // for ($i = 0; $i < count($inputImagen['name']); $i++) {
                //     $nombreArchivo = $inputImagen['name'][$i];
        
                //     $nombresImagenes[] = $nombreArchivo;
                // }
        
                // Llamar a la función Insertar_Inmueble con los valores recuperados
                $resultadoConsulta = $ObjMaster->Insertar_Inmueble(
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
                );


                if ($resultadoConsulta) {
                    echo json_encode(array('exito' => true, 'mensaje' => 'Inmueble agregado correctamente'));
                } else {
                    echo json_encode(array('exito' => false, 'mensaje' => 'Error al agregar el inmueble 1'));
                }

            } catch (Exception $e) {
                echo json_encode(array('error' => $e->getMessage()));
            }

        }
        

        if(isset($_POST['ArrayServicios']))
        {
            echo json_encode(array('exito' => true, 'mensaje' => 'Entro'));

            // $ArrayServicios = json_decode($_POST['ArrayServicios']);
    
            // $resultadoConsulta = $ObjMaster->Insertar_ServiciosInmueble($ArrayServicios);
    
            // if ($resultadoConsulta) {
            //     echo json_encode(array('exito' => true, 'mensaje' => 'Servicios de inmueble agregados correctamente'));
            // } else {
            //     echo json_encode(array('exito' => false, 'mensaje' => 'Error al agregar los servicios del inmueble'));
            // }
        }



        // $resultadoConsulta = $ObjMaster->ConsultarInmuebles();

        // if ($resultadoConsulta) {
            
        //     header('Content-Type: application/json; charset=utf-8');
        //     echo json_encode($resultadoConsulta, JSON_UNESCAPED_UNICODE);
    
        // } else {
        //     echo json_encode(array('error' => 'No hay datos disponibles'));
        // }
        
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }


?>
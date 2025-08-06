<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/conexion/Conexion.php');
require_once('../funciones/funciones.class.php');



class VehiculosModelo extends Conexion
{



    public function verificarPlaca($conexion,$placa){

        $sql_verificar_placa = "SELECT  * FROM  carros WHERE placa = '".$placa."' ";

        // echo $sql_verificar_placa;

        // die();

        $consulta_placa = mysql_query($sql_verificar_placa,$conexion);

        return $consulta_placa;

    }



    public function traerVehiculos($conexion){

        $sql = "SELECT  c.placa,c.marca,c.tipo,c.color,c.idcarro,cli.nombre  as nombre

                FROM  carros  c

                LEFT OUTER JOIN cliente0 cli ON cli.idcliente = c.propietario 

                ORDER BY idcarro DESC";

        $consulta = mysql_query($sql,$conexion);

        $filas = mysql_num_rows($consulta);

        $datos = funciones::table_assoc($consulta);

        $resp['filas']=$filas;

        $resp['datos']=$datos;

        return $resp;

    }



    public function buscarPlaca($conexion,$placa){

        $sql = "select * from carros where placa = '".$placa ."'  ";

        // echo '<br>'.$sql;

        // die();

        $consulta = mysql_query($sql,$conexion); 

        $filas = mysql_num_rows($consulta);

        $datos = $this->get_table_assoc($consulta);

        $respuesta['filas']= $filas;

        $respuesta['datos']=  $datos;  

        return $respuesta; 

    }    



    public function verificarPlacaRespuestaJson($conexion,$placa){

        $sql = "select * from carros where placa = '".$placa ."'  ";

        // echo '<br>'.$sql;

        // die();

        $consulta = mysql_query($sql,$conexion); 

        $filas = mysql_num_rows($consulta);

        // echo '<br>'.$filas;

        // die();

        // $datos = $this->get_table_assoc($consulta);

        // $respuesta['filas']= $filas;

        // $respuesta['datos']=  $datos;  

        echo  json_encode($filas); 

    }



    public function get_table_assoc($datos)
		{
		 				$arreglo_assoc='';
							$i=0;	
							while($row = mysql_fetch_assoc($datos)){		
								$arreglo_assoc[$i] = $row;
								$i++;
							}
						return $arreglo_assoc;
		}



        

        public function grabarVehiculo($conexion,$request){

            $datosEmpresa = $this->traerEmpresa($conexion);

            $sql = "INSERT INTO carros (placa,propietario,marca,tipo,modelo, color,vencisoat,revision,chasis

            ,motor,id_empresa ) 

                    VALUES('".strtoupper($request['placa'])."','".$request['propietario']."',

                    '".strtoupper($request['marca'])."','".strtoupper($request['linea'])."','".strtoupper($request['modelo'])."',

                    '".strtoupper($request['color'])."','".$request['vencisoat']."','".$request['revision']."',

                    '".$request['chasis']."','".$request['motor']."' ,'".$datosEmpresa['id_empresa']."'  )";

                    $consulta = mysql_query($sql,$conexion);   

                    $maxId = $this->traerMaxIdCarros($conexion);

                    // echo '<br>'.$maxId;

                    // die();

                    return  $maxId;

        }

                public function traerMaxIdCarros($conexion){

                    $sqlId = "SELECT MAX(idcarro)as maxId FROM carros "; 

                    // echo  '<br>'.$sqlId;

                    // die();

                    $consultaId = mysql_query($sqlId,$conexion); 

                    $consultaId = mysql_fetch_assoc($consultaId);

                    return $consultaId['maxId'];

                }         

                

                public function traerEmpresa($conexion){

                    $sql = "SELECT * FROM  empresa ORDER BY id_empresa DESC ";

                    $consultaId = mysql_query($sql,$conexion);

                    $arr = mysql_fetch_assoc($consultaId); 

                    return $arr;   

                }   
                public function traerVehiculosCliente($idCliente)
                {
                    $sql ="select * from carros where propietario = '".$idCliente."'   ";
                    $consulta = mysql_query($sql,$this->connectMysql()); 
                    $vehiculos = get_table_assoc($consulta);
                    // echo 'veehiculos<pre>';
                    // print_r($vehiculos);
                    // echo '</pre>';
                    // die();
                    return $vehiculos;
                }

        
    }



?>
<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/conexion/Conexion.php');

Class OrdenesModelo extends Conexion
{

    public function __construct(){

    }


    public function traerInfoOrdenIdOrden($idOrden)
    {
        $sql = "select * from ordenes where id= '".$idOrden."'   "; 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arreglo = mysql_fetch_assoc($consulta); 
        return $arreglo; 
    }

     public function traerOrdenes($conexion){

         $sql = " SELECT o.id,o.orden,o.fecha,o.placa,c.tipo FROM ordenes o 
                  LEFT JOIN carros c on c.placa = o.placa 
                  ORDER BY  o.id DESC 
                  ";

         $consulta = mysql_query($sql,$conexion);

         $arreglo= '';

         $i=0;

         while($resul = mysql_fetch_assoc($consulta)){

                $arreglo[$i]['id'] = $resul['id'];

                $arreglo[$i]['orden'] = $resul['orden'];

                $arreglo[$i]['fecha'] = $resul['fecha'];

                $arreglo[$i]['placa'] = $resul['placa'];

                $arreglo[$i]['tipo'] = $resul['tipo'];

                $i++;

         }

         return $arreglo;

     }   

     public function traerOrdenesNew($request = []){
         $sql = " SELECT o.id,o.orden,o.fecha,o.placa,c.tipo,o.estado,o.kilometraje,o.observaciones  
                  FROM ordenes o 
                  LEFT JOIN carros c on c.placa = o.placa 
                  ORDER BY  o.id DESC 
                  ";
                //   die($sql);
         $consulta = mysql_query($sql,$this->connectMysql());
         $arreglo = $this->get_table_assoc($consulta);
         return $arreglo;
     }   



     public function traerOrdenId($id,$conexion =  '' ){
        $sql = " SELECT o.orden,o.fecha,cli.telefono,o.kilometraje,o.observaciones,t.nombre as mecanico,o.id 
                 ,o.estado,o.observacionestecnico,o.mecanico as idmecanico,cli.nombre as nombrecli, o.placa,
                 cli.email as email
                 FROM ordenes o 
                 LEFT JOIN carros c on c.placa = o.placa
                 LEFT JOIN cliente0 cli on cli.idcliente = c.propietario 
                 LEFT JOIN tecnicos t on t.idcliente = o.mecanico
                 WHERE  o.id = '".$id."'
                 ORDER BY  o.id DESC 
        ";
        die($sql);
        // echo '<br>'.$sql; 
        // $consulta = mysql_query($sql,$conexion);
        $consulta = mysql_query($sql,$this->connectMysql());  
        $arreglo= mysql_fetch_assoc($consulta);
        return $arreglo;
    }

    public function traerDatosEmpresa($conexion){

        $sql="SELECT * FROM empresa";

        $consulta = mysql_query($sql,$conexion);

        $arreglo = mysql_fetch_assoc($consulta);

        return $arreglo;  



    }

    public function traerNumeroOrdenActual($conexion){

        $sql="SELECT contaor FROM empresa " ; 

        $consulta = mysql_query($sql,$conexion);

        $arreglo = mysql_fetch_assoc($consulta);

        $contaor = $arreglo['contaor'];

        return $contaor;

    } 

    public function actualizarContadorOrdenes($conexion,$siguienteNumero){

        $sql ="UPDATE empresa  SET contaor = '".$siguienteNumero."'";

        // echo '<br>'.$sql;

        // die();

        $consulta = mysql_query($sql,$conexion);

    } 

    

    public function grabarOrden($conexion,$datos){

        $datosEmpresa = $this->traerDatosEmpresa($conexion);

        $id_empresa = $datosEmpresa['id_empresa'];

        $numeroActual = $this->traerNumeroOrdenActual($conexion);

        $siguienteNumero =  $numeroActual + 1;

        // echo '<br>'.$siguienteNumero;

        // die(); 

        $sql = "insert into ordenes

        (orden,placa,fecha,observaciones,id_empresa,estado,kilometraje,mecanico,tipo_orden,

        tipo_medida_kms_millas_horas) 

        values (

            '".$siguienteNumero."',

            '".$datos['placa']."',

            now(),

            '".$datos['descripcion']."',

            '".$id_empresa."',

            '0',

            '".$datos['kilometraje']."',

            '".$datos['mecanico']."',

            '1',

            '".$datos['tipo_medida']."'

            )";

            // echo '<br>'.$sql;

            // die();

            $consulta = mysql_query($sql,$conexion);    

            $this->actualizarContadorOrdenes($conexion,$siguienteNumero);  

            return $siguienteNumero; 

        }



    public function traerEmailCLiente($placa,$conexion){

          $sql  = "SELECT  cli.email as email FROM  carros ca 
                   INNER JOIN cliente0 cli ON  cli.idcliente = ca.propietario 
                   WHERE ca.placa = '".$placa."' ";
          $consulta = mysql_query($sql,$conexion);
          $arreglo = mysql_fetch_assoc($consulta);
          $email = $arreglo['email']; 
          return $email;            
    }

    public function busqueOrdenesConFiltroNew($request)
    {
                // echo '<pre>';
                // print_r($request);
                // echo '</pre>';
                // die();

        $sql = " SELECT o.id,o.orden,o.fecha,o.placa,c.tipo,o.estado,o.kilometraje,o.observaciones  
                FROM ordenes o 
                LEFT JOIN carros c on c.placa = o.placa 
                where 1=1 "; 


        if($request['placa'] != '')
        {
            $sql .= "  and o.placa like  '%".$request['placa']."%'   "; 
        }  

        if($request['idEstado'] != '')
        {
            $sql .= "  and o.estado =  '".$request['idEstado']."'   "; 
        }        

        $sql .= " 
                  ORDER BY  o.id DESC 
                ";        


        //  die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());  
        $arreglo = $this->get_table_assoc($consulta);
        // $arreglo= '';
        
        // $i=0;
        
        // while($resul = mysql_fetch_assoc($consulta)){
        //     $arreglo[$i]['id'] = $resul['id'];
        //     $arreglo[$i]['orden'] = $resul['orden'];
        //     $arreglo[$i]['fecha'] = $resul['fecha'];
        //     $arreglo[$i]['placa'] = $resul['placa'];
        //     $arreglo[$i]['tipo'] = $resul['tipo'];
        //        $arreglo[$i]['estado'] = $resul['estado'];
        //        $arreglo[$i]['kilometraje'] = $resul['kilometraje'];
        //        $arreglo[$i]['observaciones'] = $resul['observaciones'];
        //        $i++;
        //     }
            return $arreglo;
            
        }
        public function actualizarOrdenId($request)
        {
            $sql = "update ordenes set 
            estado = '".$request['idEstadoOrden']."'
            , observacionestecnico = '".$request['observacionestecnico']."'
            , mecanico = '".$request['idMecanico']."'
            where id = '".$request['id']."'
            ";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            echo 'Orden Actualizada ';  
            
        }
        
        public function actualizarEstadoOrdenId($idOrden)
        {
            $sql = "update ordenes set estado = '2'  where id = '".$idOrden."'    ";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $this->crearRegistroFacturada($idOrden);
        }
        
        public function crearRegistroFacturada($idOrden)
        {
            $sql = "insert into registrofacturadas (idOrden,fecha,observacion,tipo)  
            values ('".$idOrden."',now(),'Facturada','1')"; 
            $consulta = mysql_query($sql,$this->connectMysql()); 
        }
        public function traigaultimoRegistroFacturadaIdOrden($idOrden)
        {
            $sql = "select max(id),DATE_FORMAT(Fecha,'%Y/%m/%d') as fecha from registrofacturadas 
                    where idOrden = '".$idOrden."' 
                    and tipo = '1'
                    ";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $arreglo = mysql_fetch_assoc($consulta); 
            return $arreglo; 
        }
        
        public function traerDatosCarroConPlaca($placa)
        {
            $sql = "select * from carros where placa = '".$placa."' "; 
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $arrCarro = mysql_fetch_assoc($consulta);
            return $arrCarro;  
        }
        
        public function traerDatosPropietarioConPlaca($id)
        {
            $sql = "select * from cliente0 where idcliente = '".$id."'   "; 
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $arrCliente = mysql_fetch_assoc($consulta);
            return $arrCliente; 
            
        }
        
        public function traerItemsAsociadosOrdenPorIdOrden($idOrden)
        {
            $sql = "select * from item_orden where no_factura = '".$idOrden."'  "; 
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $arreglo = $this->get_table_assoc($consulta); 
            return $arreglo; 

        }
        public function realizarReversionFacturadaIdOrden($idOrden)
        {
            $sql =  "update ordenes set estado = '1' where id = '".$idOrden."'  "; 
            $consulta = mysql_query($sql,$this->connectMysql()); 
            
        }
        public function crearRegistroDesfacturadaId($idOrden)
        {
            $sql = "insert into registrofacturadas (idOrden,fecha,observacion,tipo)  
            values ('".$idOrden."',now(),'DesFacturada','2')"; 
            $consulta = mysql_query($sql,$this->connectMysql()); 
        }
        
        public function eliminarReciboDeCajaReversionFacturaIdOrden($idOrden)
        {
            $sql = "delete from recibos_de_caja where id_orden = '".$idOrden."' ";  
            $consulta = mysql_query($sql,$this->connectMysql()); 
            
        }
        
        public function traerImagenesOrdenId($idOrden)
        {
            $sql = "select * from imagenes_ordenes where idorden =  $idOrden  ";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $imagenes = $this->get_table_assoc($consulta);
            return $imagenes;  

        }

        public function actualizarNumeroImagenesOrden($idOrden,$numero)
        {
            $sql = "update ordenes set 
                    numeroImagenes = '".$numero."' 
                    where id = '".$idOrden."' 
            ";
            $consulta = mysql_query($sql,$this->connectMysql());
        }

        public function grabaregistroImagenesOrden($idOrden,$nombreIma,$ruta,$fechaSubidaImagen)
        {
            $sql = "insert into imagenes_ordenes(idorden,nombre,ruta_imagen,fecha) 
            values ('".$idOrden."','".$nombreIma."','".$ruta."','".$fechaSubidaImagen."')";
            // die($sql); 
            $consulta = mysql_query($sql,$this->connectMysql());
        }

        public function traerInfoImagenenOrdenIdImagen($id)
        {
            $sql = "select * from imagenes_ordenes where id_imagen_orden ='".$id."' ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $infoImagen = mysql_fetch_assoc($consulta);
            return $infoImagen;
        }

        public function deleteImagenOrden($id)
        {
            $sql = "delete  from imagenes_ordenes where id_imagen_orden ='".$id."' ";
            $consulta = mysql_query($sql,$this->connectMysql());
        }

        public function actualizaIdSiigoOrden($idOrden,$cufe)
        {
            $sql = "update ordenes set 
            cufe = '".$cufe."'
            where id = '".$idOrden."'
            ";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            echo 'Orden Actualizada ';  
        }
        public function actualizarCufeIdsiigoOrden($idOrden,$cufe,$idSiigo)
        {
            $sql = "update ordenes set 
            cufe = '".$cufe."',
            idSiigo = '".$idSiigo."'
            where id = '".$idOrden."'
            ";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            echo 'Orden Actualizada ';  
        }




}

?>
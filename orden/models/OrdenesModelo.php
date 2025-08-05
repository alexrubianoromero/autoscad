<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/conexion/Conexion.php');

Class OrdenesModelo extends Conexion
{

    public function __construct(){

    }

    public function traerOrdenId($idorden)
    {
        $sql ="select * from ordenes where id = '".$idorden."' ";
        // die($sql); 
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
        public function traerDatosEmpresa()
        {
            $sql = "select * from empresa where id_empresa = '94' "; 
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

        


}   

?>
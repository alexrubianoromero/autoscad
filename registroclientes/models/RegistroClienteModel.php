<?php
$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');

    class RegistroClienteModel extends Conexion
    {
        public function __construct(){
         
        }

        public function grabarCliente($request)
        {
            $sql ="insert into cliente0 (identi,nombre,direccion,telefono,email,id_empresa) 
            values (
                '".$request['identi']."'
                ,'".strtoupper($request['nombre'])."'
                ,'".strtoupper($request['direccion'])."'
                ,'".$request['celular']."'
                ,'".$request['email']."'
                ,'94'
            )"; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $ultId =  $this->traerUltimoIdCliente0();
            return $ultId;
        }

        public function grabarMoto($request)
        {
            $sql ="insert into carros (propietario,placa,marca,tipo,modelo,color,id_empresa) 
            values (
                '".$request['idcliente']."'
                ,'".strtoupper($request['placa'])."'
                ,'".strtoupper($request['marca'])."'
                ,'".strtoupper($request['linea'])."'
                ,'".strtoupper($request['modelo'])."'
                ,'".strtoupper($request['color'])."'
                ,'94'
            )"; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $ultId =  $this->traerUltimoIdMotos();
            return $ultId;
        }
        
        public function traerUltimoIdCliente0()
        {
            $sql = "select max(idcliente) as maxId from cliente0";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrId = mysql_fetch_assoc($consulta);
            $maxId = $arrId['maxId'];
            return $maxId;
        }
        public function traerUltimoIdMotos()
        {
            $sql = "select max(idcarro) as maxId from carros";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrId = mysql_fetch_assoc($consulta);
            $maxId = $arrId['maxId'];
            return $maxId;
        }
        
        public function traerInfoClienteId($id)
        {
            $sql = "select * from cliente0 where idcliente = '".$id."'  "; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrCliente = mysql_fetch_assoc($consulta); 
            return $arrCliente;
        }
        public function traerInfoMotoId($id)
        {
            $sql = "select * from carros where idcarro = '".$id."'  "; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrMoto = mysql_fetch_assoc($consulta); 
            return $arrMoto;
        }
        public function traerInfoClienteIdenti($identi)
        {
            $sql = "select * from cliente0 where identi = '".$identi."'  "; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $filas = mysql_num_rows($consulta); 
            $arrCliente = mysql_fetch_assoc($consulta); 
            $respu['filas'] = $filas; 
            $respu['data'] = $arrCliente; 
            return $respu;
        }
        public function traerInfoMotoPlaca($placa)
        {
            $sql = "select * from carros where placa = '".$placa."'  "; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $filas = mysql_num_rows($consulta); 
            $arrMoto = mysql_fetch_assoc($consulta); 
            $respu['filas'] = $filas; 
            $respu['data'] = $arrMoto; 
            return $respu;
        }




    }
<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/conexion/Conexion.php');
// die($raiz);

class GrabarEventoModel extends Conexion
{
    // public function __construct(){
    //     if(!($request['opcion'])){
    //         $this->traerEventos();
    //     }
    // }
    
    public function traerEventoId($id)
    {
        $sql = "SELECT * FROM citas where id= '".$id."'";
        $consulta = mysql_query($sql,$this->connectMysql());
        $evento = mysql_fetch_assoc($consulta);
        return $evento;
    }

    public function grabarEvento($request)
    {
        $sql = "INSERT INTO citas (fecha, placa,hora,email,servicio) 
        VALUES ('".$request['fecha']."','".$request['placa']."'
        ,'".$request['hora']."','".$request['email']."','".$request['servicio']."')";
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    public function traerMaxidEventos()
    {
        $sql = "select max(id) as maxId from citas ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $arreglo = mysql_fetch_assoc($consulta);
        return $arreglo['maxId'];
    }

    public function actualizarEvento($request)
    {
        $sql = "update  citas set fecha =  '".$request['nuevaFecha']."' where id =   '".$request['id']."'";
        $consulta = mysql_query($sql,$this->connectMysql());
    }

    public function traerAgendaProximosdias($dias)
    {
        $sql = "    SELECT * FROM citas
                    WHERE fecha = DATE_ADD(CURDATE(), INTERVAL ".$dias." DAY)";
         $consulta = mysql_query($sql,$this->connectMysql());
         $filas = mysql_num_rows($consulta); 
         $eventos = $this->get_table_assoc($consulta);
         $respu['filas']=$filas; 
         $respu['info']=$eventos; 
         return $respu;
    }


    
    public function grabarCliente($request){
        $datosEmpresa = $this->traerEmpresa();
        $sql = "insert into cliente0 (identi,nombre,telefono,email,observaci,id_empresa) 
                values ('".$request['telefono']."','".$request['nombre']."'
                ,'".$request['telefono']."' ,'".$request['email']."','Grabado desde agenda '
                ,'".$datosEmpresa['id_empresa']."')";
        //  die($sql);       
        $consulta = mysql_query($sql,$this->connectMysql());
        $maxId = $this->traerMaxIdCLiente0();
        return $maxId;   
    }
    
    public function traerEmpresa(){
        $sql = "SELECT * FROM  empresa ORDER BY id_empresa DESC limit 1";
        $consultaId = mysql_query($sql,$this->connectMysql());
        $arr = mysql_fetch_assoc($consultaId); 
        return $arr;   
    } 
    
    public function traerMaxIdCLiente0(){
        $sql= "SELECT MAX(idcliente)as maxId FROM cliente0 "; 
        $consultaId = mysql_query($sql,$this->connectMysql());
        $consultaId = mysql_fetch_assoc($consultaId);
        return $consultaId['maxId'];
    } 
    public function grabarvehiculoCita($request,$idCliente)
    {
        $datosEmpresa = $this->traerEmpresa();
        $sql = "insert into carros  (placa,propietario,id_empresa) 
        values ('".$request['placa']."','".$idCliente."','".$datosEmpresa['id_empresa']."') "; 
        $consulta = mysql_query($sql,$this->connectMysql());
    }
    
    public function verificarCliente0()
    {

    }
    public function verificarCarro()
    {

    }


    
    public function traerClienteConPlaca($placa)
    {
        $sql = "select * from cliente0 cli  
        inner join carros ca on (cli.idcliente = ca.propietario)
        where ca.placa = '".$placa."'
        ";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $cliente = mysql_fetch_assoc($consulta);
        return $cliente;
    }
    public function verificarOrdenCreada($evento)
    {
        $sql = "select * from ordenes 
        where  1=1
        and placa = '".$evento['placa']."' 
        and fecha = '".$evento['fecha']."' 
         ";
         $consulta = mysql_query($sql,$this->connectMysql());
         $respu['filas']= mysql_num_rows($consulta);
         $respu['datos']=  mysql_fetch_assoc($consulta); 
         return $respu;

    }


    //////////ordenes 

    
    
    
    public function grabarOrdenAgenda($request){
        $datosEvento = $this->traerEventoId($request['idEvento']);
        $datosEmpresa = $this->traerEmpresa();
         
        //     echo '<pre>';
        //    print_r($datosEmpresa);
        //    echo '</pre>';
        //    die();
        $siguienteNumero =  $datosEmpresa['contaor'] + 1;
        // echo '<br>'.$siguienteNumero;
        // die(); 
        $sql = "insert into ordenes
        (orden,placa,fecha,observaciones,id_empresa,estado,kilometraje,tipo_orden) 
        values (
            '".$siguienteNumero."'
            ,'".$datosEvento['placa']."'
            ,'".$datosEvento['fecha']."'
            ,'".$datosEvento['servicio']."'
            ,'". $datosEmpresa['id_empresa']."'
            ,'0'
            ,'".$request['kilometraje']."'
            ,'1'
           
            )";

            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $this->actualizarContadorEmpresa($siguienteNumero);  
            return $siguienteNumero; 
        }

        public function traerUltimaOrdenPlaca($placa)
        {
            $sql ="select * from ordenes 
            where placa = '".$placa."' 
            and anulado =0 
                order by id desc limit 1
            ";
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $orden = mysql_fetch_assoc($consulta);
            return $orden ;

        }

        public function actualizarContadorEmpresa($numero)
        {
            $sql = "update empresa set contaor = '".$numero."' ";
            $consulta = mysql_query($sql,$this->connectMysql());
        }
        
        public function traerInfoclienteIdCLiente($idCliente)
        {
            $sql = "select * from cliente0 where idcliente = '".$idCliente."'    "; 
            $consulta = mysql_query($sql,$this->connectMysql());
            $arreglo = mysql_fetch_assoc($consulta);
            return $arreglo;
            
        }
        
        public function actualizarEmailClienteId($idCliente ,$email)
        {
            $sql = "update cliente0 set email = '".$email."'   where idcliente = '".$idCliente."'    "; 
            $consulta = mysql_query($sql,$this->connectMysql());
            
        }
        
        public function actualizarNombreEnCita($idCita,$nombre)
        {
            $sql = "update citas set nombre_cliente = '".$nombre."'    where id = '".$idCita."'   "; 
            $consulta = mysql_query($sql,$this->connectMysql());
        }


}


?>
<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/conexion/Conexion.php');
// die($raiz);

class EventoModel extends Conexion
{
    public function __construct(){
        if(!($_REQUEST['opcion'])){
            $this->traerEventos();
        }
    }
    
    public function traerEventos()
    {
        $sql = "SELECT id, fecha AS start, concat(hora,'-',placa,'-',servicio) AS title FROM citas order by fecha, hora asc";
        $consulta = mysql_query($sql,$this->connectMysql());
        $eventos = $this->get_table_assoc($consulta);
        echo json_encode($eventos);
    }

    public function traerClienteConPlaca($placa)
    {
        $sql = "select * from cliente cli  
        inner join carros ca on (cli.idcliente = ca.propietario)
        where ca.placa = '".$placa."'
        ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $cliente = mysql_fetch_assoc($consulta);
        return $cliente;
    }

   

}

$conect = new EventoModel();

?>
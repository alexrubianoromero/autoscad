<?php
$raiz = dirname(dirname(dirname(__file__)));
//  die('controller'.$raiz);
require_once($raiz.'/registroclientes/views/registroClientesView.php');
require_once($raiz.'/registroclientes/models/RegistroClienteModel.php');
// require_once($raiz.'/inventario_codigos/modelo/CodigosInventarioModelo.php');
// require_once($raiz.'/inventario_codigos/modelo/MovimientosInventarioModelo.php');

class registroClientesController
{
    private $vista; 
    private $model;
    // private $movimientosModelo;  


    public function __construct()
    {

        // echo '<pre>'; 
        // print_r($_REQUEST);
        // echo '</pre>';
        // die(); 
        $this->vista =  new registroClientesView();
        $this->model =  new RegistroClienteModel();

        if(!$_REQUEST['opcion'])
        {
            $this->pantallaInicialRegistroCliente();
        }
        if($_REQUEST['opcion'] == 'registrarCliente'){
            $this->registrarCliente($_REQUEST);
        }
        if($_REQUEST['opcion'] == 'reviseIdenti'){
            $this->reviseIdenti($_REQUEST);
        }
        if($_REQUEST['opcion'] == 'revisePlaca'){
            $this->revisePlaca($_REQUEST);
        }
        if($_REQUEST['opcion'] == 'registrarMoto'){
            $this->registrarMoto($_REQUEST);
        }

    }

    public function pantallaInicialRegistroCliente()
    {
        $this->vista->pantallaInicialRegistroCliente();
    }
    
    public function registrarCliente($request)
    {
        $ultId = $this->model->grabarCliente($request); 
        // die($ultId);
        $infoCliente = $this->model->traerInfoClienteId($ultId);
        echo 'Cliente Grabado';
        $this->vista->muestreInfoCliente($infoCliente);
    }    
    public function registrarMoto($request)
    {
        $ultId = $this->model->grabarMoto($request); 
        // die($ultId);
        $infoMoto = $this->model->traerInfoMotoId($ultId);
        echo 'Moto Grabada';
        $this->vista->muestreInfoMoto($infoMoto);
    }    
    public function reviseIdenti($request)
    {
        $reviseIdenti = $this->model->traerInfoClienteIdenti($request['identi']); 
        echo json_encode($reviseIdenti);

    }
    
    public function revisePlaca($request)
    {
        $revisePlaca = $this->model->traerInfoMotoPlaca($request['placa']); 
        echo json_encode($revisePlaca);

    }
    
}
<?php

$raiz = dirname(dirname(dirname(__file__)));

// echo $raiz;

// die();

require_once($raiz.'/vehiculos/vista/VehiculoVista.php');

require_once($raiz.'/vehiculos/modelo/VehiculosModelo.php');

require_once($raiz.'/clientes/modelo/ClientesModelo.class.php');

// require_once('../funciones.class.php');

class vehiculoControlador{

    private $vehiculoVista;

    private $vehiculoModelo;

    private $clientesModelo; 

    

    public function __construct($conexion)

    {

        $this->vehiculoVista = new VehiculoVista();

        $this->vehiculoModelo = new VehiculosModelo();

        $this->clientesModelo = new ClientesModelo();



        

        if(!isset($_REQUEST['opcion'])){

          $this->pantallainicialVehiculos($conexion);

        }

        if($_REQUEST['opcion']=='muestreVehiculos' ){
            $this->muestreVehiculos($conexion);
          }
          
        if($_REQUEST['opcion']=='muestreVehiculosPlaca' ){
            $this->muestreVehiculosPlaca($_REQUEST);
          }

          

        if($_REQUEST['opcion']=='nuevo'){

            $this->vehiculoVista->nuevaPlaca();

        }

        if($_REQUEST['opcion']=='buscarPlaca'){

            $this->buscarPlaca($conexion,$_REQUEST['placa']);

        } 

        if($_REQUEST['opcion']=='buscarPlacaDesdeOrden'){

            $this->buscarPlacaDesdeOrden($conexion,$_REQUEST['placa']);

        } 

        if($_REQUEST['opcion']=='grabarVehiculo1'){

            $this->grabarVehiculo($conexion,$_REQUEST);

        }

        if($_REQUEST['opcion']=='verificarPlacaRespuestaJson'){

            $this->verificarPlacaRespuestaJson($conexion,$_REQUEST['placa']);

        }
        if($_REQUEST['opcion']=='mostrarHistorialVehiculo'){
            $this->mostrarHistorialVehiculo($_REQUEST);
        }
        if($_REQUEST['opcion']=='muestreInfoVehiculo'){
            $this->muestreInfoVehiculo($_REQUEST);
        }
        if($_REQUEST['opcion']=='actualizarDatosVehiculoNew'){
            $this->actualizarDatosVehiculoNew($_REQUEST);
        }
        if($_REQUEST['opcion']=='buscarPlacaSimple'){

            $this->buscarPlacaSimple($_REQUEST);
        } 
        if($_REQUEST['opcion']=='buscarPlacaSimpleTraerInfoPlacaYProp'){

            $this->buscarPlacaSimpleTraerInfoPlacaYProp($_REQUEST);
            
        } 
        if($_REQUEST['opcion']=='buscarPlacaDesdeCambio'){

            $this->buscarPlacaDesdeCambio($_REQUEST);
        } 
        if($_REQUEST['opcion']=='mostrarDatosPlacaNewCambioAceite'){

            $this->mostrarDatosPlacaNewCambioAceite($_REQUEST);
        } 
        if($_REQUEST['opcion']=='preguntarDatosPlacaDesdeCambio'){

            $this->preguntarDatosPlacaDesdeCambio($_REQUEST);
        } 


    }



    public function verificarPlacaRespuestaJson($conexion,$placa){

        $filas = $this->vehiculoModelo->verificarPlacaRespuestaJson($conexion,$placa);
        // $respu['filas']= $filas;
        echo json_encode($filas);
    }

    public function pantallainicialVehiculos($conexion){

        $datosVehiculos = $this->vehiculoModelo->traerVehiculos($conexion);

        $this->vehiculoVista->pantallainicialVehiculos($datosVehiculos);         

    }

    

    public function muestreVehiculos($conexion){

            $datosVehiculos = $this->vehiculoModelo->traerVehiculos($conexion);

            //   echo '<pre>';

            //   print_r($datosVehiculos);

            //   echo '</pre>';

            //   die();

            // echo 'asdasdas';

            $this->vehiculoVista->verVehiculos($datosVehiculos);

    }



    public function buscarPlaca($conexion,$placa){

        $datosPlaca = $this->vehiculoModelo->buscarPlaca($conexion,$placa);

        if($datosPlaca['filas']>0){

            $datosCliente0 = $this->clientesModelo->buscarCliente0Id($conexion,$datosPlaca['datos'][0]['propietario']);

            $this->vehiculoVista->mostrarDatosPlaca($datosPlaca['datos'],$datosCliente0['datos']);

        }

        else{

            $propietarios = $this->clientesModelo->traerDatosCliente0($conexion);

            $propietarios = $propietarios['datos'];

            $this->vehiculoVista->preguntarDatosPlaca($placa,$propietarios);

        }

    }

    public function buscarPlacaDesdeOrden($conexion,$placa){

        $datosPlaca = $this->vehiculoModelo->buscarPlaca($conexion,$placa);

        if($datosPlaca['filas']>0){

            $datosCliente0 = $this->clientesModelo->buscarCliente0Id($conexion,$datosPlaca['datos'][0]['propietario']);

            $this->vehiculoVista->mostrarDatosPlaca($datosPlaca['datos'],$datosCliente0['datos']);

        }

        else{

            $propietarios = $this->clientesModelo->traerDatosCliente0($conexion);

            $propietarios = $propietarios['datos'];

            $this->vehiculoVista->preguntarDatosPlacaDesdeOrden($placa,$propietarios);

        }

    }
    public function mostrarDatosPlacaNewCambioAceite($request)
    {
        //esto es solamente si la placa existe
        $datosPlaca = $this->vehiculoModelo->buscarPlacaSimple($request['placa']);
        $datosCliente0 = $this->clientesModelo->buscarCliente0Id('',$datosPlaca['datos'][0]['idpropietario']);
        $this->vehiculoVista->mostrarDatosPlacaNewCambioAceite($datosPlaca['datos'][0],$datosCliente0['datos'][0]);
    }
    public function preguntarDatosPlacaDesdeCambio($request)
    {
        $propietarios = $this->clientesModelo->traerDatosCliente0('');
        $propietarios = $propietarios['datos'];
        $desdeDonde = 1;  //esto es para identificar que viene de  cambioaceite y que el boton de grabar realice acciones diferentes sea diferente
        $this->vehiculoVista->preguntarDatosPlacaDesdeOrden($request['placa'],$propietarios,$desdeDonde);
    }

    public function buscarPlacaDesdeCambio($request){
        $datosPlaca = $this->vehiculoModelo->buscarPlacaSimple($request['placa']);
        
        if($datosPlaca['filas']>0){
            $datosCliente0 = $this->clientesModelo->buscarCliente0Id('',$datosPlaca['datos'][0]['idpropietario']);
            $this->vehiculoVista->mostrarDatosPlacaNewCambioAceite($datosPlaca['datos'][0],$datosCliente0['datos'][0]);
        }
        else{
            $propietarios = $this->clientesModelo->traerDatosCliente0('');
            $propietarios = $propietarios['datos'];
            $desdeDonde = 1;  //esto es para identificar que viene de  cambioaceite y que el boton de grabar realice acciones diferentes sea diferente
            $this->vehiculoVista->preguntarDatosPlacaDesdeOrden($request['placa'],$propietarios,$desdeDonde);
        }
    }


    // public function grabarPeritaje($conexion,$request){

    //     $this->modelo->grabarPeritaje($conexion,$request);

    //     $this->pantallaInicial($conexion);

    // }


    public function grabarVehiculo($conexion,$request){
        $idNuevoCarro = $this->vehiculoModelo->grabarVehiculo($conexion,$request);
        $this->buscarPlaca($conexion,$request['placa']);
    }

    public function mostrarHistorialVehiculo($request)
    {
        $historiales = $this->vehiculoModelo->buscarHistoriales($request['placa']);

        $this->vehiculoVista->mostrarHistorialvehiculo($historiales);
        

    }

    public function muestreVehiculosPlaca($request)
    {
        $datosVehiculos = $this->vehiculoModelo->traerVehiculosPlaca($request['placa']);
        $this->vehiculoVista->verVehiculos($datosVehiculos);
    }

    public function muestreInfoVehiculo($request)
    {
        $datosPlaca = $this->vehiculoModelo->traerVehiculosPlaca($request['placa']);
        $datosCliente0 = $this->clientesModelo->buscarCliente0Id('',$datosPlaca['datos'][0]['idpropietario']);
        $this->vehiculoVista->mostrarDatosPlacaNew($datosPlaca['datos'][0],$datosCliente0['datos'][0]);
    }
    
    public function actualizarDatosVehiculoNew($request)
    {
        $datosPlaca = $this->vehiculoModelo->actualizarDatosVehiculoNew($request);
        if($request['placaAnterior'] != $request['placaNueva'] )
        {
            $this->vehiculoModelo->actualizarPlacaOrdenes($request['placaAnterior'],$request['placaNueva'] );
            
        }
        echo 'Informacion Actualizada'; 
    }

    /**
     * Esta funcion indica simplemente si un vehiculo existe o no en la base de datos 
     */
    public function buscarPlacaSimple($request)
    {
            $datosPlaca = $this->vehiculoModelo->buscarPlacaSimple($request['placa']);
            echo json_encode($datosPlaca);
            exit();
    }
    public function buscarPlacaSimpleTraerInfoPlacaYProp($request)
    {
            $datosPlaca = $this->vehiculoModelo->buscarPlacaSimpleTraerInfoPlacaYProp($request['placa']);
            echo json_encode($datosPlaca);
            exit();
    }

   
}



?>
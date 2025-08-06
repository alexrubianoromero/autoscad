<?php
 date_default_timezone_set('America/Bogota');
 $raiz = dirname(dirname(dirname(__file__)));
//  die($raiz);
 require_once($raiz.'/calendario/views/calendarioView.php');  
 require_once($raiz.'/calendario/models/GrabarEventoModel.php');  
 require_once($raiz.'/calendario/EnviarCorreoPhpMailer.class.php');  

 class calendarioController
 {
    protected $view;
    protected $model;
    protected $correo; 

    public function   __construct()
    {
        //     echo '<pre>';
        //    print_r($_REQUEST);
        //    echo '</pre>';
        //    die();
        $this->view = new calendarioView();
        $this->model = new GrabarEventoModel();
        $this->correo = new GrabarEventoModel();
        // echo 'bienvenido calendario ';
        if(!$_REQUEST['opcion'])
        {
            $this->view->menuPrincipal(); 
        }

        if($_REQUEST['opcion']=='grabarEvento')
        { 
            if($_REQUEST['flagPlaca']==0){ //si laplaca no existe graba datos
                $this->grabarClienteVehiculo($_REQUEST);
            }
           $body = $this->traerBody($_REQUEST);
           new enviarCorreoPhpMailer($_REQUEST['email'],$body);
            $this->model->grabarEvento($_REQUEST);   
        }


        if($_REQUEST['opcion']=='actualizarEvento')
        {
            $this->model->actualizarEvento($_REQUEST);        
        }
        if($_REQUEST['opcion']=='traerInfoEventoExistente')
        {
            $this->traerInfoEventoExistente($_REQUEST['id']);     
        }
        if($_REQUEST['opcion']=='formuCrearOrdenDesdeAgenda')
        {
            // echo 'llego a crear orden ';
            $this->view->formuCrearOrdenDesdeAgenda($_REQUEST['idEvento']);   
              
        }
        if($_REQUEST['opcion']=='crearOrdenAgenda')
        {
            // echo 'llego a crear orden ';
           $numeroOrden =  $this->model->grabarOrdenAgenda($_REQUEST);   
           echo 'Se creo el numero de orden '.$numeroOrden;

        }


        
    }//finde construct


    public function traerInfoEventoExistente($id)
    {
        //consultar info y devolverla
        $evento = $this->model->traerEventoId($id);
        
        //     echo '<pre>';
        //    print_r($evento);
        //    echo '</pre>';
        //    die();
        $this->view->formuEventoExistente($evento);
        // echo json_encode($evento);
        // exit();
    }


    public function grabarClienteVehiculo($request)
    {
        
       $idCliente =  $this->model->grabarCliente($request);
       $this->model->grabarvehiculoCita($request,$idCliente);

    }

    public function traerBody($datos){
        $body='';
        $body .='

        Hola <br> 
        Esperamos y deseamos que estes muy bien!<br><br>
        Queremos informarte que la  cita de tu vehiculo de placas  '.$datos['placa'].'<br> 
        ha sido generada exitosamente para el dia '.$datos['fecha'].' <br>
        a las  '.$datos['hora'].' <br><br>
        Estamos muy contentos de tener la oportunidad de atenderte y esperamos poder ofrecerte una excelente experiencia.<br><br>
        Aquí tienes un resumen de los detalles de tu cita:<br>
        Fecha: '.$datos['fecha'].' <br>
        Hora: '.$datos['hora'].' <br>
        Servicio/Motivo de la Cita: '.$datos['servicio'].'<br>
        Direccion: Direccion del taller <br>
        Si tienes alguna pregunta o necesitas realizar algún cambio en tu cita, no dudes en responder a este correo
         o llamarnos al 310 123 45 45. Estaremos encantados de ayudarte.<br>
         Agradecemos tu preferencia y esperamos verte pronto.
       
         Saludos Cordiales<br>
         Pepito perez<br>
         Gerente<br>
         Cel: 310 123 45 45<br>
         E-mail:     autoscad@gmail.com<br><br>
        ';

        return $body;

    }



 }



?>
<?php
 date_default_timezone_set('America/Bogota');
 $raiz = dirname(dirname(dirname(__file__)));
//  die($raiz);
 require_once($raiz.'/calendario/models/GrabarEventoModel.php');  
 require_once($raiz.'/calendario/EnviarCorreoPhpMailerNew.php'); 

 class enviarcorreoRecordarAgenda
 {
     protected $correo;
     public function   __construct()
     {
         $this->traerEventos();
        
     }
    
    public function traerEventos()
    {
        $eventoModel = new GrabarEventoModel();
         $validarEventos = $eventoModel->traerAgendaProximosdias(1);
          echo '<pre>'; print_r($validarEventos); echo '</pre>';die();
        //  if($validarEventos['filas']>0)
        //  {
        //      $eventos = $validarEventos['info'];
        //      foreach ($eventos as $evento)
        //      {
        //         // $body = $this->traerBody($evento);
        //         $body='prueba de recordacion';
        //         $email = 'alexrubianoromero@gmail.com';
        //         // $this->correo->enviarRecordatorioCorreoPhpMailer($email,$body);
        //         // echo '<br>'.$evento['hora'].' '.$evento['servicio'];

        //      }
        //  }
    }

    public function traerBody($datos){
        $body='';
        $body .='cuerpo recordatorio ';
        // $body .='
        // Hola <br> 
        // Esperamos y deseamos que estes muy bien!<br><br>
        // Queremos informarte que la  cita de tu vehiculo de placas  '.$datos['placa'].'<br> 
        // ha sido generada exitosamente para el dia '.$datos['fecha'].' <br>
        // a las  '.$datos['hora'].' <br><br>
        // Estamos muy contentos de tener la oportunidad de atenderte y esperamos poder ofrecerte una excelente experiencia.<br><br>
        // Aquí tienes un resumen de los detalles de tu cita:<br>
        // Fecha: '.$datos['fecha'].' <br>
        // Hora: '.$datos['hora'].' <br>
        // Servicio/Motivo de la Cita: '.$datos['servicio'].'<br>
        // Direccion: Direccion del taller <br>
        // Si tienes alguna pregunta o necesitas realizar algún cambio en tu cita, no dudes en responder a este correo
        //  o llamarnos al 310 123 45 45. Estaremos encantados de ayudarte.<br>
        //  Agradecemos tu preferencia y esperamos verte pronto.
       
        //  Saludos Cordiales<br>
        //  Pepito perez<br>
        //  Gerente<br>
        //  Cel: 310 123 45 45<br>
        //  E-mail:     kaymo@gmail.com<br><br>
        // ';

        return $body;

    }

 }
 $recordar = new enviarcorreoRecordarAgenda();
?>
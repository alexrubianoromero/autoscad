<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('America/Bogota');
require '../../phpmailer/Exception.php';
require '../../phpmailer/PHPMailer.php';
require '../../phpmailer/SMTP.php';
class EnviarCorreoPhpMailer 
{
    protected $mail;
    protected $body;
    protected $email; 

    public function __construct($email,$body){
        $this->email = $email;
        $this->body = $body;
        $this->mail = new PHPMailer(true);
        $this->enviarCorreoPhpMailer();
    }

    public function enviarCorreoPhpMailer(){
        try {
            $this->mail->SMTPDebug = 0;                      //Enable verbose debug output
            $this->mail->isSMTP();                                            //Send using SMTP
            $this->mail->Host       = 'mail.arsolutiontechnology.com';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = 'correo@arsolutiontechnology.com';                     //SMTP username
            $this->mail->Password   = 'estecorreosisaldra';                               //SMTP password
            $this->mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $this->mail->setFrom('correo@arsolutiontechnology.com', 'Autoscad Informa el Avance de tu  Orden');
            $this->mail->addAddress($this->email);     //Add a recipient
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = 'AVANCE ORDEN';
            $this->mail->Body    = $this->body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $this->mail->send();
            echo 'Mensaje de Correo Enviado';
        } catch (Exception $e) {
            echo "Error en e  el envio del mensaje: {$this->mail->ErrorInfo}";
        }
    }
    
    // public function enviarRecordatorioCorreoPhpMailer(){
    //     try {
    //         $this->mail->SMTPDebug = 0;                      //Enable verbose debug output
    //         $this->mail->isSMTP();                                            //Send using SMTP
    //         $this->mail->Host       = 'mail.arsolutiontechnology.com';                     //Set the SMTP server to send through
    //         $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //         $this->mail->Username   = 'correo@arsolutiontechnology.com';                     //SMTP username
    //         $this->mail->Password   = 'estecorreosisaldra';                               //SMTP password
    //         $this->mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    //         $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //         //Recipients
    //         $this->mail->setFrom('correo@arsolutiontechnology.com', 'KAYMO Recordatorio de tu cita ');
    //         $this->mail->addAddress($this->email);     //Add a recipient
    //         //Attachments
    //         // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //         // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    //         //Content
    //         $this->mail->isHTML(true);                                  //Set email format to HTML
    //         $this->mail->Subject = 'Recordatorio de tu cita';
    //         $this->mail->Body    = $this->body;
    //         // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //         $this->mail->send();
    //         echo 'Mensaje de Correo Enviado<br>';
    //     } catch (Exception $e) {
    //         echo "Error en e  el envio del mensaje: {$this->mail->ErrorInfo}";
    //     }
    // }


} //fin de la clase

?>
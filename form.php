<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$empresa = $_POST['empresa'];
$texto = $_POST['texto'];

$errors = array();

$ip = $_SERVER['REMOTE-ADDR'];
$captcha = $_POST['g-recaptcha-response'];
$secretkey = "";

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretkey}&response={$captcha}&remoteip={$ip}");
$atribute = json_decode($response, TRUE);

if(isset($_POST['submit'])){

    if($atribute['success']) {

        // Datos de la cuenta de correo utilizada para enviar vía SMTP
        $smtpHost = "";  // Dominio alternativo brindado en el email de alta 
        $smtpUsuario = "";  // Mi cuenta de correo
        $smtpClave = "";  // Mi contraseña
        
        // Email donde se enviaran los datos cargados en el formulario de contacto
        $emailDestino = "";
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Port = 465; 
        $mail->SMTPSecure = 'ssl';
        $mail->IsHTML(true); 
        $mail->CharSet = "utf-8";
        
        // VALORES A MODIFICAR //
        $mail->Host = $smtpHost; 
        $mail->Usernombre = $smtpUsuario; 
        $mail->Password = $smtpClave;
        
        $mail->From = $email; // Email desde donde envío el correo.
        $mail->FromName = $nombre;
        $mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario
        
        $mail->Subject = "Formulario de contacto del sitio web RPA-Works"; // Este es el titulo del email.
        $mail->Body = "De: $nombre <a href='mailto:$email'>$email</a><br />Nombre: $nombre <br /> Teléfono: $telefono<br />Compañía: $empresa<br /> $texto"; // Texto del email en formato HTML
        $mail->AltBody = "De: $nombre <a href='mailto:$email'>$email</a><br />Nombre: $nombre <br /> Teléfono: $telefono<br />Compañía: $empresa<br /> $texto"; // Texto sin formato HTML
        // FIN - VALORES A MODIFICAR //
        
        $estadoEnvio = $mail->Send(); 
        if($estadoEnvio){
            header('Location: http://www.prospectiva.digital/gracias.html');
        } else {
            header('Location: http://www.prospectiva.digital/error.html');
        }
            
    } else {
        echo "<script>
            var respuesta = prompt('Debes completar el captcha para enviar el formulario. ¿Eres un robot?');
            if (respuesta !== null) {
                window.location.href = 'http://www.prospectiva.digital';
            }
        </script>";
    }
}
?>

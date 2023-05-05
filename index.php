<?php
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
        $mail->Fromnombre = $nombre;
        $mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario
        
        $mail->Subject = "Formulario de contacto del sitio web RPA-Works"; // Este es el titulo del email.
        $mail->Body = "De: $nombre <a href='mailto:$email'>$email</a><br />Nombre: $nombre <br /> Teléfono: $telefono<br />Compañía: $empresa<br /> $texto"; // Texto del email en formato HTML
        $mail->AltBody = "De: $nombre <a href='mailto:$email'>$email</a><br />Nombre: $nombre <br /> Teléfono: $telefono<br />Compañía: $empresa<br /> $texto"; // Texto sin formato HTML
        // FIN - VALORES A MODIFICAR //
        
        $estadoEnvio = $mail->Send(); 
        if($estadoEnvio){
            header('Location: gracias.html');
        } else {
            header('Location: error.html');
        }
            
    } else {
        echo "<script>
            var respuesta = prompt('Debes completar el captcha para enviar el formulario. ¿Eres un robot?');
            if (respuesta !== null) {
                window.location.href = 'https://www.rpa-works.com';
            }
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Prospectiva</title>
    <script src="https://kit.fontawesome.com/df53a93159.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <header class="header">
        <div class="header__container">
            <div class="fakeBox"></div>

            <div class="header__logo">
                <a href="index.html"><img class="header__logo--img one" src="assets/Isologo Prospectiva Final-06.png" alt="logo Prospectiva"></a>
                <a href="index.html"><img class="header__logo--img two hidden" src="assets/Isologo Prospectiva Final-02.png" alt="logo Prospectiva"></a>
            </div>
            
            <div class="nav-burguer flex"><div class="bar"></div></div>
        </div>

        <nav class="header__navigation flex bg-violet">
            <ul class="header__navigation--list flex">
                <li><a class="text-white" href="#inicio">Inicio</a></li>
                <li><a class="text-white" href="#quienes-somos">Quiénes somos</a></li>
                <li><a class="text-white" href="#servicios">Servicios</a></li>
                <li><a class="text-white" href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <!-- <a href="" class="wapp"><img src="assets/whatsapp.svg" alt="logo whatsapp"></a> -->

    <main class="wrapper">

        <section id="inicio" class="full-bleed  container">
            <div class="column text-white container__content" id="inicio__content">
                <h1>Generamos oportunidades para <span class="text-violet">tu negocio inmobiliario</span></h1>
                <p class="p1" id="inicio__description">Te ayudamos a conseguir clientes potenciales para que puedas cerrar más transacciones</p>
            </div>
        </section>

        <section id="quienes-somos" class="full-bleed bg-violet container pd">

            <div class="column grid col text-white">
                <div>
                    <h2>Quiénes somos</h2>
                    <p class="p2 text-white">Somos expertos en marketing digital, orientados a la generación de demanda para el sector inmobiliario. Creamos y optimizamos anuncios y campañas publicitarias en línea para que obtengas el mayor retorno de la inversión posible.</p>
                </div>
                <div class="contacto">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="grid col" id="formulario">
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre y Apellido">
                        <input type="text" name="mail" id="mail" placeholder="Mail">
                        <input type="text" name="telefono" id="telefono" placeholder="Teléfono">
                        <input type="text" name="empresa" id="empresa" placeholder="Empresa">
                        <textarea name="texto" id="texto__uno" cols="0" rows="5" placeholder="Escribe tu consulta"></textarea>
                        <!-- <div class="center"> -->
                            <input type="submit" value="Enviar" class="btn">
                        <!-- </div> -->
                    </form>
                </div>
            </div> 

        </section>

        <section id="servicios" class="full-bleed container">

            <div class="full-bleed bg-white grid pd"  id="servicios__box--uno">
                <div class="column container__content grid">
                    <h2>Servicios</h2>
                    <p class="p1 text-black">Contamos con dos planes de publicidad que te permitirán tener un sistema con el cual captar un flujo de personas interesadas en comprar o vender un inmueble. Descubre tu mejor opción:</p>
                    <div class="grid col plans">
                        <div class="flex flex__boxes--servicios">
                            <h2>Plan Silver</h2>
                            <h3 class="p1 text-violet m-0">Publicidad en Facebook<br> e Instagram</h3>
                            <p class="p2 m-0">Creamos y optimizamos anuncios para generar las consultas de tus clientes potenciales y ayudarte a aumentar las ventas a corto plazo.</p>
                            <a href="#contacto" class="btn btn--hire bg-violet silver">Contratar</a>
                        </div>
                        <div class="flex flex__boxes--servicios">
                            <h2>Plan Gold</h2>
                            <h3 class="p1 text-violet m-0">Publicidad en Facebook,<br> Instagram y Google</h3>
                            <p class="p2 m-0">Gestionamos los anuncios en Facebook Ads para atraer clientes potenciales, y nos aseguramos de tu posicionamiento en Google para que las personas interesadas en vender o comprar propiedades te encuentren.</p>
                            <a href="#contacto" class="btn btn--hire bg-violet gold">Contratar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="full-bleed bg-violet grid container pd" id="servicios__box">
                <div class="column container__content text-white flex">
                    <div id="servicios__box--desc">
                        <p class="p3">“Estamos comprometidos en ayudarte a crecer en clientes potenciales <span>y así obtener un retorno de más del 200% de tu inversión”</span></p>
                        <p class="p3 name">Juan Ignacio Nassi</p>
                    </div>
                    <img src="assets/Juani.png" alt="Foto de Juan Ignacio Nassi">
                </div>
            </div>
  
            <div class="full-bleed bg-grey grid pd" id="servicios__box--tres">
                <div class="column container__content">
                    <h2 class="text-violet">Nuestro equipo</h2>
                    <p class="p2">Contamos con un equipo de más de 10 especialistas en Facebook Ads y Google Ads lo que nos permite dar un servicio de calidad y personalizado a nuestros clientes quienes confían en nosotros. Buscamos hacer una diferencia en lo que hacemos. Nos motiva la calidad humana y la búsqueda de poder hacer más, ver hasta dónde podemos llegar.
                    </p>
                </div>
            </div>
           
        </section>

        <section id="contacto" class="full-bleed container bg-lightergrey grid pd">
            <div class="column grid col" >
                <div class="flex flex-align">
                    <h2 class="text-violet container__content" id="contacto__title">Contactate <br>con nosotros</h2>
                </div>
                <div class="contacto">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="grid col" id="form__box">
                        <input type="text" name="nombre" id="" placeholder="Nombre y Apellido">
                        <input type="text" name="email" id="" placeholder="Mail">
                        <input type="text" name="telefono" id="" placeholder="Teléfono">
                        <input type="text" name="empresa" id="" placeholder="Empresa">
                        <textarea name="texto" id="texto__dos" cols="0" rows="5" placeholder="Escribe tu consulta" class="textarea"></textarea>
                        <input type="submit" value="Enviar" class="btn">
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer__container flex">
            <h4 class="text-white">Prospectiva</h4>
            <div class="footer__container--socials">
                <a href="https://www.instagram.com/prospectiva.mkt.inmobiliario/" target="_blank"><i class="fa-brands fa-instagram text-white"></i></a>
                <!-- <a href=""><i class="fa-brands fa-whatsapp text-white" target="_blank"></i></a> -->
                <a href="https://www.linkedin.com/company/prospectiva-marketing-inmobiliario/?viewAsMember=true" target="_blank"><i class="fa-brands fa-linkedin text-white" target="_blank"></i></a>
            </div>
        </div>
        <a href="https://efectodigital.com.ar/" class="efdig-link text-white center" target="_blank">© 2023 Desarrollado por Efecto Digital</a>
    </footer>

    <script src="js/header.js"></script>
    <script src="js/form.js"></script>
</body>
</html>
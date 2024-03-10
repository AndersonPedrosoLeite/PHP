<?php
//identificação para a chamada da classe
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['enviar'])) 
{
	
$nome = $_POST['nome'];

$email = $_POST['email'];

$mensagem = $_POST['mensagem'];

$assunto="Teste de DAW";

$email_resposta = $_POST['email_resposta'];

        require "./PHPMailer/src/PHPMailer.php";
        require "./PHPMailer/src/SMTP.php";
        require "./PHPMailer/src/Exception.php";
        $mail = new PHPMailer();


        $mail->isSMTP();

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->SMTPDebug = 2;
        $mail->SMTPAuth = true;

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->Username = 'dawexemplo2014@gmail.com';
        $mail->Password = 'crelffsizlgmecrr';

        $mail->setFrom('dawexemplo2014@gmail.com','Adm Site');

        $mail->addAddress($email, $nome );

        $mail->CharSet = "utf-8";

        if($email_resposta)
        {
            $mail->addReplyTo($email_resposta);
        }

        $mail->Subject = $assunto;

        $mail->Body = $mensagem;

        $mail->isHTML(true);

        if (!$mail->send()) {
            echo "não funcionou";
        } else {
            echo "funcionou";
        }

}


?>

 <head>

 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 <title>Envio de email pela classe PHPMailer</title>


 </head>

 <body>

<form action="formulario_email.php" method="post" name="frm_contato">

Informe o nome do destinatário: 

<input type="text" name="nome"> <br />

 

Informe o E-mail do destinatário: 

<input type="text" name="email"> <br />


Informe o E-mail para resposta: 

<input type="text" name="email_resposta"> <br />


Escreva uma Mensagem: 

<textarea name="mensagem" rows="5" cols="50"></textarea> <br />



<input type="submit" name="enviar" value="ENVIAR" />

</form>



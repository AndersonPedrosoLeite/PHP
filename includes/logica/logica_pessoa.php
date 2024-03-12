<?php
    require_once('conecta.php');
    require_once('funcoes_pessoa.php');
#CADASTRO PESSOA
    if(isset($_POST['cadastrar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
        $array = array($nome, $email, $cpf, $senha);
        $retorno=inserirPessoa($conexao, $array);
        if(!$retorno)
        {
            $_SESSION['msg']="Erro ao inserir";
        }
        header('location:../../index.php');
    }
#ENTRAR
    if(isset($_POST['entrar'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $array = array($email, $senha);
        $pessoa = acessarPessoa($conexao,$array);
        if($pessoa){
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['codpessoa'] = $pessoa['codpessoa'];
            $_SESSION['nome'] = $pessoa['nome'];
            $data = date("m-d-Y");  
            $hora = date("H:i:s");
$mensagem = "O usuário {$pessoa['nome']} logou no sistema em:
                <br> Data: $data
                <br> Hora: $hora";
            echo $mensagem;
          header('location:../../index.php');
        }
        else{
            session_start();
            $_SESSION['msg']="Usuário ou senha inválidos";
            header('location:../../login.php');
        }
    }

#SAIR
    if(isset($_POST['sair'])){
            session_start();
            session_destroy();
            header('location:../../login.php');
    }

#EDITAR PESSOA
    if(isset($_POST['editar'])){
    
            $codpessoa = $_POST['editar'];
            $array = array($codpessoa);
            $pessoa=buscarPessoa($conexao, $array);
            require_once('../../alterarPessoa.php');
    }    
#ALTERAR PESSOA
    if(isset($_POST['alterar'])){
    
            $codpessoa = $_POST['codpessoa'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            $senha = $_POST['senha'];    
            $array = array($nome, $email, $cpf, $senha, $codpessoa);
            alterarPessoa($conexao, $array);
    
            header('location:../../index.php');
    }
#DELETAR PESSOA
    if(isset($_POST['deletar'])){
        $codpessoa = $_POST['deletar'];
        $array=array($codpessoa);
        deletarPessoa($conexao, $array);

        header('Location:../../index.php');
    }

#PESQUISAR PESSOA
    if(isset($_POST['pesquisar'])){
        $nome = $_POST['nome'];
        $array=array("%".$nome."%");
        $pessoas=pesquisarPessoa($conexao, $array);
        require_once('../../mostrarPessoa.php');
    }
#ALTERAR PERFIL
    if(isset($_POST['alterarPerfil'])){
    
            $codpessoa = $_POST['codpessoa'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            $senha = $_POST['senha'];    
            $array = array($nome, $email, $cpf, $senha, $codpessoa);
            alterarPessoaPerfil($conexao, $array);

            header('location:../../alterarPerfil.php');
    }
#ENVIAR EMAIL
//identificação para a chamada da classe
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['ENVIAR'])) 
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
            echo "Email promocional enviado";
        }
        $array = array($nome, $email,$mensagem, $assunto, $email_resposta,$mail);
        enviarPromocao($conexao, $array);
        header('Location:../../index.php');
}
?>
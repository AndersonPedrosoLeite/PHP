<!DOCTYPE html>
<html>
<?php
 include_once('includes/componentes/cabecalho.php');
 include_once('includes/componentes/header.php');
 include_once('includes/logica/funcoes_pessoa.php');
 include_once('includes/logica/conecta.php');
 $codpessoa = $_SESSION['codpessoa'];
 $array = array($codpessoa);
 $pessoa=buscarPessoa($conexao, $array);
?>
    <title>Alterar Perfil</title>
</head>
<body>

<main>
    <section>
    <form action="includes/logica/logica_pessoa.php" method="post">
      <p><label for="nome">Nome: </label><input type="text" name="nome" id="nome" value="<?php echo $pessoa['nome']; ?>"></p>
      <p><label for="email">Email: </label><input type="text" name="email" id="email" value="<?php echo $pessoa['email']; ?>"></p>
      <p><label for="cpf">CPF: </label><input type="text" name="cpf" id="cpf" value="<?php echo $pessoa['cpf']; ?>"></p>
      <p><label for="senha">Senha: </label><input type="password" name="senha" id="senha" value="<?php echo $pessoa['senha']; ?>"></p>
      <input type="hidden" id='codpessoa' name='codpessoa' value="<?php echo $pessoa['codpessoa']; ?>">
      <p> <input type="submit" id='alterarPerfil' name='alterarPerfil' value="Alterar">
      </p>        
        </form>

    </section>
</main>
<?php require('includes/componentes/footer.php');?>
</body>
</html>
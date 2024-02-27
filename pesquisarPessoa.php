<?php
 include_once('includes/componentes/cabecalho.php');
?>
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
<?php require('includes/componentes/header.php') ?>
<main>
    <section>
    <form action="includes/logica/logica_pessoa.php" method="post">
      <p><label for="nome">Pesquisa por nome: </label><input type="text" name="nome" id="nome"></p>
      <p><button type="submit" id='pesquisar' name='pesquisar' value="Pesquisar"> Pesquisar </button>  </p>      
    </form>
    </section>
</main>
<?php require('includes/componentes/footer.php');?>
</body>
</html>
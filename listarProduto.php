<!DOCTYPE html>
<html>

<?php
include_once('includes/componentes/cabecalho.php');
include_once('includes/componentes/header.php');
include_once('includes/logica/funcoes_produto.php');
include_once('includes/logica/conecta.php');
?>
   <title>Listar Usuário</title>
</head>
<body>  
<body>
<main>
         <h2> Usuário Logado:  <?php echo $_SESSION['nome']; ?>  </h2>
         <h3> Listagem de Produtos </h3>
    <?php
        $produtos = listarProduto($conexao);
        if(empty($produtos)){
            ?>
                <section>
                    <p>Não há produtos cadastrados.</p>
                </section>
            <?php
        }
        foreach($produtos as $produto){
                 
            ?>
                <section>
                    <p>Nome: <?php echo $produto['nome']; ?></p>
                    <p>Descrição <?php echo $produto['descricao']; ?></p>
                    <p>Quantidade: <?php echo $produto['quantidade']; ?></p>
                    <p>Imagem: <img src="imagens/<?php echo $produto['imagem'];?>" width='100px' height='100px'/></p>
                    
                    <form action="includes/logica/logica_produto.php" method="post">
                        <button type="submit" name="editar" value="<?php echo $produto['codproduto']; ?>"> Editar </button>
                        <button type="submit" name="deletar" value="<?php echo $pessoa['codproduto']; ?>" onclick = "return confirma_excluir()"> Deletar </button> 
                    </form>
                    <br><br>                                                          
                </section>
            <?php
        }
    ?>
</main>
<?php require('includes/componentes/footer.php');?>
</body>
<script type="text/javascript">
    function confirma_excluir()
    {
        resp=confirm("Confirma Exclusão?")

        if (resp==true)
        {

            return true;
        }
        else
        {
            return false;

        }

    }

</script>
<div id='msg'>
<?php
if(isset($_SESSION['msg']))
{
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
}
?>
</div>
</html>
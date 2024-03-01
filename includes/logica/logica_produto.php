<?php
    require_once('conecta.php');
    require_once('funcoes_produto.php');
#CADASTRO PRODUTO
    if(isset($_POST['cadastrar'])){
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $array = array($nome, $descricao, $quantidade);
        $retorno=inserirProduto($conexao, $array);
        if(!$retorno)
        {
            $_SESSION['msg']="Erro ao inserir";
        }
        header('location:../../index.php');
    }
    #PESQUISAR PRODUTO
    if(isset($_POST['pesquisar'])){
        $nome = $_POST['nome'];
        $array=array("%".$nome."%");
        $produtos=pesquisarProduto($conexao, $array);
        require_once('../../mostrarProduto.php');
    }
    #DELETAR PRODUTO
    if(isset($_POST['deletar'])){
        $codproduto = $_POST['deletar'];
        $array=array($codproduto);
        deletarProduto($conexao, $array);

        header('Location:../../mostrarProduto.php');
    }
    ?>
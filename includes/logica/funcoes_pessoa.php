<?php

function inserirPessoa($conexao, $array)
{
    try {
        $query = $conexao->prepare("insert into pessoa (nome, email, cpf, senha) values (?, ?, ?, ?)");

        $resultado = $query->execute($array);

        return $resultado;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

}


function alterarPessoa($conexao, $array)
{
    try {
        $query = $conexao->prepare("update pessoa set nome= ?, email = ?, cpf= ?, senha= ? where codpessoa = ?");
        $resultado = $query->execute($array);
        return $resultado;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function alterarPessoaPerfil($conexao, $array)
{
    try {
        session_start();
        $query = $conexao->prepare("update pessoa set nome= ?, email = ?, cpf= ?, senha= ? where codpessoa = ?");
        $resultado = $query->execute($array);
        $_SESSION['nome'] = $array[0];
        return $resultado;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



function deletarPessoa($conexao, $array)
{
    try {
        $query = $conexao->prepare("delete from pessoa where codpessoa = ?");
        $resultado = $query->execute($array);
        return $resultado;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

}

function listarPessoa($conexao)
{
    try {
        $query = $conexao->prepare("SELECT * FROM pessoa");
        $query->execute();
        $pessoas = $query->fetchAll();
        return $pessoas;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

}

function buscarPessoa($conexao, $array)
{
    try {
        $query = $conexao->prepare("select * from pessoa where codpessoa=?");
        if ($query->execute($array)) {
            $pessoa = $query->fetch(); //coloca os dados num array $usuario
            return $pessoa;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function acessarPessoa($conexao, $array)
{
    try {
        $query = $conexao->prepare("select * from pessoa where email=? and status=true");
        if ($query->execute($array)) {
            $pessoa = $query->fetch(); //coloca os dados num array $pessoa
            if(password_verify($senha, $pessoa['senha']))
            {  
                return $pessoa;
            }
             else {
                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function pesquisarPessoa($conexao, $array)
{
    try {
        $query = $conexao->prepare("select * from pessoa where nome like ?");
        if ($query->execute($array)) {
            $pessoas = $query->fetchAll(); //coloca os dados num array $pessoa
            if ($pessoas) {
                return $pessoas;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
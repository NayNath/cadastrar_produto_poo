<?php
require_once "conexao.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];
    if(!empty($nome)){
        $sql = "INSERT INTO produtos(nome,preco,quantidade,descricao)
                VALUES(:nome,:preco,:quantidade,:descricao)";
    
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":nome",$nome);
        $stmt->bindParam(":preco",$preco);
        $stmt->bindParam(":quantidade",$quantidade);
        $stmt->bindParam(":descricao",$descricao);

        if($stmt->execute()){
            $mensagem = "Produto cadastrado";
        }
        else{
            $mensagem = "O campo nome é obrigatorio";
        }
    }
    $sql = "SELECT*FROM produtos ORDER BY nome";
    $stmt = $pdo->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produtos</title>
    <link rel="stylesheet" href="./estilo.css">
</head>
<body>
    <form action="" method="post">
        <h2>Cadastrar Produtos</h2>

        <label for="nome"> NOME:</label>
        <input type="text" name="nome"><br>

        <label for="preco">PREÇO:</label>
        <input type="text" name="preco"><br>

        <label for="quantidade">QUANTIDADE:</label>
        <input type="number" name="quantidade"><br>

        <label for="descricao">DESCRIÇÃO:</label>
        <input type="text" name="descricao"><br>

        <button type="submit">Enviar</button>
    </form>
    <?php if (isset($mensagem)) { ?>
        <div class="mensagem"><?= $mensagem ?></div>
    <?php } ?>
 
    <?php
    if(!empty($produtos)){?>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($produtos as $produto){?>
                        <tr>
                            <td><?=htmlspecialchars($produto['id'])?></td>
                            <td><?=htmlspecialchars($produto['nome'])?></td>
                            <td><?=htmlspecialchars($produto['preco'])?></td>
                            <td><?=htmlspecialchars($produto['quantidade'])?></td>
                            <td><?=htmlspecialchars($produto['descricao'])?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>


</body>
</html>
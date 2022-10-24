<?php
    include("banco.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testando PHP</title>

    <style>
        * {
            font-family: 'Consolas Mono', sans-serif;
        }

        h1 {
            color: lightblue;
            font-weight: bold;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            justify-content: center;
            align-items: center;
            align-content: center;
            background: linear-gradient(to bottom, blue, darkblue) no-repeat;
        }

        .resultados{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            gap: 10px;
            background: lightblue;
            color: black;
            border: 2px white solid;
            border-radius: 40px;
            padding: 30px;
        }
        .pesquisa {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        tr, th, td {
            border: 2px darkblue solid;
            border-radius: 10px;
            background: white;
            text-align: center;
        }

        input {
            border-radius: 15px;
            background: white;
            transition: all .2s;
            width: 450px;
            border: 2px darkblue solid;
            font-size: 22px;
            padding: 4px 15px;
            margin-right: 20px
        }

        input:focus {
            border: 2px darkblue solid;
            transform: scale(1.1)
        }

        button {
            border-radius: 15px;
            transition: all .2s;
            font-size: 22px;
            padding: 3px 10px;
        }

        button:hover {
            transform: scale(1.1)
        }

        button:active {
            transform: scale(0.7)
        }
    </style>

</head>
<body>
    <h1>Lista de Clientes</h1>
    <div class="resultados">
        <div class="pesquisa">
            <form action="">
                <input type="text" name="busca" placeholder="Digite o que deseja pesquisar!">
                <button type="submit">Pesquisar</button>
            </form>
        </div>
        <table width="750px">
            <tr>
                <th>
                    Nome
                </th>
                <th>
                    Telefone
                </th>
                <th>
                    CPF
                </th>
            </tr>
            <?php
            if (!isset($_GET['busca'])) {
                ?>    
                <td colspan="3">
                    Digite algo para pesquisar
                </td>
            <?php } else {
                $quantidade = 0;
                $pesquisa = $mysqli->real_escape_string($_GET["busca"]);
                $sql_code = "SELECT * FROM clientes where nome like '%$pesquisa%' or telefone like '%$pesquisa%' or CPF like '%$pesquisa%' order by nome" ;
                $sql_query = $mysqli->query($sql_code) or die("ERRO aou consultar: $mysqli->error");

                if ($sql_query->num_rows == 0) { ?>
                
                    <td colspan='3'>
                        Não foram encontrados resultados!
                    </td>
                
                <?php } else {

                    while($dados = $sql_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $dados['Nome']; ?></td>
                        <td><?php echo $dados['Telefone']; ?></td>
                        <td><?php echo $dados['CPF']; ?></td>
                    </tr>
            <?php $quantidade++; } ?>
            <?php } ?>
        <?php } ?>
        </table>
        <?php echo "$quantidade resultados encontrados"; ?>
    </div>
</body>
</html>
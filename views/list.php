<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/list.css">
    <title>Listar Usuários</title>
</head>

<body>

    <div class="container-btn">
        <button class='btn btn-primary btn-sm' id="btn-to" onclick="window.history.back();">Voltar</button>
    </div>

    <div class="container mt-5">
        <h1 class="mb-4">Listar Usuários</h1>

        <?php
        require '../config/conexao.php';

        $sql = "SELECT * FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($usuarios) > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead>";
            echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Profissão</th><th>Cidade</th><th>Estado</th>
            <th>Data Nascimento</th><th>Ações</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach ($usuarios as $usuario) {
                $dtnasc = new DateTime($usuario['dtnasc']);
                $formattedDate = $dtnasc->format('d/m/Y');
                echo "<tr>";
                echo "<td>" . $usuario['id'] . "</td>";
                echo "<td>" . $usuario['nome'] . "</td>";
                echo "<td>" . $usuario['email'] . "</td>";
                echo "<td>" . $usuario['profissao'] . "</td>";
                echo "<td>" . $usuario['cidade'] . "</td>";
                echo "<td>" . $usuario['uf'] . "</td>";
                echo "<td>" . $formattedDate . "</td>"; 


                echo "<td>
                    <a href='../controllers/visualizar.php?id=" . $usuario['id'] . "' class='btn btn-primary btn-sm'>Visualizar</a>
                    <a href='../controllers/editar.php?id=" . $usuario['id'] . "' class='btn btn-warning btn-sm'>Editar</a>
                    <a href='../controllers/apagar.php?id=" . $usuario['id'] . "' class='btn btn-danger btn-sm'>Apagar</a>
                  </td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo '<br>';
            echo "<p class='alert alert-warning'>Nenhum usuário encontrado.</p>";
        }
        ?>
    </div>

</body>

</html>
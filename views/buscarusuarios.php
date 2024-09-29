<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/buscaruser.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>Buscar Usuários</title>
</head>

<body>

    <div class="container-btn">
        <button onclick="window.history.back();">Voltar</button>
    </div>

    <div class="container mt-5">
        <h1 class="mb-4">Buscar Usuários</h1>

        <div class="input-container">
            <input type="text" id="searchInput" placeholder="Pesquisar usuários...">
            <button onclick="searchUser()">Buscar</button>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="resultContainer">
                </div>
            </div>
        </div>



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
            <th>Data Nascimento</th></tr>";
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
                echo "<td>" . $formattedDate . "</td>"; // Exibe a data formatada
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



    <script src="../js/custom.js"></script>

</body>

</html>
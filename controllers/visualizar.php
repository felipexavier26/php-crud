<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Usuário</title>
    <link rel="stylesheet" href="../assets/visualizar.css"> 
</head>

<body>
    <div class="container-btn">
        <button class='btn btn-primary btn-sm' id="btn-to" onclick="window.history.back();">Voltar</button> <!-- Botão Voltar -->
    </div>

    <div class="container">
        <?php
        require '../config/conexao.php';

        if (!isset($_GET['id'])) {
            die("<p class='error'>ID do usuário não foi fornecido.</p>");
        }

        $id = intval($_GET['id']);

        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {

            $dtnasc = new DateTime($usuario['dtnasc']);
            $formattedDate = $dtnasc->format('d/m/Y');
            
            echo "<h2>Detalhes do Usuário</h2>";
            echo "<p><strong>Nome:</strong> " . htmlspecialchars($usuario['nome']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($usuario['email']) . "</p>";
            echo "<p><strong>Profissão:</strong> " . htmlspecialchars($usuario['profissao']) . "</p>";
            echo "<p><strong>Cidade:</strong> " . htmlspecialchars($usuario['cidade']) . "</p>";
            echo "<p><strong>Estado:</strong> " . htmlspecialchars($usuario['uf']) . "</p>";
            echo "<p><strong>Data nascimento:</strong> " . htmlspecialchars($formattedDate) . "</p>";

        } else {
            echo "<p class='error'>Usuário não encontrado!</p>";
        }
        ?>
    </div>
</body>

</html>
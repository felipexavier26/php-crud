<?php
require '../config/conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (empty($nome) || empty($email)) {
        die("Todos os campos são obrigatórios.");
    }

    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar.";
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/cad-form.css">
    <title>Cadastrar usuarios</title>
</head>

<body>
    <div class="container-btn">
        <button onclick="window.history.back();">Voltar</button>
    </div>

    <div class="form-container">
        <form method="POST" action="cadastrar.php" id="form-container">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required placeholder="Nome:"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="E-mail"><br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>

</html>
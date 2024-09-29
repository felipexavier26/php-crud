<?php
require '../config/conexao.php';

if (!isset($_GET['id'])) {
    die("ID não fornecido.");
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura dos novos campos
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $profissao = $_POST['profissao'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $dtnasc = $_POST['dtnasc'];

    if (empty($nome) || empty($email) || empty($profissao) || empty($cidade) || empty($uf) || empty($dtnasc)) {
        die("Todos os campos são obrigatórios.");
    }

    try {
        // Atualiza a query para incluir os novos campos
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, profissao = :profissao, cidade = :cidade, uf = :uf, dtnasc = :dtnasc WHERE id = :id";
        $stmt = $conn->prepare($sql);

        // Vincula os novos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profissao', $profissao);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':uf', $uf);
        $stmt->bindParam(':dtnasc', $dtnasc);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>
                alert('Dados atualizados com sucesso!');
                window.location.href = 'http://localhost/crud/views/list.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao atualizar.');
            </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
            alert('Erro ao atualizar: " . addslashes($e->getMessage()) . "');
        </script>";
    }

    exit;
}

$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}
$dtnasc = new DateTime($usuario['dtnasc']);
$formattedDate = $dtnasc->format('d/m/Y');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/edit-form.css">
    <title>Editar Usuários</title>
</head>

<body>
    <div class="container-btn">
        <button class='btn' id="btn-to" onclick="window.history.back();">Voltar</button> <!-- Botão Voltar -->
    </div>

    <div class="form-container">
        <form method="POST" id="form" action="editar.php?id=<?= $id ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

            <label for="profissao">Profissão:</label>
            <input type="text" id="profissao" name="profissao" value="<?= htmlspecialchars($usuario['profissao']) ?>" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($usuario['cidade']) ?>" required>

            <label for="uf">UF:</label>
            <input type="text" id="uf" name="uf" value="<?= htmlspecialchars($usuario['uf']) ?>" required>

            <label for="dtnasc">Data de Nascimento:</label>
            <input type="text" id="dtnasc" name="dtnasc" value="<?= htmlspecialchars($formattedDate) ?>" required readonly>

            <button type="submit">Salvar</button>
        </form>
    </div>

</body>

</html>
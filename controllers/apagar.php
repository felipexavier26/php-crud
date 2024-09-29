<?php
require '../config/conexao.php';

if (!isset($_GET['id'])) {
    die("ID não fornecido.");
}

$id = intval($_GET['id']); 

try {
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Usuário apagado com sucesso!";
    } else {
        echo "Erro ao apagar.";
    }
} catch (PDOException $e) {
    echo "Erro ao apagar: " . $e->getMessage();
}

?>

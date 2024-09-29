<?php
require '../config/conexao.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM usuarios WHERE nome LIKE :search OR email LIKE :search";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($usuarios) > 0) {
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Profissão</th><th>Cidade</th><th>Estado</th>
        <th>Data Nascimento</th></tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($usuarios as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario['id'] . "</td>";
            echo "<td>" . $usuario['nome'] . "</td>";
            echo "<td>" . $usuario['email'] . "</td>";
            echo "<td>" . $usuario['profissao'] . "</td>";
            echo "<td>" . $usuario['cidade'] . "</td>";
            echo "<td>" . $usuario['uf'] . "</td>";
            echo "<td>" . $usuario['dtnasc'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Nenhum usuário encontrado.</p>";
    }
} else {
    echo "<p>Erro: Nenhuma pesquisa foi enviada.</p>";
}

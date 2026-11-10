<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de PDO com SQLite</title>
</head>
<body>
    <h1>Exemplo de PDO com SQLite</h1>

    <?php
    try {
        $conexao = new PDO('sqlite::memory:');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conexao->exec(
            'CREATE TABLE alunos (
                id INTEGER PRIMARY KEY,
                nome TEXT NOT NULL,
                nota_p1 REAL NOT NULL,
                nota_p2 REAL NOT NULL
            )'
        );

        $inserir = $conexao->prepare(
            'INSERT INTO alunos (nome, nota_p1, nota_p2) VALUES (:nome, :nota_p1, :nota_p2)'
        );
        $inserir->execute(['nome' => 'João', 'nota_p1' => 8.7, 'nota_p2' => 9.4]);
        $inserir->execute(['nome' => 'Maria', 'nota_p1' => 9.2, 'nota_p2' => 8.9]);
        $inserir->execute(['nome' => 'Luis', 'nota_p1' => 7.8, 'nota_p2' => 8.4]);
        $inserir->execute(['nome' => 'Fernanda', 'nota_p1' => 8.7, 'nota_p2' => 9.1]);

        $alunos = $conexao->query(
            'SELECT nome, nota_p1, nota_p2 FROM alunos ORDER BY id'
        );
        ?>
        <p>Conexão realizada e dados consultados com sucesso.</p>
        <table border="1" cellpadding="6">
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Nota P1</th>
                    <th>Nota P2</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?= htmlspecialchars($aluno['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars((string) $aluno['nota_p1'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars((string) $aluno['nota_p2'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    } catch (PDOException $erro) {
        http_response_code(500);
        echo '<p>Erro ao acessar o banco de dados: '
            . htmlspecialchars($erro->getMessage(), ENT_QUOTES, 'UTF-8')
            . '</p>';
    }
    ?>
</body>
</html>

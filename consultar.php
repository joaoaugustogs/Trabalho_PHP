<?php
$file = 'doadores.json';
$doadores = [];

if (file_exists($file)) {
    $doadores = json_decode(file_get_contents($file), true);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Doadores</title>
  <link rel="stylesheet" href="style.css">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #fff;
    color: #333;
    margin: 0;
    padding: 0;
  }

  table {
    width: 90%;
    margin: 30px auto;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  th, td {
    padding: 12px;
    border: 1px solid #ccc;
    text-align: left;
    color: #333; /* <-- Força a cor do texto a ser visível */
  }

  th {
    background-color: #cc0000;
    color: white;
  }

  h2 {
    text-align: center;
    margin-top: 30px;
    color: #cc0000;
  }

  a {
    display: block;
    text-align: center;
    margin: 20px;
    color: #cc0000;
    text-decoration: none;
    font-weight: bold;
  }

  a:hover {
    text-decoration: underline;
  }
</style>

</head>
<body>
  <h2>Lista de Doadores</h2>
  <a href="index.php">← Voltar</a>
  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>Data de Nascimento</th>
        <th>Tipo Sanguíneo</th>
        <th>Data do Registro</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($doadores)): ?>
        <?php foreach ($doadores as $doador): ?>
          <tr>
            <td><?= htmlspecialchars($doador['nome']) ?></td>
            <td><?= htmlspecialchars($doador['cpf']) ?></td>
            <td><?= htmlspecialchars($doador['data']) ?></td>
            <td><?= htmlspecialchars($doador['tipo']) ?></td>
            <td><?= htmlspecialchars($doador['data_envio']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5">Nenhum doador cadastrado ainda.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>

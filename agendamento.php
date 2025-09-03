<?php
$file = 'doadores.json';
$agendamentosFile = 'agendamentos.json';

$cpf = $_GET['cpf'] ?? null;
$doador = null;

// Busca o doador pelo CPF
if ($cpf && file_exists($file)) {
    $doadores = json_decode(file_get_contents($file), true);
    foreach ($doadores as $d) {
        if ($d['cpf'] === $cpf) {
            $doador = $d;
            break;
        }
    }
}

// Se enviou o agendamento
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cpf = $_POST['cpf'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $agendamento = [
        'cpf' => $cpf,
        'data' => $data,
        'hora' => $hora,
        'criado_em' => date("Y-m-d H:i:s")
    ];

    if (file_exists($agendamentosFile)) {
        $agendamentos = json_decode(file_get_contents($agendamentosFile), true);
    } else {
        $agendamentos = [];
    }

    $agendamentos[] = $agendamento;
    file_put_contents($agendamentosFile, json_encode($agendamentos, JSON_PRETTY_PRINT));

    echo "<h2 style='text-align:center;color:green;'>✅ Agendamento realizado com sucesso!</h2>";
    echo "<p style='text-align:center;'><a href='index.php'>Voltar à página inicial</a></p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Agendamento de Doação</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="modal active">
    <div class="modal-content">
      <h3>Agendamento de Doação</h3>
      <?php if ($doador): ?>
        <p>Olá <strong><?= htmlspecialchars($doador['nome']) ?></strong>, escolha uma data e horário disponíveis:</p>
        <form method="POST" action="agendamento.php">
          <input type="hidden" name="cpf" value="<?= htmlspecialchars($doador['cpf']) ?>">

          <div class="form-group">
            <label for="data">Data</label>
            <input type="date" id="data" name="data" required>
          </div>

          <div class="form-group">
            <label for="hora">Horário</label>
            <select id="hora" name="hora" required>
              <option value="">Selecione...</option>
              <option>08:00</option>
              <option>09:00</option>
              <option>10:00</option>
              <option>11:00</option>
              <option>14:00</option>
              <option>15:00</option>
              <option>16:00</option>
            </select>
          </div>

          <button type="submit" class="submit-btn">Agendar</button>
        </form>
      <?php else: ?>
        <p style="color:red;">Doador não encontrado.</p>
        <a href="index.php">← Voltar</a>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>

<?php
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$t] != $d) {
            return false;
        }
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $data = htmlspecialchars($_POST['data']);
    $tipo = htmlspecialchars($_POST['tipo']);
    $data_agendamento = htmlspecialchars($_POST['data_agendamento']);
    $hora_agendamento = htmlspecialchars($_POST['hora_agendamento']);

    if (!validarCPF($cpf)) {
        echo "<h2>CPF inválido. Tente novamente.</h2>";
        echo "<a href='doar.php'>Voltar</a>";
        exit;
    }

    $dados = [
        'nome' => $nome,
        'cpf' => $cpf,
        'data' => $data,
        'tipo' => $tipo,
        'data_agendamento' => $data_agendamento,
        'hora_agendamento' => $hora_agendamento,
        'data_envio' => date("Y-m-d H:i:s")
    ];

    $file = 'doadores.json';
    if (file_exists($file)) {
        $doadores = json_decode(file_get_contents($file), true);
    } else {
        $doadores = [];
    }

    $doadores[] = $dados;
    file_put_contents($file, json_encode($doadores, JSON_PRETTY_PRINT));

    echo "<h2>Obrigado, $nome! Sua doação foi registrada para o dia $data_agendamento às $hora_agendamento.</h2>";
    echo "<a href='index.php'>Voltar</a>";
    exit;
}
?>

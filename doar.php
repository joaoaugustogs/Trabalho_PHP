<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Formulário de Doação</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
    <div class="modal active">
      <div class="modal-content">
        <h3>Cadastro de Doação</h3>
        <form method="POST" action="formulario.php" id="doacaoForm">
          <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome" required>
          </div>
          <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" maxlength="14" required placeholder="000.000.000-00">
          </div>
          <div class="form-group">
            <label for="data">Data de Nascimento</label>
            <input type="date" id="data" name="data" required>
          </div>
          <div class="form-group">
            <label for="tipo">Tipo Sanguíneo</label>
            <select id="tipo" name="tipo" required>
              <option value="">Selecione...</option>
              <option>A+</option><option>A-</option>
              <option>B+</option><option>B-</option>
              <option>AB+</option><option>AB-</option>
              <option>O+</option><option>O-</option>
            </select>
          </div>
          <button type="submit" class="submit-btn">Enviar</button>
        </form>
        <a href="index.php" style="display:block;text-align:center;margin-top:15px;">← Voltar</a>
      </div>
    </div>
  </main>

  <script>
    // Máscara de CPF
    const cpfInput = document.getElementById('cpf');
    cpfInput.addEventListener('input', () => {
      let value = cpfInput.value.replace(/\D/g, '');
      if (value.length > 11) value = value.slice(0, 11);

      if (value.length > 9) {
        cpfInput.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, "$1.$2.$3-$4");
      } else if (value.length > 6) {
        cpfInput.value = value.replace(/(\d{3})(\d{3})(\d{0,3})/, "$1.$2.$3");
      } else if (value.length > 3) {
        cpfInput.value = value.replace(/(\d{3})(\d{0,3})/, "$1.$2");
      } else {
        cpfInput.value = value;
      }
    });

    // Validação de CPF no frontend
    function validarCPF(cpf) {
      cpf = cpf.replace(/\D/g, '');
      if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

      let soma = 0, resto;
      for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i-1, i)) * (11 - i);
      resto = (soma * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
      if (resto !== parseInt(cpf.substring(9, 10))) return false;

      soma = 0;
      for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i-1, i)) * (12 - i);
      resto = (soma * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
      if (resto !== parseInt(cpf.substring(10, 11))) return false;

      return true;
    }

    document.getElementById('doacaoForm').addEventListener('submit', function(e) {
      if (!validarCPF(cpfInput.value)) {
        e.preventDefault();
        alert("CPF inválido, verifique e tente novamente.");
      }
    });
  </script>
</body>
</html>

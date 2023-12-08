<?php require_once "functions.php"; ?>
Pagina de contato - HTML

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulário de Contato</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <h1>Formulário de Contato</h1>
  <?php insertUser($connect); ?>
  <form action="https://formsubmit.co/your@email.com" method="POST" class="form">
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" required />
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" required />
    <label for="mensagem">Mensagem</label>
    <textarea name="mensagem" id="mensagem" required></textarea>
    <input type="hidden" name="_captcha" value="false" />
    <input type="hidden" name="_next" value="https://yourdomain.co/thanks.html" />
    <button type="submit" name="submit">Enviar</button>
  </form>
</body>

</html>
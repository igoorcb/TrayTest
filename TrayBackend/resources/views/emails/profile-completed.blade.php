<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Cadastro Concluído</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 2rem;">
  <div
    style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);">
    <h2 style="color: #2d6cdf;">Olá, {{ $user->name }}!</h2>
    <p style="font-size: 16px; color: #333;">Seu cadastro foi <strong>finalizado com sucesso</strong>!</p>
    <p style="font-size: 16px; color: #333;">Estamos felizes em ter você no sistema da Tray 😊</p>
    <hr style="margin: 2rem 0;">
    <p style="font-size: 14px; color: #777;">Se você não reconhece esse cadastro, ignore este e-mail.</p>
  </div>
</body>

</html>
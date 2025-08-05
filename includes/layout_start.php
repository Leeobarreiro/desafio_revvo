<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Desafio Revvo</title>
  <link rel="stylesheet" href="../css/style.css">
  <script defer src="../js/modal.js"></script>
  <script defer src="../js/carousel.js"></script>
</head>
<body>
  <!-- Modal de primeiro acesso -->
  <div id="meuModal" style="display:none; position:fixed; top:0; left:0; background:rgba(0,0,0,0.8); width:100%; height:100%; z-index:10;">
    <div style="margin:10% auto; padding:20px; background:#fff; width:300px; position:relative;">
      <p>Seja bem-vindo! Esse é o seu primeiro acesso.</p>
      <button id="fecharModal">Fechar</button>
    </div>
  </div>

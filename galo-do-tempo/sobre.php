<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sobre — Galo do Tempo</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet"><link rel="stylesheet" href="assets/styles.css">
</head>
<body class="about-page theme-dry"><div class="grain"></div>
  <header class="site-header container"><a class="brand" href="index.php"><span>Galo do <strong>Tempo</strong></span></a><nav class="desktop-nav"><a href="index.php">Hoje</a><a href="index.php#como-funciona">Como funciona</a><a class="active" href="sobre.php">Sobre o site</a></nav><button class="menu-button" aria-label="Abrir menu" data-menu-toggle><span></span><span></span></button></header>
  <nav class="mobile-nav" data-mobile-nav><a href="index.php">Hoje</a><a href="index.php#como-funciona">Como funciona</a><a href="sobre.php">Sobre o site</a></nav>
  <main class="about-main container"><p class="eyebrow"><span class="status-dot"></span> Um projeto sobre observar</p><h1>Menos números.<br><em>Mais sensação.</em></h1><div class="about-grid"><div class="about-lead"><p>O Galo do Tempo nasceu para transformar a previsão em um pequeno ritual visual. Em vez de abrir uma lista complicada, você olha para a cor do galo e entende como o dia está se comportando.</p><p>A leitura atual vem do sensor DHT11, enviado pelo ESP32 ao ThingSpeak. O site consulta temperatura e umidade, mas é a umidade que define a cor do galo automaticamente.</p><a class="text-link" href="index.php">Voltar para a previsão <span>↗</span></a></div><div class="principles"><article><span>01</span><h2>Seco</h2><p>De 0% a 39%, o galo fica azul: ar seco e tempo mais estável.</p></article><article><span>02</span><h2>Moderado</h2><p>De 40% a 69%, o galo fica roxo: umidade moderada e mudança nas condições.</p></article><article><span>03</span><h2>Muito úmido</h2><p>De 70% a 100%, o galo fica rosa: ar muito úmido e possibilidade de chuva.</p></article></div></div></main>
  <footer class="site-footer container"><span>Galo do Tempo © <?php echo date('Y'); ?></span><a href="index.php">Ver o clima de hoje →</a></footer><script src="assets/app.js"></script>
</body></html>

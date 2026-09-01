<?php
require __DIR__ . '/includes/weather.php';
$weather = getWeatherData();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galo do Tempo — <?php echo e($weather['label']); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="weather-page theme-<?php echo e($weather['theme']); ?>">
  <div class="grain"></div>
  <header class="site-header container">
    <a class="brand" href="index.php"><span>Galo do <strong>Tempo</strong></span></a>
    <nav class="desktop-nav" aria-label="Navegação principal">
      <a class="active" href="index.php">Hoje</a>
      <a href="#como-funciona">Como funciona</a>
      <a href="sobre.php">Sobre o site</a>
    </nav>
    <button class="menu-button" aria-label="Abrir menu" data-menu-toggle><span></span><span></span></button>
  </header>
  <nav class="mobile-nav" data-mobile-nav><a href="index.php">Hoje</a><a href="#como-funciona">Como funciona</a><a href="sobre.php">Sobre o site</a></nav>

  <main>
    <section class="hero container">
      <div class="hero-copy">
        <p class="location">⌖ <?php echo e($weather['location']); ?></p>
        <h1>O tempo muda.<br><em>O galo avisa.</em></h1>
        <p class="intro">Uma leitura simples, visual e cheia de personalidade para entender o clima da sua cidade de primeira.</p>
        <div class="temperature-row"><span class="temperature"><?php echo e($weather['temperature']); ?><sup>°C</sup></span><div class="temperature-meta"><strong><?php echo e($weather['label']); ?></strong><span>Sensação térmica <?php echo e($weather['feels_like']); ?>°C</span></div></div>
        <div class="weather-pills"><span>Umidade <strong><?php echo e($weather['humidity']); ?>%</strong></span></div>
      </div>

      <div class="rooster-stage" aria-label="Galo do tempo na cor <?php echo e($weather['label']); ?>">
        <div class="sun-orb"></div><div class="cloud cloud-one"></div><div class="cloud cloud-two"></div><div class="rooster-shadow"></div>
        <svg class="rooster" viewBox="0 0 420 520" role="img" aria-label="Ilustração de um galo do tempo">
          <ellipse class="tail" cx="112" cy="284" rx="88" ry="147" transform="rotate(-27 112 284)"/><ellipse class="tail tail-light" cx="92" cy="258" rx="49" ry="118" transform="rotate(-49 92 258)"/>
          <path class="body" d="M124 365c-17-109 14-202 102-217 78-14 123 57 100 147-16 65-38 103-91 119-58 18-103 2-111-49z"/><circle class="head" cx="270" cy="120" r="70"/>
          <path class="comb" d="M221 76c-22-55 10-84 30-50 22-55 53-22 43 13 43-24 63 13 29 40-27 21-78 26-102-3z"/><path class="wattle" d="M294 164c-7 23 7 43 24 38 19-7 18-35 0-50z"/><path class="beak" d="M329 123l56 20-54 23c-15-9-15-32-2-43z"/>
          <circle class="eye" cx="295" cy="106" r="7"/><circle class="eye-glint" cx="297" cy="104" r="2"/><path class="wing" d="M151 291c23-72 91-85 126-31 20 30 5 80-38 96-35 13-71-11-88-65z"/><path class="wing-line" d="M170 284c26 25 53 31 85 15M168 307c27 24 52 30 75 24"/>
          <path class="leg" d="M214 386v83M278 382v87"/><path class="foot" d="M188 469h57l-23 13h-48zM252 469h58l-23 13h-49z"/>
        </svg>
      </div>
    </section>

    <section class="explainer container" id="como-funciona"><div><p class="section-kicker">A ideia é simples</p><h2>Um sinal visual<br>para o seu dia.</h2></div><div class="explainer-copy"><p>O Galo do Tempo traduz a umidade em uma mudança de cor instantânea: azul para o ar seco, roxo para a umidade moderada e rosa para o ar muito úmido.</p><div class="state-list"><span><i class="swatch dry"></i> Seco</span><span><i class="swatch moderate"></i> Moderado</span><span><i class="swatch very-humid"></i> Muito úmido</span></div></div></section>
  </main>
  <footer class="site-footer container"><span>Galo do Tempo © <?php echo date('Y'); ?></span><a href="sobre.php">Conheça o projeto →</a></footer>
  <script src="assets/app.js"></script>
</body>
</html>

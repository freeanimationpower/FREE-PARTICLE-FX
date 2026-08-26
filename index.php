<?php ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Lax');
session_start();
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
$dev = in_array(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '', array('127.0.0.1','::1'), true);
if(!isset($_SESSION['email']) && !$dev){ header('Location:/login.php?redirect='.urlencode($_SERVER['REQUEST_URI'])); exit; } ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23ffdc00'/%3E%3Ccircle cx='23' cy='24' r='5' fill='%23070706'/%3E%3Ccircle cx='45' cy='24' r='5' fill='%23070706'/%3E%3Ccircle cx='34' cy='44' r='5' fill='%23070706'/%3E%3C/svg%3E">
  <title>Free Particle FX &mdash; Sistemas de Particulas Animados | Free Animation Power</title>
  <meta name="description" content="16 sistemas de particulas animados: confetti, fuegos artificiales, fuego, nieve, galaxia y mas. Exportacion WebM MP4 y GIF con transparencia.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --yellow:    #ffdc00;
      --yellow2:   #ffe94d;
      --yellow3:   #ffe066;
      --yellow4:   #fff3b3;
      --ink:       #070706;
      --ink2:      #1a1a1a;
      --ink3:      #333;
      --white:     #ffffff;
      --cream:     #fefcf0;
      --warm:      #faf6e8;
      --border:    #ede4c0;
      --border2:   #e8dca0;
      --muted:     #6b6500;
      --muted2:    #938c00;
      --accent:    #ff4200;
      --error:     #cc2200;
      --radius-sm: 10px;
      --radius:    18px;
      --radius-lg: 24px;
      --radius-pill: 50px;
      --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
      --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    html { font-size:16px; }
    body {
      font-family:'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background:var(--yellow);
      color:var(--ink);
      min-height:100vh;
      overflow:hidden;
      line-height:1.5;
      -webkit-font-smoothing:antialiased;
    }
    button { font-family:inherit; cursor:pointer; }
    input, select, textarea { font-family:inherit; }

    nav {
      grid-area:nav;
      display:flex;
      align-items:center;
      gap:0.75rem;
      background:var(--white);
      border-radius:var(--radius-pill);
      padding:8px 10px 8px 18px;
      box-shadow:0 2px 16px rgba(7,7,6,0.08), 0 0 0 1px var(--border);
      z-index:100;
      min-width:0;
    }
    .nav-logo {
      height:40px; width:40px; flex-shrink:0;
      display:flex; align-items:center; justify-content:center;
      background:var(--ink); color:var(--yellow);
      font-family:'Outfit',sans-serif; font-weight:900; font-size:1rem; letter-spacing:-0.02em;
      border-radius:12px;
    }
    .nav-divider { width:1px; height:18px; background:var(--border); flex-shrink:0; }
    .nav-title { font-family:'Outfit',sans-serif; font-weight:700; font-size:0.9rem; letter-spacing:-0.02em; white-space:nowrap; }
    .nav-badge {
      font-family:'Outfit',sans-serif;
      font-size:0.62rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;
      background:var(--accent); color:var(--white);
      padding:0.25em 0.8em; border-radius:999px; white-space:nowrap;
    }
    .nav-actions { margin-left:auto; display:flex; gap:8px; flex-shrink:0; }
    .nav-btn {
      border:none; border-radius:var(--radius-pill);
      background:var(--warm); color:var(--ink);
      font-size:0.8rem; font-weight:600; letter-spacing:0.02em;
      padding:9px 16px; transition:all .15s ease; white-space:nowrap;
    }
    .nav-btn:hover { background:var(--yellow4); transform:translateY(-1px); }
    .nav-btn.primary { background:var(--ink); color:var(--yellow); }
    .nav-btn.primary:hover { background:var(--ink2); }

    .app {
      display:grid;
      grid-template-rows:auto 1fr;
      grid-template-columns:290px 1fr 330px;
      grid-template-areas:"nav nav nav" "left stage right";
      gap:12px;
      padding:12px;
      height:100vh;
    }
    .panel {
      background:var(--white);
      border-radius:var(--radius);
      box-shadow:0 2px 16px rgba(7,7,6,0.06), 0 0 0 1px var(--border);
      overflow-y:auto;
      overflow-x:hidden;
      padding:16px;
    }
    .panel::-webkit-scrollbar { width:6px; }
    .panel::-webkit-scrollbar-thumb { background:var(--border2); border-radius:3px; }
    .panel-left { grid-area:left; }
    .panel-right { grid-area:right; }

    .sec-title {
      font-family:'Outfit',sans-serif;
      font-size:0.68rem; font-weight:800; text-transform:uppercase; letter-spacing:0.12em;
      color:var(--muted);
      margin:14px 0 10px;
      display:flex; align-items:center; gap:8px;
    }
    .sec-title:first-child { margin-top:0; }
    .sec-title::after { content:""; flex:1; height:1px; background:var(--border); }

    .field { margin-bottom:12px; }
    .field label {
      display:block;
      font-size:0.74rem; font-weight:700; letter-spacing:0.04em; text-transform:uppercase;
      color:var(--ink3); margin-bottom:6px;
    }
    .field-row { display:flex; gap:8px; align-items:center; }
    .field-row > div { flex:1; min-width:0; }

    input[type=text], input[type=number], select, textarea {
      font-size:0.9rem; width:100%;
      padding:9px 13px;
      border:1px solid var(--border2);
      border-radius:12px;
      background:var(--white); color:var(--ink);
      outline:none; transition:border-color .15s;
    }
    textarea { resize:vertical; min-height:74px; line-height:1.45; }
    input:focus, select:focus, textarea:focus { border-color:var(--ink); }
    select { cursor:pointer; }

    input[type=range] {
      -webkit-appearance:none; appearance:none;
      width:100%; height:4px; border:none; border-radius:2px;
      background:var(--border2); outline:none; padding:0;
    }
    input[type=range]::-webkit-slider-thumb {
      -webkit-appearance:none; width:16px; height:16px; border-radius:50%;
      background:var(--ink); cursor:pointer; box-shadow:0 1px 4px rgba(0,0,0,0.2);
    }
    input[type=range]::-moz-range-thumb { width:16px; height:16px; border:none; border-radius:50%; background:var(--ink); cursor:pointer; }
    .range-val { font-weight:700; min-width:48px; text-align:right; font-variant-numeric:tabular-nums; font-size:0.8rem; }

    input[type=color] {
      -webkit-appearance:none; appearance:none;
      width:100%; height:36px; border:1px solid var(--border2);
      border-radius:12px; cursor:pointer; padding:3px; background:var(--white);
    }
    input[type=color]::-webkit-color-swatch-wrapper { padding:2px; }
    input[type=color]::-webkit-color-swatch { border:none; border-radius:8px; }
    input[type=color]::-moz-color-swatch { border:none; border-radius:8px; }

    .pills { display:flex; background:var(--warm); border-radius:var(--radius-pill); padding:3px; gap:2px; }
    .pills button {
      flex:1; border:1px solid var(--border); background:var(--white); border-radius:var(--radius-pill);
      padding:7px 8px; font-size:0.74rem; font-weight:600; letter-spacing:0.02em;
      color:var(--muted); transition:all .15s;
    }
    .pills button:hover:not(.active) { background:var(--yellow4); border-color:var(--border2); }
    .pills button.active { background:var(--ink); color:var(--yellow); font-weight:700; border-color:var(--ink); }

    .switch-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; gap:10px; }
    .switch-row span { font-size:0.82rem; font-weight:600; letter-spacing:0.02em; }
    .switch {
      position:relative; width:42px; height:24px; flex-shrink:0;
      background:var(--border2); border-radius:var(--radius-pill);
      cursor:pointer; transition:background .2s; border:none;
    }
    .switch::after {
      content:""; position:absolute; top:3px; left:3px; width:18px; height:18px;
      background:var(--white); border-radius:50%; box-shadow:0 1px 4px rgba(0,0,0,0.2);
      transition:transform .2s;
    }
    .switch.on { background:var(--ink); }
    .switch.on::after { transform:translateX(18px); background:var(--yellow); }

    .pal-grid { display:grid; grid-template-columns:repeat(5,1fr); gap:8px; }
    .pal-btn {
      height:38px; border-radius:10px; border:2px solid var(--border);
      transition:all .15s; position:relative;
    }
    .pal-btn:hover { transform:translateY(-1px); }
    .pal-btn.active { border-color:var(--ink); box-shadow:0 0 0 2px var(--ink); }
    .pal-btn.custom {
      background:var(--warm); color:var(--ink);
      font-family:'Outfit',sans-serif; font-weight:800; font-size:1.1rem;
      border-style:dashed;
    }

    .stage { grid-area:stage; display:flex; flex-direction:column; gap:12px; min-width:0; min-height:0; }
    .canvas-wrap {
      flex:1; display:flex; align-items:center; justify-content:center;
      background:var(--white); border-radius:var(--radius);
      box-shadow:0 2px 16px rgba(7,7,6,0.06), 0 0 0 1px var(--border);
      padding:20px; min-height:0; overflow:hidden;
    }
    .canvas-frame {
      position:relative; max-width:100%; max-height:100%;
      border-radius:12px; overflow:hidden;
      box-shadow:0 8px 30px rgba(7,7,6,0.15);
      background-image:
        linear-gradient(45deg,#e9e9e9 25%,transparent 25%),
        linear-gradient(-45deg,#e9e9e9 25%,transparent 25%),
        linear-gradient(45deg,transparent 75%,#e9e9e9 75%),
        linear-gradient(-45deg,transparent 75%,#e9e9e9 75%);
      background-size:16px 16px;
      background-position:0 0, 0 8px, 8px -8px, -8px 0;
      background-color:#f5f5f5;
    }
    #preview { display:block; width:100%; height:auto; }

    .timeline {
      background:var(--white); border-radius:var(--radius);
      box-shadow:0 2px 16px rgba(7,7,6,0.06), 0 0 0 1px var(--border);
      padding:14px 18px; display:flex; align-items:center; gap:14px;
    }
    .play-btn {
      width:44px; height:44px; border-radius:50%; flex-shrink:0;
      background:var(--ink); color:var(--yellow); border:none;
      display:flex; align-items:center; justify-content:center;
      transition:all .15s;
    }
    .play-btn:hover { background:var(--accent); color:var(--white); transform:scale(1.05); }
    .play-btn svg { width:18px; height:18px; }
    .tl-track {
      flex:1; position:relative; height:44px; min-width:80px;
      background:var(--warm); border-radius:var(--radius-pill); cursor:pointer; overflow:hidden;
    }
    .tl-fill { position:absolute; top:0; left:0; bottom:0; background:var(--yellow); pointer-events:none; opacity:0.5; }
    .tl-head { position:absolute; top:4px; bottom:4px; width:4px; background:var(--ink); border-radius:2px; pointer-events:none; }
    .tl-ticks { position:absolute; inset:0; display:flex; pointer-events:none; }
    .tl-ticks span { flex:1; border-right:1px solid var(--border2); position:relative; }
    .tl-ticks span:last-child { border:none; }
    .tl-ticks span::after {
      content:attr(data-t); position:absolute; top:4px; left:6px;
      font-size:0.6rem; color:var(--muted); font-weight:700; letter-spacing:0.04em;
    }
    .tl-time { font-variant-numeric:tabular-nums; font-weight:700; font-size:0.85rem; min-width:86px; text-align:center; }
    .tl-duration { display:flex; align-items:center; gap:8px; }
    .tl-duration label { font-size:0.66rem; font-weight:800; text-transform:uppercase; color:var(--muted); }
    .tl-duration input { width:64px; text-align:center; padding:8px; }

    details.family { border:1px solid var(--border); border-radius:var(--radius-sm); margin-bottom:8px; overflow:hidden; }
    details.family summary {
      cursor:pointer; list-style:none;
      font-family:'Outfit',sans-serif; font-size:0.76rem; font-weight:700; letter-spacing:0.04em;
      padding:10px 14px; background:var(--warm);
      display:flex; align-items:center; justify-content:space-between;
    }
    details.family summary::-webkit-details-marker { display:none; }
    details.family summary::after { content:"+"; font-weight:800; color:var(--muted); }
    details.family[open] summary::after { content:"–"; }
    details.family[open] summary { background:var(--yellow4); }
    .preset-grid { display:grid; grid-template-columns:1fr 1fr; gap:6px; padding:10px; }
    .preset {
      border:1px solid var(--border2); border-radius:var(--radius-pill);
      background:var(--white); color:var(--ink3);
      font-size:0.72rem; font-weight:600; letter-spacing:0.01em;
      padding:8px 6px; text-align:center; transition:all .15s;
    }
    .preset:hover { border-color:var(--ink); }
    .preset.active { background:var(--ink); color:var(--yellow); border-color:var(--ink); font-weight:700; }

    .modal-back {
      position:fixed; inset:0; background:rgba(7,7,6,0.5);
      backdrop-filter:blur(4px); -webkit-backdrop-filter:blur(4px);
      display:none; align-items:center; justify-content:center; z-index:200;
    }
    .modal-back.open { display:flex; }
    .modal {
      background:var(--white); border-radius:var(--radius-lg); padding:26px;
      width:min(430px, 92vw); box-shadow:0 20px 60px rgba(0,0,0,0.25);
    }
    .modal h2 { font-family:'Outfit',sans-serif; font-size:1.2rem; font-weight:800; letter-spacing:-0.02em; margin-bottom:18px; }
    .modal-actions { display:flex; gap:8px; margin-top:22px; }
    .modal-actions .nav-btn { flex:1; text-align:center; }
    .progress { height:6px; background:var(--warm); border-radius:3px; overflow:hidden; margin-top:16px; display:none; }
    .progress.active { display:block; }
    .progress-bar { height:100%; background:var(--accent); width:0; transition:width .1s; }

    .hint { font-size:0.7rem; color:var(--muted); line-height:1.5; }
    .footer-note {
      position:fixed; bottom:4px; left:50%; transform:translateX(-50%);
      font-size:0.66rem; color:var(--muted2); font-weight:600; z-index:50;
      pointer-events:none; text-align:center;
    }

    #renderCanvas, #fileInput { display:none; }

    @media (max-width:1100px) {
      body { overflow:auto; }
      .app { grid-template-columns:250px 1fr 290px; height:auto; min-height:100vh; }
    }
    @media (max-width:920px) {
      body { overflow:auto; }
      .app {
        display:flex; flex-direction:column; height:auto; min-height:100vh; gap:10px; padding:80px 10px 10px;
      }
      nav { position:fixed; top:10px; left:10px; right:10px; border-radius:var(--radius-pill); }
      .nav-actions .nav-btn { padding:8px 10px; font-size:0.72rem; }
      .stage { order:1; }
      .stage .canvas-wrap { min-height:260px; }
      .panel-left { order:2; }
      .panel-right { order:3; }
      .panel { max-height:none; }
      .footer-note { display:none; }
    }
  </style>
</head>
<body>

<div class="app">

  <nav>
    <span class="nav-logo">FAP</span>
    <div class="nav-divider"></div>
    <span class="nav-title">Free Particle FX</span>
    <span class="nav-badge">Nuevo</span>
    <div class="nav-actions">
      <button class="nav-btn" id="btnNew">Nuevo</button>
      <button class="nav-btn" id="btnOpen">Abrir</button>
      <button class="nav-btn" id="btnSave">Guardar</button>
      <button class="nav-btn primary" id="btnExport">Exportar</button>
    </div>
  </nav>

  <aside class="panel panel-left">

    <div class="sec-title">Sistema</div>
    <div class="field" id="fldCount">
      <label>Cantidad</label>
      <div class="field-row">
        <input type="range" id="count" min="4" max="800" value="220">
        <span class="range-val" id="countVal">220</span>
      </div>
    </div>
    <div class="field">
      <label>Tamano</label>
      <div class="field-row">
        <input type="range" id="size" min="20" max="300" value="100">
        <span class="range-val" id="sizeVal">100%</span>
      </div>
    </div>
    <div class="field">
      <label>Velocidad</label>
      <div class="field-row">
        <input type="range" id="speed" min="20" max="300" value="100">
        <span class="range-val" id="speedVal">100%</span>
      </div>
    </div>
    <div class="field">
      <label>Gravedad</label>
      <div class="field-row">
        <input type="range" id="grav" min="0" max="300" value="100">
        <span class="range-val" id="gravVal">100%</span>
      </div>
    </div>
    <div class="field">
      <label>Viento</label>
      <div class="field-row">
        <input type="range" id="wind" min="0" max="200" value="0">
        <span class="range-val" id="windVal">0</span>
      </div>
    </div>
    <div class="field">
      <label>Turbulencia</label>
      <div class="field-row">
        <input type="range" id="turb" min="0" max="200" value="100">
        <span class="range-val" id="turbVal">100%</span>
      </div>
    </div>
    <div class="field">
      <label>Vida</label>
      <div class="field-row">
        <input type="range" id="life" min="50" max="200" value="100">
        <span class="range-val" id="lifeVal">100%</span>
      </div>
    </div>
    <div class="field">
      <label>Opacidad</label>
      <div class="field-row">
        <input type="range" id="opacity" min="10" max="100" value="100">
        <span class="range-val" id="opacityVal">100%</span>
      </div>
    </div>

    <div id="secEmitter">
      <div class="sec-title">Emisor</div>
      <div class="field">
        <div class="pills" id="emitterGroup">
          <button data-v="screen" class="active">Pantalla</button>
          <button data-v="center">Centro</button>
          <button data-v="top">Arriba</button>
          <button data-v="bottom">Abajo</button>
        </div>
      </div>
      <p class="hint">Aplica a explosion, fuente, polvo magico y galaxia. El fuego real (DOOM) usa toda la base.</p>
    </div>

    <div class="sec-title">Mezcla</div>
    <div class="field">
      <div class="pills" id="blendGroup">
        <button data-v="normal">Normal</button>
        <button data-v="lighter">Aditivo</button>
        <button data-v="screen">Pantalla</button>
      </div>
    </div>

    <div class="sec-title">Paleta</div>
    <div class="field">
      <div class="pal-grid" id="paletteGrid"></div>
    </div>
    <div id="customColors" style="display:none">
      <div class="field">
        <div class="field-row" id="customRow"></div>
      </div>
    </div>

    <div class="sec-title">Fondo</div>
    <div class="switch-row">
      <span>Mostrar fondo</span>
      <div class="switch on" id="bgSwitch"></div>
    </div>
    <div class="field">
      <label>Color de fondo</label>
      <input type="color" id="bgColor" value="#0d0d1a">
    </div>
    <p class="hint">Desactiva el fondo para previsualizar la transparencia (exportable en WebM y GIF con canal alfa).</p>

    <div class="sec-title">Avanzado</div>
    <div class="switch-row">
      <span>Estelas de movimiento</span>
      <div class="switch" id="trailSwitch"></div>
    </div>
    <div class="switch-row">
      <span>Bucle</span>
      <div class="switch on" id="loopSwitch"></div>
    </div>
    <div class="switch-row">
      <span>Pixelar salida (estilo DOOM)</span>
      <div class="switch" id="pixelateSwitch"></div>
    </div>
    <div class="field">
      <label>Semilla</label>
      <div class="field-row">
        <input type="number" id="seedInput" min="1" max="999999" value="1234">
        <button class="nav-btn" id="btnRandom">Aleatorio</button>
      </div>
    </div>

  </aside>

  <main class="stage">
    <div class="canvas-wrap">
      <div class="canvas-frame">
        <canvas id="preview" width="1280" height="720"></canvas>
      </div>
    </div>
    <div class="timeline">
      <button class="play-btn" id="btnPlay">
        <svg id="iconPlay" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
        <svg id="iconPause" viewBox="0 0 24 24" fill="currentColor" style="display:none"><path d="M6 4h4v16H6zM14 4h4v16h-4z"/></svg>
      </button>
      <div class="tl-track" id="tlTrack">
        <div class="tl-ticks" id="tlTicks"></div>
        <div class="tl-fill" id="tlFill"></div>
        <div class="tl-head" id="tlHead"></div>
      </div>
      <div class="tl-time" id="tlTime">0.00 / 4.00</div>
      <div class="tl-duration">
        <label>Dur</label>
        <input type="number" id="duration" min="0.5" max="20" step="0.1" value="4">
      </div>
    </div>
  </main>

  <aside class="panel panel-right">

    <div class="sec-title">Sistemas de particulas &mdash; 54 presets</div>
    <div class="field">
      <input type="text" id="presetSearch" placeholder="Buscar sistema...">
    </div>
    <div id="presetList"></div>

    <div class="sec-title">Parametros del sistema</div>
    <div id="sysParams"><p class="hint">Selecciona un sistema para editar sus parametros.</p></div>

    <div class="sec-title">Proyecto</div>
    <p class="hint">Guarda tu configuracion como archivo JSON (.particlefx) y abrelo cuando quieras. El autoguardado guarda el estado en este navegador.</p>

  </aside>

</div>

<div class="modal-back" id="exportModal">
  <div class="modal">
    <h2>Exportar animacion</h2>
    <div class="field">
      <label>Formato</label>
      <div class="pills" id="formatGroup">
        <button data-f="webm" class="active">WebM</button>
        <button data-f="mp4">MP4</button>
        <button data-f="gif">GIF</button>
      </div>
    </div>
    <div class="field">
      <label>Cuadros por segundo</label>
      <select id="exportFps">
        <option value="24">24 fps</option>
        <option value="30" selected>30 fps</option>
        <option value="60">60 fps</option>
      </select>
    </div>
    <div class="switch-row">
      <span>Fondo transparente (WebM/GIF)</span>
      <div class="switch on" id="exportAlphaSwitch"></div>
    </div>
    <div class="progress" id="exportProgress">
      <div class="progress-bar" id="exportBar"></div>
    </div>
    <div class="modal-actions">
      <button class="nav-btn" id="btnCancelExport">Cancelar</button>
      <button class="nav-btn primary" id="btnDoExport">Exportar</button>
    </div>
  </div>
</div>

<canvas id="renderCanvas" width="1280" height="720"></canvas>
<input type="file" id="fileInput" accept=".json,application/json">
<div class="footer-note">Free Particle FX &middot; parte del ecosistema Free Animation Power &middot; ESPACIO = reproducir/pausar</div>

<script>
const $=id=>document.getElementById(id);
const W=1280, H=720;
const TAU=Math.PI*2;

function clamp(v,a,b){ return Math.max(a, Math.min(b,v)); }
function sleep(ms){ return new Promise(r=>setTimeout(r,ms)); }
function damp(t,dr){ return dr>0.0001 ? (1-Math.exp(-dr*t))/dr : t; }
function mulberry32(a){
  return function(){
    a|=0; a=a+0x6D2B79F5|0;
    let t=Math.imul(a^a>>>15,1|a);
    t=t+Math.imul(t^t>>>7,61|t)^t;
    return ((t^t>>>14)>>>0)/4294967296;
  };
}

const RAMP_FIRE=['#fff8c4','#ffe259','#ffb62e','#ff7e1d','#f23c00','#8f1c00'];
const RAMP_FOUNT=['#fff3b0','#ffd94d','#ff9a2e','#f25500'];
const RAMP_EMBER=['#ffd76a','#ff9d3c','#e85500'];
const RAMP_SMOKE=['#9a9a9a','#6f6f6f','#4a4a4a'];
const AURORA_COLS=['#5affb0','#3ac8ff','#b45aff'];

function hexA(hex,al){
  const r=parseInt(hex.slice(1,3),16), g=parseInt(hex.slice(3,5),16), b=parseInt(hex.slice(5,7),16);
  return 'rgba('+r+','+g+','+b+','+al+')';
}
function rampAt(ramp,k){ return ramp[clamp(Math.floor(k*ramp.length),0,ramp.length-1)]; }

const sprites=new Map();
function glowSprite(color){
  const key='g|'+color;
  if(sprites.has(key))return sprites.get(key);
  const c=document.createElement('canvas');
  c.width=c.height=64;
  const g=c.getContext('2d');
  const rg=g.createRadialGradient(32,32,0,32,32,32);
  rg.addColorStop(0,'#ffffff');
  rg.addColorStop(0.22,hexA(color,1));
  rg.addColorStop(0.55,hexA(color,0.35));
  rg.addColorStop(1,hexA(color,0));
  g.fillStyle=rg;
  g.fillRect(0,0,64,64);
  sprites.set(key,c);
  return c;
}
function softSprite(color){
  const key='s|'+color;
  if(sprites.has(key))return sprites.get(key);
  const c=document.createElement('canvas');
  c.width=c.height=128;
  const g=c.getContext('2d');
  const rg=g.createRadialGradient(64,64,0,64,64,64);
  rg.addColorStop(0,hexA(color,0.9));
  rg.addColorStop(0.4,hexA(color,0.45));
  rg.addColorStop(1,hexA(color,0));
  g.fillStyle=rg;
  g.fillRect(0,0,128,128);
  sprites.set(key,c);
  return c;
}
function ringSprite(color){
  const key='r|'+color;
  if(sprites.has(key))return sprites.get(key);
  const c=document.createElement('canvas');
  c.width=c.height=128;
  const g=c.getContext('2d');
  const rg=g.createRadialGradient(64,64,0,64,64,64);
  rg.addColorStop(0,'rgba(0,0,0,0)');
  rg.addColorStop(0.55,hexA(color,0.05));
  rg.addColorStop(0.72,hexA(color,0.85));
  rg.addColorStop(0.86,hexA(color,0.9));
  rg.addColorStop(1,'rgba(0,0,0,0)');
  g.fillStyle=rg;
  g.fillRect(0,0,128,128);
  sprites.set(key,c);
  return c;
}
function blit(ctx,spr,x,y,r,alpha){
  ctx.globalAlpha=clamp(alpha,0,1);
  const d=r*2;
  ctx.drawImage(spr,x-r,y-r,d,d);
}
function mixHex(hex,k){
  const r=parseInt(hex.slice(1,3),16), g=parseInt(hex.slice(3,5),16), b=parseInt(hex.slice(5,7),16);
  return 'rgb('+Math.round(k>=0?r+(255-r)*k:r*(1+k))+','+Math.round(k>=0?g+(255-g)*k:g*(1+k))+','+Math.round(k>=0?b+(255-b)*k:b*(1+k))+')';
}
function gradSprite(color){
  const key='v|'+color;
  if(sprites.has(key))return sprites.get(key);
  const c=document.createElement('canvas');
  c.width=c.height=64;
  const g=c.getContext('2d');
  const lg=g.createLinearGradient(0,0,0,64);
  lg.addColorStop(0,mixHex(color,0.45));
  lg.addColorStop(0.45,color);
  lg.addColorStop(1,mixHex(color,-0.45));
  g.fillStyle=lg;
  g.fillRect(0,0,64,64);
  sprites.set(key,c);
  return c;
}
function leafSprite(color){
  const key='leaf|'+color;
  if(sprites.has(key))return sprites.get(key);
  const c=document.createElement('canvas');
  c.width=c.height=64;
  const g=c.getContext('2d');
  g.beginPath();
  g.moveTo(32,4);
  g.quadraticCurveTo(60,28,32,60);
  g.quadraticCurveTo(4,28,32,4);
  g.closePath();
  const lg=g.createLinearGradient(0,0,64,64);
  lg.addColorStop(0,mixHex(color,0.45));
  lg.addColorStop(0.55,color);
  lg.addColorStop(1,mixHex(color,-0.4));
  g.fillStyle=lg;
  g.fill();
  g.strokeStyle='rgba(0,0,0,0.2)';
  g.lineWidth=1.4;
  g.beginPath();
  g.moveTo(32,6);
  g.lineTo(32,58);
  g.stroke();
  sprites.set(key,c);
  return c;
}
function petalSprite(color){
  const key='petal|'+color;
  if(sprites.has(key))return sprites.get(key);
  const c=document.createElement('canvas');
  c.width=c.height=64;
  const g=c.getContext('2d');
  g.beginPath();
  g.moveTo(32,6);
  g.quadraticCurveTo(56,32,32,58);
  g.quadraticCurveTo(8,32,32,6);
  g.closePath();
  const lg=g.createLinearGradient(0,0,64,64);
  lg.addColorStop(0,mixHex(color,0.5));
  lg.addColorStop(0.55,color);
  lg.addColorStop(1,mixHex(color,-0.35));
  g.fillStyle=lg;
  g.fill();
  sprites.set(key,c);
  return c;
}
function blitR(ctx,spr,x,y,w,h,rot,sy,alpha){
  ctx.globalAlpha=clamp(alpha,0,1);
  ctx.save();
  ctx.translate(x,y);
  if(rot)ctx.rotate(rot);
  if(sy&&sy!==1)ctx.scale(1,sy);
  ctx.drawImage(spr,-w/2,-h/2,w,h);
  ctx.restore();
}
function swX(p,tt){
  let v=0;
  for(let i=0;i<p.sw.length;i++)v+=Math.sin(tt*p.sw[i][1]+p.sw[i][2])*p.sw[i][0];
  return v;
}

const PALETTES={
  fiesta:['#ff2d55','#ffdd00','#00e5ff','#7cff00','#ff7b00','#d500ff'],
  fuego:['#ffe600','#ff9900','#ff5e00','#ff2200','#ffcf5e'],
  neon:['#00ffd5','#ff00e5','#00b3ff','#ccff00','#ff6600'],
  pastel:['#ffd6e7','#d6f5ff','#e4ffd6','#fff3c2','#e6d6ff'],
  noche:['#9db8ff','#c9a7ff','#ffffff','#ffd1a8','#8fd9ff'],
  metal:['#e8e8e8','#b8b8b8','#8a8a8a','#5f5f5f','#ffffff'],
  naturaleza:['#7bd389','#f7b801','#5c946e','#c9d17e','#b06d3b'],
  candy:['#ff9eb5','#ffd700','#9be8ff','#c3ff8f','#ffb3ff'],
  rgb:['#ff0044','#00ff66','#0066ff'],
  oro:['#fff2b0','#ffe066','#ffd24a','#ffb300','#fffbe0'],
  agua:['#ffffff','#dff4ff','#a8e0ff','#5ec4f2','#8fd8ff'],
  viento:['#f4fafc','#d6e9ef','#a9c8d6','#ffffff','#87aebf']
};

function hash32(n){
  let t=n|0;
  t=Math.imul(t^t>>>16,2246822507);
  t=Math.imul(t^t>>>13,3266489909);
  t^=t>>>16;
  return (t>>>0)/4294967296;
}
function doomPal(anchors){
  const out=[];
  const N=37;
  for(let i=0;i<N;i++){
    const t=i/(N-1);
    let a=anchors[0], b=anchors[anchors.length-1];
    for(let j=0;j<anchors.length-1;j++){
      if(t>=anchors[j][0]&&t<=anchors[j+1][0]){ a=anchors[j]; b=anchors[j+1]; break; }
    }
    const span=(b[0]-a[0])||1;
    const k=clamp((t-a[0])/span,0,1);
    out.push([
      Math.round(a[1][0]+(b[1][0]-a[1][0])*k),
      Math.round(a[1][1]+(b[1][1]-a[1][1])*k),
      Math.round(a[1][2]+(b[1][2]-a[1][2])*k)
    ]);
  }
  return out;
}
const DOOM={w:160,h:90,grid:new Uint8Array(160*90),cv:null,ictx:null,img:null,pal:null,step:0,sig:'',seed:1,warm:110,ck:new Map()};

function hex2rgb(hex){
  return [parseInt(hex.slice(1,3),16),parseInt(hex.slice(3,5),16),parseInt(hex.slice(5,7),16)];
}
function doomPalFromColors(colors){
  const rgb=colors.map(hex2rgb);
  const anchors=[[0,[5,5,5]]];
  const n=rgb.length;
  for(let i=0;i<n;i++){
    const t=0.15+((i+1)/(n+1))*0.62;
    anchors.push([t,rgb[i]]);
  }
  anchors.push([0.86,[255,244,224]]);
  anchors.push([1,[255,255,255]]);
  return doomPal(anchors);
}
function doomPalFor(){
  return doomPalFromColors(currentPal());
}

function doomInit(){
  if(!DOOM.cv){
    DOOM.cv=document.createElement('canvas');
    DOOM.cv.width=DOOM.w;
    DOOM.cv.height=DOOM.h;
    DOOM.ictx=DOOM.cv.getContext('2d');
    DOOM.img=DOOM.ictx.createImageData(DOOM.w,DOOM.h);
  }
  DOOM.ck.clear();
  DOOM.grid.fill(0);
  DOOM.step=0;
  DOOM.seed=state.seed;
  DOOM.pal=doomPalFor();
  const P=state.pp.fireDoom||{};
  const src=clamp(P.intensidad!==undefined?P.intensidad:32,1,36);
  const off=DOOM.w*DOOM.h-DOOM.w;
  for(let c=0;c<DOOM.w;c++)DOOM.grid[off+c]=src;
  for(let i=0;i<DOOM.warm;i++)doomStep();
  DOOM.step=DOOM.warm;
}

function doomStep(){
  const w=DOOM.w,h=DOOM.h,g=DOOM.grid;
  const P=state.pp.fireDoom||{};
  const src=clamp(P.intensidad!==undefined?P.intensidad:32,1,36);
  const windBias=Math.round(state.wind/50)-2;
  const turb=(state.turb-100)/100;
  for(let row=0;row<h-1;row++){
    for(let col=0;col<w;col++){
      const below=(row+1)*w+col;
      let d=Math.floor(hash32(DOOM.step*977+below*131+DOOM.seed)*2);
      if(turb>0&&hash32(DOOM.step*613+below*191+DOOM.seed*3)<turb*0.3)d++;
      const lateral=(Math.floor(hash32(DOOM.step*401+below*59+DOOM.seed*5)*3)-1)+windBias;
      const v=g[below]-d;
      const nv=v>0?v:0;
      const col2=(col+lateral+w*4)%w;
      g[row*w+col2]=nv;
    }
  }
  const off=w*h-w;
  for(let c=0;c<w;c++)g[off+c]=src;
}

function doomDraw(ctx,glow){
  const w=DOOM.w,h=DOOM.h,g=DOOM.grid,img=DOOM.img,d=img.data,pal=DOOM.pal;
  for(let i=0;i<w*h;i++){
    const v=g[i];
    const o=i*4;
    if(v<=0){ d[o+3]=0; continue; }
    const c=pal[Math.min(v,pal.length-1)];
    d[o]=c[0]; d[o+1]=c[1]; d[o+2]=c[2]; d[o+3]=255;
  }
  DOOM.ictx.putImageData(img,0,0);
  ctx.save();
  ctx.imageSmoothingEnabled=true;
  ctx.imageSmoothingQuality='high';
  ctx.globalCompositeOperation=state.blend;
  ctx.drawImage(DOOM.cv,0,0,W,H);
  if(glow>0){
    try{
      ctx.filter='blur('+glow+'px)';
      ctx.globalAlpha=0.55;
      ctx.drawImage(DOOM.cv,0,0,W,H);
      ctx.filter='none';
    }catch(e){}
  }
  ctx.restore();
}

function doomRender(ctx,t){
  const S=state;
  const P=S.pp.fireDoom||{};
  const sig=['doom',S.seed,S.palette,S.wind,S.turb,S.speed,JSON.stringify(P)].join('|');
  if(sig!==DOOM.sig){ DOOM.sig=sig; doomInit(); }
  const sps=Math.max(4,Math.round((P.pasos!==undefined?P.pasos:18)*(S.speed/100)));
  const target=Math.floor(t*sps)+DOOM.warm;
  if(target<DOOM.step){ doomInit(); }
  const CK=16;
  const ckBase=Math.floor(DOOM.step/CK)*CK;
  const ckWant=Math.floor(target/CK)*CK;
  if(ckWant>DOOM.warm&&ckWant!==ckBase){
    const snap=DOOM.ck.get(DOOM.sig+'|'+ckWant);
    if(snap){ DOOM.grid.set(snap); DOOM.step=ckWant; }
  }
  while(DOOM.step<target){
    doomStep();
    DOOM.step++;
    if(DOOM.step%CK===0&&DOOM.step>DOOM.warm&&DOOM.ck.size<64){
      DOOM.ck.set(DOOM.sig+'|'+DOOM.step,DOOM.grid.slice());
    }
  }
  doomDraw(ctx,P.glow!==undefined?P.glow:22);
}

const PX={w:160,h:90,grid:null,g2:null,cv:null,ictx:null,img:null,pal:null,rule:'',step:0,sig:'',seed:1,warm:0,cap:36,amul:1,ck:new Map()};

const WATER_PAL=doomPal([[0,[4,32,70]],[0.25,[10,70,130]],[0.5,[30,130,200]],[0.72,[80,190,245]],[0.86,[150,215,255]],[0.95,[200,240,255]],[1,[135,206,235]]]);
const PX_CFG={
  lava:{cap:36,amul:1,warm:110},
  humo:{cap:26,amul:0.9,warm:120},
  agua:{cap:30,amul:0.95,warm:90},
  arena:{cap:30,amul:1,warm:80},
  lluvia:{cap:30,amul:0.95,warm:20},
  matrix:{cap:30,amul:0.95,warm:90},
  tinta:{cap:30,amul:0.9,warm:80},
  ondasPx:{cap:30,amul:0.9,warm:40},
  estatica:{cap:24,amul:1,warm:1},
  vida:{cap:35,amul:1,warm:30},
  viento:{cap:26,amul:0.85,warm:1},
  plasma:{cap:34,amul:0.9,direct:1},
  auroraPx:{cap:28,amul:0.8,direct:1},
  nieblaPx:{cap:28,amul:0.6,direct:1},
  nebula:{cap:30,amul:0.85,direct:1}
};

function pxInit(){
  if(!PX.cv){
    PX.cv=document.createElement('canvas');
    PX.cv.width=PX.w;
    PX.cv.height=PX.h;
    PX.ictx=PX.cv.getContext('2d');
    PX.img=PX.ictx.createImageData(PX.w,PX.h);
  }
  PX.grid=new Float32Array(PX.w*PX.h);
  PX.g2=new Float32Array(PX.w*PX.h);
  PX.ck.clear();
  PX.step=0;
  PX.seed=state.seed;
  PX.rule=({arena2:'arena',lluvia2:'lluvia'})[state.preset]||state.preset;
  PX.pal=PX.rule==='agua'?WATER_PAL:doomPalFromColors(currentPal());
  const cfg=PX_CFG[PX.rule]||{cap:36,amul:1,warm:60};
  PX.cap=cfg.cap;
  PX.amul=cfg.amul;
  PX.warm=cfg.warm||0;
  if(PX.rule==='vida'){
    for(let i=0;i<PX.w*PX.h;i++)PX.grid[i]=hash32(i*17+PX.seed)<0.30?1:0;
  }
  if(PX.rule==='matrix'){
    for(let c=0;c<PX.w;c++){
      PX.g2[c]=hash32(c*29+PX.seed)<0.5?hash32(c*43+PX.seed)*(PX.h-10):0;
    }
  }
  for(let i=0;i<PX.warm;i++)pxStep();
  PX.step=PX.warm;
}

function pxStep(){
  const w=PX.w,h=PX.h,g=PX.grid,g2=PX.g2;
  switch(PX.rule){
    case 'lava':{
      const P=state.pp.lava||{};
      const src=clamp(P.intensidad!==undefined?P.intensidad:32,1,36);
      for(let row=0;row<h-1;row++){
        for(let col=0;col<w;col++){
          const below=(row+1)*w+col;
          const d=Math.floor(hash32(PX.step*977+below*131+PX.seed)*2);
          const lateral=Math.floor(hash32(PX.step*401+below*59+PX.seed*5)*3)-1;
          const v=g[below]-d;
          g[row*w+((col+lateral+w)%w)]=v>0?v:0;
        }
      }
      const off=w*h-w;
      for(let c=0;c<w;c++)g[off+c]=src;
      break;
    }
    case 'humo':
      for(let row=0;row<h-1;row++){
        for(let col=0;col<w;col++){
          const below=(row+1)*w+col;
          const d=Math.floor(hash32(PX.step*913+below*97+PX.seed)*2);
          const v=g[below]-d;
          const lat=Math.round((hash32(PX.step*331+below*71+PX.seed*7)-0.5)*8);
          const col2=col+lat;
          if(col2>=0&&col2<w)g[row*w+col2]=v>0?v:0;
        }
      }
      {
        const off=w*h-w;
        for(let c=0;c<w;c++){
          g[off+c]=hash32(PX.step*67+c*23+PX.seed)<0.7?24:0;
        }
      }
      break;
    case 'agua':{
      for(let col=0;col<w;col++){
        if(hash32(PX.step*71+col*13+PX.seed)<0.6)g[col]=30;
      }
      for(let row=h-1;row>=1;row--){
        for(let col=0;col<w;col++){
          const idx=row*w+col;
          const above=idx-w;
          if(g[idx]<=0&&g[above]>0){
            const lat=hash32(PX.step*39+idx*11+PX.seed)<0.5?-1:1;
            const ncol=col+lat;
            if(ncol>=0&&ncol<w){ g[idx]=g[above]; g[above]=0; }
          }
        }
      }
      for(let col=0;col<w;col++){
        const idx=(h-1)*w+col;
        if(g[idx]>0){
          const dir=hash32(PX.step*57+col*31+PX.seed)<0.5?-1:1;
          const ncol=col+dir;
          if(ncol>=0&&ncol<w&&g[(h-1)*w+ncol]<=0)g[(h-1)*w+ncol]=g[idx]*0.8;
          g[idx]*=0.985;
          if(g[idx]<0.5)g[idx]=0;
        }
      }
      break;
    }
    case 'arena':{
      for(let col=0;col<w;col++){
        if(hash32(PX.step*73+col*17+PX.seed)<0.4)g[col]=30;
      }
      for(let pass=0;pass<2;pass++){
        for(let row=h-1;row>=0;row--){
          for(let col=0;col<w;col++){
            const idx=row*w+col;
            if(g[idx]<=0)continue;
            if(row===h-1){ g[idx]*=0.95; if(g[idx]<1)g[idx]=0; continue; }
            const below=idx+w;
            if(g[below]<=0){ g[below]=g[idx]; g[idx]=0; continue; }
            const dir=hash32(PX.step*47+idx*23+PX.seed)<0.5?-1:1;
            const ncol=col+dir;
            if(ncol>=0&&ncol<w){
              const side=below+dir;
              if(g[side]<=0){ g[side]=g[idx]; g[idx]=0; }
            }
          }
        }
      }
      break;
    }
    case 'lluvia':
      for(let row=h-1;row>=3;row--){
        for(let col=0;col<w;col++)g[row*w+col]=g[(row-3)*w+col]*0.97;
      }
      for(let row=0;row<3;row++){
        for(let col=0;col<w;col++){
          if(hash32(PX.step*29+row*7+col*61+PX.seed)<0.45){
            g[row*w+col]=row===2?26:32;
          }else{
            g[row*w+col]=0;
          }
        }
      }
      break;
    case 'matrix':{
      for(let i=0;i<w*h;i++)g[i]*=0.9;
      for(let col=0;col<w;col++){
        if(g2[col]<=0){
          g2[col]=hash32(PX.step*83+col*37+PX.seed)<0.3?hash32(col*13+PX.seed)*(h-10):0;
        }
        if(g2[col]>0){
          const row=Math.floor(g2[col]);
          if(row<h)g[row*w+col]=30;
          g2[col]-=hash32(PX.step*11+col*43+PX.seed)*4;
          if(g2[col]<0)g2[col]=0;
        }
      }
      break;
    }
    case 'tinta':{
      for(let y=0;y<h;y++){
        for(let x=0;x<w;x++){
          const i=y*w+x;
          let sum=g[i];
          let n=1;
          if(x>0){sum+=g[i-1];n++;}
          if(x<w-1){sum+=g[i+1];n++;}
          if(y>0){sum+=g[i-w];n++;}
          if(y<h-1){sum+=g[i+w];n++;}
          g2[i]=(g[i]*0.25+sum/n*0.75)*0.995;
        }
      }
      const src=26+6*Math.sin(PX.step*0.12);
      for(let c2=0;c2<7;c2++){
        const cx=Math.floor(w/2-3+hash32(PX.step*53+c2*17+PX.seed)*7);
        if(cx>=0&&cx<w)g2[cx]=Math.max(g2[cx],src);
      }
      if(PX.step%10===0){
        for(let d2=0;d2<3;d2++){
          const rx=Math.floor(hash32(PX.step*79+d2*31+PX.seed)*w);
          const ry=Math.floor(hash32(PX.step*101+d2*47+PX.seed*3)*h);
          g2[ry*w+rx]=Math.max(g2[ry*w+rx],30);
        }
      }
      PX.grid=g2;
      PX.g2=g;
      break;
    }
    case 'ondasPx':{
      if(PX.step%2===0){
        for(let d2=0;d2<2;d2++){
          const cx=Math.floor(hash32(PX.step*37+d2*19+PX.seed)*w);
          const cy=Math.floor(hash32(PX.step*67+d2*13+PX.seed*3)*h*0.8);
          g[cy*w+cx]=Math.min(36,g[cy*w+cx]+26);
        }
      }
      for(let y=0;y<h;y++){
        for(let x=0;x<w;x++){
          const i=y*w+x;
          const xL=x===0?1:x-1;
          const xR=x===w-1?w-2:x+1;
          const yU=y===0?1:y-1;
          const yD=y===h-1?h-2:y+1;
          g2[i]=((g[y*w+xL]+g[y*w+xR]+g[yU*w+x]+g[yD*w+x])*0.5-g[i])*0.97;
        }
      }
      PX.grid=g2;
      PX.g2=g;
      break;
    }
    case 'estatica':{
      const glitchRow=Math.floor(hash32(PX.step*41+PX.seed)*h);
      const shift=Math.floor(hash32(PX.step*97+PX.seed*5)*20)-10;
      for(let y=0;y<h;y++){
        for(let x=0;x<w;x++){
          const i=y*w+x;
          const isG=(y>=glitchRow&&y<=glitchRow+2);
          const x2=isG?(x+shift+w)%w:x;
          const alive=hash32(PX.step*211+x2*13+y*97+PX.seed)<(isG?0.6:0.45);
          g[i]=alive?hash32(i+1)*20:0;
        }
      }
      break;
    }
    case 'vida':{
      if(PX.step%25===0){
        const gx=Math.floor(hash32(PX.step*171+PX.seed)*(w-6))+3;
        const gy=Math.floor(hash32(PX.step*193+PX.seed*7)*(h-6))+3;
        const cells=[[1,0],[2,1],[0,2],[1,2],[2,2]];
        for(let c=0;c<cells.length;c++){
          const x2=(gx+cells[c][0]+w)%w, y2=(gy+cells[c][1]+h)%h;
          g[y2*w+x2]=1;
        }
      }
      for(let i=0;i<w*h;i++){
        const x=i%w, y=(i/w)|0;
        let n=0;
        for(let dy=-1;dy<=1;dy++){
          for(let dx=-1;dx<=1;dx++){
            if(!dx&&!dy)continue;
            const x2=(x+dx+w)%w, y2=(y+dy+h)%h;
            if(g[y2*w+x2]>0)n++;
          }
        }
        g2[i]=g[i]>0?(n===2||n===3?Math.min(35,g[i]+1):0):(n===3?1:0);
      }
      PX.grid=g2;
      PX.g2=g;
      break;
    }
    case 'viento':
      for(let y=0;y<h;y++){
        const sh=Math.floor(hash32(PX.step*17+y*29+PX.seed)*5)-2;
        for(let x=0;x<w;x++){
          const i=y*w+x;
          const x2=(x+sh+2+w)%w;
          const n=Math.sin(x*0.15+PX.step*0.6)*Math.sin(y*0.2-PX.step*0.4);
          g[y*w+x2]=Math.max(0,n+hash32(i)*0.5)*20;
        }
      }
      break;
  }
}

function pxFillDirect(t){
  const w=PX.w,h=PX.h,g=PX.grid;
  const P=state.pp[PX.rule]||{};
  const sp=P.vel!==undefined?P.vel/100:1;
  switch(PX.rule){
    case 'plasma':{
      const cx=w/2, cy=h/2;
      for(let y=0;y<h;y++){
        for(let x=0;x<w;x++){
          const v=Math.sin(x*0.09+t*1.4*sp)+Math.sin(y*0.07-t*1.1*sp)+Math.sin(Math.hypot(x-cx,y-cy)*0.09+t*0.8*sp);
          g[y*w+x]=(v/3+1)*17;
        }
      }
      break;
    }
    case 'auroraPx':
      for(let y=0;y<h;y++){
        for(let x=0;x<w;x++){
          const band=Math.sin(y*0.16-t*0.7*sp)+Math.sin(x*0.03+y*0.05+t*0.5*sp);
          g[y*w+x]=Math.max(0,band)*14;
        }
      }
      break;
    case 'nieblaPx':
      for(let y=0;y<h;y++){
        for(let x=0;x<w;x++){
          const n=Math.sin(x*0.02+t*0.25*sp)*Math.sin(y*0.03-t*0.18*sp)+Math.sin((x+y)*0.013+t*0.3*sp);
          g[y*w+x]=Math.max(0,n+0.4)*14;
        }
      }
      break;
    case 'nebula':
      for(let y=0;y<h;y++){
        for(let x=0;x<w;x++){
          const n=Math.sin(x*0.013+t*0.16*sp)*Math.sin(y*0.021-t*0.12*sp)+Math.sin((x*0.8+y*0.5)*0.03+t*0.2*sp)+Math.sin(Math.hypot(x-w*0.3,y-h*0.4)*0.05+t*0.3*sp);
          g[y*w+x]=Math.max(0,n+1.2)*9;
        }
      }
      break;
  }
}

function pxDraw(ctx,glow){
  const w=PX.w,h=PX.h,g=PX.grid,img=PX.img,d=img.data,pal=PX.pal;
  const cap=PX.cap, amul=PX.amul;
  for(let i=0;i<w*h;i++){
    const v=g[i];
    const o=i*4;
    if(v<=0){ d[o+3]=0; continue; }
    const k=Math.min(1,v/cap);
    const c=pal[Math.min(pal.length-1,Math.floor(k*(pal.length-1)))];
    d[o]=c[0]; d[o+1]=c[1]; d[o+2]=c[2];
    d[o+3]=Math.round(clamp(k,0,1)*255*amul);
  }
  PX.ictx.putImageData(img,0,0);
  ctx.save();
  ctx.imageSmoothingEnabled=true;
  ctx.imageSmoothingQuality='high';
  ctx.globalCompositeOperation=state.blend;
  ctx.drawImage(PX.cv,0,0,W,H);
  if(glow>0){
    try{
      ctx.filter='blur('+glow+'px)';
      ctx.globalAlpha=0.5;
      ctx.drawImage(PX.cv,0,0,W,H);
      ctx.filter='none';
    }catch(e){}
  }
  ctx.restore();
}

function pxRender(ctx,t){
  const S=state;
  const P=S.pp[S.preset]||{};
  const sig=['px',S.preset,S.seed,S.palette,S.wind,S.turb,S.speed,JSON.stringify(P)].join('|');
  if(sig!==PX.sig){ PX.sig=sig; pxInit(); }
  const cfg=PX_CFG[({arena2:'arena',lluvia2:'lluvia'})[S.preset]||S.preset];
  if(cfg&&cfg.direct){
    pxFillDirect(t);
    pxDraw(ctx,P.glow!==undefined?P.glow:16);
    return;
  }
  const sps=Math.max(4,Math.round((P.pasos!==undefined?P.pasos:14)*(S.speed/100)));
  const target=Math.floor(t*sps)+PX.warm;
  if(target<PX.step){ pxInit(); }
  const CK=16;
  const ckBase=Math.floor(PX.step/CK)*CK;
  const ckWant=Math.floor(target/CK)*CK;
  if(ckWant>PX.warm&&ckWant!==ckBase){
    const snap=PX.ck.get(PX.sig+'|'+ckWant);
    if(snap){ PX.grid.set(snap.g); PX.g2.set(snap.g2); PX.step=ckWant; }
  }
  while(PX.step<target){
    pxStep();
    PX.step++;
    if(PX.step%CK===0&&PX.step>PX.warm&&PX.ck.size<64){
      PX.ck.set(PX.sig+'|'+PX.step,{g:PX.grid.slice(),g2:PX.g2.slice()});
    }
  }
  pxDraw(ctx,P.glow!==undefined?P.glow:16);
}

const PRESETS=[
  { id:'confetti', family:'Celebracion', name:'Confetti', count:220, pal:'fiesta', blend:'normal' },
  { id:'fireworks', family:'Celebracion', name:'Fuegos artificiales', count:8, pal:'fiesta', blend:'lighter',
    params:[{key:'altura',label:'Altura',min:50,max:200,step:5,def:100},{key:'potencia',label:'Potencia',min:50,max:200,step:5,def:100}] },
  { id:'burst', family:'Celebracion', name:'Explosion', count:90, pal:'neon', blend:'lighter',
    params:[{key:'potencia',label:'Potencia',min:50,max:200,step:5,def:100}] },
  { id:'fountain', family:'Celebracion', name:'Fuente', count:130, pal:'fuego', blend:'lighter' },
  { id:'fire', family:'Fuego y luz', name:'Llamas (particulas)', count:130, pal:'fuego', blend:'lighter' },
  { id:'fireDoom', family:'Fuego y luz', name:'Fuego real (DOOM)', count:36, pal:'fuego', blend:'lighter',
    params:[{key:'intensidad',label:'Intensidad del fuego',min:10,max:36,step:1,def:32},
            {key:'pasos',label:'Velocidad de llama',min:6,max:40,step:1,def:18},
            {key:'glow',label:'Resplandor (bloom)',min:4,max:40,step:1,def:22}] },
  { id:'embers', family:'Fuego y luz', name:'Ascuas', count:90, pal:'fuego', blend:'lighter' },
  { id:'smoke', family:'Fuego y luz', name:'Humo', count:60, pal:'metal', blend:'normal' },
  { id:'magic', family:'Fuego y luz', name:'Polvo magico', count:150, pal:'neon', blend:'lighter',
    params:[{key:'torbellino',label:'Torbellino',min:50,max:250,step:5,def:100}] },
  { id:'sparkles', family:'Fuego y luz', name:'Destellos', count:80, pal:'noche', blend:'lighter' },
  { id:'snow', family:'Naturaleza', name:'Nieve', count:220, pal:'noche', blend:'normal' },
  { id:'rain', family:'Naturaleza', name:'Lluvia', count:170, pal:'noche', blend:'normal' },
  { id:'leaves', family:'Naturaleza', name:'Hojas', count:45, pal:'naturaleza', blend:'normal' },
  { id:'bubbles', family:'Naturaleza', name:'Burbujas', count:60, pal:'pastel', blend:'normal' },
  { id:'starfield', family:'Espacio', name:'Campo de estrellas', count:160, pal:'noche', blend:'lighter' },
  { id:'galaxy', family:'Espacio', name:'Galaxia', count:360, pal:'noche', blend:'lighter',
    params:[{key:'vel',label:'Velocidad orbital',min:50,max:250,step:5,def:100}] },
  { id:'bokeh', family:'Espacio', name:'Bokeh', count:16, pal:'pastel', blend:'screen' },
  { id:'meteoros', family:'Espacio', name:'Meteoros', count:22, pal:'noche', blend:'lighter' },
  { id:'warp', family:'Espacio', name:'Viaje warp', count:220, pal:'noche', blend:'lighter' },
  { id:'aurora', family:'Espacio', name:'Aurora boreal', count:5, pal:'noche', blend:'screen' },
  { id:'cometas', family:'Espacio', name:'Cometas', count:6, pal:'noche', blend:'lighter' },
  { id:'rayos', family:'Fuego y luz', name:'Rayos', count:120, pal:'noche', blend:'lighter',
    params:[{key:'fuerza',label:'Fuerza',min:50,max:200,step:5,def:100}] },
  { id:'polen', family:'Naturaleza', name:'Polen', count:70, pal:'oro', blend:'lighter' },
  { id:'luciernagas', family:'Naturaleza', name:'Luciernagas', count:24, pal:'naturaleza', blend:'lighter' },
  { id:'niebla', family:'Naturaleza', name:'Niebla', count:26, pal:'viento', blend:'screen' },
  { id:'serpentinas', family:'Celebracion', name:'Serpentinas', count:26, pal:'fiesta', blend:'normal' },
  { id:'glitter', family:'Celebracion', name:'Glitter', count:80, pal:'fiesta', blend:'lighter' },
  { id:'gotas', family:'Agua', name:'Gotas con ondas', count:90, pal:'agua', blend:'normal' },
  { id:'ondas', family:'Agua', name:'Ondas', count:40, pal:'agua', blend:'normal' },
  { id:'salpicaduras', family:'Agua', name:'Salpicaduras', count:120, pal:'agua', blend:'normal' },
  { id:'vapor', family:'Agua', name:'Vapor', count:70, pal:'agua', blend:'normal' },
  { id:'espuma', family:'Agua', name:'Espuma', count:60, pal:'agua', blend:'normal' },
  { id:'rafagas', family:'Viento', name:'Rafagas', count:60, pal:'viento', blend:'normal' },
  { id:'torbellino', family:'Viento', name:'Torbellino', count:260, pal:'metal', blend:'normal',
    params:[{key:'fuerza',label:'Fuerza',min:50,max:200,step:5,def:100}] },
  { id:'remolino', family:'Viento', name:'Remolino', count:120, pal:'noche', blend:'lighter',
    params:[{key:'giro',label:'Giro',min:50,max:250,step:5,def:100}] },
  { id:'plumas', family:'Viento', name:'Plumas', count:30, pal:'viento', blend:'normal' },
  { id:'petalos', family:'Viento', name:'Petalos', count:50, pal:'candy', blend:'normal' },
  { id:'polvo', family:'Viento', name:'Polvo en el viento', count:160, pal:'viento', blend:'normal' },
  { id:'arena', family:'Viento', name:'Tormenta de arena', count:340, pal:'oro', blend:'normal' },
  { id:'lava', family:'Pixel FX', name:'Lava', count:36, pal:'fuego', blend:'lighter',
    params:[{key:'intensidad',label:'Intensidad',min:10,max:36,step:1,def:32},{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:20}] },
  { id:'humo', family:'Pixel FX', name:'Humo pixel', count:24, pal:'metal', blend:'normal',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:8}] },
  { id:'agua', family:'Pixel FX', name:'Cascada pixel', count:30, pal:'agua', blend:'normal',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:10}] },
  { id:'arena2', family:'Pixel FX', name:'Arena pixel', count:34, pal:'oro', blend:'normal',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14}] },
  { id:'lluvia2', family:'Pixel FX', name:'Lluvia pixel', count:30, pal:'noche', blend:'normal',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14}] },
  { id:'matrix', family:'Pixel FX', name:'Matrix', count:30, pal:'naturaleza', blend:'lighter',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:10}] },
  { id:'tinta', family:'Pixel FX', name:'Tinta', count:30, pal:'noche', blend:'normal',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14}] },
  { id:'ondasPx', family:'Pixel FX', name:'Ondas pixel', count:30, pal:'agua', blend:'lighter',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:8}] },
  { id:'estatica', family:'Pixel FX', name:'Estatica TV', count:24, pal:'metal', blend:'normal',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14}] },
  { id:'vida', family:'Pixel FX', name:'Juego de la vida', count:35, pal:'neon', blend:'lighter',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:8}] },
  { id:'viento', family:'Pixel FX', name:'Viento pixel', count:20, pal:'viento', blend:'normal',
    params:[{key:'pasos',label:'Velocidad',min:6,max:40,step:1,def:14}] },
  { id:'plasma', family:'Pixel FX', name:'Plasma', count:34, pal:'neon', blend:'normal',
    params:[{key:'vel',label:'Velocidad',min:50,max:250,step:5,def:100},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:12}] },
  { id:'auroraPx', family:'Pixel FX', name:'Aurora pixel', count:28, pal:'noche', blend:'screen',
    params:[{key:'vel',label:'Velocidad',min:50,max:250,step:5,def:100},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:14}] },
  { id:'nieblaPx', family:'Pixel FX', name:'Niebla pixel', count:28, pal:'viento', blend:'screen',
    params:[{key:'vel',label:'Velocidad',min:50,max:250,step:5,def:100}] },
  { id:'nebula', family:'Pixel FX', name:'Nebulosa pixel', count:30, pal:'candy', blend:'screen',
    params:[{key:'vel',label:'Velocidad',min:50,max:250,step:5,def:100},{key:'glow',label:'Resplandor',min:4,max:40,step:1,def:16}] },
];
const PRESET_BY_ID={};
PRESETS.forEach(p=>PRESET_BY_ID[p.id]=p);

const DEFAULT_STATE={
  preset:'fireworks', count:8, size:100, speed:100, grav:100, wind:0, turb:100, life:100, opacity:100,
  palette:'fiesta', custom:['#ff2d55','#ffdd00','#00e5ff','#7cff00','#d500ff'],
  emitter:'screen', blend:'lighter', bgOn:true, bg:'#0d0d1a',
  seed:1234, trail:false, loop:true, duration:4, pixelate:false, pixelSize:4,
  time:0, playing:true, pp:{}
};
const APP_VERSION='2.1';
let state=Object.assign({},DEFAULT_STATE,{pp:{},custom:[].concat(DEFAULT_STATE.custom)});

const SYS=[];
let lastSig='';

function currentPal(){
  return state.palette==='custom' ? state.custom : (PALETTES[state.palette]||PALETTES.fiesta);
}

function simSig(){
  return [state.preset,state.count,state.size,state.speed,state.grav,state.wind,state.turb,state.life,
          state.palette,state.custom.join(','),state.emitter,state.seed,state.duration,
          JSON.stringify(state.pp[state.preset]||{})].join('|');
}

function emPos(){
  switch(state.emitter){
    case 'center': return {x:W/2,y:H/2};
    case 'top': return {x:W/2,y:30};
    case 'bottom': return {x:W/2,y:H-30};
    default: return {x:W/2,y:H/2};
  }
}

function buildSim(){
  SYS.length=0;
  const S=state;
  const pal=currentPal();
  const T=Math.max(0.5,S.duration);
  const rng=mulberry32((S.seed*2654435761)|0);
  const spd=S.speed/100, siz=S.size/100, life=S.life/100, grav=S.grav/100, turb=S.turb/100;
  const P=S.pp[S.preset]||{};
  const rnd=(a,b)=>a+rng()*(b-a);
  const n=clamp(Math.round(S.count),4,800);
  const ci=()=>Math.floor(rng()*pal.length);
  const e=emPos();
  const pr=PRESET_BY_ID[S.preset]||PRESETS[0];
  const pget=(k,d)=>P[k]!==undefined?P[k]:d;
  const O=pr.over||{};
  const R=(k,d)=>O[k]!==undefined?O[k]:d;

  switch(pr.base||pr.id){
    case 'fireDoom':
      break;
    case 'confetti':
      for(let i=0;i<n;i++){
        const d=(R('lifeMin',2.4)+rnd(0,R('lifeVar',1.6)))*life;
        SYS.push({t:'conf',b:rng()*T,cyc:d,d:d,
          x0:rnd(0,W),y0:rnd(-H,-40),
          vy:rnd(R('vyMin',50),R('vyMax',150))*spd,vx:rnd(-55,55)*spd,
          g:rnd(R('gMin',240),R('gMax',420))*grav,dr:rnd(0.7,1.1),
          rot:rnd(0,TAU),vr:rnd(-6,6)*spd,
          fl:rnd(R('flMin',15),R('flMax',55))*turb,sf:rnd(2,6),ph:rnd(0,TAU),
          s:rnd(R('sMin',5),R('sMax',12))*siz,ci:ci(),wc:0.6});
      }
      break;
    case 'fireworks':{
      const rockN=Math.max(2,Math.min(R('rockMax',30),Math.round(n)));
      const alt=pget('altura',100)/100, pot=pget('potencia',100)/100;
      for(let i=0;i<rockN;i++){
        const b=rng()*T;
        const x0=rnd(W*0.12,W*0.88);
        const y0=H-rnd(0,20);
        const vy=-rnd(R('vyMin',430),R('vyMax',620))*spd*alt;
        const vx=rnd(-55,55);
        const g=rnd(300,360)*grav;
        const te=clamp(-vy/g,0.3,1.6);
        const xe=x0+vx*te, ye=y0+vy*te+0.5*g*te*te;
        SYS.push({t:'rocket',b:b,cyc:T,d:te+0.05,x0:x0,y0:y0,vx:vx,vy:vy,g:g,te:te});
        const sn=Math.round(rnd(R('snMin',60),R('snMax',110)));
        for(let j=0;j<sn;j++){
          SYS.push({t:'spark',b:b+te,cyc:T,d:rnd(R('spLifeMin',0.9),R('spLifeMax',1.8))*life,
            xe:xe,ye:ye,a:rng()*TAU,sp:rnd(R('spMin',60),R('spMax',320))*pot,dr:rnd(0.7,1.1),g:rnd(110,170)*grav,
            s:rnd(R('sMin',1.6),R('sMax',3))*siz,ci:ci(),ph:rnd(0,TAU),tr:true});
        }
        SYS.push({t:'flash',b:b+te,cyc:T,d:0.4,x:xe,y:ye,s:rnd(70,130)*siz,color:'#ffdf8a'});
      }
      break;
    }
    case 'burst':{
      const pot=pget('potencia',100)/100;
      for(let i=0;i<n;i++){
        SYS.push({t:'burst',b:rnd(0,0.35),cyc:T,d:rnd(1.1,2.2)*life,
          xe:e.x,ye:e.y,a:rng()*TAU,sp:rnd(160,620)*pot,dr:rnd(1.8,2.6),g:rnd(120,220)*grav,
          s:rnd(3,8)*siz,ci:ci(),tr:true});
      }
      break;
    }
    case 'fountain':
      for(let i=0;i<n;i++){
        const d=rnd(0.9,1.7)*life;
        SYS.push({t:'fount',b:rng()*T,cyc:d,d:d,
          x0:e.x+rnd(-34,34),y0:e.y+rnd(-6,6),
          vy:-rnd(R('vyMin',280),R('vyMax',470))*spd,vx:rnd(-90,90)*spd,
          g:rnd(430,560)*grav,dr:rnd(0.5,0.9),
          s:rnd(R('sMin',1.8),R('sMax',3.6))*siz,ciN:pal.length,ph:rnd(0,TAU),wc:0.8,tr:true});
      }
      break;
    case 'fire':{
      const src=S.emitter==='screen'?{x:W/2,y:H-10}:e;
      const mkSw=()=>[
        [rnd(24,58)*turb,rnd(1.4,2.4),rnd(0,TAU)],
        [rnd(16,38)*turb,rnd(3.2,4.8),rnd(0,TAU)],
        [rnd(6,18)*turb,rnd(6,9),rnd(0,TAU)]
      ];
      const fN=Math.round(n*0.55), cN=Math.round(n*0.28), sN=Math.round(n*0.22);
      for(let i=0;i<fN;i++){
        const d=rnd(0.8,1.9)*life;
        SYS.push({t:'flame',b:rng()*T,cyc:d,d:d,
          x0:src.x+rnd(-200,200),y0:src.y+rnd(-6,10),
          vy:-rnd(95,220)*spd,g:rnd(130,230)*grav,dr:rnd(1.2,1.9),
          sw:mkSw(),s:rnd(13,30)*siz,wc:0.4,tr:true});
      }
      for(let i=0;i<cN;i++){
        const d=rnd(0.3,0.9)*life;
        SYS.push({t:'core',b:rng()*T,cyc:d,d:d,
          x0:src.x+rnd(-90,90),y0:src.y+rnd(-4,4),
          vy:-rnd(30,90)*spd,g:rnd(90,150)*grav,dr:rnd(1.6,2.4),
          sw:mkSw(),s:rnd(5,11)*siz,color:rng()<0.7?'#ffffff':'#bfe3ff',wc:0.3});
      }
      for(let i=0;i<sN;i++){
        const d=rnd(0.5,1.3)*life;
        SYS.push({t:'fspark',b:rng()*T,cyc:d,d:d,
          x0:src.x+rnd(-140,140),y0:src.y+rnd(-8,6),
          vy:-rnd(90,240)*spd,vx:rnd(-140,140)*spd,
          g:rnd(280,520)*grav,dr:rnd(1.2,2),
          sw:[[rnd(6,20)*turb,rnd(2,4),rnd(0,TAU)]],
          s:rnd(1.6,3.8)*siz,fw:rnd(8,22),ph:rnd(0,TAU),wc:0.5,tr:true});
      }
      break;
    }
    case 'embers':
      for(let i=0;i<n;i++){
        const d=rnd(1.4,2.8)*life;
        SYS.push({t:'ember',b:rng()*T,cyc:d,d:d,
          x0:rnd(W*0.08,W*0.92),y0:H-rnd(0,14),
          vy:-rnd(R('vyMin',40),R('vyMax',110))*spd,vx:rnd(-20,20)*spd,
          g:rnd(20,60)*grav,dr:rnd(0.8,1.3),
          sw:[[rnd(16,46)*turb,rnd(1.6,3),rnd(0,TAU)],[rnd(8,26)*turb,rnd(3.5,6),rnd(0,TAU)]],
          s:rnd(R('sMin',2.2),R('sMax',6))*siz,ph:rnd(0,TAU),wc:0.7,tr:true});
      }
      break;
    case 'smoke':
      for(let i=0;i<n;i++){
        const d=rnd(2.6,4.6)*life;
        SYS.push({t:'smoke',b:rng()*T,cyc:d,d:d,
          x0:rnd(W*0.28,W*0.72),y0:H-rnd(0,12),
          vy:-rnd(26,64)*spd,vx:rnd(-8,8)*spd,
          sw:[[rnd(10,30)*turb,rnd(0.8,1.6),rnd(0,TAU)],[rnd(6,20)*turb,rnd(2.2,3.6),rnd(0,TAU)]],
          s:rnd(15,36)*siz,a0:rnd(0.35,0.55),color:RAMP_SMOKE[Math.floor(rng()*3)],wc:1});
      }
      break;
    case 'magic':{
      const tor=pget('torbellino',100)/100;
      for(let i=0;i<n;i++){
        const d=rnd(2.5,5)*life;
        SYS.push({t:'magic',b:rng()*T,cyc:d,d:d,
          cx:e.x,cy:e.y,a0:rng()*TAU,
          w:(rng()<0.5?-1:1)*rnd(R('wMin',0.5),R('wMax',2.2))*spd*tor,
          r0:rnd(R('rMin',40),R('rMax',300)),ph:rnd(0,TAU),
          s:rnd(R('sMin',1.8),R('sMax',5.5))*siz,ci:ci(),tr:true});
      }
      break;
    }
    case 'sparkles':
      for(let i=0;i<n;i++){
        const d=rnd(1.5,4)*life;
        const s2=rnd(R('sMin',1.2),R('sMax',4.6))*siz;
        SYS.push({t:'sparkle',b:rng()*T,cyc:d,d:d,
          x0:rnd(20,W-20),y0:rnd(20,H-20),
          w:rnd(R('wMin',1.5),R('wMax',5)),ph:rnd(0,TAU),s:s2,cr:s2>2.4,ci:ci()});
      }
      break;
    case 'snow':
      for(let i=0;i<n;i++){
        const vy=rnd(R('vyMin',45),R('vyMax',95))*spd;
        const d=((H+90)/vy)*life;
        SYS.push({t:'snow',b:rng()*T,cyc:d,d:d,
          x0:rnd(0,W),y0:rnd(-H,0),vy:vy,vx:rnd(R('vxMin',-14),R('vxMax',14))*spd,
          sway:rnd(14,44)*turb,sf:rnd(1,2.6),ph:rnd(0,TAU),
          s:rnd(R('sMin',2),R('sMax',5.5))*siz,a0:rnd(R('aMin',0.6),R('aMax',1)),ci:ci(),wc:1});
      }
      break;
    case 'rain':
      for(let i=0;i<n;i++){
        const vy=rnd(R('vyMin',560),R('vyMax',900))*spd;
        const d=((H+120)/vy)*life;
        SYS.push({t:'rain',b:rng()*T,cyc:d,d:d,
          x0:rnd(0,W),y0:rnd(-H,0),vy:vy,vx:rnd(R('vxMin',-26),R('vxMax',-4))*spd,
          s:rnd(R('sMin',1),R('sMax',2.2))*siz,a0:rnd(R('aMin',0.2),R('aMax',0.38)),ci:ci(),wc:1});
      }
      break;
    case 'leaves':
      for(let i=0;i<n;i++){
        const vy=rnd(45,85)*spd;
        const d=((H+90)/vy)*life;
        SYS.push({t:'leaf',b:rng()*T,cyc:d,d:d,
          x0:rnd(0,W),y0:rnd(-H,0),vy:vy,vx:rnd(-18,18)*spd,
          sway:rnd(24,60)*turb,sf:rnd(0.8,1.8),ph:rnd(0,TAU),
          rot:rnd(0,TAU),vr:rnd(-2.4,2.4)*spd,
          s:rnd(7,15)*siz,ci:ci(),wc:1});
      }
      break;
    case 'bubbles':
      for(let i=0;i<n;i++){
        const d=rnd(R('lifeMin',3),R('lifeMax',6))*life;
        SYS.push({t:'bubble',b:rng()*T,cyc:d,d:d,
          x0:rnd(30,W-30),y0:rnd(H*0.2,H),vy:rnd(R('vyMin',40),R('vyMax',90))*spd,
          sway:rnd(14,40)*turb,sf:rnd(0.8,1.8),ph:rnd(0,TAU),
          s:rnd(R('sMin',4),R('sMax',22))*siz,a0:rnd(R('aMin',0.3),R('aMax',0.65)),ci:ci(),wc:0.7});
      }
      break;
    case 'starfield':
      for(let i=0;i<n;i++){
        const d=rnd(2,5)*life;
        const sp=rnd(R('spMin',90),R('spMax',600))*spd;
        SYS.push({t:'star',b:rng()*T,cyc:d,d:d,
          x0:rnd(0,W+160),y0:rnd(0,H),
          sp:sp,sl:sp*0.05+1,w:rnd(2,7),ph:rnd(0,TAU),
          s:rnd(R('sMin',1),R('sMax',2.6))*siz,ci:ci()});
      }
      break;
    case 'galaxy':{
      const vel=pget('vel',100)/100;
      const nebN=Math.min(14,Math.max(5,Math.round(n*0.04)));
      for(let i=0;i<nebN;i++){
        const d=rnd(5,9)*life;
        const r0=rnd(8,110);
        SYS.push({t:'nebula',b:rng()*T,cyc:d,d:d,
          cx:e.x,cy:e.y,ang:rng()*TAU,r0:r0,
          w:(0.5/Math.pow(Math.max(20,r0),0.5))*spd*vel*(rng()<0.5?-1:1),
          a0:rnd(0.06,0.13),s:rnd(90,220)*siz,ci:ci(),ph:rnd(0,TAU)});
      }
      SYS.push({t:'galcore',b:0,cyc:T,d:T,cx:e.x,cy:e.y,a0:0.3,s:150*siz,color:'#e8dcff',ph:rnd(0,TAU)});
      const bgN=Math.min(300,Math.round(n*0.75));
      for(let i=0;i<bgN;i++){
        const d=rnd(4,9)*life;
        SYS.push({t:'bgstar',b:rng()*T,cyc:d,d:d,
          x0:rnd(0,W),y0:rnd(0,H),s:rnd(0.7,2)*siz,w:rnd(1.5,4),ph:rnd(0,TAU),ci:ci()});
      }
      const starN=Math.max(40,n-nebN-1-bgN);
      const arms=3;
      const armBase=rng()*TAU;
      for(let i=0;i<starN;i++){
        const d=rnd(4,8)*life;
        const isBulge=rng()<0.28;
        const r0=isBulge?rnd(4,60):rnd(18,270);
        const armIdx=Math.floor(rng()*arms);
        const armA=armBase+armIdx*(TAU/arms);
        const spiralA=armA+r0*0.022;
        const jitter=isBulge?rng()*TAU:(rng()-0.5)*1.1*(r0/270);
        SYS.push({t:'gal',b:rng()*T,cyc:d,d:d,
          cx:e.x,cy:e.y,a0:spiralA+jitter,r0:r0,
          w:(1.4/Math.pow(Math.max(12,r0),0.6))*spd*vel*0.9,
          tw:rnd(2,6),ph:rnd(0,TAU),s:rnd(0.8,2.6)*siz,ci:ci()});
      }
      break;
    }
    case 'bokeh':
      for(let i=0;i<n;i++){
        const d=rnd(4,8)*life;
        SYS.push({t:'bokeh',b:rng()*T,cyc:d,d:d,
          x0:rnd(-40,W+40),y0:rnd(H*0.3,H+40),
          vx:rnd(-12,12)*spd,vy:-rnd(8,26)*spd,
          s:rnd(36,110)*siz,a0:rnd(0.05,0.13),ci:ci(),ph:rnd(0,TAU)});
      }
      break;
    case 'gotas':
      for(let i=0;i<n;i++){
        const x0=rnd(40,W-40), y0=rnd(-400,-40);
        const vy=rnd(120,220)*spd, g=rnd(900,1200)*grav;
        const fall=(-vy+Math.sqrt(vy*vy+2*g*(H-20-y0)))/g;
        const d=fall+0.15;
        const b=rng()*T;
        SYS.push({t:'drop',b:b,cyc:d,d:d,x0:x0,y0:y0,vy:vy,g:g,
          s:rnd(2,4.5)*siz,ci:ci(),wc:0.4});
        SYS.push({t:'ripple',b:b+fall,cyc:d,d:rnd(0.9,1.4),
          x0:x0,s:rnd(18,46)*siz,v:rnd(50,120),ci:ci(),surf:H-20});
      }
      break;
    case 'ondas':
      for(let i=0;i<n;i++){
        SYS.push({t:'ripple',b:rng()*T,cyc:T,d:rnd(1.4,2.4),
          x0:rnd(100,W-100),s:rnd(10,40)*siz,v:rnd(60,160),ci:ci(),surf:H-20});
      }
      break;
    case 'salpicaduras':
      for(let i=0;i<n;i++){
        const vy=rnd(250,520)*spd, g=rnd(700,900)*grav;
        const d=2*vy/g+0.15;
        SYS.push({t:'sdrop',b:rng()*T,cyc:d,d:d,
          x0:rnd(W*0.15,W*0.85),y0:H-10,vy:-vy,vx:rnd(-160,160)*spd,g:g,
          s:rnd(2,5)*siz,ci:ci(),wc:0.4});
      }
      break;
    case 'vapor':
      for(let i=0;i<n;i++){
        const d=rnd(1.6,3)*life;
        SYS.push({t:'vapor',b:rng()*T,cyc:d,d:d,
          x0:rnd(W*0.3,W*0.7),y0:H-rnd(0,12),
          vy:-rnd(40,90)*spd,vx:rnd(-10,10)*spd,
          sw:[[rnd(12,34)*turb,rnd(1,2),rnd(0,TAU)],[rnd(8,24)*turb,rnd(2.4,4),rnd(0,TAU)],[rnd(4,14)*turb,rnd(5,8),rnd(0,TAU)]],
          s:rnd(20,50)*siz,a0:rnd(0.25,0.45),ci:ci(),wc:1});
      }
      break;
    case 'espuma':
      for(let i=0;i<n;i++){
        const d=rnd(2.5,5)*life;
        SYS.push({t:'foam',b:rng()*T,cyc:d,d:d,
          x0:rnd(20,W-20),y0:rnd(H-34,H-6),
          vy:rnd(10,30)*spd,sway:rnd(8,22)*turb,sf:rnd(0.8,1.8),ph:rnd(0,TAU),
          s:rnd(8,26)*siz,a0:rnd(0.3,0.55),ci:ci(),wc:0.7});
      }
      break;
    case 'rafagas':
      for(let i=0;i<n;i++){
        const vx=rnd(R('vxMin',400),R('vxMax',900))*spd;
        const d=((W+700)/vx);
        SYS.push({t:'gust',b:rng()*T,cyc:d,d:d,
          x0:rnd(-300,0),y0:rnd(H*0.1,H*0.9),vx:vx,
          len:rnd(R('lenMin',90),R('lenMax',220))*siz,amp:rnd(R('ampMin',10),R('ampMax',30))*turb,sf:rnd(6,12),ph:rnd(0,TAU),
          s:rnd(1.2,2.6)*siz,a0:rnd(0.35,0.6),ci:ci()});
      }
      break;
    case 'torbellino':{
      const fuerza=pget('fuerza',100)/100;
      for(let i=0;i<n;i++){
        const d=rnd(4,8)*life;
        SYS.push({t:'torn',b:rng()*T,cyc:d,d:d,
          cx:W/2+rnd(-30,30),h0:rnd(0,H),vr:rnd(90,150)*spd*fuerza,
          r0:rnd(2,10),k:rnd(0.12,0.22),swirl:rnd(0.012,0.03),
          a0:rnd(0,TAU),spin:rnd(0.4,1)*spd*fuerza,
          s:rnd(2,6)*siz,ci:ci()});
      }
      break;
    }
    case 'remolino':{
      const giro=pget('giro',100)/100;
      const e2=S.emitter==='screen'?{x:W/2,y:H-30}:e;
      for(let i=0;i<n;i++){
        const d=rnd(2.5,5)*life;
        const r0=rnd(6,240);
        SYS.push({t:'swirl',b:rng()*T,cyc:d,d:d,
          cx:e2.x,gy:e2.y,r0:r0,
          vr:-(r0*0.4+rnd(50,90))*spd,
          w:rnd(3,6)*spd*giro*giro,a0:rnd(0,TAU),
          s:rnd(2,4.5)*siz,ci:ci()});
      }
      break;
    }
    case 'plumas':
      for(let i=0;i<n;i++){
        const d=rnd(5,9)*life;
        SYS.push({t:'feather',b:rng()*T,cyc:d,d:d,
          x0:rnd(60,W-60),y0:rnd(-300,-20),vy:rnd(25,60)*spd,vx:rnd(-30,30)*spd,
          sway:rnd(40,90)*turb,sf:rnd(0.5,1.2),ph:rnd(0,TAU),
          rot:rnd(0,TAU),vr:rnd(-0.8,0.8)*spd,
          s:rnd(14,26)*siz,ci:ci(),wc:1.5});
      }
      break;
    case 'petalos':
      for(let i=0;i<n;i++){
        const d=rnd(4.5,8)*life;
        SYS.push({t:'petal',b:rng()*T,cyc:d,d:d,
          x0:rnd(30,W-30),y0:rnd(-300,-20),vy:rnd(30,70)*spd,vx:rnd(-20,20)*spd,
          sway:rnd(30,70)*turb,sf:rnd(0.7,1.5),ph:rnd(0,TAU),
          rot:rnd(0,TAU),vr:rnd(-2.4,2.4)*spd,
          s:rnd(10,20)*siz,ci:ci(),wc:1.2});
      }
      break;
    case 'polvo':
      for(let i=0;i<n;i++){
        const vx=rnd(R('vxMin',200),R('vxMax',500))*spd;
        const d=((W+500)/vx);
        SYS.push({t:'dust',b:rng()*T,cyc:d,d:d,
          x0:rnd(-250,0),y0:rnd(H*0.08,H*0.95),vx:vx,
          len:rnd(R('lenMin',20),R('lenMax',60))*siz,amp:rnd(6,18)*turb,sf:rnd(4,10),ph:rnd(0,TAU),
          s:rnd(R('sMin',1),R('sMax',2.5))*siz,a0:rnd(R('aMin',0.15),R('aMax',0.35)),ci:ci()});
      }
      break;
    case 'arena':
      for(let i=0;i<n;i++){
        const vx=rnd(200,600)*spd;
        const d=((W+400)/vx);
        const air=rng()<0.75;
        SYS.push({t:'sand',b:rng()*T,cyc:d,d:d,
          x0:rnd(-200,0),vx:vx,
          y0:air?rnd(H*0.04,H-14):H-6,
          vy:air?rnd(-26,12)*spd:0,
          f:rnd(6,14),ph:rnd(0,TAU),sway:air?rnd(6,26):0,
          s:rnd(1.5,3.5)*siz,ci:ci(),air:air});
      }
      break;
    case 'polen':
      for(let i=0;i<n;i++){
        const d=rnd(3,6)*life;
        SYS.push({t:'pollen',b:rng()*T,cyc:d,d:d,
          x0:rnd(20,W-20),y0:rnd(20,H-20),
          a1:rnd(30,90),f1:rnd(0.3,0.8),a2:rnd(20,60),f2:rnd(0.4,1),
          ph:rnd(0,TAU),ph2:rnd(0,TAU),w:rnd(2,5),
          s:rnd(1.5,4)*siz,ci:ci(),wc:2});
      }
      break;
    case 'luciernagas':
      for(let i=0;i<n;i++){
        const d=rnd(5,9)*life;
        SYS.push({t:'firefly',b:rng()*T,cyc:d,d:d,
          x0:rnd(60,W-60),y0:rnd(H*0.3,H*0.9),
          a1:rnd(50,120),f1:rnd(0.2,0.5),a2:rnd(40,100),f2:rnd(0.3,0.7),
          ph:rnd(0,TAU),ph2:rnd(0,TAU),ph3:rnd(0,TAU),
          s:rnd(2.5,5)*siz,wc:1});
      }
      break;
    case 'niebla':
      for(let i=0;i<n;i++){
        const vx=rnd(R('vxMin',8),R('vxMax',26))*spd;
        const d=((W+700)/vx);
        SYS.push({t:'fog',b:rng()*T,cyc:d,d:d,
          x0:rnd(-400,0),y0:rnd(R('yMin',H*0.45),R('yMax',H*0.9)),vx:vx,
          s:rnd(R('sMin',160),R('sMax',320))*siz,a0:rnd(R('aMin',0.05),R('aMax',0.12)),ph:rnd(0,TAU)});
      }
      break;
    case 'serpentinas':
      for(let i=0;i<n;i++){
        const d=rnd(5,9)*life;
        SYS.push({t:'streamer',b:rng()*T,cyc:d,d:d,
          x0:rnd(60,W-60),y0:rnd(-400,-40),vy:rnd(40,90)*spd,
          sway:rnd(30,60)*turb,sf:rnd(1,2),ph:rnd(0,TAU),
          s:rnd(60,120)*siz,ci:ci(),wc:0.8});
      }
      break;
    case 'glitter':
      for(let i=0;i<n;i++){
        const d=rnd(3,6)*life;
        SYS.push({t:'glitter',b:rng()*T,cyc:d,d:d,
          x0:rnd(30,W-30),y0:rnd(-200,-20),vy:rnd(R('vyMin',20),R('vyMax',55))*spd,
          sway:rnd(10,26)*turb,sf:rnd(0.8,1.6),ph:rnd(0,TAU),
          w:rnd(R('wMin',6),R('wMax',14)),s:rnd(R('sMin',1.5),R('sMax',3.5))*siz,ci:ci(),wc:0.5});
      }
      break;
    case 'meteoros':
      for(let i=0;i<n;i++){
        const vx=rnd(R('vxMin',500),R('vxMax',900))*spd;
        const d=((W+400)/vx);
        SYS.push({t:'meteor',b:rng()*T,cyc:d,d:d,
          x0:rnd(-100,W),y0:rnd(-60,H*0.3),vx:vx,vy:vx*0.55,
          s:rnd(R('sMin',1.5),R('sMax',3))*siz,ci:ci(),ph:rnd(0,TAU)});
      }
      break;
    case 'warp':{
      const R=Math.hypot(W,H)/2+80;
      for(let i=0;i<n;i++){
        const d=rnd(2,4)*life;
        SYS.push({t:'warp',b:rng()*T,cyc:d,d:d,
          a:rng()*TAU,r0:rnd(0,R),v:rnd(300,900)*spd,
          k:rnd(0.35,0.8),s:rnd(1,2.5)*siz,ci:ci(),ph:rnd(0,TAU)});
      }
      SYS.push({t:'warpcore',b:0,cyc:T,d:T,s:120*siz,color:'#bfe3ff',ph:rnd(0,TAU)});
      break;
    }
    case 'aurora':
      for(let i=0;i<Math.max(3,n);i++){
        SYS.push({t:'aurora',b:0,cyc:T,d:T,
          baseY:rnd(H*0.18,H*0.5),amp:rnd(40,90),fq:rnd(0.4,0.8),ph:rnd(0,TAU),
          s:rnd(14,26),ci:ci()});
      }
      break;
    case 'cometas':
      for(let i=0;i<n;i++){
        const d=rnd(6,10)*life;
        SYS.push({t:'comet',b:rng()*T,cyc:d,d:d,
          x0:rnd(W*0.6,W*1.4),y0:rnd(60,H*0.5),vx:-rnd(40,90)*spd,vy:rnd(-10,10)*spd,
          s:rnd(10,18)*siz,ci:ci(),ph:rnd(0,TAU)});
      }
      break;
    case 'rayos':{
      const fuerza=pget('fuerza',100)/100;
      const strikeN=clamp(Math.round(n/60),1,8);
      for(let i=0;i<strikeN;i++){
        const d=rnd(0.5,0.8);
        const x0=rnd(W*0.15,W*0.85);
        const pts=[];
        let x=x0, y=-20;
        const segs=22;
        const spread=rnd(26,60)*fuerza*(state.turb/100);
        const wb=(Math.round(state.wind/50)-2)*1.5;
        for(let s2=0;s2<segs;s2++){
          pts.push([x,y]);
          y+=H/segs;
          const h1=hash32(i*101+s2*7+state.seed);
          const h2=hash32(i*213+s2*11+state.seed);
          const kink=(h1-0.5)*2*spread*(h2>0.88?2.2:0.7);
          x+=kink+(x0-x)*0.07+wb;
        }
        pts.push([x,H+10]);
        const branches=[];
        const bn=1+Math.floor(rng()*2);
        for(let bb=0;bb<bn;bb++){
          const bi=4+Math.floor(rng()*(segs-8));
          const bp=pts[bi];
          const br=[];
          let bx=bp[0], by=bp[1];
          for(let s2=0;s2<6;s2++){
            br.push([bx,by]);
            by+=H/segs*0.7;
            bx+=(hash32(i*331+bb*53+s2*17+state.seed)-0.5)*2*spread*0.8;
          }
          branches.push(br);
        }
        SYS.push({t:'bolt',b:rng()*T,cyc:T,d:d,x0:x0,pts:pts,branches:branches,
          s:rnd(2,3.2)*siz,color:pal[ci()%pal.length]});
      }
      break;
    }
  }
}

function frameP(p,tt,S,PAL){
  const k=clamp(tt/p.d,0,1);
  const windDrift=S.wind*1.2*p.wc*tt;
  switch(p.t){
    case 'conf':{
      const ex=Math.exp(-p.dr*tt);
      const y=p.y0+(p.g/p.dr)*tt+(p.vy-p.g/p.dr)*(1-ex)/p.dr;
      const x=p.x0+p.vx*tt+Math.sin(tt*p.sf+p.ph)*p.fl+windDrift;
      const rot=p.rot+p.vr*tt;
      return {x:x,y:y,a:(k>0.85?(1-k)/0.15:1),s:p.s,rot:rot,
              sy:Math.abs(Math.sin(rot))*0.55+0.45,color:PAL[p.ci%PAL.length],
              sh:clamp((H-50-y)/380,0,1)};
    }
    case 'flame':{
      const ex=Math.exp(-p.dr*tt);
      const vt=p.g/p.dr;
      const y=p.y0+vt*tt+(p.vy-vt)*(1-ex)/p.dr;
      const x=p.x0+swX(p,tt)*(1-k*0.5)+windDrift;
      return {x:x,y:y,a:Math.pow(1-k,1.4)*0.5,s:p.s*(1-k*0.82),rot:0,color:rampAt(RAMP_FIRE,k),tr:true};
    }
    case 'core':{
      const ex=Math.exp(-p.dr*tt);
      const vt=p.g/p.dr;
      const y=p.y0+vt*tt+(p.vy-vt)*(1-ex)/p.dr;
      const x=p.x0+swX(p,tt)*(1-k*0.6)+windDrift;
      return {x:x,y:y,a:Math.pow(1-k,1.2)*0.85,s:p.s*(1-k*0.6),rot:0,color:p.color};
    }
    case 'fspark':{
      const ex=Math.exp(-p.dr*tt);
      const vt=p.g/p.dr;
      const y=p.y0+vt*tt+(p.vy-vt)*(1-ex)/p.dr;
      const x=p.x0+p.vx*tt+swX(p,tt)*(1-k*0.4)+windDrift;
      return {x:x,y:y,a:(1-k)*(0.5+0.5*Math.sin(tt*p.fw+p.ph)),s:p.s*(1-k*0.5),rot:0,color:rampAt(RAMP_FIRE,k),tr:true};
    }
    case 'ember':{
      const ex=Math.exp(-p.dr*tt);
      const vt=p.g/p.dr;
      const y=p.y0+vt*tt+(p.vy-vt)*(1-ex)/p.dr;
      const x=p.x0+p.vx*tt+swX(p,tt)+windDrift;
      const fl=0.5+0.5*Math.sin(tt*14+p.ph);
      return {x:x,y:y,a:fl*(1-k),s:p.s*(1-k*0.45),rot:0,color:rampAt(RAMP_EMBER,k),tr:true};
    }
    case 'smoke':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+p.vx*tt+swX(p,tt)*(0.4+tt*0.8)+windDrift;
      return {x:x,y:y,a:Math.pow(1-k,1.8)*p.a0,s:p.s*(0.45+1.9*k),rot:tt*0.3,color:p.color};
    }
    case 'snow':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+p.vx*tt+Math.sin(tt*p.sf+p.ph)*p.sway+windDrift;
      return {x:x,y:y,a:p.a0*(0.85+0.15*Math.sin(tt*3+p.ph)),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'rain':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+p.vx*tt+windDrift;
      return {x:x,y:y,x2:x-(p.vx+S.wind*1.2*p.wc)*0.045,y2:y-p.vy*0.05,
              a:p.a0,s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'leaf':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+p.vx*tt+Math.sin(tt*p.sf+p.ph)*p.sway+windDrift;
      const rot=p.rot+p.vr*tt;
      return {x:x,y:y,a:(k>0.9?(1-k)/0.1:1),s:p.s,rot:rot,
              sy:Math.abs(Math.cos(tt*1.4+p.ph))*0.55+0.45,color:PAL[p.ci%PAL.length]};
    }
    case 'bubble':{
      const y=p.y0-p.vy*tt;
      const x=p.x0+Math.sin(tt*p.sf+p.ph)*p.sway+windDrift;
      return {x:x,y:y,a:p.a0*(1-k*0.4),s:p.s*(1+0.22*Math.sin(tt*3+p.ph)),rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'rocket':{
      if(tt>p.te)return null;
      const tt2=Math.max(0,tt-0.09);
      const x=p.x0+p.vx*tt;
      const y=p.y0+p.vy*tt+0.5*p.g*tt*tt;
      const px=p.x0+p.vx*tt2;
      const py=p.y0+p.vy*tt2+0.5*p.g*tt2*tt2;
      return {x:x,y:y,px:px,py:py,a:1,s:3.5,rot:0,color:'#ffdf8a',tr:true};
    }
    case 'spark':{
      const r=p.sp*damp(tt,p.dr);
      const x=p.xe+Math.cos(p.a)*r;
      const y=p.ye+Math.sin(p.a)*r+0.5*p.g*tt*tt;
      const tt2=Math.max(0,tt-0.05);
      const r2=p.sp*damp(tt2,p.dr);
      const px=p.xe+Math.cos(p.a)*r2;
      const py=p.ye+Math.sin(p.a)*r2+0.5*p.g*tt2*tt2;
      return {x:x,y:y,px:px,py:py,a:(1-k)*(0.7+0.3*Math.sin(tt*9+p.ph)),s:p.s,rot:0,color:PAL[p.ci%PAL.length],tr:true};
    }
    case 'burst':{
      const r=p.sp*damp(tt,p.dr);
      const x=p.xe+Math.cos(p.a)*r;
      const y=p.ye+Math.sin(p.a)*r+0.5*p.g*tt*tt;
      const tt2=Math.max(0,tt-0.05);
      const r2=p.sp*damp(tt2,p.dr);
      const px=p.xe+Math.cos(p.a)*r2;
      const py=p.ye+Math.sin(p.a)*r2+0.5*p.g*tt2*tt2;
      return {x:x,y:y,px:px,py:py,a:1-k,s:p.s*(1-k*0.7),rot:0,color:PAL[p.ci%PAL.length],tr:true};
    }
    case 'fount':{
      const ex=Math.exp(-p.dr*tt);
      const vt=p.g/p.dr;
      const y=p.y0+vt*tt+(p.vy-vt)*(1-ex)/p.dr;
      const x=p.x0+p.vx*tt+windDrift;
      const tt2=Math.max(0,tt-0.04);
      const ex2=Math.exp(-p.dr*tt2);
      const y2=p.y0+vt*tt2+(p.vy-vt)*(1-ex2)/p.dr;
      const x2=p.x0+p.vx*tt2+S.wind*1.2*p.wc*tt2;
      return {x:x,y:y,px:x2,py:y2,a:1-k,s:p.s*(1-k*0.7),rot:0,color:rampAt(RAMP_FOUNT,k),tr:true};
    }
    case 'magic':{
      const a2=p.a0+tt*p.w;
      const r=p.r0*(0.75+0.25*Math.sin(tt*1.6+p.ph));
      const x=p.cx+Math.cos(a2)*r;
      const y=p.cy+Math.sin(a2)*r*0.65;
      return {x:x,y:y,a:(0.35+0.65*Math.pow(0.5+0.5*Math.sin(tt*2.5+p.ph),2)),
              s:p.s*(0.8+0.2*Math.sin(tt*3+p.ph)),rot:0,color:PAL[p.ci%PAL.length],tr:true};
    }
    case 'sparkle':{
      const a=Math.pow(0.5+0.5*Math.sin(tt*p.w+p.ph),3);
      return {x:p.x0,y:p.y0,a:a,s:p.s*(0.7+0.3*Math.sin(tt*2+p.ph)),rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'star':{
      const span=W+160;
      const x=W+80-((tt*p.sp+p.x0)%span);
      const y=p.y0+Math.sin(tt*0.5+p.ph)*3;
      return {x:x,y:y,a:(0.35+0.65*Math.pow(0.5+0.5*Math.sin(tt*p.w+p.ph),2)),
              s:p.s,rot:0,color:PAL[p.ci%PAL.length],x2:x+p.sl,y2:y};
    }
    case 'gal':{
      const a2=p.a0+tt*p.w;
      const r=p.r0*(1-k*0.04);
      const x=p.cx+Math.cos(a2)*r;
      const y=p.cy+Math.sin(a2)*r*0.55;
      return {x:x,y:y,a:(0.3+0.7*Math.pow(0.5+0.5*Math.sin(tt*p.tw+p.ph),2)),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'bokeh':{
      const x=p.x0+p.vx*tt+Math.sin(tt*0.5+p.ph)*8;
      const y=p.y0+p.vy*tt;
      return {x:x,y:y,a:p.a0*(0.8+0.2*Math.sin(tt*1.1+p.ph)),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'nebula':{
      const a2=p.ang+tt*p.w*0.12;
      const r=p.r0*(1+0.08*Math.sin(tt*0.3+p.ph));
      const x=p.cx+Math.cos(a2)*r;
      const y=p.cy+Math.sin(a2)*r*0.55;
      return {x:x,y:y,a:p.a0*(0.7+0.3*Math.sin(tt*0.8+p.ph)),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'galcore':{
      return {x:p.cx,y:p.cy,a:p.a0*(0.8+0.2*Math.sin(tt*1.4)),s:p.s,rot:0,color:p.color};
    }
    case 'flash':{
      return {x:p.x,y:p.y,a:(1-k)*0.6,s:p.s*(0.6+0.4*k),rot:0,color:p.color};
    }
    case 'drop':{
      const y=p.y0+p.vy*tt+0.5*p.g*tt*tt;
      const x=p.x0+windDrift;
      const tt2=Math.max(0,tt-0.04);
      return {x:x,y:y,px:p.x0+S.wind*1.2*p.wc*tt2,py:p.y0+p.vy*tt2+0.5*p.g*tt2*tt2,
              a:(k>0.9?(1-k)/0.1:1)*0.7,s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'ripple':{
      const r=p.s+p.v*tt;
      return {x:p.x0,y:p.surf,a:(1-k)*0.45,s:r,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'foam':{
      const y=p.y0-p.vy*tt;
      const x=p.x0+Math.sin(tt*p.sf+p.ph)*p.sway+windDrift;
      return {x:x,y:y,a:(1-k)*p.a0,s:p.s*(1+0.15*Math.sin(tt*2+p.ph)),rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'sdrop':{
      const y=p.y0+p.vy*tt+0.5*p.g*tt*tt;
      const x=p.x0+p.vx*tt+windDrift;
      const tt2=Math.max(0,tt-0.035);
      return {x:x,y:y,px:p.x0+p.vx*tt2+S.wind*1.2*p.wc*tt2,py:p.y0+p.vy*tt2+0.5*p.g*tt2*tt2,
              a:1-k,s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'vapor':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+p.vx*tt+swX(p,tt)*(0.4+tt*0.9)+windDrift;
      return {x:x,y:y,a:Math.pow(1-k,1.7)*p.a0,s:p.s*(0.45+1.9*k),rot:tt*0.3,color:PAL[p.ci%PAL.length]};
    }
    case 'gust':{
      const x=((p.x0+tt*p.vx)%(W+700))-350;
      const y=p.y0+Math.sin(tt*p.sf+p.ph)*p.amp*0.25;
      const a=p.a0*Math.min(1,tt/0.25)*(k>0.8?(1-k)/0.2:1);
      return {x:x,y:y,x2:x-p.len,y2:y+Math.sin(tt*p.sf+p.ph+1.4)*p.amp*0.5,a:a,s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'torn':{
      const Hmax=H+120;
      const h=(p.h0+tt*p.vr)%Hmax;
      const r=p.r0+h*p.k;
      const ang=p.a0+h*p.swirl+tt*p.spin;
      return {x:p.cx+Math.cos(ang)*r,y:H+40-h,a:(1-h/Hmax)*0.6,s:p.s*(1-h/Hmax*0.5),rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'swirl':{
      const r=p.r0+p.vr*tt;
      if(r<=2)return null;
      const tt2=Math.max(0,tt-0.04);
      const r2=p.r0+p.vr*tt2;
      const k2=r/p.r0;
      const ang=p.a0+tt*p.w+(1-k2)*5;
      const ang2=p.a0+tt2*p.w+(1-r2/p.r0)*5;
      return {x:p.cx+Math.cos(ang)*r,y:p.gy-(1-k2)*30,
              px:p.cx+Math.cos(ang2)*r2,py:p.gy-(1-r2/p.r0)*30,
              a:(1-k)*Math.min(1,k2*2)*0.9,s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'feather':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+p.vx*tt+Math.sin(tt*p.sf+p.ph)*p.sway+windDrift;
      const rot=p.rot+p.vr*tt+Math.sin(tt*0.7+p.ph)*0.3;
      return {x:x,y:y,a:(k>0.85?(1-k)/0.15:1)*0.9,s:p.s,rot:rot,sy:1,color:PAL[p.ci%PAL.length]};
    }
    case 'petal':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+p.vx*tt+Math.sin(tt*p.sf+p.ph)*p.sway+windDrift;
      const rot=p.rot+p.vr*tt;
      return {x:x,y:y,a:(k>0.9?(1-k)/0.1:1),s:p.s,rot:rot,
              sy:Math.abs(Math.cos(tt*1.2+p.ph))*0.5+0.5,color:PAL[p.ci%PAL.length]};
    }
    case 'dust':{
      const x=((p.x0+tt*p.vx)%(W+500))-250;
      const y=p.y0+Math.sin(tt*p.sf+p.ph)*p.amp;
      return {x:x,y:y,x2:x-p.len,y2:y+Math.sin(tt*p.sf+p.ph+1)*p.amp*0.4,
              a:p.a0*(k>0.8?(1-k)/0.2:1),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'sand':{
      const x=((p.x0+tt*p.vx)%(W+400))-200;
      const y=p.air?(p.y0+p.vy*tt+Math.sin(tt*1.4+p.ph)*p.sway):(H-6-Math.abs(Math.sin(tt*p.f+p.ph))*9);
      return {x:x,y:y,x2:x-p.s*8,y2:y,a:0.5,s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'pollen':{
      const x=p.x0+Math.sin(tt*p.f1+p.ph)*p.a1+windDrift;
      const y=p.y0+Math.sin(tt*p.f2+p.ph2)*p.a2;
      return {x:x,y:y,a:(0.4+0.6*Math.pow(0.5+0.5*Math.sin(tt*p.w+p.ph),2)),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'firefly':{
      const x=p.x0+Math.sin(tt*p.f1+p.ph)*p.a1+windDrift;
      const y=p.y0+Math.sin(tt*p.f2+p.ph2)*p.a2;
      const on=Math.sin(tt*0.9+p.ph3)>0.4;
      const a=on?(0.5+0.5*Math.sin(tt*6+p.ph))*0.85:0.05;
      return {x:x,y:y,a:a*(k>0.85?(1-k)/0.15:1),s:p.s,rot:0,color:'#e0ff7a'};
    }
    case 'fog':{
      const x=p.x0+tt*p.vx;
      const y=p.y0+Math.sin(tt*0.2+p.ph)*6;
      const fin=Math.min(1,tt/0.8);
      const a=p.a0*fin*(k>0.85?(1-k)/0.15:1)*(0.85+0.15*Math.sin(tt*0.5+p.ph));
      return {x:x,y:y,a:a,s:p.s,rot:0,color:'#ffffff'};
    }
    case 'streamer':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+Math.sin(tt*p.sf+p.ph)*p.sway*0.3+windDrift;
      const pts=[];
      for(let i=0;i<=8;i++){
        const yy=y+(i/8)*p.s;
        const xx=x+Math.sin(tt*p.sf*1.5+p.ph+i*0.55)*p.sway*(i/8);
        pts.push([xx,yy]);
      }
      return {x:x,y:y,a:(k>0.85?(1-k)/0.15:1)*0.9,s:p.s,rot:0,sy:1,color:PAL[p.ci%PAL.length],pts:pts};
    }
    case 'glitter':{
      const y=p.y0+p.vy*tt;
      const x=p.x0+Math.sin(tt*p.sf+p.ph)*p.sway+windDrift;
      const tw=Math.pow(0.5+0.5*Math.sin(tt*p.w+p.ph),3);
      return {x:x,y:y,a:tw*(k>0.85?(1-k)/0.15:1),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'meteor':{
      const x=p.x0+p.vx*tt;
      const y=p.y0+p.vy*tt;
      return {x:x,y:y,px:x-p.vx*0.12,py:y-p.vy*0.12,a:(k>0.7?(1-k)/0.3:1)*0.9,s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'aurora':{
      return {x:p.baseY,y:p.amp,a:1,s:p.s,rot:0,color:PAL[p.ci%PAL.length],tt:tt,ph:p.ph,fq:p.fq};
    }
    case 'comet':{
      const x=p.x0+p.vx*tt;
      const y=p.y0+p.vy*tt+Math.sin(tt*0.6+p.ph)*6;
      return {x:x,y:y,a:(k>0.8?(1-k)/0.2:1),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'bolt':{
      const ph2=tt/p.d;
      let a;
      if(ph2<0.15)a=ph2/0.15;
      else if(ph2<0.32)a=1-(ph2-0.15)/0.17;
      else if(ph2<0.45)a=0.25+0.55*Math.sin((ph2-0.32)/0.13*Math.PI);
      else if(ph2<0.6)a=0.25*(1-(ph2-0.45)/0.15);
      else a=0.08*Math.max(0,1-(ph2-0.6)/0.4);
      return {x:p.x0,y:0,a:a,s:p.s,rot:0,color:p.color};
    }
    case 'warp':{
      const R=Math.hypot(W,H)/2+80;
      const r=(p.r0+tt*p.v)%R;
      const len=p.s*18+r*p.k;
      const x=W/2+Math.cos(p.a)*r;
      const y=H/2+Math.sin(p.a)*r;
      const x2=W/2+Math.cos(p.a)*(r-len);
      const y2=H/2+Math.sin(p.a)*(r-len);
      return {x:x,y:y,x2:x2,y2:y2,a:(1-k)*0.9,s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
    case 'warpcore':{
      return {x:p.cx!==undefined?p.cx:W/2,y:p.cy!==undefined?p.cy:H/2,a:0.16+0.06*Math.sin(tt*2+p.ph),s:p.s,rot:0,color:p.color};
    }
    case 'bgstar':{
      return {x:p.x0,y:p.y0,a:(0.3+0.7*Math.pow(0.5+0.5*Math.sin(tt*p.w+p.ph),2)),s:p.s,rot:0,color:PAL[p.ci%PAL.length]};
    }
  }
  return null;
}

function drawP(p,f,ctx,mul){
  const a=clamp(f.a*state.opacity/100*mul,0,1);
  ctx.globalAlpha=a;
  switch(p.t){
    case 'conf':
      if((f.sh||0)>0.02) blit(ctx,softSprite('#000000'),f.x,H-40,f.s*(1.2+0.5*(1-f.sh)),f.sh*0.3*a);
      blitR(ctx,gradSprite(f.color),f.x,f.y,f.s*1.6,f.s*1.1,f.rot,f.sy,a);
      break;
    case 'rain':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=p.s*2.6;
      ctx.globalAlpha=a*0.3;
      ctx.beginPath();
      ctx.moveTo(f.x,f.y);
      ctx.lineTo(f.x2,f.y2);
      ctx.stroke();
      ctx.globalAlpha=a;
      ctx.lineWidth=p.s;
      ctx.beginPath();
      ctx.moveTo(f.x,f.y);
      ctx.lineTo(f.x2,f.y2);
      ctx.stroke();
      break;
    case 'leaf':
      blitR(ctx,leafSprite(f.color),f.x,f.y,f.s*3.2,f.s*3.2,f.rot,f.sy,a);
      break;
    case 'bubble':{
      const g=ctx.createRadialGradient(f.x-f.s*0.32,f.y-f.s*0.36,f.s*0.08,f.x,f.y,f.s);
      g.addColorStop(0,'rgba(255,255,255,0.55)');
      g.addColorStop(0.65,hexA(f.color,0.05));
      g.addColorStop(1,hexA(f.color,0.28));
      ctx.fillStyle=g;
      ctx.beginPath();
      ctx.arc(f.x,f.y,f.s,0,TAU);
      ctx.fill();
      ctx.strokeStyle=hexA(f.color,0.55);
      ctx.lineWidth=1.1;
      ctx.stroke();
      break;
    }
    case 'sparkle':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.4,a);
      if(p.cr){
        ctx.globalAlpha=a*0.8;
        const L=f.s*5;
        ctx.strokeStyle=f.color;
        ctx.lineWidth=1.1;
        ctx.beginPath();
        ctx.moveTo(f.x-L,f.y); ctx.lineTo(f.x+L,f.y);
        ctx.moveTo(f.x,f.y-L); ctx.lineTo(f.x,f.y+L);
        ctx.stroke();
      }
      break;
    case 'star':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=p.s;
      ctx.beginPath();
      ctx.moveTo(f.x2,f.y2);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,p.s*2,a*0.8);
      break;
    case 'rocket':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=1.6;
      ctx.globalAlpha=a*0.55;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.4,a);
      break;
    case 'spark':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=1.2;
      ctx.globalAlpha=a*0.7;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.6,a);
      break;
    case 'burst':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=1.3;
      ctx.globalAlpha=a*0.7;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*3,a);
      break;
    case 'fount':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=1.1;
      ctx.globalAlpha=a*0.6;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.8,a);
      break;
    case 'flame':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2,a);
      break;
    case 'core':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.6,a);
      break;
    case 'fspark':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*3,a);
      break;
    case 'ember':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.8,a);
      break;
    case 'smoke':
      blit(ctx,softSprite(f.color),f.x,f.y,f.s*1.6,a);
      break;
    case 'magic':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.8,a);
      if(a>0.5){
        ctx.globalAlpha=(a-0.5)*1.6;
        const L=f.s*4;
        ctx.strokeStyle='#ffffff';
        ctx.lineWidth=1;
        ctx.beginPath();
        ctx.moveTo(f.x-L,f.y); ctx.lineTo(f.x+L,f.y);
        ctx.moveTo(f.x,f.y-L); ctx.lineTo(f.x,f.y+L);
        ctx.stroke();
      }
      break;
    case 'snow':
      blit(ctx,softSprite(f.color),f.x,f.y,f.s*3,a);
      break;
    case 'nebula':
      blit(ctx,softSprite(f.color),f.x,f.y,f.s*1.8,a);
      break;
    case 'galcore':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*1.8,a);
      break;
    case 'gal':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.6,a);
      break;
    case 'bokeh':
      blit(ctx,ringSprite(f.color),f.x,f.y,f.s*1.4,a);
      break;
    case 'flash':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*1.8,a);
      break;
    case 'drop':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=f.s*1.4;
      ctx.globalAlpha=a*0.6;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.2,a);
      break;
    case 'ripple':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=2.2;
      ctx.globalAlpha=a;
      ctx.beginPath();
      ctx.ellipse(f.x,f.y,f.s,f.s*0.22,0,0,TAU);
      ctx.stroke();
      ctx.globalAlpha=a*0.5;
      ctx.lineWidth=1.4;
      ctx.beginPath();
      ctx.ellipse(f.x,f.y,f.s*0.6,f.s*0.13,0,0,TAU);
      ctx.stroke();
      break;
    case 'foam':
      blit(ctx,softSprite(f.color),f.x,f.y,f.s*1.7,a);
      break;
    case 'sdrop':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=f.s*1.2;
      ctx.globalAlpha=a*0.6;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.4,a);
      break;
    case 'vapor':
      blit(ctx,softSprite(f.color),f.x,f.y,f.s*1.6,a);
      break;
    case 'gust':{
      const y1=f.y, y2=f.y2;
      ctx.strokeStyle=f.color;
      ctx.lineWidth=f.s*3;
      ctx.globalAlpha=a*0.25;
      ctx.beginPath();
      ctx.moveTo(f.x,y1);
      ctx.quadraticCurveTo((f.x+f.x2)/2,(y1+y2)/2-8,f.x2,y2);
      ctx.stroke();
      ctx.globalAlpha=a*0.8;
      ctx.lineWidth=f.s;
      ctx.beginPath();
      ctx.moveTo(f.x,y1);
      ctx.quadraticCurveTo((f.x+f.x2)/2,(y1+y2)/2-8,f.x2,y2);
      ctx.stroke();
      break;
    }
    case 'torn':
      blit(ctx,softSprite(f.color),f.x,f.y,f.s*2.2,a);
      break;
    case 'swirl':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=f.s;
      ctx.globalAlpha=a*0.6;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.4,a);
      break;
    case 'bgstar':
      ctx.fillStyle=f.color;
      ctx.globalAlpha=a;
      ctx.fillRect(f.x,f.y,f.s,f.s);
      break;
    case 'feather':
      blitR(ctx,softSprite(f.color),f.x,f.y,f.s*3.2,f.s*1.5,f.rot,1,a);
      break;
    case 'petal':
      blitR(ctx,petalSprite(f.color),f.x,f.y,f.s*2.6,f.s*2.6,f.rot,f.sy,a);
      break;
    case 'dust':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=f.s*2;
      ctx.globalAlpha=a*0.4;
      ctx.beginPath();
      ctx.moveTo(f.x,f.y);
      ctx.lineTo(f.x2,f.y2);
      ctx.stroke();
      ctx.globalAlpha=a;
      ctx.lineWidth=f.s;
      ctx.beginPath();
      ctx.moveTo(f.x,f.y);
      ctx.lineTo(f.x2,f.y2);
      ctx.stroke();
      break;
    case 'sand':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=f.s;
      ctx.globalAlpha=a*0.8;
      ctx.beginPath();
      ctx.moveTo(f.x2,f.y2);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      break;
    case 'pollen':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.2,a);
      break;
    case 'firefly':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.2,a);
      if(a>0.4)blit(ctx,glowSprite(f.color),f.x,f.y,f.s*4,a*0.25);
      break;
    case 'fog':
      blit(ctx,softSprite(f.color),f.x,f.y,f.s*1.6,a);
      break;
    case 'streamer':{
      ctx.strokeStyle=f.color;
      ctx.lineWidth=2.5;
      ctx.beginPath();
      ctx.moveTo(f.pts[0][0],f.pts[0][1]);
      for(let i=1;i<f.pts.length;i++){
        ctx.globalAlpha=a*(1-i/f.pts.length*0.55);
        ctx.lineTo(f.pts[i][0],f.pts[i][1]);
      }
      ctx.stroke();
      break;
    }
    case 'glitter':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2.6,a);
      if(a>0.55){
        ctx.globalAlpha=(a-0.55)*1.8;
        const L=f.s*4.5;
        ctx.strokeStyle='#ffffff';
        ctx.lineWidth=1;
        ctx.beginPath();
        ctx.moveTo(f.x-L,f.y); ctx.lineTo(f.x+L,f.y);
        ctx.moveTo(f.x,f.y-L); ctx.lineTo(f.x,f.y+L);
        ctx.stroke();
      }
      break;
    case 'meteor':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=f.s*2.4;
      ctx.globalAlpha=a*0.35;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      ctx.globalAlpha=a;
      ctx.lineWidth=f.s;
      ctx.beginPath();
      ctx.moveTo(f.px,f.py);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite('#ffffff'),f.x,f.y,f.s*3,a);
      break;
    case 'aurora':{
      const baseY=f.x, amp=f.y, tt2=f.tt, ph=f.ph, fq=f.fq;
      const grad=ctx.createLinearGradient(0,baseY-amp-40,0,baseY+amp+40);
      grad.addColorStop(0,hexA(f.color,0));
      grad.addColorStop(0.35,hexA(f.color,0.5));
      grad.addColorStop(0.7,hexA(f.color,0.22));
      grad.addColorStop(1,hexA(f.color,0));
      ctx.strokeStyle=grad;
      ctx.lineWidth=f.s;
      ctx.globalAlpha=a*0.8;
      ctx.beginPath();
      for(let i=0;i<=48;i++){
        const xx=(i/48)*W;
        const yy=baseY+Math.sin(xx*0.012+tt2*fq+ph)*amp+Math.sin(xx*0.05-tt2*0.3+ph)*14;
        if(i===0)ctx.moveTo(xx,yy); else ctx.lineTo(xx,yy);
      }
      ctx.stroke();
      break;
    }
    case 'comet':{
      const dx=-p.vx*0.06, dy=-p.vy*0.06;
      for(let j=10;j>=1;j--){
        blit(ctx,glowSprite(f.color),f.x+dx*j,f.y+dy*j,f.s*(1-j*0.08),a*(1-j*0.09)*0.5);
      }
      blit(ctx,glowSprite('#ffffff'),f.x,f.y,f.s*1.6,a);
      break;
    }
    case 'bolt':{
      const strokePts=(pts,w,col,al)=>{
        ctx.globalAlpha=a*al;
        ctx.strokeStyle=col;
        ctx.lineWidth=w;
        ctx.beginPath();
        ctx.moveTo(pts[0][0],pts[0][1]);
        for(let i=1;i<pts.length;i++)ctx.lineTo(pts[i][0],pts[i][1]);
        ctx.stroke();
      };
      strokePts(p.pts,12,f.color,0.18);
      strokePts(p.pts,5,f.color,0.5);
      strokePts(p.pts,2,'#ffffff',0.95);
      for(let bi=0;bi<p.branches.length;bi++){
        strokePts(p.branches[bi],3,f.color,0.35);
        strokePts(p.branches[bi],1.1,'#ffffff',0.7);
      }
      for(let i=0;i<p.pts.length;i+=3){
        blit(ctx,glowSprite('#ffffff'),p.pts[i][0],p.pts[i][1],7,a*0.6);
      }
      blit(ctx,softSprite(f.color),p.x0,80,420,a*0.14);
      blit(ctx,softSprite('#ffffff'),p.x0,40,140,a*0.2);
      break;
    }
    case 'warp':
      ctx.strokeStyle=f.color;
      ctx.lineWidth=f.s*2.2;
      ctx.globalAlpha=a*0.4;
      ctx.beginPath();
      ctx.moveTo(f.x2,f.y2);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      ctx.globalAlpha=a;
      ctx.lineWidth=f.s;
      ctx.beginPath();
      ctx.moveTo(f.x2,f.y2);
      ctx.lineTo(f.x,f.y);
      ctx.stroke();
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*2,a*0.8);
      break;
    case 'warpcore':
      blit(ctx,glowSprite(f.color),f.x,f.y,f.s*1.6,a);
      blit(ctx,glowSprite('#ffffff'),f.x,f.y,f.s*0.5,a*1.2);
      break;
    default:
      ctx.fillStyle=f.color;
      ctx.beginPath();
      ctx.arc(f.x,f.y,f.s,0,TAU);
      ctx.fill();
  }
}


function render(ctx,t,forceBg){
  renderCore(ctx,t,forceBg);
  if(state.pixelate)pxl(ctx);
}

function renderCore(ctx,t,forceBg){
  const S=state;
  ctx.clearRect(0,0,W,H);
  const showBg=forceBg!==undefined?forceBg:S.bgOn;
  if(showBg){ ctx.fillStyle=S.bg; ctx.fillRect(0,0,W,H); }
  if(S.preset==='fireDoom'){ doomRender(ctx,t); return; }
  const pr=PRESET_BY_ID[S.preset];
  if(pr&&pr.family==='Pixel FX'){ pxRender(ctx,t); return; }
  const sig=simSig();
  if(sig!==lastSig){ lastSig=sig; buildSim(); }
  const PAL=currentPal();
  ctx.save();
  ctx.globalCompositeOperation=S.blend;
  for(let i=0;i<SYS.length;i++){
    const p=SYS[i];
    const tt=((t-p.b)%p.cyc+p.cyc)%p.cyc;
    if(tt<0||tt>p.d)continue;
    if(S.trail&&p.tr){
      const f1=frameP(p,Math.max(0,tt-0.03),S,PAL);
      if(f1)drawP(p,f1,ctx,0.3);
      const f2=frameP(p,Math.max(0,tt-0.06),S,PAL);
      if(f2)drawP(p,f2,ctx,0.1);
    }
    const f=frameP(p,tt,S,PAL);
    if(f)drawP(p,f,ctx,1);
  }
  ctx.restore();
}

function syncPlayIcon(){
  $('iconPlay').style.display=state.playing?'none':'block';
  $('iconPause').style.display=state.playing?'block':'none';
}

let pxlCv=null,pxlCtx=null,pxlSize=0;
function pxl(ctx){
  const pw=Math.round(W/state.pixelSize);
  const ph=Math.round(H/state.pixelSize);
  if(!pxlCv||pxlSize!==state.pixelSize){
    pxlCv=document.createElement('canvas');
    pxlCv.width=pw;
    pxlCv.height=ph;
    pxlCtx=pxlCv.getContext('2d');
    pxlSize=state.pixelSize;
  }
  pxlCtx.imageSmoothingEnabled=true;
  pxlCtx.drawImage(ctx.canvas,0,0,pw,ph);
  ctx.save();
  ctx.imageSmoothingEnabled=false;
  ctx.drawImage(pxlCv,0,0,W,H);
  ctx.restore();
}

function updateTimeline(){
  const d=Math.max(0.5,state.duration);
  const pct=clamp(state.time/d,0,1)*100;
  $('tlFill').style.width=pct+'%';
  $('tlHead').style.left=pct+'%';
  $('tlTime').textContent=state.time.toFixed(2)+' / '+d.toFixed(2);
}

function buildTicks(){
  const t=$('tlTicks');
  t.innerHTML='';
  const d=Math.max(0.5,state.duration);
  const n=Math.min(8,Math.max(1,Math.ceil(d)));
  for(let i=1;i<=n;i++){
    const s=document.createElement('span');
    s.dataset.t=(i/n*d).toFixed(1)+'s';
    t.appendChild(s);
  }
}

function setRange(id,key,fmt){
  const el=$(id), val=$(id+'Val');
  el.value=state[key];
  if(val)val.textContent=fmt?fmt(state[key]):state[key];
}
function wireRange(id,key,fmt){
  const el=$(id), val=$(id+'Val');
  el.addEventListener('input',()=>{
    state[key]=parseFloat(el.value);
    if(val)val.textContent=fmt?fmt(state[key]):el.value;
    saveLS();
  });
}

function wirePills(id,key){
  $(id).querySelectorAll('button').forEach(b=>{
    b.addEventListener('click',()=>{
      state[key]=b.dataset.v;
      $(id).querySelectorAll('button').forEach(x=>x.classList.toggle('active',x===b));
      saveLS();
    });
  });
}
function setPills(id,val){
  $(id).querySelectorAll('button').forEach(b=>b.classList.toggle('active',b.dataset.v===val));
}

function wireSwitch(id,key){
  const el=$(id);
  el.addEventListener('click',()=>{
    state[key]=!state[key];
    el.classList.toggle('on',state[key]);
    saveLS();
  });
}

function buildPaletteGrid(){
  const g=$('paletteGrid');
  g.innerHTML='';
  const names={fiesta:'Fiesta',fuego:'Fuego',neon:'Neon',pastel:'Pastel',noche:'Noche',metal:'Metal',naturaleza:'Naturaleza',candy:'Candy',rgb:'RGB',oro:'Oro',agua:'Agua',viento:'Viento'};
  Object.keys(PALETTES).forEach(k=>{
    const b=document.createElement('button');
    b.className='pal-btn'+(state.palette===k?' active':'');
    b.title=names[k]||k;
    b.style.background='linear-gradient(135deg,'+PALETTES[k].join(',')+')';
    b.addEventListener('click',()=>{ state.palette=k; buildPaletteGrid(); saveLS(); });
    g.appendChild(b);
  });
  const c=document.createElement('button');
  c.className='pal-btn custom'+(state.palette==='custom'?' active':'');
  c.title='Personalizada';
  c.textContent='+';
  c.addEventListener('click',()=>{ state.palette='custom'; buildPaletteGrid(); saveLS(); });
  g.appendChild(c);
  $('customColors').style.display=state.palette==='custom'?'block':'none';
}

function buildCustomColors(){
  const row=$('customRow');
  row.innerHTML='';
  for(let i=0;i<5;i++){
    const inp=document.createElement('input');
    inp.type='color';
    inp.value=state.custom[i]||'#ffffff';
    inp.addEventListener('input',()=>{
      state.custom[i]=inp.value;
      saveLS();
    });
    row.appendChild(inp);
  }
}

function buildSysParams(){
  const p=PRESET_BY_ID[state.preset];
  const box=$('sysParams');
  if(!p||!p.params||!p.params.length){
    box.innerHTML='<p class="hint">Este sistema no tiene parametros extra.</p>';
    return;
  }
  box.innerHTML='';
  const pp=state.pp[state.preset]||{};
  p.params.forEach(pr=>{
    const f=document.createElement('div');
    f.className='field';
    f.innerHTML='<label>'+pr.label+'</label><div class="field-row"><input type="range" min="'+pr.min+'" max="'+pr.max+'" step="'+pr.step+'" value="'+pp[pr.key]+'"><span class="range-val">'+pp[pr.key]+'</span></div>';
    const r=f.querySelector('input'), v=f.querySelector('.range-val');
    r.addEventListener('input',()=>{
      state.pp[state.preset]=state.pp[state.preset]||{};
      state.pp[state.preset][pr.key]=parseFloat(r.value);
      v.textContent=r.value;
      saveLS();
    });
    box.appendChild(f);
  });
}

function buildPresetList(){
  const box=$('presetList');
  box.innerHTML='';
  const q=($('presetSearch').value||'').toLowerCase();
  const fams={};
  PRESETS.forEach(p=>{
    if(q&&!(p.name.toLowerCase().indexOf(q)>-1||p.id.indexOf(q)>-1||p.family.toLowerCase().indexOf(q)>-1))return;
    (fams[p.family]=fams[p.family]||[]).push(p);
  });
  Object.keys(fams).forEach(f=>{
    const det=document.createElement('details');
    det.className='family';
    det.open=true;
    const sum=document.createElement('summary');
    sum.textContent=f;
    det.appendChild(sum);
    const grid=document.createElement('div');
    grid.className='preset-grid';
    fams[f].forEach(p=>{
      const b=document.createElement('button');
      b.className='preset'+(state.preset===p.id?' active':'');
      b.textContent=p.name;
      b.addEventListener('click',()=>selectPreset(p.id));
      grid.appendChild(b);
    });
    det.appendChild(grid);
    box.appendChild(det);
  });
}

function selectPreset(id){
  const p=PRESET_BY_ID[id];
  if(!p)return;
  state.preset=id;
  state.count=p.count;
  state.palette=p.pal;
  state.blend=p.blend;
  state.pp[id]=state.pp[id]||{};
  p.params.forEach(pr=>{
    if(state.pp[id][pr.key]===undefined)state.pp[id][pr.key]=pr.def;
  });
  syncUI();
  buildSysParams();
  buildPresetList();
  saveLS();
  render(ctx,state.time);
}

function syncUI(){
  const isPX=!!(PRESET_BY_ID[state.preset]&&PRESET_BY_ID[state.preset].family==='Pixel FX');
  $('fldCount').style.display=isPX?'none':'block';
  $('secEmitter').style.display=isPX?'none':'block';
  setRange('count','count');
  setRange('size','size',v=>v+'%');
  setRange('speed','speed',v=>v+'%');
  setRange('grav','grav',v=>v+'%');
  setRange('wind','wind');
  setRange('turb','turb',v=>v+'%');
  setRange('life','life',v=>v+'%');
  setRange('opacity','opacity',v=>v+'%');
  setPills('emitterGroup',state.emitter);
  setPills('blendGroup',state.blend);
  $('bgSwitch').classList.toggle('on',state.bgOn);
  $('trailSwitch').classList.toggle('on',state.trail);
  $('loopSwitch').classList.toggle('on',state.loop);
  $('pixelateSwitch').classList.toggle('on',state.pixelate);
  $('bgColor').value=state.bg;
  $('seedInput').value=state.seed;
  $('duration').value=state.duration;
  buildPaletteGrid();
  buildCustomColors();
  buildSysParams();
  buildPresetList();
  buildTicks();
  updateTimeline();
  syncPlayIcon();
}

function sanitizeState(raw){
  if(!raw||typeof raw!=='object')return {};
  const D=DEFAULT_STATE;
  const out={};
  const num=(v,def,min,max)=>{
    const n=Number(v);
    if(!isFinite(n))return def;
    return clamp(n,min,max);
  };
  const hex=/^#[0-9a-fA-F]{6}$/;
  out.preset=PRESET_BY_ID[raw.preset]?raw.preset:D.preset;
  out.count=num(raw.count,D.count,4,800);
  out.size=num(raw.size,D.size,20,300);
  out.speed=num(raw.speed,D.speed,20,300);
  out.grav=num(raw.grav,D.grav,0,300);
  out.wind=num(raw.wind,D.wind,0,200);
  out.turb=num(raw.turb,D.turb,0,200);
  out.life=num(raw.life,D.life,50,200);
  out.opacity=num(raw.opacity,D.opacity,10,100);
  out.emitter=['screen','center','top','bottom'].indexOf(raw.emitter)>-1?raw.emitter:D.emitter;
  out.blend=['normal','lighter','screen'].indexOf(raw.blend)>-1?raw.blend:D.blend;
  out.palette=(PALETTES[raw.palette]||raw.palette==='custom')?raw.palette:D.palette;
  out.custom=[].concat(D.custom);
  if(Array.isArray(raw.custom)){
    for(let i=0;i<5;i++){
      if(typeof raw.custom[i]==='string'&&hex.test(raw.custom[i]))out.custom[i]=raw.custom[i];
    }
  }
  out.bg=(typeof raw.bg==='string'&&hex.test(raw.bg))?raw.bg:D.bg;
  out.bgOn=raw.bgOn===undefined?D.bgOn:!!raw.bgOn;
  out.trail=!!raw.trail;
  out.loop=raw.loop===undefined?D.loop:!!raw.loop;
  out.seed=Math.round(num(raw.seed,D.seed,1,999999));
  out.duration=num(raw.duration,D.duration,0.5,20);
  out.pixelate=!!raw.pixelate;
  out.pixelSize=Math.round(num(raw.pixelSize,D.pixelSize,2,8));
  out.time=num(raw.time,0,0,20);
  out.playing=false;
  out.pp={};
  const pr=PRESET_BY_ID[out.preset];
  if(pr&&pr.params){
    out.pp[out.preset]={};
    const srcPp=(raw.pp&&raw.pp[out.preset])||{};
    pr.params.forEach(p=>{
      out.pp[out.preset][p.key]=num(srcPp[p.key],p.def,p.min,p.max);
    });
  }
  return out;
}

function saveLS(){
  try{
    localStorage.setItem('fap_particlefx_ver',APP_VERSION);
    localStorage.setItem('fap_particlefx_v1',JSON.stringify(state));
  }catch(e){}
}

function restoreLS(){
  try{
    if(localStorage.getItem('fap_particlefx_ver')!==APP_VERSION)return;
    const raw=localStorage.getItem('fap_particlefx_v1');
    if(raw){
      const d=sanitizeState(JSON.parse(raw));
      Object.assign(state,DEFAULT_STATE,{pp:{},custom:[].concat(DEFAULT_STATE.custom)});
      Object.assign(state,d);
    }
  }catch(e){}
}

const cv=$('preview');
const ctx=cv.getContext('2d');

let last=performance.now();
function loop(now){
  const dt=Math.min(0.1,(now-last)/1000);
  last=now;
  if(state.playing){
    state.time+=dt;
    if(state.time>=state.duration){
      if(state.loop){ state.time=0; }
      else { state.time=state.duration; state.playing=false; syncPlayIcon(); }
    }
  }
  render(ctx,state.time);
  updateTimeline();
  requestAnimationFrame(loop);
}

$('btnPlay').addEventListener('click',()=>{
  if(!state.playing&&state.time>=state.duration)state.time=0;
  state.playing=!state.playing;
  syncPlayIcon();
  saveLS();
});

const tlTrack=$('tlTrack');
function scrub(e){
  const rect=tlTrack.getBoundingClientRect();
  state.time=clamp((e.clientX-rect.left)/rect.width,0,1)*Math.max(0.5,state.duration);
  render(ctx,state.time);
  updateTimeline();
}
tlTrack.addEventListener('pointerdown',e=>{
  tlTrack.setPointerCapture(e.pointerId);
  scrub(e);
  const move=ev=>scrub(ev);
  tlTrack.addEventListener('pointermove',move);
  tlTrack.addEventListener('pointerup',()=>tlTrack.removeEventListener('pointermove',move),{once:true});
});

$('duration').addEventListener('input',()=>{
  state.duration=clamp(parseFloat($('duration').value)||4,0.5,20);
  buildTicks();
  updateTimeline();
  saveLS();
});

$('presetSearch').addEventListener('input',buildPresetList);

$('btnNew').addEventListener('click',()=>{
  state=Object.assign({},DEFAULT_STATE,{pp:{},custom:[].concat(DEFAULT_STATE.custom)});
  lastSig='';
  syncUI();
  saveLS();
});

$('btnSave').addEventListener('click',()=>{
  download(new Blob([JSON.stringify(state,null,2)],{type:'application/json'}),'particlefx.json');
});

$('fileInput').addEventListener('change',e=>{
  const f=e.target.files[0];
  if(!f)return;
  const r=new FileReader();
  r.onload=ev=>{
    try{
      const d=sanitizeState(JSON.parse(ev.target.result));
      Object.assign(state,DEFAULT_STATE,{pp:{},custom:[].concat(DEFAULT_STATE.custom)});
      Object.assign(state,d,{playing:false,time:0});
      lastSig='';
      syncUI();
      saveLS();
    }catch(err){ alert('Archivo de proyecto invalido'); }
  };
  r.readAsText(f);
  e.target.value='';
});

$('btnOpen').addEventListener('click',()=>$('fileInput').click());

$('seedInput').addEventListener('input',()=>{
  state.seed=clamp(parseInt($('seedInput').value)||1,1,999999);
  saveLS();
});
$('btnRandom').addEventListener('click',()=>{
  state.seed=Math.floor(Math.random()*999999)+1;
  $('seedInput').value=state.seed;
  saveLS();
});

$('bgColor').addEventListener('input',()=>{
  state.bg=$('bgColor').value;
  saveLS();
});

wirePills('emitterGroup','emitter');
wirePills('blendGroup','blend');
wireSwitch('bgSwitch','bgOn');
wireSwitch('trailSwitch','trail');
wireSwitch('loopSwitch','loop');
wireSwitch('pixelateSwitch','pixelate');

document.addEventListener('keydown',e=>{
  if(e.code==='Space'&&!e.target.matches('input,textarea,select')){
    e.preventDefault();
    $('btnPlay').click();
  }
});

let exportFormat='webm';
let exportAlpha=true;
$('btnExport').addEventListener('click',()=>$('exportModal').classList.add('open'));
$('btnCancelExport').addEventListener('click',()=>$('exportModal').classList.remove('open'));
$('formatGroup').querySelectorAll('button').forEach(b=>{
  b.addEventListener('click',()=>{
    $('formatGroup').querySelectorAll('button').forEach(x=>x.classList.remove('active'));
    b.classList.add('active');
    exportFormat=b.dataset.f;
  });
});
$('exportAlphaSwitch').addEventListener('click',function(){
  exportAlpha=!exportAlpha;
  this.classList.toggle('on',exportAlpha);
});

function setBar(v){ $('exportBar').style.width=(v*100)+'%'; }
function download(blob,name){
  const a=document.createElement('a');
  a.href=URL.createObjectURL(blob);
  a.download=name;
  a.click();
  setTimeout(()=>URL.revokeObjectURL(a.href),1000);
}

$('btnDoExport').addEventListener('click',async ()=>{
  const fps=parseInt($('exportFps').value);
  const prog=$('exportProgress');
  prog.classList.add('active');
  setBar(0);
  $('btnDoExport').disabled=true;
  const xcv=$('renderCanvas');
  const xctx=xcv.getContext('2d');
  const wantAlpha=exportAlpha&&exportFormat==='webm';
  const showBg=!(exportAlpha&&(exportFormat==='webm'||exportFormat==='gif'));
  try{
    if(exportFormat==='gif'){
      await exportGIF(xctx,fps,showBg);
    }else{
      await exportVideo(xctx,fps,showBg,wantAlpha);
    }
  }catch(err){
    alert('Fallo la exportacion: '+err.message);
  }
  prog.classList.remove('active');
  $('btnDoExport').disabled=false;
  $('exportModal').classList.remove('open');
});

async function exportVideo(xctx,fps,showBg,wantAlpha){
  const mimes=wantAlpha?['video/webm;codecs=vp9','video/webm']:['video/mp4;codecs=avc1','video/mp4','video/webm;codecs=vp9','video/webm'];
  const mime=mimes.find(m=>MediaRecorder.isTypeSupported(m))||'video/webm';
  const frames=Math.max(1,Math.round(state.duration*fps));
  const stream=$('renderCanvas').captureStream(0);
  const rec=new MediaRecorder(stream,{mimeType:mime,videoBitsPerSecond:8000000});
  const chunks=[];
  rec.ondataavailable=e=>chunks.push(e.data);
  const done=new Promise(res=>rec.onstop=res);
  rec.start();
  const track=stream.getVideoTracks()[0];
  const rf=track&&typeof track.requestFrame==='function';
  const start=performance.now();
  for(let i=0;i<=frames;i++){
    render(xctx,(i/frames)*state.duration,showBg);
    setBar(i/frames);
    if(rf){
      track.requestFrame();
      await 0;
    }else{
      const due=start+i*(1000/fps);
      while(performance.now()<due){ await 0; }
    }
  }
  rec.stop();
  await done;
  const ext=mime.indexOf('mp4')>-1?'mp4':'webm';
  download(new Blob(chunks,{type:mime}),'particlefx.'+ext);
}

async function exportGIF(xctx,fps,showBg){
  const gif=new GifEnc(W,H);
  gif.setDelay(Math.round(1000/fps));
  gif.setRepeat(0);
  gif.setAlpha(!showBg);
  gif.start();
  const frames=Math.max(1,Math.round(state.duration*fps));
  for(let i=0;i<=frames;i++){
    render(xctx,(i/frames)*state.duration,showBg);
    gif.add(xctx);
    setBar(i/frames);
    await 0;
  }
  gif.finish();
  download(new Blob([new Uint8Array(gif.out)],{type:'image/gif'}),'particlefx.gif');
}

function GifEnc(w,h){
  this.w=w; this.h=h; this.out=[]; this.delay=10; this.repeat=0; this.alpha=false;
}
GifEnc.prototype.setDelay=function(ms){ this.delay=Math.round(ms/10); };
GifEnc.prototype.setRepeat=function(r){ this.repeat=r; };
GifEnc.prototype.setAlpha=function(a){ this.alpha=a; };
GifEnc.prototype.ws=function(s){ for(let i=0;i<s.length;i++)this.out.push(s.charCodeAt(i)); };
GifEnc.prototype.wsh=function(v){ this.out.push(v&255,(v>>8)&255); };
GifEnc.prototype.start=function(){
  this.ws("GIF89a");
  this.wsh(this.w); this.wsh(this.h);
  this.out.push(0xF0|7,0,0);
  for(let i=0;i<256;i++)this.out.push(i,i,i);
  this.out.push(0x21,0xFF,11);
  this.ws("NETSCAPE2.0");
  this.out.push(3,1);
  this.wsh(this.repeat);
  this.out.push(0);
};
GifEnc.prototype.add=function(ctx){
  const img=ctx.getImageData(0,0,this.w,this.h).data;
  const n=this.w*this.h;
  const pixels=new Uint8Array(n);
  const palette=[];
  const map=new Map();
  const TR=255;
  for(let i=0;i<n;i++){
    const a=img[i*4+3];
    if(this.alpha&&a<128){ pixels[i]=TR; continue; }
    const r=img[i*4]&0xF8, g=img[i*4+1]&0xFC, b=img[i*4+2]&0xF8;
    const key=(r<<16)|(g<<8)|b;
    let idx=map.get(key);
    if(idx===undefined){
      if(palette.length<255){ idx=palette.length; palette.push([r,g,b]); map.set(key,idx); }
      else{
        let best=0, bd=1e9;
        for(let j=0;j<255;j++){
          const p=palette[j];
          const d=(p[0]-r)*(p[0]-r)+(p[1]-g)*(p[1]-g)+(p[2]-b)*(p[2]-b);
          if(d<bd){ bd=d; best=j; }
        }
        idx=best; map.set(key,idx);
      }
    }
    pixels[i]=idx;
  }
  this.out.push(0x21,0xF9,4);
  this.out.push(this.alpha?9:8);
  this.wsh(this.delay);
  this.out.push(this.alpha?TR:0);
  this.out.push(0);
  this.out.push(0x2C);
  this.wsh(0); this.wsh(0);
  this.wsh(this.w); this.wsh(this.h);
  this.out.push(0x87);
  for(let i=0;i<256;i++){
    const c=palette[i]||[0,0,0];
    this.out.push(c[0],c[1],c[2]);
  }
  this.lzw(pixels);
};
GifEnc.prototype.lzw=function(pixels){
  const minCode=8;
  this.out.push(minCode);
  const clear=1<<minCode, eoi=clear+1;
  let codeSize=minCode+1, dict=new Map(), next=eoi+1;
  let buf=0, bits=0;
  const bytes=[];
  const emit=c=>{
    buf|=c<<bits; bits+=codeSize;
    while(bits>=8){ bytes.push(buf&0xFF); buf>>=8; bits-=8; }
  };
  emit(clear);
  let prev=pixels[0];
  for(let i=1;i<pixels.length;i++){
    const c=pixels[i];
    const key=(prev<<12)|c;
    if(dict.has(key)){ prev=dict.get(key); }
    else{
      emit(prev);
      dict.set(key,next++);
      if(next>(1<<codeSize)&&codeSize<12)codeSize++;
      if(next>=4096){ emit(clear); dict.clear(); next=eoi+1; codeSize=minCode+1; }
      prev=c;
    }
  }
  emit(prev); emit(eoi);
  if(bits>0)bytes.push(buf&0xFF);
  let p=0;
  while(p<bytes.length){
    const len=Math.min(255,bytes.length-p);
    this.out.push(len);
    for(let i=0;i<len;i++)this.out.push(bytes[p+i]);
    p+=len;
  }
  this.out.push(0);
};
GifEnc.prototype.finish=function(){ this.out.push(0x3B); };

function fitCanvas(){
  const wrap=document.querySelector('.canvas-wrap');
  const frame=document.querySelector('.canvas-frame');
  const pad=40;
  const availW=wrap.clientWidth-pad;
  const availH=wrap.clientHeight-pad;
  const scale=Math.min(availW/W,availH/H,1);
  frame.style.width=(W*scale)+'px';
}
window.addEventListener('resize',fitCanvas);

(function init(){
  restoreLS();
  if(!PRESET_BY_ID[state.preset])state.preset='fireworks';
  syncUI();
  wireRange('count','count');
  wireRange('size','size',v=>v+'%');
  wireRange('speed','speed',v=>v+'%');
  wireRange('grav','grav',v=>v+'%');
  wireRange('wind','wind');
  wireRange('turb','turb',v=>v+'%');
  wireRange('life','life',v=>v+'%');
  wireRange('opacity','opacity',v=>v+'%');
  fitCanvas();
  render(ctx,0);
  requestAnimationFrame(loop);
})();
</script>
</body>
</html>


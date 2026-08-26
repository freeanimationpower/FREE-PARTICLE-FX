# Informe Técnico — FAP Particle FX

Estudio de efectos de partículas y autómatas celulares del ecosistema Free Animation Power.

**Versión analizada**: 54 presets · 7 familias · archivo único `index.php` (~3.000 líneas) + demo estática `docs/index.html`.

---

## 1. Qué es

Herramienta web de motion graphics que genera efectos animados deterministas (partículas, fuego, fluidos pixel) y los exporta a video con o sin canal alfa. Cero dependencias, 100 % cliente: el mismo código dibuja el preview en vivo y cada frame del video exportado.

## 2. Arquitectura general

| Capa | Detalle |
|------|---------|
| Stack | HTML5 + CSS3 + Vanilla JS + Canvas 2D. Sin librerías. PHP solo para el email gate del hub (bypass en localhost) |
| Canvas | `#preview` 1280×720 visible; `#renderCanvas` 1280×720 oculto para exportación |
| Render loop | `requestAnimationFrame`; `render(ctx, t)` pinta un instante exacto `t` |
| Determinismo | Todo el azar sale de `mulberry32(seed)` y `hash32(n)`. El frame `t` del preview y del export son idénticos |
| Sprites | Caché de texturas pre-renderizadas por color: `glowSprite` (64 px, núcleo blanco), `softSprite` (128 px), `ringSprite` (anillo bokeh), `gradSprite` (degradado vertical), `leafSprite`, `petalSprite` |
| Mezcla | `globalCompositeOperation`: normal / lighter (aditivo) / screen |
| Estado | `state` global: preset, cantidad, tamaño, velocidad, gravedad, viento, turbulencia, vida, opacidad, emisor, paleta (12 + personalizada de 5 colores), fondo, semilla, bucle, estelas, duración |

### 2.1 Motor de partículas (39 presets)

- `buildSim()` genera el array `SYS` de partículas al cambiar cualquier parámetro relevante (firma `simSig()`).
- Cada partícula tiene física **analítica** (fórmula cerrada: caída con rozamiento exponencial, arco parabólico, rebote de muelle, órbitas). `frameP(p, tt)` devuelve posición/alfa/tamaño para un tiempo local `tt`; no hay integración numérica por frame.
- `drawP(p, f, ctx)` dibuja con sprites: estelas de movimiento = volver a calcular `frameP` en `tt-0.03` y `tt-0.06` con alfa menor.
- Ciclos: cada partícula re-nace (`b` + `cyc`) para bucles continuos.

### 2.2 Motor DOOM (fuego real)

- Grilla de intensidades 160×90 (`Uint8Array`), 37 tonos de paleta generados desde la paleta elegida (`doomPalFromColors`: anclas oscuras → colores de paleta → blanco incandescente).
- Paso: cada celda copia la celda de abajo menos decaimiento aleatorio (0–1) y la escribe 1 fila arriba con desplazamiento lateral (jitter + viento). La fila inferior es la fuente de calor (intensidad configurable).
- `doomInit()` ejecuta 110 pasos de **precalentado** (la llama arranca encendida). `doomRender(t)` avanza pasos según `floor(t·pasos·speed)`; si el scrubbing retrocede, se reconstruye desde cero (determinista por `hash32(step·k + cell·j + seed)`).
- `doomDraw`: `putImageData` → escalado suavizado 1280×720 → segunda pasada con `ctx.filter='blur(Npx)'` + alfa 0,55 (bloom). Intensidad 0 = alfa 0 (transparencia real).

### 2.3 Motor Pixel FX (15 presets)

Generalización del motor DOOM: grilla `Float32Array` 160×90 + buffer auxiliar, reglas de autómata celular intercambiables, capa de intensidad (`cap`), escala de alfa (`amul`), precalentado (`warm`) y bloom.

Dos familias de reglas:

- **Secuenciales** (dependen del paso anterior; scrub hacia atrás = reconstrucción): lava, humo, agua, arena, lluvia, matrix, tinta, ondas, estática, vida, viento.
- **Directas** (fórmula de tiempo; scrubbing perfecto): plasma, aurora, niebla, nebulosa.

## 3. Catálogo de efectos

### Celebracion (6) — partículas

| Efecto | Cómo funciona |
|--------|---------------|
| Confetti | Rectángulos con degradado vertical y sombra proyectada en el suelo; caída con rozamiento + aleteo senoidal + giro; rebote visual por sombra |
| Fuegos artificiales | Cohetes parabólicos que explotan al alcanzar el vértice (tiempo analítico `te=-vy/g`); 60–110 chispas con estela (pos en `tt-0.05`), destello central y rampa de paleta |
| Explosion | Destello radial único desde el emisor con arrastre exponencial y gravedad |
| Fuente | Chispas lanzadas hacia arriba con gravedad fuerte; rampa amarillo→naranja→rojo fija; estelas |
| Serpentinas | Cintas poligonales de 9 segmentos ondulados (fase por segmento), caída lenta |
| Glitter | Confeti diminuto aditivo con twinkle `sin³` y cruz destello en picos |

### Fuego y luz (7)

| Efecto | Motor | Cómo funciona |
|--------|-------|---------------|
| Llamas (particulas) | Partículas | 3 capas: cuerpo (rampa de 6 tonos + turbulencia de 3 octavas), núcleo incandescente blanco/azul en la base, chispas que saltan |
| **Fuego real (DOOM)** | DOOM | Autómata de calor por píxel, precalentado, bloom, paleta dinámica |
| Brasas | Partículas | Ascenso con turbulencia 2-octavas, parpadeo y rampa fija |
| Humo | Partículas | Nubes `softSprite` grises que crecen y se disipan |
| Polvo magico | Partículas | Espiral elíptica alrededor del emisor, aditivo, cruz blanca en brillos altos |
| Destellos | Partículas | Puntos fijos con pulso `sin³` y cruz de 4 rayos |
| Rayos | Partículas | Trayectorias precomputadas de 22 segmentos (quiebres irregulares con `hash32`), ramas, doble destello (golpe + re-destello), 3 capas de trazo y resplandor de cielo |

### Naturaleza (7) — partículas

| Efecto | Cómo funciona |
|--------|---------------|
| Nieve | Caída lineal + sway senoidal; sprite suave con tintado de paleta |
| Lluvia | Estelas de doble trazo (halo + núcleo) en diagonal con viento |
| Hojas | Sprite de hoja con vena central, caída con giro y aleteo `scaleY` |
| Burbujas | Círculos con degradado esférico, brillo especular y wobble de tamaño |
| Polen | Deriva senoidal doble + twinkle, aditivo dorado |
| Luciernagas | Vagabundeo senoidal 2D; ciclo on/off (sin > 0,4) con halo extra en encendido |
| Niebla | Sprites blancos gigantes con deriva lineal, fundido de entrada/salida (sin saltos de envoltura) |

### Espacio (7)

| Efecto | Motor | Cómo funciona |
|--------|-------|---------------|
| Campo de estrellas | Partículas | Estelas horizontales de longitud proporcional a la velocidad + twinkle |
| **Galaxia** | Partículas | 3 brazos espirales logarítmicos (ángulo = brazo + r·0.022 + jitter), 28 % bulge central, ~300 estrellas de fondo fijas parpadeantes, nebulosas suaves y núcleo brillante; rotación orbital coherente |
| Viaje warp | Partículas | Estelas radiales desde el centro cuya longitud crece con el radio (efecto Star Trek) + núcleo pulsante |
| Aurora boreal | Partículas | 5 cintas poligonales de 48 muestras con degradado vertical y doble seno |
| Meteoros | Partículas | Estela diagonal de doble trazo + cabeza blanca |
| Cometas | Partículas | Cola de 10 sprites decrecientes a lo largo del vector de movimiento |
| Bokeh | Partículas | Anillos `ringSprite` derivando lentos en modo screen |

### Agua (5) — partículas

| Efecto | Cómo funciona |
|--------|---------------|
| Gotas con ondas | Gota parabólica; al tocar el suelo (H-20) nace un anillo elíptico (`ripple`) con tiempo de caída precalculado |
| Ondas | Anillos elípticos expansivos en la base (doble anillo) |
| Salpicaduras | Arcos parabólicos desde el suelo con estela y cabeza brillante |
| Vapor | Columnas blancas que suben con 3 octavas de turbulencia y se expanden |
| Espuma | Cúmulos blancos suaves flotando desde abajo con sway |

### Viento (7) — partículas

| Efecto | Cómo funciona |
|--------|---------------|
| Rafagas | Líneas curvas (cuadrática) con envolvente de intensidad y doble trazo |
| Torbellino | Columna cónica en espiral: altura cíclica, radio creciente con la altura, giro + remolino |
| Remolino | Vórtice en el suelo: espiral hacia adentro, estelas tangenciales, agujero central, aditivo |
| Plumas | Sprite suave alargado girando con sway amplio y deriva de viento fuerte |
| Petalos | Sprite de pétalo con aleteo y giro |
| Polvo | Estelas finas horizontales de baja alfa |
| Tormenta de arena | 75 % granos aéreos con deriva ascendente y turbulencia + 25 % granos que botan en el suelo |

### Pixel FX (15) — autómata celular estilo DOOM

| Efecto | Regla | Detalle |
|--------|-------|---------|
| Lava | Calor ascendente | Igual que fuego DOOM pero decaimiento 0–1 (más viscoso) |
| Humo pixel | Advección ascendente | Sube 1 fila/paso con jitter lateral amplio; fuente intermitente inferior; alfa 0,85 |
| Cascada pixel | Arena cayendo | Fuente superior; cae si la celda inferior está vacía; en el fondo se derrama lateral y se evapora (×0,5) |
| Arena pixel | Sandpile | Fuente superior; cae, y si está bloqueado se desliza en diagonal; se apila y en el fondo se evapora |
| Lluvia pixel | Desplazamiento | Todo baja 2 filas/paso con decaimiento 0,96; filas superiores aleatorias |
| Matrix | Columnas | Cada columna tiene una cabeza (en buffer auxiliar) que baja y escribe intensidad 30; la grilla decae 0,9 → estelas |
| Tinta | Difusión | `nueva = (propia·0,5 + media de vecinos·0,5)·0,99` + 3 fuentes centrales; buffers intercambiados por paso |
| Ondas pixel | Onda 2D | `nueva = (Σ4 vecinos)/2 − anterior`, amortiguada 0,97; gotas cada 3 pasos |
| Estatica TV | Ruido + glitch | Ruido por hash; 3 filas contiguas desplazadas lateralmente (banda de glitch) |
| Juego de la vida | Conway | Reglas B3/S23 sobre grilla toroidal; edad de la célula (1–35) mapea la paleta; patrón inicial aleatorio |
| Viento pixel | Advección de ruido | Cada fila se desplaza con shift aleatorio por paso; valor = producto de senos + jitter |
| Plasma | Directa | `v = sin(x·0.09+t·1.4) + sin(y·0.07−t·1.1) + sin(dist·0.09+t·0.8)` |
| Aurora pixel | Directa | Bandas `sin(y·0.16−t·0.7) + sin(x·0.03+y·0.05+t·0.5)` en modo screen |
| Niebla pixel | Directa | Ruido senoidal 2D lento, alfa 0,6, screen |
| Nebulosa pixel | Directa | 3 senos multi-escala + distancia al centro, alfa 0,85, screen |

## 4. Exportación

| Formato | Método |
|---------|--------|
| WebM + alfa | `MediaRecorder` sobre `captureStream(0)` con `track.requestFrame()` por frame (duracion exacta); fallback a pacing con deadlines absolutos si el navegador no soporta `requestFrame` |
| MP4 | Cascada de MIME: `avc1` → `mp4` → `webm` (si el navegador no soporta MP4, el archivo sale .webm silenciosamente) |
| GIF | `GifEnc` propio: paleta de hasta 255 colores por frame (cuantización 5/6/5 bits), LZW, transparencia por umbral de alfa < 128; sin dependencia de tiempo real |

Los frames se dibujan con la misma `render(t)` del preview. El post-proceso de pixelado (si esta activo) aplica por igual a los tres formatos.

## 5. UI y persistencia

- Paneles: izquierda (controles globales, emisor, mezcla, paleta, fondo, semilla), centro (canvas + timeline con scrubbing), derecha (buscador, 54 presets agrupados, parámetros del preset).
- ESPACIO = reproducir/pausa; clic en timeline = scrub.
- Autoguardado `localStorage['fap_particlefx_v1']`; proyectos JSON `.particlefx` (Guardar/Abrir).
- Botones seleccionados en negro consistente (presets, píldoras, paletas).

## 6. Análisis de falencias

### 6.1 Falencias estéticas/visuales

| # | Falencia | Afecta | Gravedad |
|---|----------|--------|----------|
| 1 | Pixel FX secuenciales con **precalentado fijo**: al abrir el preset (t=0) el efecto aparece ya desarrollado; no hay animación de "encendido" | lava, humo, agua, arena, lluvia, matrix, tinta, ondas, vida | Baja (decisión de diseño) |
| 2 | **Resolución fija 160×90**: sin bloom el pixelado es visible; con bloom se pierde detalle fino | DOOM y Pixel FX | Media |
| 3 | En reglas directas (plasma/niebla/nebula) la **paleta mapea por intensidad**; paletas oscuras (metal, rgb) producen manchas feas; se ven mejor con paletas claras | Pixel FX directas | Media |
| 4 | **Juego de la vida**: el patrón inicial aleatorio (22 % vivo) suele colapsar en colonias estáticas o extinguirse en ~20 segundos; sin re-siembra se queda estático | vida | Media |
| 5 | **Tinta**: la difusión ×0,99 sin reinyección periódica pierde contraste y queda en velo gris | tinta | Media |
| 6 | **Estática TV**: el patrón es ruido blanco uniforme; le falta sincronía de barrido vertical (retroceso de TV real) | estatica | Baja |
| 7 | **Viento pixel** es abstracto: se percibe como nubes de ruido, no como viento | viento | Media |
| 8 | **Aurora (partícula) usa colores fijos** (`AURORA_COLS`); la paleta del usuario no la afecta — incoherente con el resto | aurora | Baja |
| 9 | **Rayos** no responden a viento/turbulencia (trayectorias precomputadas) | rayos, storm | Baja |
| 10 | Ondas pixel **sin reflexión de bordes**: las ondas mueren al llegar al borde (agua real refleja) | ondasPx | Baja |

### 6.2 Falencias técnicas

| # | Falencia | Detalle | Gravedad |
|---|----------|---------|----------|
| 11 | **Scrub hacia atrás caro**: los autómatas secuenciales reconstruyen todos los pasos desde 0 (O(n·14.400)); con duración 20 s y 40 pasos/s son ~11,5 M operaciones por scrub | DOOM, Pixel FX secuenciales | Media |
| 12 | **Exportación en tiempo real**: `sleep(1000/fps)` no garantiza timing; si la máquina se ralentiza el video sale con duración alterada (MediaRecorder graba tiempo real) | todos | Media |
| 13 | **MP4 silencioso**: si `avc1` no existe, descarga .webm con nombre .mp4 corregido por extensión — bien, pero el usuario puede creer que es MP4 | export | Baja |
| 14 | **GIF**: cuantización por frame → banding en degradados; umbral de alfa 128 recorta halos suaves (bloom/niebla) | export | Media |
| 15 | **Bloom con `ctx.filter`**: no soportado en Safari viejo/Firefox antiguo; el fallback silencioso deja el fuego sin halo | DOOM/PX | Baja |
| 16 | **Cantidad/Emisor no aplican a Pixel FX** (grilla fija, fuente interna) — controles globales muertos en esa familia, confunden | Pixel FX | Baja |
| 17 | **Sensibilidad de semilla**: en algunos efectos (polvo, niebla) dos semillas producen resultados casi idénticos; el botón Aleatorio parece no hacer nada | varios | Baja |
| 18 | **Estelas (toggle)** solo afecta tipos con `tr`; el usuario no sabe cuáles | varios | Baja |
| 19 | **Galaxia**: 700+ partículas con glow sprites + línea por enlace puede bajar a <30 fps en equipos débiles | galaxy | Baja |
| 20 | **Estado no migrable**: si cambia el esquema de `state`/localStorage, proyectos guardados viejos pueden cargar con parámetros faltantes (se protege con defaults, pero pp de presets renombrados se pierde) | persistencia | Baja |

### 6.3 Falencias de coherencia de producto

| # | Falencia | Gravedad |
|---|----------|----------|
| 21 | Dos estéticas conviven (partículas suaves vs. píxel DOOM); falta un discurso visual que las una (ej. modo "Pixelizar" global) | Media |
| 22 | Sin previsualización en miniatura de cada preset (el usuario debe probar uno a uno) | Media |
| 23 | Parámetros por preset solo sliders; no hay guardado de presets favoritos | Baja |

## 7. Refactor aplicado — resoluciones y flujos nuevos

### 7.1 Exportacion frame-accurate (resuelve falencia 12)

Doble camino en `exportVideo`:

- **Camino principal**: `captureStream(0)` + `track.requestFrame()` por frame. El video recibe exactamente los frames solicitados; la duracion es matematica, sin depender del rendimiento del CPU.
- **Fallback**: deadlines absolutos `due = start + i*(1000/fps)` con espera activa (`await 0`). El drift se elimina porque el deadline es absoluto, no acumulativo.

El GIF usa `await 0` (cesion de hilo) porque no depende de tiempo real.

### 7.2 Checkpointing del timeline (resuelve falencia 11)

- `DOOM.ck` y `PX.ck`: Map con clave `sig + '|' + bloque`, bloque de 16 pasos, limite de 64 entradas, limpieza en `doomInit`/`pxInit`.
- Al retroceder: restauracion de la instantanea mas cercana y como maximo 16 pasos de recalculo.
- Los efectos con doble buffer (tinta, ondasPx, vida) guardan `grid` y `g2`; la restauracion repone ambos.
- La cache es memoizacion pura: el azar sigue siendo `hash32(step·k + cell·j + seed)`. Verificado: grilla tras scrub con checkpoint identica a la corrida directa con la misma semilla.

### 7.3 Validacion de estado (resuelve falencia 20)

`sanitizeState(raw)` valida antes de aplicar: claves por whitelist de `DEFAULT_STATE`, coerción numerica con `clamp` (count 4-800, duration 0.5-20, seed 1-999999, tiempo 0-20), colores hex estrictos, preset contra `PRESET_BY_ID`, emisor y mezcla contra enumerados, `pp` solo con claves declaradas en los params del preset y con sus minimos/maximos. Aplicado en `restoreLS` y en la carga de archivos.

### 7.4 UI adaptativa (resuelve falencia 16)

`syncUI` oculta `fldCount` (Cantidad) y `secEmitter` (Emisor) cuando la familia es Pixel FX, ya que la grilla celular tiene resolucion y fuente fijas.

### 7.5 Correcciones fisicas y visuales

| Fase | Cambio | Detalle |
|------|--------|---------|
| Vida (falencia 4) | Re-siembra periodica | Cada 25 pasos se inyecta un glider (5 celulas) en posicion derivada de `hash32(step, seed)`. Verificado: 655 celulas vivas tras 600 pasos |
| Tinta (falencia 5) | Inyeccion continua | Decaimiento 0.995 + fuente senoidal `26 + 6·sin(step·0.12)` en 5 columnas con `Math.max` (no sobrescribe brillos). Verificado: maxima 24.3 tras 200 pasos |
| Ondas pixel (falencia 10) | Reflexion de bordes | Vecinos espejo en los cuatro bordes; las ondas rebotan y conservan energia |
| Aurora (falencia 8) | Paleta dinamica | `ci:ci()` en el spawn y `color:PAL[p.ci%PAL.length]` en el frame; la paleta global controla los colores |
| Rayos (falencia 9) | Viento y turbulencia | `spread × (turb/100)` y sesgo `(round(wind/50)−2)·1.5` en cada paso horizontal; color del trazo desde la paleta |
| Estetica (falencia 21) | Pixelado global | Post-proceso 320x180 sin suavizado al final de `render()`; unifica particulas y automatas en preview y exportacion |

### 7.6 Determinismo

Toda la aleatoriedad nueva (gliders, fuentes de tinta, jitter existente) usa `hash32` con la semilla de estado. La exportacion y el preview comparten `render()`, por lo que el frame `t` es identico en ambos.

## 8. Recomendaciones restantes

1. **P2** — Miniaturas de presets (render offscreen de 1 s y `toDataURL`) para elegir efectos sin probar uno a uno.
2. **P3** — Ajuste automatico de resolucion de grilla segun el dispositivo (rendimiento en equipos debiles).
3. **P3** — Galeria de favoritos con guardado de combinaciones paleta + parametros.
4. **P3** — Documentacion de la sensibilidad de la semilla por efecto.

---

*Generado para revisión del ecosistema Free Animation Power.*

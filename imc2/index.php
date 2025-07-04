<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Superhéroes</title>
  <link href="https://fonts.googleapis.com/css?family=Faster+One" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- Encabezado con nombre y botón debajo -->
  <div class="encabezado">
    <h1 class="nombre">Diana Paola Jimenez Ramirez</h1>
    <button class="boton-info" onclick="mostrarInformacion()">Ver Perfil</button>
    
    <!-- Información oculta que se despliega debajo del botón -->
    <div id="info" class="info-oculta">
      <img src="img\descarga.jpg" alt="Foto" class="foto-perfil" />
      <p><strong> INSTITUTO TECNOLOGICO SUPERIOR DE COMALCALCO</p>
      <p><strong>CARRERA:</strong> Ingenieria en Sistemas Computacionales</p>
      <p><strong>MATERIA:</strong> Verificación y Validación de Software</p>
      <p><strong>DOCENTE:</strong> Elías Rodríguez Rodríguez</p>
       <p><strong>SEMESTRE:</strong> 9 Grupo A</p>
      <p><strong>MATRICULA:</strong> TE210705</p>
    </div>
  </div>

  <!-- Separador -->
  <div class="separador"></div>

  <!-- Contenedor fila superhéroes -->
  <div class="fila-superheroes" id="contenedor-superheroes">
    <!-- Cards serán agregadas por JS -->
  </div>

  <script>
    async function populate() {
      const requestURL = "superheroes.json";
      const response = await fetch(requestURL);
      const superHeroes = await response.json();
      populateHeroes(superHeroes);
    }

    function populateHeroes(obj) {
      const contenedor = document.getElementById('contenedor-superheroes');
      const heroes = obj.members;

      for (const hero of heroes) {
        const card = document.createElement('div');
        card.classList.add('card');

        const titulo = document.createElement('h2');
        titulo.textContent = hero.name;
        titulo.classList.add('subtitulo');

        const para1 = document.createElement('p');
        para1.textContent = `Identidad secreta: ${hero.secretIdentity}`;

        const para2 = document.createElement('p');
        para2.textContent = `Edad: ${hero.age}`;

        const para3 = document.createElement('p');
        para3.textContent = 'Poderes:';

        const lista = document.createElement('ul');
        for (const poder of hero.powers) {
          const li = document.createElement('li');
          li.textContent = poder;
          lista.appendChild(li);
        }

        card.appendChild(titulo);
        card.appendChild(para1);
        card.appendChild(para2);
        card.appendChild(para3);
        card.appendChild(lista);

        contenedor.appendChild(card);
      }
    }

    function mostrarInformacion() {
      document.getElementById('info').classList.toggle('info-oculta');
    }

    populate();
  </script>
</body>
</html>

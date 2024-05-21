<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-KTZ25JHZGT"></script>
	<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KTZ25JHZGT');
	</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Postulación Programa Quantum</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <style>
    /* Clase para ocultar elementos, usada para controlar la visibilidad de las secciones del formulario */
    .hidden {
        display: none;
    }

    /* Keyframes para animar el giro y cambio de opacidad del SVG */
    @keyframes rotateAndFade {
    from {
        transform: translate(-50%, -50%) rotate(0deg);
        opacity: 0.5;
    }
    to {
        transform: translate(-50%, -50%) rotate(90deg);
        opacity: 0.8;
    }
}

    /* Clase que aplica la animación definida a los elementos, asegurando que la animación se mantiene al finalizar */
    .animated {
        animation: rotateAndFade 0.5s ease forwards;
    }

    /* Estilos para posicionar el SVG como una marca de agua detrás del contenido del formulario */
    #logoSvg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* Centra el SVG exactamente en el centro de la pantalla */
        width: 1000px; /* Tamaño adecuado para visualización como marca de agua */
        height: 1000px;
        opacity: 0.5; /* Opacidad inicial para que actúe como una marca de agua sutil */
        z-index: -1; /* Coloca el SVG detrás del formulario */
    }

	.bg-semi-transparent {
    	background-color: rgba(255, 255, 255, 0.5);
    }

   .timeline-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-top: 20px;
    }

    .timeline-point {
        width: 20px;
        height: 20px;
        background-color: gray; /* Color inicial */
        border-radius: 50%;
        transition: background-color 0.4s ease-in-out, border-color 0.4s ease-in-out; /* Suaviza el cambio de color */
    }

    .timeline-line {
        flex-grow: 1;
        height: 3px;
        background-color: gray;
        border-radius: 5px; /* Bordes redondeados */
        margin: 0 10px;
        transition: background-color 0.4s ease-in-out; /* Suaviza el cambio de color */
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var rutField = document.getElementById('rut');
    rutField.addEventListener('blur', function() {
        loadDraftData(this.value);
    });
});

function loadDraftData(rut) {
    if (rut) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'load_draft.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                var response = JSON.parse(this.responseText);
                if (response) {
                    // Asumiendo que response es un objeto con las propiedades que corresponden a los nombres de los campos del formulario
                    Object.keys(response).forEach(function(key) {
                        var input = document.getElementById(key);
                        if (input) {
                            input.value = response[key];
                        }
                    });
                }
            }
        };
        xhr.send('rut=' + encodeURIComponent(rut));
    }
}
</script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <img id="logoSvg" src="iconsvg.svg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 1000px; height: 1000px; opacity: 0.1; z-index: -1;" />
    <div class="w-full max-w-4xl p-5 rounded shadow bg-semi-transparent">
	<img src="logoquantum.png" alt="Header Image" class="w-full md:w-3/4 lg:w-1/2 mx-auto rounded">
<h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mt-4">Formulario de Postulación</h1>
    <h2 class="text-xl lg:text-2xl font-semibold text-gray-700 mt-2">Programa "Nextech Startup Evolution: Salto Cuántico al Éxito de Startups en Tarapacá"</h2><br>
        <form action="submit.php" method="POST" id="multiStepForm">
            <!-- Sección 1 -->
            <div id="section1" class="form-section">
                <div class="mb-4">
                    <label for="rut" class="font-bold text-lg">RUT</label>
                    <input type="text" id="rut" name="rut" class="w-full p-2 border rounded" placeholder="Ingresa tu RUT" maxlength="10" onblur="verifyRUT()">
                </div>
                    <div class="mb-4">
                    <label for="nombreCompleto" class="font-bold text-lg">Nombre Completo</label>
                    <input type="text" id="nombreCompleto" name="nombreCompleto" class="w-full p-2 border rounded" placeholder="Tu nombre completo">
                </div>
                <div class="mb-4">
                    <label for="cargo" class="font-bold text-lg">Cargo en Emprendimiento</label>
                    <input type="text" id="cargo" name="cargo" class="w-full p-2 border rounded" placeholder="Tu cargo">
                </div>
                <button type="button" onclick="showSection(2)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</button>
            </div>

            <!-- Sección 2 -->
            <div id="section2" class="form-section hidden">
                <div class="mb-4">
                    <label for="telefono" class="font-bold text-lg">Teléfono Celular</label>
                    <input type="text" id="telefono" name="telefono" class="w-full p-2 border rounded" placeholder="Tu número de celular">
                </div>
                <div class="mb-4">
                    <label for="region" class="font-bold text-lg">Región de Residencia</label>
                    <select id="region" name="region" class="w-full p-2 border rounded">
                        <option value="">Selecciona una región</option>
                        <option value="Arica y Parinacota">Arica y Parinacota</option>
                        <option value="Tarapacá">Tarapacá</option>
                        <option value="Antofagasta">Antofagasta</option>
                        <option value="Atacama">Atacama</option>
                        <option value="Coquimbo">Coquimbo</option>
                        <option value="Valparaíso">Valparaíso</option>
                        <option value="Región Metropolitana de Santiago">Región Metropolitana de Santiago</option>
                        <option value="O’Higgins">O’Higgins</option>
                        <option value="Maule">Maule</option>
                        <option value="Ñuble">Ñuble</option>
                        <option value="Biobío">Biobío</option>
                        <option value="Araucanía">Araucanía</option>
                        <option value="Los Ríos">Los Ríos</option>
                        <option value="Los Lagos">Los Lagos</option>
                        <option value="Aysén">Aysén</option>
                        <option value="Magallanes">Magallanes</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="email" class="font-bold text-lg">E-Mail</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border rounded" placeholder="email@example.com">
                </div>
                <button type="button" onclick="showSection(1)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Anterior</button>
                <button type="button" onclick="showSection(3)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</button>
            </div>

            <!-- Sección 3 -->
            <div id="section3" class="form-section hidden">
                <div class="mb-4">
                    <label for="sitioWeb" class="font-bold text-lg">Sitio Web /RRSS del Emprendimiento (Opcional)</label>
                    <input type="text" id="sitioWeb" name="sitioWeb" class="w-full p-2 border rounded" placeholder="URL del sitio web o RRSS">
                </div>
                <div class="mb-4">
                    <label for="actorPrevio" class="font-bold text-lg">¿Ha trabajado anteriormente con algún actor del ecosistema emprendedor?, ¿Cuál(es)?</label>
                    <input type="text" id="actorPrevio" name="actorPrevio" class="w-full p-2 border rounded" placeholder="Actores del ecosistema">
                </div>
                <div class="mb-4">
                    <label for="nombreSolucion" class="font-bold text-lg">Nombre de la Solución</label>
                    <input type="text" id="nombreSolucion" name="nombreSolucion" class="w-full p-2 border rounded" placeholder="Nombre de tu solución">
                </div>
                <button type="button" onclick="showSection(2)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Anterior</button>
                <button type="button" onclick="showSection(4)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</button>
            </div>

            <!-- Sección 4 -->
            <div id="section4" class="form-section hidden">
                <div class="mb-4">
                    <label for="descripcionSolucion" class="font-bold text-lg">Describe brevemente tu idea o solución tecnológica.</label>
                    <textarea id="descripcionSolucion" name="descripcionSolucion" class="w-full p-2 border rounded" placeholder="Incluye detalles sobre el problema que resuelve y cómo tu solución se diferencia de otras existentes en el mercado."></textarea>
                </div>
                <div class="mb-4">
                    <label for="caracteristicas" class="font-bold text-lg">Explica cuáles son las principales características que hacen única a tu propuesta.</label>
                    <textarea id="caracteristicas" name="caracteristicas" class="w-full p-2 border rounded" placeholder="¿Qué ventajas competitivas tiene tu solución sobre otras?"></textarea>
                </div>
                <div class="mb-4">
                    <label for="estadoPrototipo" class="font-bold text-lg">Si cuentas con un prototipo o una versión inicial de tu producto/servicio, descríbelo.</label>
                    <textarea id="estadoPrototipo" name="estadoPrototipo" class="w-full p-2 border rounded" placeholder="Detalla su estado actual y qué avances has logrado hasta el momento."></textarea>
                </div>
                <button type="button" onclick="showSection(3)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Anterior</button>
                <button type="button" onclick="showSection(5)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</button>
            </div>

            <!-- Sección 5 -->
            <div id="section5" class="form-section hidden">
                <div class="mb-4">
                    <label for="equipo" class="font-bold text-lg">¿Posee un equipo de trabajo multidisciplinario con las competencias necesarias para desarrollar el proyecto?</label>
                    <textarea id="equipo" name="equipo" class="w-full p-2 border rounded" placeholder="Describe brevemente los perfiles del equipo, puede adjuntar enlaces de Linkedin u otros."></textarea>
                </div>
                <div class="mb-4">
                    <label for="videoProyecto" class="font-bold text-lg">Adjunta enlace de video de máximo 180 segundos integrando aspectos relevantes de su proyecto.</label>
                    <input type="text" id="videoProyecto" name="videoProyecto" class="w-full p-2 border rounded" placeholder="URL del video">
                </div>
                <div class="mb-4">
                    <label for="videoSeleccion" class="font-bold text-lg">Cuéntanos en un video ¿Por qué debemos seleccionarte?</label>
                    <input type="text" id="videoSeleccion" name="videoSeleccion" class="w-full p-2 border rounded" placeholder="URL del video">
                </div>
                <div class="mb-4">
                    <label for="fuente" class="font-bold text-lg">¿Cómo te enteraste de esta convocatoria?</label>
                    <div class="flex gap-4">
                        <div>
                            <input type="checkbox" id="fuenteLinkedin" name="fuente[]" value="Linkedin">
                            <label for="fuenteLinkedin">Linkedin</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fuenteInstagram" name="fuente[]" value="Instagram">
                            <label for="fuenteInstagram">Instagram</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fuenteFacebook" name="fuente[]" value="Facebook">
                            <label for="fuenteFacebook">Facebook</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fuenteEmail" name="fuente[]" value="Email">
                            <label for="fuenteEmail">Email</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fuenteAmigo" name="fuente[]" value="Amigo">
                            <label for="fuenteAmigo">Por un Amigo o Amiga</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fuenteOtro" name="fuente[]" value="Otro">
                            <label for="fuenteOtro">Otro</label>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="showSection(4)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Anterior</button>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Enviar</button>
            </div>
        </form>
    <div class="timeline-container mt-4">
    <div class="timeline-point" data-section="1"></div>
    <div class="timeline-line"></div>
    <div class="timeline-point" data-section="2"></div>
    <div class="timeline-line"></div>
    <div class="timeline-point" data-section="3"></div>
    <div class="timeline-line"></div>
    <div class="timeline-point" data-section="4"></div>
    <div class="timeline-line"></div>
    <div class="timeline-point" data-section="5"></div>
</div>
    <div class="flex justify-center items-center space-x-4 mt-4 flex-wrap">
    <img src="logocolor3.png" alt="Imagen 1" class="rounded-lg w-full sm:w-auto" style="max-width: 500px;">
    </div>

    <script>
        function showSection(section) {
            const allSections = document.querySelectorAll('.form-section');
            allSections.forEach(sec => sec.classList.add('hidden'));
            document.getElementById('section' + section).classList.remove('hidden');
        }
    </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const points = document.querySelectorAll('.timeline-point');
    const lines = document.querySelectorAll('.timeline-line');

    function showSection(section) {
        const allSections = document.querySelectorAll('.form-section');
        allSections.forEach((sec, index) => {
            if (index + 1 === section) {
                sec.classList.remove('hidden');
                updateTimeline(index + 1);
            } else {
                sec.classList.add('hidden');
            }
        });
    }

    function updateTimeline(currentSection) {
        const inputs = document.getElementById(`section${currentSection}`).querySelectorAll('input, textarea, select');
        let isValid = true;
        inputs.forEach(input => {
            if (input.type !== 'checkbox' && input.type !== 'radio' && !input.value.trim()) isValid = false;
        });

        points[currentSection - 1].style.backgroundColor = isValid ? 'green' : 'blue';
        points[currentSection - 1].style.borderColor = isValid ? 'green' : 'blue';
        if (currentSection > 1) {
            lines[currentSection - 2].style.backgroundColor = isValid ? 'green' : 'blue';
        }
    }

    // Formatea el RUT mientras el usuario escribe
const rutInput = document.getElementById('rut');
rutInput.addEventListener('input', function(e) {
    let valor = e.target.value.replace(/[^\dKk]/g, ''); // Elimina todos los caracteres que no sean números o K

    // Comprobar si el último carácter es un dígito o una K, y si la longitud es adecuada para insertar un guión
    if (valor.length > 1) {
        let cuerpo = valor.slice(0, -1); // Todos los dígitos excepto el último
        let dv = valor.slice(-1).toUpperCase(); // El último dígito o K, convertido a mayúscula

        valor = cuerpo + '-' + dv; // Agrega el guión
    }

    e.target.value = valor; // Actualiza el valor del campo con el formato correcto
});


    rutInput.addEventListener('blur', function(e) {
        const rut = e.target.value;
        if (!/^(\d{1,8}-[\dkK])$/.test(rut)) {
            alert("El formato del RUT es incorrecto. Debe ser como 12345678-9 o 12345678-K.");
            return;
        }

        const [cuerpo, dv] = rut.split('-');
        let suma = 0;
        const multiplo = [2, 3, 4, 5, 6, 7];
        for (let i = cuerpo.length - 1, j = 0; i >= 0; i--, j = (j + 1) % 6) {
            suma += parseInt(cuerpo.charAt(i)) * multiplo[j];
        }

        const dvCalculado = 11 - (suma % 11);
        const dvEsperado = dvCalculado === 10 ? 'K' : dvCalculado === 11 ? '0' : dvCalculado.toString();
        if (dv.toUpperCase() !== dvEsperado) {
            alert("El dígito verificador es incorrecto. Debería ser " + dvEsperado);
        } else {
            alert("El RUT es válido.");
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const allSections = document.querySelectorAll('.form-section');
    const points = document.querySelectorAll('.timeline-point');
    const lines = document.querySelectorAll('.timeline-line');

    // Función para mostrar la sección correspondiente
    function showSection(section) {
        allSections.forEach((sec, index) => {
            sec.classList.add('hidden');
            if (index + 1 === section) {
                sec.classList.remove('hidden');
                updateTimeline(section);
            }
        });
    }

    // Función para actualizar el color de la línea de tiempo
    function updateTimeline(currentSection) {
        for (let i = 0; i < currentSection; i++) {
            if (validateSection(i + 1)) {
                points[i].style.backgroundColor = 'green';
                points[i].style.borderColor = 'green';
                if (i > 0) {
                    lines[i - 1].style.backgroundColor = 'green';
                }
            } else {
                points[i].style.backgroundColor = 'blue';
                points[i].style.borderColor = 'blue';
                if (i > 0) {
                    lines[i - 1].style.backgroundColor = 'blue';
                }
            }
        }
    }

    // Función para validar una sección específica
    function validateSection(index) {
        const section = document.getElementById(`section${index}`);
        if (!section) return false;
        const inputs = section.querySelectorAll('input[type="text"], input[type="email"], textarea, select');
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    // Agregar evento a botones para cambiar de sección
    document.querySelectorAll('button[onclick^="showSection"]').forEach(button => {
        button.addEventListener('click', function () {
            const nextSection = parseInt(this.getAttribute('onclick').match(/\d+/)[0]);
            showSection(nextSection);
        });
    });

    // Rotación y animación del logo SVG
    const logoSvg = document.getElementById('logoSvg');
    let currentDegree = 0;

    function rotateLogo() {
        currentDegree += 90; // Incrementa 90 grados
        logoSvg.style.transform = `translate(-50%, -50%) rotate(${currentDegree % 360}deg)`;
    }

    // Registrar eventos de botones Siguiente para animar el logo
    document.querySelectorAll('button[onclick*="showSection"]').forEach(button => {
        button.addEventListener('click', rotateLogo);
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const logoSvg = document.getElementById('logoSvg');
    let currentDegree = 0; // Inicializa el grado de rotación aquí para un mejor control

    // Registrar un solo manejador de eventos para manejar el fin de cada animación
    logoSvg.addEventListener('animationend', () => {
        currentDegree += 90; // Añade 90 grados después de cada animación
        logoSvg.style.transform = `translate(-50%, -50%) rotate(${currentDegree % 360}deg)`; // Usa módulo para evitar el overflow
        logoSvg.classList.remove('rotate');
    });

    document.querySelectorAll('button[onclick^="showSection"]').forEach(button => {
        button.addEventListener('click', function () {
            const nextSection = parseInt(this.getAttribute('onclick').match(/\d+/)[0]);
            showSection(nextSection);
            rotateLogo();
        });
    });

    function rotateLogo() {
        logoSvg.classList.add('rotate'); // Solo inicia la animación
    }

    function showSection(sectionNumber) {
        // Asumiendo que existe una función para manejar la lógica de mostrar secciones
        console.log("Mostrando sección:", sectionNumber);
    }
});
</script>
<script>
function verifyRUT() {
    var rut = document.getElementById('rut').value;
    if (rut) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'verify_rut.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                var response = JSON.parse(this.responseText);
                if (response.exists) {
                    alert("Bienvenido de nuevo. Por favor, continúa llenando tu formulario.");
                    fillFormWithData(response.data); // Función para rellenar el formulario
                } else {
                    alert("Pareces ser un nuevo postulante. Tu información se guardará como borrador.");
                }
            }
        };
        xhr.send('rut=' + encodeURIComponent(rut));
    }
}

function fillFormWithData(data) {
    document.getElementById('nombreCompleto').value = data.nombre_completo || '';
    // Completa otros campos del formulario de manera similar
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('blur', function () {
            if (this.value.trim() !== "") { // Solo guarda si hay algo escrito
                autoSaveField(this.id, this.value);
            }
        });
    });
});

function autoSaveField(fieldId, value) {
    const rut = document.getElementById('rut').value;
    if (!rut) {
        console.log('RUT no proporcionado, guardado automático no realizado.');
        return;
    }
    var data = `field=${fieldId}&value=${encodeURIComponent(value)}&rut=${encodeURIComponent(rut)}`;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'autosave.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log('Autoguardado completado: ' + this.responseText);
        }
    };
    xhr.send(data);
}
</script>
</body>
</html>



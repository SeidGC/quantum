<!DOCTYPE html>
<html lang="es">
<head>
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
                // Asegurarse de que la respuesta incluye un indicativo claro de éxito o fallo
                if (response.success) {
                    Object.keys(response.data).forEach(function(key) {
                        var input = document.getElementById(key);
                        if (input) {
                            input.value = response.data[key];
                        }
                    });
                    alert("Bienvenido de nuevo. Por favor, continúa llenando tu formulario.");
                } else {
                    alert("Pareces ser un nuevo postulante. Tu información se guardará como borrador.");
                }
            } else {
                alert("Error al cargar datos. Por favor, inténtalo de nuevo.");
            }
        };
        xhr.onerror = function() {
            // Manejo de errores de conexión
            alert("Error en la conexión con el servidor.");
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
// Función para cambiar de sección en el formulario
function showSection(section) {
    const allSections = document.querySelectorAll('.form-section');
    // Oculta todas las secciones y muestra la seleccionada
    allSections.forEach(sec => sec.classList.add('hidden'));
    document.getElementById('section' + section).classList.remove('hidden');
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const points = document.querySelectorAll('.timeline-point');
    const lines = document.querySelectorAll('.timeline-line');

    // Función para mostrar la sección del formulario y actualizar la línea de tiempo
    function showSection(section) {
        const allSections = document.querySelectorAll('.form-section');
        allSections.forEach((sec, index) => {
            sec.classList.add('hidden');
            if (index + 1 === section) {
                sec.classList.remove('hidden');
                updateTimeline(index + 1);
            }
        });
    }

    // Actualiza la línea de tiempo basándose en la validez de los datos de la sección actual
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
        let valor = e.target.value.replace(/\D/g, '');
        if (valor.length > 1) {
            valor = valor.slice(0, -1) + '-' + valor.slice(-1);
        }
        e.target.value = valor;
    });

    // Verifica el RUT al perder el foco del campo
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
    // Función para actualizar la validez de la sección actual y ajustar la animación del logo
    function validateSection(index) {
        const section = document.getElementById(`section${index}`);
        if (!section) return false;
        const inputs = section.querySelectorAll('input[type="text"], input[type="email"], textarea, select');
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    // Función para rotar el logo al cambiar de sección
    function rotateLogo() {
        const logoSvg = document.getElementById('logoSvg');
        let currentDegree = 0;
        logoSvg.addEventListener('animationend', () => {
            currentDegree += 90;
            logoSvg.style.transform = `translate(-50%, -50%) rotate(${currentDegree % 360}deg)`;
            logoSvg.classList.remove('rotate');
        });

        document.querySelectorAll('button[onclick^="showSection"]').forEach(button => {
            button.addEventListener('click', function () {
                const nextSection = parseInt(this.getAttribute('onclick').match(/\d+/)[0]);
                showSection(nextSection);
                logoSvg.classList.add('rotate'); // Inicia la animación
            });
        });
    }

    rotateLogo(); // Inicializa la animación del logo al cargar el documento
});
</script>

<script>
// Función para verificar el RUT y cargar datos si existe previamente
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
                    fillFormWithData(response.data);
                } else {
                    alert("Pareces ser un nuevo postulante. Tu información se guardará como borrador.");
                }
            }
        };
        xhr.send('rut=' + encodeURIComponent(rut));
    }
}

// Función para rellenar el formulario con datos cargados
function fillFormWithData(data) {
    // Verifica que 'data' no sea nulo antes de intentar acceder a sus propiedades
    if (!data) {
        console.error('No se recibieron datos para llenar el formulario.');
        return;
    }

    document.getElementById('nombreCompleto').value = data.nombre_completo || '';
    document.getElementById('cargo').value = data.cargo || '';
    document.getElementById('telefono').value = data.telefono_celular || '';
    document.getElementById('region').value = data.region_residencia || '';
    document.getElementById('email').value = data.email || '';
    document.getElementById('sitioWeb').value = data.sitio_web || '';
    document.getElementById('actorPrevio').value = data.actor_ecosistema || '';
    document.getElementById('nombreSolucion').value = data.nombre_solucion || '';
    document.getElementById('descripcionSolucion').value = data.descripcion_solucion || '';
    document.getElementById('caracteristicas').value = data.caracteristicas_solucion || '';
    document.getElementById('estadoPrototipo').value = data.estado_prototipo || '';
    document.getElementById('equipo').value = data.equipo_descripcion || '';
    document.getElementById('videoProyecto').value = data.video_proyecto || '';
    document.getElementById('videoSeleccion').value = data.video_seleccion || '';

    // Manejo seguro de 'fuente_informacion' que espera un string de valores separados por comas
    if (data.fuente_informacion) {
        const fuentesActivas = data.fuente_informacion.split(',');
        ['fuenteLinkedin', 'fuenteInstagram', 'fuenteFacebook', 'fuenteEmail', 'fuenteAmigo', 'fuenteOtro'].forEach(function(fieldId) {
            document.getElementById(fieldId).checked = fuentesActivas.includes(document.getElementById(fieldId).value);
        });
    } else {
        // Desmarcar todas las opciones si no hay información disponible
        ['fuenteLinkedin', 'fuenteInstagram', 'fuenteFacebook', 'fuenteEmail', 'fuenteAmigo', 'fuenteOtro'].forEach(function(fieldId) {
            document.getElementById(fieldId).checked = false;
        });
    }
}


</script>
<script>
function camelToSnakeCase(str) {
    return str.replace(/[\w]([A-Z])/g, function(m) {
        return m[0] + "_" + m[1].toLowerCase();
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() !== "") {
                console.log(`Enviando: ${this.id} (convertido: ${camelToSnakeCase(this.id)}) con valor: ${this.value}`);
                autoSaveField(this.id, this.value);
            }
        });
    });
});

function autoSaveField(fieldId, value) {
    const rut = document.getElementById('rut').value;
    if (!rut) {
        console.error('RUT no proporcionado, guardado automático no realizado.');
        return;
    }
    const snakeCaseId = camelToSnakeCase(fieldId);

    var data = `field=${snakeCaseId}&value=${encodeURIComponent(value)}&rut=${encodeURIComponent(rut)}`;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'autosave.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (this.readyState === 4) {
            console.log(`Respuesta para campo ${snakeCaseId}: ${this.responseText}`);
            if (this.status !== 200) {
                console.error('Error en el autoguardado con status ' + this.status + ': ' + this.statusText);
            }
        }
    };
    xhr.onerror = function() {
        console.error('Error en la red o problema en el servidor al intentar autoguardar.');
    };
    xhr.send(data);
}

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const points = document.querySelectorAll('.timeline-point');
    const lines = document.querySelectorAll('.timeline-line');

    // Función para mostrar la sección del formulario y actualizar la línea de tiempo
    function showSection(section) {
        const allSections = document.querySelectorAll('.form-section');
        allSections.forEach((sec, index) => {
            sec.classList.add('hidden');
            if (index + 1 === section) {
                sec.classList.remove('hidden');
                updateTimeline(index + 1);
            }
        });
    }

    // Actualiza la línea de tiempo basándose en la validez de los datos de la sección actual
    function updateTimeline(currentSection) {
        const inputs = document.getElementById(`section${currentSection}`).querySelectorAll('input, textarea, select');
        let isValid = true;
        inputs.forEach(input => {
            if (input.type !== 'checkbox' && input.type !== 'radio' && !input.value.trim()) {
                isValid = false;
            }
        });

        points[currentSection - 1].style.backgroundColor = isValid ? 'green' : 'blue';
        points[currentSection - 1].style.borderColor = isValid ? 'green' : 'blue';
        if (currentSection > 1) {
            lines[currentSection - 2].style.backgroundColor = isValid ? 'green' : 'blue';
        }
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

    // Validar campos en tiempo real para actualización de la línea de tiempo
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('change', function () {
            let sectionIndex = this.closest('.form-section').getAttribute('id').match(/\d+/)[0];
            updateTimeline(sectionIndex);
        });
    });
});
</script>
</body>
</html>



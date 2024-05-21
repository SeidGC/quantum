<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Tabla de Reportes</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    text-align: left;
    padding: 12px;
    border-bottom: 1px solid #ddd;
  }
  th {
    background-color: #4CAF50;
    color: white;
  }
  tr:hover {
    background-color: #f5f5f5;
  }
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
  }
  .modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  }
  .modal-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  .modal-table th, .modal-table td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
  }
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>
</head>
<body>

<h2>Tabla de Reportes</h2>
<table id="reportTable">
  <thead>
    <tr>
      <th>Nombre Completo</th>
      <th>Nombre Solución</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require 'db.php'; // Incluye la configuración de la base de datos
    $sql = "SELECT * FROM postulantes";
    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch()) {
        echo "<tr onclick='showModal(".json_encode($row).")'>";
        echo "<td>" . htmlspecialchars($row["nombre_completo"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nombre_solucion"]) . "</td>";
        echo "</tr>";
    }
    ?>
  </tbody>
</table>

<!-- Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <table class="modal-table">
      <!-- Detalles del registro se insertarán aquí -->
    </table>
  </div>
</div>

<script>
function showModal(data) {
  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  var table = document.querySelector(".modal-content .modal-table");
  table.innerHTML = ""; // Limpia el contenido anterior
  Object.keys(data).forEach(function(key) {
    var tr = document.createElement('tr');
    tr.innerHTML = "<th>" + key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase()) + "</th><td>" + data[key] + "</td>";
    table.appendChild(tr);
  });

  modal.style.display = "block";

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}
</script>

</body>
</html>


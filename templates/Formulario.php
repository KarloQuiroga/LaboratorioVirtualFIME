<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="col-12">
    <div class="card">
      <div class="card-header">Completa el formulario</div>
      <div class="card-body">
        <form action="../static/php/LeerCSV.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="archivo">Selecciona un archivo <code>.csv</code></label>
            <input type="file" class="form-control" name="archivo" id="archivo" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
          </div>
          <button class="btn btn-success" type="submit">Importar</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
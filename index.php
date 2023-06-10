<?php
session_start();
$arrayEmployees = [];
$arrayAux = [];
if (isset($_SESSION['EmployeeData'])) {
  $arrayEmployees = $_SESSION['EmployeeData'];

}
if (isset($_POST['delete'])) {
  session_destroy();
  header("Location: index.php");
}
class employee
{
  public $nameEmployee;
  public $surnameEmployee;
  public $ageEmployee;
  public $civilStatusEmployee;
  public $incomeEmployee;
  public $sexEmployee;

  public function __construct($name, $surname, $age, $civilStatus, $income, $sex)
  {
    $this->nameEmployee = $name;
    $this->surnameEmployee = $surname;
    $this->ageEmployee = $age;
    $this->civilStatusEmployee = $civilStatus;
    $this->incomeEmployee = $income;
    $this->sexEmployee = $sex;
  }
  public function getName()
  {
    return $this->nameEmployee;
  }
  public function getSurname()
  {
    return $this->surnameEmployee;
  }
  public function getAge()
  {
    return $this->ageEmployee;
  }
  public function getCivilStatus()
  {
    return $this->civilStatusEmployee;
  }
  public function getIncome()
  {
    return $this->incomeEmployee;
  }
  public function getSex()
  {
    return $this->sexEmployee;
  }
}



if ((isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['age'])) && (isset($_POST['civilStatus']) && isset($_POST['income']) && isset($_POST['sex']))) {
  if ((!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['age'])) && (!empty($_POST['civilStatus']) && !empty($_POST['income']) && !empty($_POST['sex']))) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $civilStatus = $_POST['civilStatus'];
    $income = $_POST['income'];
    $sex = $_POST['sex'];

    date_default_timezone_set('America/Caracas');
    $date = date('d-m-Y');
    $birthdate = $_POST['age'];

    $exactBirthdate = strtotime($date) - strtotime($birthdate);
    $age = intval($exactBirthdate / 60 / 60 / 24 / 365.25);

    $arrayAux = new employee($name, $surname, $age, $civilStatus, $income, $sex);
    array_push($arrayEmployees, $arrayAux);
    $_SESSION['EmployeeData'] = $arrayEmployees;
  } else {
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!--Metadata-->
  <meta name="author" content="Daniel Prieto" />
  <meta name="description" content="Ejercicio 1 de Programación web" />
  <meta name="keywords" content="" />
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--Title-->
  <title>Ejercicio 1 | Daniel Prieto</title>
  <!--Boostrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
</head>

<body>
  <div class="container">
    <h1>Registro de empleados</h1>
    <div>
      <h4>Ingrese sus datos de empleado:</h4>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="nameid">Nombre:</label>
              <input type="text" id="nameid" class="form-control" placeholder="nombre" name="name" />
            </div>
            <div class="col">
              <label for="surnameid">Apellido:</label>
              <input type="text" id="surnameid" class="form-control" placeholder="apellido" name="surname" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="ageid">Edad:</label>
          <input type="date" id="ageid" class="form-control" name="age" min="1900-01-01" max="2004-12-31" />
        </div>
        <div class="form-group">
          <label for="civilStatusid">Estado civil:</label>
          <select name="civilStatus" id="civilStatusid" class="form-select" aria-label="Default select example">
            <option value="Soltero(a)">Soltero(a)</option>
            <option value="Casado(a)">Casado(a)</option>
            <option value="Viudo(a)">Viudo(a)</option>
          </select>
        </div>

        <div class="form-group">
          <label for="incomeid">Sueldo:</label>
          <select name="income" id="incomeid" class="form-select" aria-label="Default select example">
            <option value="Menos de 1000">Menos de 1000</option>
            <option value="entre 1000 y 2500">Entre 1000 y 2500</option>
            <option value="mas de 2500">Más de 2500</option>
          </select>
        </div>
        <div class="form-group">
          <p>Sexo</p>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="femaleid" value="Femenino" name="sex" />
            <label class="form-check-label" for="femaleid">Femenino</label><br />

            <input type="radio" class="form-check-input" id="maleid" value="Masculino" name="sex" />
            <label class="form-check-label" for="maleid">Masculino</label><br />

            <input type="radio" class="form-check-input" id="otherid" value="Otro" name="sex" />
            <label class="form-check-label" for="otherid">Otro</label><br />
          </div>
        </div>

        <button type="submit" class="btn btn-primary" name="register">
          Registrar
        </button>
        <button type="submit" class="btn btn-danger" name="delete">
          Eliminar registros
        </button>

      </form>
    </div>
    <div class="tabla">
      <h4>Lista de empleados: </h4>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Edad</th>
            <th scope="col">Estado Civil</th>
            <th scope="col">Sueldo</th>
            <th scope="col">Sexo</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($arrayEmployees as $employee) {
            echo "<tr>";
            echo "<td>", $employee->getName(), "</td>";
            echo "<td>", $employee->getSurname(), "</td>";
            echo "<td>", $employee->getAge(), "</td>";
            echo "<td>", $employee->getCivilStatus(), "</td>";
            echo "<td>", $employee->getIncome(), "</td>";
            echo "<td>", $employee->getSex(), "</td>";
            echo "</tr>";

          }

          ?>
        </tbody>
      </table>
    </div>
    <div>
      <h4>
        Datos determinados:
      </h4>
      <div class="tabla">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Total de femeninas</th>
              <th scope="col">Masculinos casados que ganan más de 2500</th>
              <th scope="col">Femeninas viudas que ganan mas de 1000</th>
              <th scope="col">Edad promedio de Masculinos</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              $amountFemale = 0;
              $amountMalesMarried2500 = 0;
              $amountWidows1000 = 0;
              $amountMales = 0;
              $averageAgeMale = 0;
              foreach ($arrayEmployees as $employee) {
                if ($employee->getSex() == "Femenino") {
                  $amountFemale += 1;
                }
                if ($employee->getCivilStatus() == "Casado(a)" && $employee->getIncome() == "mas de 2500") {
                  $amountMalesMarried2500 += 1;
                }
                if ($employee->getCivilStatus() == "Viudo(a)" && $employee->getSex() == "Femenino" && ($employee->getIncome() == "entre 1000 y 2500" || $employee->getIncome() == "mas de 2500")) {
                  $amountWidows1000 += 1;
                }
                if ($employee->getSex() == "Masculino") {
                  $amountMales += 1;
                  $averageAgeMale += $employee->getAge();
                }
              }

              echo "<td>", $amountFemale, "</td>";
              echo "<td>", $amountMalesMarried2500, "</td>";
              echo "<td>", $amountWidows1000, "</td>";
              echo "<td>";
              try {
                echo $averageAgeMale / $amountMales;
              } catch (DivisionByZeroError) {
                echo "0";
              }
              echo "</td>";
              ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--Boostrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>
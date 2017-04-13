<?php

class Person {
    private $nombre;
    private $fechaDeNacimiento;
    private $cedula;
    private $cedulaPadre;
    private $cedulaMadre;
    private $sexo;
    private $nacionalidad;
    private $edad;
    private $hijos;
    private $matrimonios;
    private $lugarDeVotacion;


    function __construct($nombre_in, $fecha_in, $ced_in, $cedP_in, $cedM_in, $sexo_in, $nac_in, $edad_in, $hijos_in, $matr_in, $lugVot_in) {
        $this->nombre = $nombre_in;
        $this->fechaDeNacimiento = $fecha_in;
        $this->cedula = $ced_in;
        $this->cedulaPadre = $cedP_in;
        $this->cedulaMadre = $cedM_in;
        $this->sexo = $sexo_in;
        $this->nacionalidad = $nac_in;
        $this->edad = $edad_in;
        $this->hijos = $hijos_in;
        $this->matrimonios = $matr_in;
        $this->lugarDeVotacion = $lugVot_in;

    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getFechaDeNacimiento()
    {
        return $this->fechaDeNacimiento;
    }

    /**
     * @return mixed
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @return mixed
     */
    public function getCedulaPadre()
    {
        return $this->cedulaPadre;
    }

    /**
     * @return mixed
     */
    public function getCedulaMadre()
    {
        return $this->cedulaMadre;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @return mixed
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @return mixed
     */
    public function getHijos()
    {
        return $this->hijos;
    }

    /**
     * @return mixed
     */
    public function getMatrimonios()
    {
        return $this->matrimonios;
    }

    /**
     * @return mixed
     */
    public function getLugarDeVotacion()
    {
        return $this->lugarDeVotacion;
    }


}

class Facade {
    public static function process($person_data, $actionType) {
        $validData = DataValidation::dataTypeValidation($person_data);
        if($validData == true){
            #Opciones de CRUD
            if($actionType == 0){
                CRUD::create($person_data);
            }
            if($actionType == 1){
                CRUD::read($person_data);
            }
            if($actionType == 2){
                CRUD::update($person_data);
            }
            if($actionType == 3){
                CRUD::delete($person_data);
            }
        }
        return $validData;
    }
}
#Clase para validaciones necesarias antes de llamar a CRUD
class DataValidation {
    public static function dataTypeValidation($person_data) {
        $person_id = $person_data->getCedula();
        $regex = '/^[0-9]{9}$/';
        if (!preg_match($regex, $person_id)) {
            writeln('Formato de Cedula incorrecto. Deben ser 9 numeros. Ejemplo: 123456789');
            return false;
        }
        return true;
    }
}
#Clase encargada de funciones CRUD
class CRUD {
    public static function create($person_data) {
        writeln("Insertando datos en la Base de Datos");
        return $person_data;
    }
    public static function read($person_data) {
        writeln("Buscando datos de la persona en la Base de Datos");
        return $person_data;
    }
    public static function update($person_data) {
        writeln("Actualizando datos de la persona en la Base de Datos");
        return $person_data;
    }
    public static function delete($person_data) {
        writeln("Eliminando datos de la persona en la Base de Datos");
        return $person_data;
    }
}

/*
writeln('COMENZANDO PRUEBA DE PATRON FACHADA');
writeln('');

$person = new Person('115050010','Alejandro','Rojas','Jara',
    'Clinica Biblica, San Jose','05/06/1992','masculino');


writeln('Solicitando registro para : '.$person->getName().' '.$person->getFirstLastName().' Cedula: '.$person->getID());
$register_result = Facade::process($person, 0);

if($register_result == true){
    writeln('Insercion realizada correctamente!');
}
writeln('');
$person = new Person('10353aabb','Jose','Rivera','Jara',
    'Clinica Biblica, San Jose','05/06/1992','masculino');


writeln('Solicitando registro para : '.$person->getName().' '.$person->getFirstLastName().' Cedula: '.$person->getID());
$register_result = Facade::process($person,0);

if($register_result == true){
    writeln('Insercion realizada correctamente!');
}

writeln('');
writeln('FIN DE PRUEBA DE PATRON FACHADA');
*/
function writeln($line_in) {
    echo $line_in."\n";
    echo nl2br("\n");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
// define variables and set to empty values
$nombreErr = $fechaDeNacimientoErr = $cedulaErr = $cedulaPadreErr = $cedulaMadreErr = $sexoErr = $nacionalidadErr = $edadErr = $hijosErr = $matrimoniosErr = $lugarDeVotacionErr = "";
$nombre = $fechaDeNacimiento = $cedula = $cedulaPadre = $cedulaMadre = $sexo = $nacionalidad = $edad = $hijos = $matrimonios = $lugarDeVotacion = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["nombre"]);
    }

    if (empty($_POST["fechaDeNacimiento"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["fechaDeNacimiento"]);
    }

    if (empty($_POST["cedula"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["cedula"]);
    }

    if (empty($_POST["cedulaPadre"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["cedulaPadre"]);
    }

    if (empty($_POST["cedulaMadre"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["cedulaMadre"]);
    }

    if (empty($_POST["sexo"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["sexo"]);
    }

    if (empty($_POST["nacionalidad"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["nacionalidad"]);
    }

    if (empty($_POST["edad"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["edad"]);
    }

    if (empty($_POST["hijos"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["hijos"]);
    }

    if (empty($_POST["matrimonios"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["matrimonios"]);
    }

    if (empty($_POST["lugarDeVotacion"])) {
        $nameErr = "";
    } else {
        $name = test_input($_POST["lugarDeVotacion"]);
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* obligatorio.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    Nombre: <input type="text" name="nombre" value="<?php echo $nombre;?>">
    <span class="error">* <?php echo $nombreErr;?></span>
    <br><br>
    Fecha De Nacimiento: <input type="text" name="fechaDeNacimiento" value="<?php echo $fechaDeNacimiento;?>">
    <span class="error">* <?php echo $fechaDeNacimientoErr;?></span>
    <br><br>
    Cedula: <input type="text" name="cedula" value="<?php echo $cedula;?>">
    <span class="error">* <?php echo $cedulaErr;?></span>
    <br><br>
    Cedula Padre: <input type="text" name="cedulaPadre" value="<?php echo $cedulaPadre;?>">
    <span class="error">* <?php echo $cedulaPadreErr;?></span>
    <br><br>
    Cedula Madre: <input type="text" name="cedulaMadre" value="<?php echo $cedulaMadre;?>">
    <span class="error">* <?php echo $cedulaMadreErr;?></span>
    <br><br>
    Sexo: <input type="text" name="sexo" value="<?php echo $sexo;?>">
    <span class="error">* <?php echo $sexoErr;?></span>
    <br><br>
    Nacionalidad: <input type="text" name="nacionalidad" value="<?php echo $nacionalidad;?>">
    <span class="error">* <?php echo $nacionalidadErr;?></span>
    <br><br>
    Edad: <input type="text" name="edad" value="<?php echo $edad;?>">
    <span class="error">* <?php echo $edadErr;?></span>
    <br><br>
    Hijos: <input type="text" name="hijos" value="<?php echo $hijos;?>">
    <span class="error">* <?php echo $hijosErr;?></span>
    <br><br>
    Matrimonios: <input type="text" name="matrimonios" value="<?php echo $matrimonios;?>">
    <span class="error">* <?php echo $matrimoniosErr;?></span>
    <br><br>
    Lugar De Votacion: <input type="text" name="lugarDeVotacion" value="<?php echo $lugarDeVotacion;?>">
    <span class="error">* <?php echo $lugarDeVotacionErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>



<?php
echo "<h2>Your Input:</h2>";
echo $nombre;
echo "<br>";
echo $fechaDeNacimiento;
echo "<br>";
echo $cedula;
echo "<br>";
echo $cedulaPadre;
echo "<br>";
echo $cedulaMadre;
echo "<br>";
echo $sexo;
echo "<br>";
echo $nacionalidad;
echo "<br>";
echo $edad;
echo "<br>";
echo $hijos;
echo "<br>";
echo $matrimonios;
echo "<br>";
echo $lugarDeVotacion;
?>

</body>
</html>




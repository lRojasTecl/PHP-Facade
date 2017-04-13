<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php

class Person {
    private $identification;
    private $fullName;
    private $birth_place;
    private $birth_day;
    private $gender;
    #private $masDatos; ...

    function __construct($id_in, $name_in, $birthday_in, $birthplace_in, $gender_in) { #,$masDatos_in) {
        $this->identification = $id_in;
        $this->fullName  = $name_in;
        $this->birth_place  = $birthplace_in;
        $this->birth_day  = $birthday_in;
        $this->gender = $gender_in;
        #$this->masDatos = $masDatos_in; ....
    }

    function getID() {
        return $this->identification;
    }
    function setID($newID){
        $this->identification = $newID;
    }

    function getName() {
        return $this->fullName;
    }
    function setName($newName){
        $this->fullName = $newName;
    }

    function getDayOfBirth() {
        return $this->birth_day;
    }
    function setDayOfBirth($newDOB){
        $this->birth_day = $newDOB;
    }

    function getPlaceOfBirth() {
        return $this->birth_place;
    }
    function setPlaceOfBirth($newPOB){
        $this->birth_place = $newPOB;
    }

    function getGender() {
        return $this->gender;
    }
    function setGender($newGender){
        $this->gender = $newGender;
    }

    #function getMasDatos()...
    #function setMasDatos($newDato)...
}

class Facade {
    public static function process($person_data, $actionType) {
        $dataValidation = new DataValidation();
        $validData = $dataValidation->dataTypeValidation($person_data);
        if($dataValidation->isValidData() == true){
            #Opciones de CRUD
            if($actionType == 0){
                CRUD::create($person_data);
                return null;
            }
            if($actionType == 1){
                CRUD::read($person_data);
                return null;
            }
            if($actionType == 2){
                CRUD::update($person_data);
                return null;
            }
            if($actionType == 3){
                CRUD::delete($person_data);
                return null;
            }
        }
        return $validData;
    }
}
#Clase para validaciones necesarias antes de llamar a CRUD
class DataValidation {
    private $validData;

    #Variable para determinar si los datos son validos o no
    function __construct()
    {
        $this->validData = true;
    }

    public function dataTypeValidation($person_data) {
        #------------------------------------------
        # Verificacion de campo de ID o Cedula
        #------------------------------------------
        $person_id = $person_data->getID();
        $person_id = self::clean_input($person_id);
        $regex = '/^[0-9]{9}$/';
        # No puede ser vacio
        if(empty($person_id)){
            $this->validData = false;
            $person_data ->setID("El campo Cedula no puede estar vacio!");
        }
        # Formato especifico
        elseif (!preg_match($regex, $person_id)) {
            $this->validData = false;
            $person_data->setID("Formato de Cedula incorrecto. Deben ser 9 numeros. Ejemplo: 123456789");
        }
        else{ $person_data ->setID("");}

        #----------------------------------------
        # Verificacion de campo de Nombre
        #----------------------------------------
        $person_name = $person_data ->getName();
        $person_name = self::clean_input($person_name);
        # No puede ser vacio
        if(empty($person_name)){
            $this->validData = false;
            $person_data ->setName("El campo Nombre no puede estar vacio!");
        }
        # Formato especifico
        elseif (!preg_match("/^[a-zA-Z ]*$/",$person_name)) {
            $this->validData = false;
            $person_data->setName("Solo se permiten letras y espacios!");
        }else{ $person_data ->setName("");}

        #----------------------------------------
        # Verificacion de fecha de Naciimiento
        #----------------------------------------
        $person_DOB = $person_data ->getDayOfBirth();
        $person_DOB = self::clean_input($person_DOB);
        # No puede ser vacio
        if(empty($person_DOB)){
            $this->validData = false;
            $person_data ->setDayOfBirth("La Fecha de Nacimiento no puede estar vacia!");
        }
        # Formato especifico
        elseif (!DateTime::createFromFormat('d/m/Y', $person_DOB)) {
            $this->validData = false;
            $person_data ->setDayOfBirth("Formato de fecha incorrecto. Deberia ser DD/MM/AAAA");
        }else{ $person_data ->setDayOfBirth("");}

        #-------------------------------------------
        # Verificacion de lugar de Nacimiento
        #------------------------------------------
        $person_POB = $person_data->getPlaceOfBirth();
        # No puede ser vacio
        if(empty($person_POB)){
            $this->validData = false;
            $person_data ->setPlaceOfBirth("El campo Lugar de nacimiento no puede estar vacio!");
        }
        else{ $person_data ->setPlaceOfBirth("");}

        #------------------------------------------
        # Verificacion de genero
        #------------------------------------------
        $person_gender = $person_data->getGender();
        # No puede ser vacio
        if(empty($person_gender)){
            $this->validData = false;
            $person_data ->setGender("Por favor selecciono el genero.");
        }
        else{$person_data ->setGender("");}

        #------------------------------------------
        # Otras verificaciones...
        #------------------------------------------

        # Devolvemos mensajes de error si hay alguno.
        return $person_data;
    }

    static function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function isValidData(){
        return $this->validData;
    }
}
#Clase encargada de funciones CRUD
class CRUD {
    public static function create($person_data) {
        writeln("CREATE :: Insertando datos en la Base de Datos");
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

function writeln($line_in) {
    echo $line_in."<br/>\n";
}

# variable de datos y mensajes de error
$idErr   = $nameErr   = $birthDayErr   = $birthPlaceErr   = $genderErr   = ""; # = $masDatosErr
$idInput = $nameInput = $birthdayInput = $birthPlaceInput = $genderInput = ""; # = $masDatosInput

#ACCION DE SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>Prueba de Facade:</h2>";

    writeln('COMENZANDO PRUEBA DE PATRON FACHADA');
    writeln('');
    #Creamos objecto de Person con la informacion ingresada.
    $idInput = $_POST["idInput"];
    $nameInput = $_POST["nameInput"];
    $birthdayInput = $_POST["birthdayInput"];
    $birthPlaceInput = $_POST["birthPlaceInput"];
    if (empty($_POST["genderInput"])) {
        $genderInput = null;
    } else {
        $genderInput = $_POST["genderInput"];
    }
    # $masDatosInput = $_POST["masDatosInput"];


    $person = new Person($idInput,$nameInput,$birthdayInput, $birthPlaceInput, $genderInput); # ,$masDatosInput);

    writeln('Solicitando registro....');


    $register_result = Facade::process($person, 0);
    if(empty($register_result)){
           writeln('Insercion realizada correctamente!');
    }
    else{
        $idErr = $register_result->getID();
        $nameErr = $register_result->getName();
        $birthDayErr = $register_result->getDayOfBirth();
        $genderErr = $register_result->getGender();
        # $masDatosErr = $register_result->getMasDatos();
        writeln('Hay datos invalidos! Por favor revise los campos.');
    }

    writeln('');
    writeln('FIN DE PRUEBA DE PATRON FACHADA');
}
?>

<h2>Datos personales:</h2>
<p><span class="error">* campo obligatorio.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Cedula: <input type="text" name="idInput" value="<?php echo $idInput;?>">
    <span class="error">* <?php echo $idErr;?></span>
    <br><br>
    
    Nombre Completo: <input type="text" name="nameInput" value="<?php echo $nameInput;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
        
    Fecha De Nacimiento: <input type="text" name="birthdayInput" value="<?php echo $birthdayInput;?>">
    <span class="error">* <?php echo $birthDayErr;?></span>
    <br><br>

    Lugar De Nacimiento: <textarea name="birthPlaceInput" rows="5" cols="40"><?php echo $birthPlaceInput;?></textarea>
    <br><br>

    <!-- Mas Datos: <input type="text" name="masDatosInput" value=" < ?php echo $birthdayInput;?>"></textarea> -->
    <!-- <span class="error">* < ?php echo $masDatosErr;?></span> -->
    <!-- <br><br> -->
        
    Genero:
    <input type="radio" name="genderInput" <?php if (isset($genderInput) && $genderInput=="Femenino") echo "checked";?> value="Femenino">Femenino
    <input type="radio" name="genderInput" <?php if (isset($genderInput) && $genderInput=="Masculino") echo "checked";?> value="Masculino">Masculino
    <span class="error">* <?php echo $genderErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>

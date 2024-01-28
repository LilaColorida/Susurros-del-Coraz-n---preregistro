<?php

// Ruta al archivo JSON
$archivoJSON = "../emails.json";

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Tipo de petición incorrecta.";
    die();
}

// Asegurarse de que el campo email ha sido enviado
if (!isset($_POST["email"])) {
    echo "No existe el email";
    die();
}

$email = $_POST["email"];

// Validar el email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email no válido";
    die();
}

// Leer el archivo JSON y almacenar los emails existentes
$emailsExistentes = [];
if (file_exists($archivoJSON)) {
    $contenido = file_get_contents($archivoJSON);
    $emailsExistentes = json_decode($contenido, true);
    if (!is_array($emailsExistentes)) {
        $emailsExistentes = []; // En caso de que el archivo JSON no sea una lista
    }
}

// Comprobar si el email ya está en el archivo
if (!in_array($email, $emailsExistentes)) {
    // Agregar el nuevo email al array
    $emailsExistentes[] = $email;

    // Guardar el array actualizado en el archivo JSON
    file_put_contents($archivoJSON, json_encode($emailsExistentes));
}

echo "Email agregado con éxito. Felicidades, pronto podrás empezar tu nueva aventura. ♥";
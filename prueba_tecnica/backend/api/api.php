<?php
include_once 'db.php';

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'GET':
        // Obtener todos los elementos de la api
        getItems();
        break;
    case 'POST':
        // Crear un nuevo elemento en la api
        createItem();
        break;
    case 'PUT':
        // Actualizar un elemento existente
        updateItem();
        break;
    case 'DELETE':
        // Eliminar un elemento
        deleteItem();
        break;
    default:
        // Método no soportado
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getItems() {
    global $conn;
    // Creación de una nueva query
    $query = "SELECT * FROM items";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($items);
}

function createItem() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $query = "INSERT INTO items (name, lastname, age, email, area, job) VALUES (:name, :lastname, :age, :email, :area, :job)";
    $stmt = $conn->prepare($query);
    // Onteniendo los elementos del JSON
    $stmt->bindParam(":name", $data['name']);
    $stmt->bindParam(":lastname", $data['lastname']);
    $stmt->bindParam(":age", $data['age']);
    $stmt->bindParam(":email", $data['email']);
    $stmt->bindParam(":area", $data['area']);
    $stmt->bindParam(":job", $data['job']);
    if($stmt->execute()) {
        $response = array('status' => 1, 'message' => 'Item created successfully.');
    } else {
        $response = array('status' => 0, 'message' => 'Item creation failed.');
    }
    echo json_encode($response);
}

function updateItem() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $query = "UPDATE items SET name = :name, lastname = :lastname, age = :age, email = :email, area = :area, job = :job WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name", $data['name']);
    $stmt->bindParam(":lastname", $data['lastname']);
    $stmt->bindParam(":age", $data['age']);
    $stmt->bindParam(":email", $data['email']);
    $stmt->bindParam(":area", $data['area']);
    $stmt->bindParam(":job", $data['job']);
    // Obtiene el id del JSON para compararlo con la base de datos
    $stmt->bindParam(":id", $data[]);
    if($stmt->execute()) {
        $response = array('status' => 1, 'message' => 'Item updated successfully.');
    } else {
        $response = array('status' => 0, 'message' => 'Item update failed.');
    }
    echo json_encode($response);
}

function deleteItem() {
    global $conn;
    $id = json_decode(file_get_contents("php://input"), true);
    $query = "DELETE FROM items WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id["id"]);
    if($stmt->execute()) {
        $response = array('status' => 1, 'message' => 'Item deleted successfully.');
    } else {
        $response = array('status' => 0, 'message' => 'Item deletion failed.');
    }
    echo json_encode($response);
}
?>

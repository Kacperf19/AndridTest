<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = json_decode(file_get_contents('php://input'), true);
    $user_id = $_SESSION['user_id'];

    foreach ($data as $date => $tasks) {
        if (is_array($tasks)) {
            foreach ($tasks as $task) {
                if (isset($task['task']) && isset($task['startTime']) && isset($task['endTime'])) {
                    $task_description = $task['task'];
                    $start_time = $task['startTime'];
                    $end_time = $task['endTime'];
                 
                  

    
        $stmt = $conn->prepare("INSERT INTO tasks (task_date,  task_description, start_time, end_time) VALUES (?, ?, ?, ?)");
     
        $stmt->bind_param("ssss", $date,  $task_description, $start_time, $end_time);
        
                    if ($stmt->execute()) {
                        $task_id = $conn->insert_id; 

                       
                        $link_stmt = $conn->prepare("INSERT INTO user_tasks (user_id, task_id) VALUES (?, ?)");
                        $link_stmt->bind_param("ii", $user_id, $task_id);

                        if (!$link_stmt->execute()) {
                            echo json_encode(["status" => "error", "message" => "Nie udało się powiązać zadania z użytkownikiem"]);
                      
                            exit;
                        }
                    } else {
                        echo json_encode(["status" => "error", "message" => "Nie udało się zapisać zadania"]);
                        exit;
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Brak wymaganych danych w zadaniu"]);
                    exit;
                }
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Nieprawidłowe dane wejściowe"]);
            exit;
        }
    }

    echo json_encode(["status" => "success"]);
}

$conn->close();

?>
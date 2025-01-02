<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// Połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sprawdzanie metody POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdzanie, czy `task_id` został przesłany
    if (isset($_POST['task_id']) && is_numeric($_POST['task_id'])) {
        $task_id = intval($_POST['task_id']); // Konwersja na liczbę całkowitą

        // Rozpoczęcie transakcji
        $conn->begin_transaction();

        try {
            // Usunięcie powiązanych rekordów z tabeli `user_tasks`
            $stmt = $conn->prepare("DELETE FROM user_tasks WHERE task_id = ?");
            $stmt->bind_param("i", $task_id);
            $stmt->execute();
            $stmt->close();

            // Usunięcie zadania z tabeli `tasks`
            $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
            $stmt->bind_param("i", $task_id);
            $stmt->execute();
            $stmt->close();

            // Zatwierdzenie transakcji
            $conn->commit();

            echo "<script>alert('Zadanie zostało usunięte.');</script>";
            echo "<script>window.location.href = 'index.php';</script>"; // Przekierowanie za pomocą JavaScript
        } catch (Exception $e) {
            // Wycofanie transakcji w przypadku błędu
            $conn->rollback();
            echo "Błąd podczas usuwania zadania: " . $e->getMessage();
        }
    } else {
        echo "Brak lub nieprawidłowy identyfikator zadania.";
    }
}

// Zamknięcie połączenia z bazą danych
$conn->close();
?>

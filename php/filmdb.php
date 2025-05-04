<?php
// Database configuration
$host = 'localhost';
$dbname = 'film_db';
$username = 'root';
$password = 'root'; // Ensure this matches your MySQL root password

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!<br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Retrieve data from the films table
$sql = "SELECT * FROM films";
$stmt = $conn->prepare($sql);
$stmt->execute();
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Film Details</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Film Name</th>
            <th>Director</th>
        </tr>

        <?php
        // Display data in the table
        if (count($films) > 0) {
            foreach ($films as $film) {
                echo "<tr>
                        <td>" . htmlspecialchars($film['id']) . "</td>
                        <td>" . htmlspecialchars($film['film_name']) . "</td>
                        <td>" . htmlspecialchars($film['director']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        ?>
    </table>

    <?php
    // Close the connection
    $conn = null;
    ?>
</body>
</html>
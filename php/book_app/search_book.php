<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $db = "library";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $search_title = $_POST['search_title'];

    $sql = "SELECT * FROM books WHERE title LIKE '%$search_title%'";
    $result = $conn->query($sql);
    ?>
    
    <!DOCTYPE html>
    <html>
    <head>
        <title>Search Results</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        if ($result->num_rows > 0) {
            echo "<h2>Search Results:</h2>";
            while($row = $result->fetch_assoc()) {
                echo "<div class='book'>";
                echo "<strong>Accession No:</strong> " . $row["accession_no"] . "<br>";
                echo "<strong>Title:</strong> " . $row["title"] . "<br>";
                echo "<strong>Authors:</strong> " . $row["authors"] . "<br>";
                echo "<strong>Edition:</strong> " . $row["edition"] . "<br>";
                echo "<strong>Publisher:</strong> " . $row["publisher"] . "<br><br>";
                echo "</div>";
            }
        } else {
            echo "<h2>No book found with title matching '$search_title'</h2>";
        }

        $conn->close();
        ?>
    </body>
    </html>
    <?php
} else {
    echo "<h2>Please submit the search form properly.</h2> <a href='index.php'>Go back</a>";
}
?>

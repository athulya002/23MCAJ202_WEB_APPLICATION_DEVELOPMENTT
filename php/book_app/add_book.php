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

    $accession_no = $_POST['accession_no'];
    $title = $_POST['title'];
    $authors = $_POST['authors'];
    $edition = $_POST['edition'];
    $publisher = $_POST['publisher'];

    $sql = "INSERT INTO books (accession_no, title, authors, edition, publisher)
            VALUES ('$accession_no', '$title', '$authors', '$edition', '$publisher')";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="message-box">
<?php
    if ($conn->query($sql) === TRUE) {
        echo "<h2>Book added successfully!</h2>";
        echo "<a href='index.php' class='back-link'>Go back</a>";
    } else {
        echo "<h2>Error:</h2><p>" . $conn->error . "</p>";
        echo "<a href='index.php' class='back-link'>Go back</a>";
    }

    $conn->close();
} else {
    echo "<div class='message-box'><h2>Please submit the form properly.</h2> <a href='index.php' class='back-link'>Go back</a></div>";
}
?>
</div>
</body>
</html>

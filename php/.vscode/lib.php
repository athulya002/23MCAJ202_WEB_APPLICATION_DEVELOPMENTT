<?php
// Connect to MySQL Database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Book
if (isset($_POST['add'])) {
    $accession_no = $_POST['accession_no'];
    $title = $_POST['title'];
    $authors = $_POST['authors'];
    $edition = $_POST['edition'];
    $publisher = $_POST['publisher'];

    $sql = "INSERT INTO books (accession_no, title, authors, edition, publisher) 
            VALUES ('$accession_no', '$title', '$authors', '$edition', '$publisher')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='success-message'>New book added successfully!</div>";
    } else {
        echo "<div class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Search Book
if (isset($_POST['search'])) {
    $search_title = $_POST['search_title'];
    $sql = "SELECT * FROM books WHERE title LIKE '%$search_title%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-wrapper'><table>
                <tr>
                    <th>Accession Number</th>
                    <th>Title</th>
                    <th>Authors</th>
                    <th>Edition</th>
                    <th>Publisher</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['accession_no'] . "</td>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['authors'] . "</td>
                    <td>" . $row['edition'] . "</td>
                    <td>" . $row['publisher'] . "</td>
                  </tr>";
        }
        echo "</table></div>";
    } else {
        echo "<div class='message-box'>No books found!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #d965ff, #e780ff);
            margin: 0;
            padding: 30px;
            text-align: center;
        }

        .container {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin: auto;
            max-width: 600px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #b03dd4;
            margin-bottom: 20px;
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #b03dd4;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #a038c4;
        }

        .table-wrapper {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            margin: 30px auto;
            width: 90%;
            max-width: 800px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #b03dd4;
            color: white;
            font-weight: bold;
        }

        .message-box {
            background: #ffe0e0;
            color: #a00;
            padding: 10px;
            margin-top: 20px;
            border: 1px solid #faa;
            border-radius: 8px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            margin: 20px auto;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            width: fit-content;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            margin: 20px auto;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            width: fit-content;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Book</h2>
        <form method="post" action="">
            <label for="accession_no">Accession Number:</label>
            <input type="number" id="accession_no" name="accession_no" required>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="authors">Authors:</label>
            <input type="text" id="authors" name="authors" required>

            <label for="edition">Edition:</label>
            <input type="text" id="edition" name="edition">

            <label for="publisher">Publisher:</label>
            <input type="text" id="publisher" name="publisher">

            <input type="submit" name="add" value="Add Book">
        </form>

        <h2>Search Book</h2>
        <form method="post" action="">
            <label for="search_title">Enter Title to Search:</label>
            <input type="text" id="search_title" name="search_title" required>
            <input type="submit" name="search" value="Search Book">
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
<!--http://localhost/PHP/.VSCODE/lib.php-->
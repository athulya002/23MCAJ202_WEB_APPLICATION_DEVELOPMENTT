<!DOCTYPE html>
<html>
<head>
    <title>Book Entry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Add a Book</h2>
    <form class="form-box" method="post" action="add_book.php">
        <label>Accession Number:</label>
        <input type="number" name="accession_no" required><br>

        <label>Title:</label>
        <input type="text" name="title" required><br>

        <label>Authors:</label>
        <input type="text" name="authors" required><br>

        <label>Edition:</label>
        <input type="text" name="edition" required><br>

        <label>Publisher:</label>
        <input type="text" name="publisher" required><br>

        <input type="submit" value="Add Book">
    </form>

    <h2>Search a Book</h2>
    <form class="form-box" method="post" action="search_book.php">
        <label>Title:</label>
        <input type="text" name="search_title" required>
        <input type="submit" value="Search">
    </form>

</body>
</html>

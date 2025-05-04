<!--  localhost/PHP/database.php-->
<?php
// Function to establish a connection to the MySQL database
function connectToDatabase() {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "student";

    try {
        // Create a new PDO connection
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting
        return $pdo;
    } catch (PDOException $e) {
        // Display error message if connection fails
        die("<p class='error'>❌ Connection failed: " . $e->getMessage() . "</p>");
    }
}

// Function to insert a student record into the database
function insertStudent($pdo) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $roll = $_POST['roll_no'] ?? '';
        $name = $_POST['name'] ?? '';
        $course = $_POST['course'] ?? '';

        // Check if all fields are filled
        if (!empty($roll) && !empty($name) && !empty($course)) {
            try {
                // Prepare and execute the SQL INSERT query
                $stmt = $pdo->prepare("INSERT INTO students (roll_no, name, course) VALUES (:roll, :name, :course)");
                $stmt->execute(['roll' => $roll, 'name' => $name, 'course' => $course]);
                echo "<p class='success'>✅ Student added successfully!</p>";
            } catch (PDOException $e) {
                // Display error message if query fails
                echo "<p class='error'>❌ Error: " . $e->getMessage() . "</p>";
            }
        } else {
            // Display error if any field is missing
            echo "<p class='error'>❌ Please fill all fields.</p>";
        }
    }
}

// Function to display the student entry form
function displayForm() {
    echo <<<FORM
    <h2>➕ Add New Student</h2>
    <form method="POST" action="">
        <input type="number" name="roll_no" placeholder="Roll No" required>
        <input type="text" name="name" placeholder="Student Name" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="submit" value="Add Student">
    </form>
FORM;
}

// Function to fetch and display student records from the database
function displayStudents($pdo) {
    try {
        // Fetch all student records from the table
        $stmt = $pdo->query("SELECT roll_no, name, course FROM students");
        $students = $stmt->fetchAll();

        echo "<h3>📘 Student Records</h3>";

        if (count($students) > 0) {
            // Display records in a table
            echo "<table>";
            echo "<tr><th>Sl No</th><th>Roll No</th><th>Student Name</th><th>Course</th></tr>";

            $slNo = 1;
            foreach ($students as $row) {
                echo "<tr>";
                echo "<td>{$slNo}</td>";
                echo "<td>{$row['roll_no']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['course']}</td>";
                echo "</tr>";
                $slNo++;
            }

            echo "</table>";
        } else {
            // Display message if no records found
            echo "<p style='text-align:center;'>No records found.</p>";
        }
    } catch (PDOException $e) {
        // Display error message if query fails
        echo "<p class='error'>❌ Error fetching records: " . $e->getMessage() . "</p>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        /* Basic styling for page elements */
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2, h3 { text-align: center; }
        form {
            width: 60%; margin: 20px auto; padding: 15px;
            border: 1px solid #ccc; background: #f9f9f9;
            border-radius: 8px;
        }
        input[type="text"], input[type="number"] {
            width: 90%; padding: 10px; margin: 10px auto;
            display: block; border: 1px solid #aaa; border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4285F4; color: white;
            border: none; padding: 10px 20px; display: block;
            margin: 10px auto; border-radius: 5px; cursor: pointer;
        }
        table {
            border-collapse: collapse; width: 90%; margin: auto;
        }
        th, td {
            border: 1px solid #ccc; padding: 10px 15px; text-align: center;
        }
        th { background-color: #f4f4f4; }
        .success { color: green; text-align: center; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>

<?php
// Establish a database connection
$pdo = connectToDatabase();

// Handle form submission and insert student data
insertStudent($pdo);

// Display the student entry form
displayForm();

// Fetch and display all student records
displayStudents($pdo);
?>

</body>
</html>

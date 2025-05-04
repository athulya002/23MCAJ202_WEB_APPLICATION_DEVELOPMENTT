<!--http://localhost/PHP/student.php -->
<?php
// Function to display array with a label
function displayArray($array, $label) {
    echo "<h3>$label</h3>";
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

// 1. Store student names (Roll No => Name)
$students = array(
    "01" => "Athulya",
    "02" => "Adithya",
    "03" => "Geethu",
    "04" => "Reshma",
    "05" => "Aksa"
);

// 2. Display original array
displayArray($students, "Original Student List");

// 3. Sort in ascending order by name and display
$ascending = $students; // copy original
asort($ascending);
displayArray($ascending, "Student List - Sorted Ascending (A-Z)");

// 4. Sort in descending order by name and display
$descending = $students; // copy original
arsort($descending);
displayArray($descending, "Student List - Sorted Descending (Z-A)");
?>

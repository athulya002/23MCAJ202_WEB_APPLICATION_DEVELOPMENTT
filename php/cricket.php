<!--http://localhost/PHP/cricket.php -->
<?php
// Function to display player names in a styled HTML table
function displayPlayersTable($players) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Indian Cricket Players</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                padding: 20px;
            }
            h2 {
                text-align: center;
                color: #333;
            }
            table {
                width: 50%;
                margin: auto;
                border-collapse: collapse;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 50px;
            }
            th, td {
                padding: 10px;
                border: 1px solid #ccc;
                text-align: left;
            }
            th {
                background-color: #007bff;
                color: white;
            }
            
        </style>
    </head>
    <body>";

    echo "<h2>List of Indian Cricket Players</h2>";
    echo "<table>";
    echo "<tr><th>Sl No</th><th>Player Name</th></tr>";
    
    $slNo = 1;
    foreach ($players as $player) {
        echo "<tr>";
        echo "<td>{$slNo}</td>";
        echo "<td>{$player}</td>";
        echo "</tr>";
        $slNo++;
    }

    echo "</table>";

    echo "</body></html>";
}

// Array of Indian cricket players
$cricketPlayers = array(
    "Virat Kohli",
    "Rohit Sharma",
    "Jasprit Bumrah",
    "KL Rahul",
    "Hardik Pandya",
    "Ravindra Jadeja",
    "Shubman Gill",
    "Suryakumar Yadav",
    "Rishabh Pant",
    "Mohammed Shami"
);

// Call the function to display the table
displayPlayersTable($cricketPlayers);
?>

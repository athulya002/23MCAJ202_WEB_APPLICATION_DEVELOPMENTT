<!--http://localhost/PHP/register.php-->
<?php
$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = htmlspecialchars($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = htmlspecialchars($_POST["password"]);
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters";
        }
    }

    // All valid
    if ($nameErr == "" && $emailErr == "" && $passwordErr == "") {
        echo "<p class='success'>Registration successful!</p>";
        
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <style>
        body {
            font-family: Arial;
            background:rgb(234, 227, 227);
            padding: 20px;
           
        }
        h2 {
            text-align: center;
        }
        .form-container {
            background: white;
            padding: 20px;
            max-width: 400px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        input[type=text], input[type=email], input[type=password] {
            width: 100%;
            padding: 6px;
            margin-top: 6px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 1em; }
        input[type=submit] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Register</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>

        <div>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div>
        <label>Password</label>
        <input type="password" name="password">
        <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        

        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>

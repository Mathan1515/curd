<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required POST data is available
    if (!isset($_POST['username'], $_POST['tel'], $_POST['email'], $_POST['password'], $_POST['confirmpassword'], $_POST['exampleselect'])) {
        die("Missing form data.");
    }

    // Collect and sanitize form data
    $username = $_POST['username'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $exampleselect = $_POST['exampleselect'];

    // Check if passwords match
    if ($password !== $confirmpassword) {
        die("Passwords do not match.");
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO crud (username, tel, email, password, confirmpassword, exampleselect) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $tel, $email, $password, $confirmpassword, $exampleselect);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>New record created successfully</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .form-container {
            background-color: #e3f2fd; /* White background for the form */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color:#007bff  ; /* Primary button color */
            border-color: #ffefd5;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker shade for hover */
            border-color: #004085;
        }
        .form-error {
            color: #dc3545; /* Red color for error messages */
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="my-4 text-center">Registration Form</h2>
            <form id="registrationForm" action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username" class="control-label">Name</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <div class="form-error" id="usernameError"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tel" class="control-label">Mobile Number</label>
                        <input type="tel" class="form-control" id="tel" name="tel" pattern="\d{10}" placeholder="1234567890" required>
                        <div class="form-error" id="telError"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="form-error" id="emailError"></div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required minlength="6">
                        <div class="form-error" id="passwordError"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirmPassword" class="control-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmpassword" required minlength="6">
                        <div class="form-error" id="confirmPasswordError"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleSelect" class="control-label">Select a State</label>
                    <select class="form-control" id="exampleSelect" name="exampleselect" required>
                        <option value="" selected disabled>Choose One...</option>
                        <option value="Tamilnadu">Tamil Nadu</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Bangalore">Bangalore</option>
                    </select>
                    <div class="form-group">
                <label for="profileImage" class="control-label">Upload Profile Image</label>
                <input type="file" class="form-control-file" id="profileImage" name="profileImage" accept="image/*" required>
                <div class="form-error" id="imageError"></div>
            </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

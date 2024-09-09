<?php
include('db_connect.php');

// Fetch records from the database
$sql = "SELECT * FROM crud";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Username</th><th>Tel</th><th>Email</th><th>Password</th><th>Confirm Password</th><th>Example Select</th><th>Profile Image</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        // Check if 'profileImage' exists in the array to avoid warnings
        $profileImage = isset($row['profileImage']) ? htmlspecialchars($row['profileImage']) : '';

        echo "<tr>
            <td>" . htmlspecialchars($row["id"]) . "</td>
            <td>" . htmlspecialchars($row["username"]) . "</td>
            <td>" . htmlspecialchars($row["tel"]) . "</td>
            <td>" . htmlspecialchars($row["email"]) . "</td>
            <td>" . htmlspecialchars($row["password"]) . "</td>
            <td>" . htmlspecialchars($row["password"]) . "</td>
            <td>" . htmlspecialchars($row["exampleselect"]) . "</td>
            <td>";
        
        // Display the image if the path is available
        if (!empty($profileImage)) {
            echo "<img src='" . $profileImage . "' alt='Profile Image' width='50' height='50'>";
        } else {
            echo "No Image";
        }

        echo "</td>
            <td>
                <a href='update.php?id=" . htmlspecialchars($row["id"]) . "'>Edit</a> | 
                <a href='delete.php?id=" . htmlspecialchars($row["id"]) . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

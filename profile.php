<?php
session_start();

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "acrss_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in and email is stored in session


// Retrieve email from session
$email = $_SESSION['email'];

// Prepare and execute query to fetch bookings based on email
$query = $conn->prepare("SELECT * FROM book_list WHERE email = ?");
if (!$query) {
    die("Error in preparing statement: " . $conn->error);
}
echo "SQL Query: " . $query->sqlstate;

echo "Email in session: " . $_SESSION['email'];

$query->bind_param("s", $email);
$query->execute();

$result = $query->get_result();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Display fetched bookings in the user profile
echo "<h2>User Profile</h2>";
echo "<h3>Bookings</h3>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Code</th><th>Fullname</th><th>Contact</th><th>Email</th><th>Address</th><th>Status</th><th>Created At</th><th>Updated At</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['code'] . "</td>";
    echo "<td>" . $row['fullname'] . "</td>";
    echo "<td>" . $row['contact'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . ($row['status'] ? 'Active' : 'Inactive') . "</td>";
    echo "<td>" . $row['created_at'] . "</td>";
    echo "<td>" . $row['updated_at'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Close database connection
mysqli_close($conn);
?>

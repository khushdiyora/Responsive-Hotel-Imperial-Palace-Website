<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $roomType = $_POST["roomType"];
    $roomNumber = $_POST["roomNumber"];

    // You can add more form data retrieval as needed

    // Perform basic validation (you should enhance this)
    if (empty($fullName) || empty($email) || empty($phone) || empty($roomType) || empty($roomNumber)) {
        echo "Error: All fields are required.";
        exit;
    }

    // Database connection (replace with your actual Oracle connection details)
    $conn = oci_connect('system', 'khush1234', 'your_connection_string');

    // Check connection
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    // Insert the booking data into the database (replace with your actual table name)
    $sql = "INSERT INTO bookings (FULLNAME, EMAIL, PHONE, ROOMTYPE, ROOMNUMBER) VALUES (:fullName, :email, :phone, :roomType, :roomNumber)";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ":fullName", $fullName);
    oci_bind_by_name($stmt, ":email", $email);
    oci_bind_by_name($stmt, ":phone", $phone);
    oci_bind_by_name($stmt, ":roomType", $roomType);
    oci_bind_by_name($stmt, ":roomNumber", $roomNumber);

    $result = oci_execute($stmt);

    if ($result) {
        // Booking successful
        echo "Booking successful!";

        // Generate and print the booking slip
        echo "<h2>Booking Slip</h2>";
        echo "<p><strong>Name:</strong> $fullName</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Room Type:</strong> $roomType</p>";
        echo "<p><strong>Room Number:</strong> $roomNumber</p>";
        // Add more details as needed

        // Close the database connection
        oci_free_statement($stmt);
        oci_close($conn);
    } else {
        // Booking failed
        $e = oci_error($stmt);
        echo "Error: " . htmlentities($e['message'], ENT_QUOTES);
    }
} else {
    // Redirect to the booking form if accessed directly
    header("Location: your_booking_form_page.html");
    exit;
}
?>

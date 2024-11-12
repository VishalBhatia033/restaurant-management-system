<?php
include "connection.php";
if(isset($_GET['updateid'])){
    $edit_id = $conn->real_escape_string($_GET['updateid']);
    $sql = "SELECT * FROM menu WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Now $row contains the data of the record to be edited
    } else {
        echo "No record found";
        // Redirect or handle the error
    }
} else {
    echo "No ID provided";
    // Redirect or handle the error
}

if(isset($_POST['update'])) {
    // Get the updated data from the form

    $updatedName = $conn->real_escape_string($_POST['name']);
    $updatedDescription = $conn->real_escape_string($_POST['username']);
    $updatedprice = $conn->real_escape_string($_POST['password']);
    $updatedcode = $conn->real_escape_string($_POST['c']);
    $updatedtype= $conn->real_escape_string($_POST['type']);
   
    // Update SQL query
    $updateSql = "UPDATE menu SET iname = ?,  description = ?,price = ?,code = ?,type = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssiss", $updatedName,$updatedDescription, $updatedprice, $updatedcode, $updatedtype,$edit_id);
    $updateStmt->execute();

    if ($updateStmt->affected_rows > 0) {
        echo "Record updated successfully";
        // Redirect or further processing
    } else {
        if($updateStmt->error) {
            echo "Error updating record: " . $updateStmt->error;
        } else {
            echo "No changes were made to the record.";
        }
    }
    $updateStmt->close();
}
$conn->close();

?>

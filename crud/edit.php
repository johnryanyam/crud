<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post" action="index.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
        <input type="text" name="phone" value="<?php echo $row['phone']; ?>">
        <input type="submit" name="update" value="Update User">
    </form>
    <a href="index.php">Back to List</a>
</body>
</html> 
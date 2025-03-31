<?php
session_start();
require_once 'config/database.php';

// Create
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO users (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $phone]);

    $_SESSION['message'] = "New record created successfully";
    header("Location: index.php");
    exit();
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users SET name=?, email=?, phone=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $phone, $id]);

    $_SESSION['message'] = "Record updated successfully";
    header("Location: index.php");
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $_SESSION['message'] = "Record deleted successfully";
    header("Location: index.php");
    exit();
}

// Edit (Fetch record for editing)
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $user['name'];
    $email = $user['email'];
    $phone = $user['phone'];
}
?> 
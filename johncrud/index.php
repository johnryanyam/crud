<?php
require_once 'config/database.php';
require_once 'process.php';

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        input.form-control {
            font-size: 14px;
            height: 35px;
            padding: 5px 10px;
        }
        
        .btn {
            font-size: 14px;
            padding: 7px 15px;
            height: 35px;
        }
        
        h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .table {
            font-size: 14px;
            margin-bottom: 0;
        }
        
        .table th {
            font-weight: 600;
            padding: 10px;
        }
        
        .table td {
            padding: 8px 10px;
            vertical-align: middle;
        }
        
        .btn-sm {
            font-size: 13px;
            padding: 3px 8px;
            height: auto;
        }
        
        .alert {
            font-size: 14px;
            padding: 8px 15px;
            margin-bottom: 15px;
        }
        
        .card {
            padding: 15px !important;
        }
        
        .mb-4 {
            margin-bottom: 15px !important;
        }
        
        .container {
            max-width: 1000px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>

        <div class="card p-4 mb-4">
            <h2>Add New User</h2>
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $id : ''; ?>">
                <div class="d-flex gap-2">
                    <input type="text" name="name" class="form-control" 
                           placeholder="Name" required 
                           value="<?php echo isset($_GET['edit']) ? $name : ''; ?>">
                    
                    <input type="email" name="email" class="form-control" 
                           placeholder="Email" required
                           value="<?php echo isset($_GET['edit']) ? $email : ''; ?>">
                    
                    <input type="tel" name="phone" class="form-control" 
                           placeholder="Phone" required
                           value="<?php echo isset($_GET['edit']) ? $phone : ''; ?>">
                    
                    <button type="submit" class="btn btn-primary" 
                            name="<?php echo isset($_GET['edit']) ? 'update' : 'save'; ?>">
                        <?php echo isset($_GET['edit']) ? 'Update' : 'Add User'; ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="card p-4">
            <h2>Users List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['phone']; ?></td>
                        <td><?php echo $user['created_at']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $user['id']; ?>" 
                               class="btn btn-primary btn-sm">Edit</a>
                            <a href="process.php?delete=<?php echo $user['id']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 
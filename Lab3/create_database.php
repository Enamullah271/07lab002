<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $databaseName = trim($_POST["database_name"]);
    $conn = new mysqli("localhost", "root", "");

    if ($conn->connect_error) {
        $message = '<div class="alert alert-danger">Connection failed: ' . $conn->connect_error . '</div>';
    } elseif ($databaseName == "") {
        $message = '<div class="alert alert-danger">Database name is required.</div>';
    } elseif (!preg_match("/^[A-Za-z0-9_]+$/", $databaseName)) {
        $message = '<div class="alert alert-danger">Invalid database name.</div>';
    } else {
        $sql = "CREATE DATABASE `$databaseName`";

        if ($conn->query($sql)) {
            $message = '<div class="alert alert-success">Database created successfully.</div>';
        } else {
            $message = '<div class="alert alert-danger">Error creating database: ' . $conn->error . '</div>';
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="mb-4">Create Database</h3>
                <?= $message ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Database Name</label>
                        <input type="text" name="database_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Database</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
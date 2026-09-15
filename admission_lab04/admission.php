<?php
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST["full_name"] ?? "");
    $fatherName = trim($_POST["father_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $program = trim($_POST["program"] ?? "");

    $programs = ["Information Systems", "Software Engineering", "Computer Science"];

    if ($fullName == "" || $fatherName == "" || $email == "" || $phone == "" || $program == "") {
        $message = '<div class="alert alert-danger">All fields are required.</div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="alert alert-danger">Please enter a valid email address.</div>';
    } elseif (!in_array($program, $programs, true)) {
        $message = '<div class="alert alert-danger">Please select a valid program.</div>';
    } else {
        $stmt = $conn->prepare("INSERT INTO applications (full_name, father_name, email, phone, program) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullName, $fatherName, $email, $phone, $program);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: admission.php");
            exit;
        }

        $message = '<div class="alert alert-danger">Application could not be saved.</div>';
        $stmt->close();
    }
}

$result = $conn->query("SELECT id, full_name, father_name, email, phone, program FROM applications ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Student Admission Application</h2>
                    <?= $message ?>
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Father's Name</label>
                                <input type="text" name="father_name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Program</label>
                                <select name="program" class="form-select" required>
                                    <option value="">Select Program</option>
                                    <option value="Information Systems">Information Systems</option>
                                    <option value="Software Engineering">Software Engineering</option>
                                    <option value="Computer Science">Computer Science</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body p-4">
                    <h3 class="mb-3">Submitted Applications</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Father's Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Program</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row["id"], ENT_QUOTES, "UTF-8") ?></td>
                                        <td><?= htmlspecialchars($row["full_name"], ENT_QUOTES, "UTF-8") ?></td>
                                        <td><?= htmlspecialchars($row["father_name"], ENT_QUOTES, "UTF-8") ?></td>
                                        <td><?= htmlspecialchars($row["email"], ENT_QUOTES, "UTF-8") ?></td>
                                        <td><?= htmlspecialchars($row["phone"], ENT_QUOTES, "UTF-8") ?></td>
                                        <td><?= htmlspecialchars($row["program"], ENT_QUOTES, "UTF-8") ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
<?php
// admin_dashboard.php - Connect to DB
$conn = new mysqli('localhost', 'root', '', 'user_registration');

// Handle Approve/Reject actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $newStatus = ($action == 'approve') ? 'approved' : 'rejected';

    $conn->query("UPDATE users SET status='$newStatus' WHERE id=$id");
    
    // KUHAON ANG EMAIL PARA PADAL-AN UG STATUS UPDATE
    $res = $conn->query("SELECT email, firstname FROM users WHERE id=$id");
    $user = $res->fetch_assoc();
    
    // Diri nimo i-call ang PHPMailer (pareha sa send.php) para ingnan ang seller
    // Subject: "Update on your Seller Account"
    // Body: "Your account has been " . $newStatus;
    
    echo "<script>alert('User $newStatus!'); window.location='admin_dashboard.php';</script>";
}

$sellers = $conn->query("SELECT * FROM users WHERE role='seller' AND status='pending'");
?>

<h2>Pending Seller Approvals</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php while($row = $sellers->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td>
            <a href="?action=approve&id=<?php echo $row['id']; ?>">Approve</a> | 
            <a href="?action=reject&id=<?php echo $row['id']; ?>" style="color:red;">Reject</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php
header("Content-Type: application/json");
require 'vendor/autoload.php'; // PHPMailer autoload
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

global $conn;

$domain = $_SERVER['HTTP_HOST'];
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$siteUrl = $protocol . $domain;

// Input sanitization
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$subject = trim($_POST["subject"]);
$message = trim($_POST["message"]);

$sql = "INSERT INTO lead_users (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if($stmt->execute()){
    // PHPMailer SMTP Send
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.demo.example.com'; // Replace with your SMTP host in production
        $mail->SMTPAuth = true;
        $mail->Username = 'demo@demo.example.com'; // Demo SMTP user
        $mail->Password = 'demo-password'; // Demo SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('demo@demo.example.com', 'Demo Website');
        $mail->addAddress('admin@demo.example.com', 'Demo Admin'); // Demo admin email

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Lead: $subject";
        $mail->Body = "
        <div style=\"background: #f4fbfa; padding: 48px 0; font-family: 'Segoe UI', Arial, sans-serif;\">
        <div style=\"max-width:520px; margin:auto; border-radius:18px; box-shadow:0 6px 32px #0d6b682e; background:#fff; overflow:hidden;\">
            <header style=\"background:linear-gradient(90deg,#0D6B68 60%,#2a9d8f 120%);padding: 32px 36px 18px 36px;\">
                <div style=\"display:flex;align-items:center;gap:12px;\">
                    <div style=\"width:44px;height:44px;background:#fff;border-radius:50%;box-shadow:0 2px 11px #26465310;display:flex;align-items:center;justify-content:center;\">
                        <span style=\"font-size:28px;color:#06d6a0\">&#9993;</span>
                    </div>
                    <div>
                        <div style=\"font-size:12px;color:#06d6a0;font-weight:500;text-transform:uppercase; letter-spacing:1px;\">Contact Lead</div>
                        <div style=\"font-size:22px;font-weight:900;color:#fff;margin-top:2px;\">New Submission</div>
                    </div>
                </div>
            </header>
            <main style=\"padding:32px 36px 18px 36px;\">
            <table style=\"width:100%;border-collapse:separate;border-spacing:0 12px;\">
                <tr>
                <td style=\"background:#f8f8fc;border-radius:9px 0 0 9px;padding:14px 18px 14px 20px;color:#264653;font-weight:700;border-left:5px solid #2a9d8f;width:38%;\">Name</td>
                <td style=\"background:#f8f8fc;border-radius:0 9px 9px 0;padding:14px 20px;color:#0d4d4d;\">".htmlspecialchars($name)."</td>
                </tr>
                <tr>
                <td style=\"background:#edf5f5;border-radius:9px 0 0 9px;padding:14px 18px 14px 20px;color:#264653;font-weight:700;border-left:5px solid #2a9d8f;\">Email</td>
                <td style=\"background:#edf5f5;border-radius:0 9px 9px 0;padding:14px 20px;color:#0d4d4d;\">".htmlspecialchars($email)."</td>
                </tr>
                <tr>
                <td style=\"background:#f8f8fc;border-radius:9px 0 0 9px;padding:14px 18px 14px 20px;color:#264653;font-weight:700;border-left:5px solid #2a9d8f;\">Subject</td>
                <td style=\"background:#f8f8fc;border-radius:0 9px 9px 0;padding:14px 20px;color:#0d4d4d;\">".htmlspecialchars($subject)."</td>
                </tr>
                <tr>
                <td style=\"background:#edf5f5;border-radius:9px 0 0 9px;padding:14px 18px 14px 20px;color:#264653;font-weight:700;border-left:5px solid #2a9d8f;\">Message</td>
                <td style=\"background:#edf5f5;border-radius:0 9px 9px 0;padding:14px 20px;color:#0d4d4d;word-break:break-word;white-space:pre-line;\">".htmlspecialchars($message)."</td>
                </tr>
                <tr>
                <td style=\"background:#edf5f5;border-radius:9px 0 0 9px;padding:14px 18px 14px 20px;color:#264653;font-weight:700;border-left:5px solid #2a9d8f;\">Date &amp; Time</td>
                <td style=\"background:#edf5f5;border-radius:0 9px 9px 0;padding:14px 20px;color:#0d4d4d;\">".date("d-m-Y h:i:s A")."</td>
                </tr>
            </table>
            </main>
            <footer style=\"background:linear-gradient(90deg,#06d6a0,#0D6B68 110%);padding:12px 36px;color:#fff;font-size:15px;font-weight:700;letter-spacing:.7px;text-align:right;\">
            ".$siteUrl."
            </footer>
        </div>
        </div>
        ";

        file_put_contents('email_log.html', $mail->Body);

        // $mail->send();
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Email not sent: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Failed to save lead"]);
}
$stmt->close();
$conn->close();
?>

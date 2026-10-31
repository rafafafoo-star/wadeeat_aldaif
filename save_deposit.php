<?php
// إعدادات الاتصال بقاعدة البيانات
$host = "localhost";
$username = "root";
$password = "";
$dbname = "wadeeat_aldaif";

// إنشاء الاتصال
$conn = new mysqli($host, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// ضبط الترميز للغة العربية
$conn->set_charset("utf8");

// استقبال البيانات المرسلة من النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_code = $_POST['ticket_code'];
    $guest_name = $_POST['guest_name'];
    $guest_phone = $_POST['guest_phone'];
    $guest_id_number = $_POST['guest_id_number'];
    $service_type = $_POST['service_type'];
    $deposit_location = $_POST['deposit_location'];
    $baggage_count = $_POST['baggage_count'];
    $status_text = $_POST['status_text'];

    // استعلام الإدخال في جدول deposits
    $sql = "INSERT INTO deposits (ticket_code, guest_name, guest_phone, guest_id_number, service_type, deposit_location, baggage_count, status_text) 
            VALUES ('$ticket_code', '$guest_name', '$guest_phone', '$guest_id_number', '$service_type', '$deposit_location', '$baggage_count', '$status_text')";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='text-align: center; margin-top: 50px; font-family: Arial; direction: rtl;'>";
        echo "<h2 style='color: green;'>تم حفظ بيانات الوديعة بنجاح! ✅</h2>";
        echo "<a href='index.html' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;'>إضافة وديعة أخرى</a>";
        echo "</div>";
    } else {
        echo "حدث خطأ أثناء الحفظ: " . $conn->error;
    }
}

$conn->close();
?>

<?php
/*$url        = 'https://notify-api.line.me/api/notify';
$token      = 'UCUTi5VGRFOsLnfDP4DHxdzmXxcNt5M76JGXhSaDNnt';
$headers    = [
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer ' . $token
];
$fields     = 'message=ใส่ข้อความที่นี่';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

var_dump($result);
$result = json_decode($result, TRUE);*/

/* test เครื่องต้นข้าว */
$expectedToken = 'UCUTi5VGRFOsLnfDP4DHxdzmXxcNt5M76JGXhSaDNnt';
$inputToken = $_GET['token']; // รับค่า token จาก URL

if ($inputToken === $expectedToken) {

    $dsn = 'mysql:host=localhost;dbname=complaint';
    $username = 'sa';
    $password = 'sa';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT 
            CONCAT(
                'ลำดับที่ ', c.idnumber, '\n',
                ' วันที่/เวลา ', c.complaint_datetime, '\n',
                ' รายละเอียดเรื่องร้องเรียน ', c.complaint_detail, '\n',
                ' ความประสงค์ในการติดต่อ = ', s.consent
            ) AS message
        FROM 
            complaint c
        LEFT JOIN 
            statusconsent s ON c.status_consent = s.status
        WHERE 
            c.improvement IS NULL OR c.improvement = ''";


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // จัดรูปแบบข้อมูลเพื่อส่งผ่าน Line Notify
        $messages = array_column($result, 'message');

        // เรียกใช้ฟังก์ชันสำหรับส่งข้อความผ่าน Line Notify
        foreach ($messages as $message) {
            sendLineNotification($message);
        }
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาด: ' . $e->getMessage();
    }

   
} else {
    // ไม่ตรงกับ token ที่คาดหวัง
    echo 'รหัส Token ไม่ถูกต้อง';
}

function sendLineNotification($message)
{
    $token = 'UCUTi5VGRFOsLnfDP4DHxdzmXxcNt5M76JGXhSaDNnt';
    $url = 'https://notify-api.line.me/api/notify';
    $data = http_build_query(['message' => $message]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $token
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    var_dump($response);
}
/* test เครื่องต้นข้าว */

/*

$expectedToken = '4lGppIeZa78QXIxXJVll4fC2Yqd4Sa1ia3xvsZMrTdp';
$inputToken = $_GET['token']; // รับค่า token จาก URL

if ($inputToken === $expectedToken) {

    $dsn = 'mysql:host=localhost;dbname=complaint';
    $username = 'web';
    $password = 'Webdb@11277';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT 
            CONCAT(
                'ลำดับที่ ', c.idnumber, '\n',
                ' วันที่/เวลา ', c.complaint_datetime, '\n',
                ' รายละเอียดเรื่องร้องเรียน ', c.complaint_detail, '\n',
                ' ความประสงค์ในการติดต่อ = ', s.consent
            ) AS message
        FROM 
            complaint c
        LEFT JOIN 
            statusconsent s ON c.status_consent = s.status
        WHERE 
            c.improvement IS NULL OR c.improvement = ''";


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // จัดรูปแบบข้อมูลเพื่อส่งผ่าน Line Notify
        $messages = array_column($result, 'message');

        // เรียกใช้ฟังก์ชันสำหรับส่งข้อความผ่าน Line Notify
        foreach ($messages as $message) {
            sendLineNotification($message);
        }
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาด: ' . $e->getMessage();
    }
} else {
    // ไม่ตรงกับ token ที่คาดหวัง
    echo 'รหัส Token ไม่ถูกต้อง';
}

function sendLineNotification($message)
{
    $token = '4lGppIeZa78QXIxXJVll4fC2Yqd4Sa1ia3xvsZMrTdp';
    $url = 'https://notify-api.line.me/api/notify';
    $data = http_build_query(['message' => $message]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $token
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    var_dump($response);
}
*/



?>






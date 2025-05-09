<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
function sendMail($mailAddress, $name, $content)
{
    $mail = new PHPMailer(true);
    $mail->setLanguage('vi', 'language/phpmailer.lang-vi.php');
    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP(); // Sử dụng SMTP để gửi mail
        $mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
        $mail->SMTPAuth = true; // Bật xác thực SMTP
        $mail->Username = 'toidz25102004@gmail.com'; // Tài khoản email
        $mail->Password = 'govn mjwa nptc yzkx'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
        $mail->SMTPSecure = 'ssl'; // Mã hóa SSL
        $mail->Port = 465; // Cổng kết nối SMTP là 465

        //Recipients
        $mail->setFrom('toidz25102004@gmail.com', 'Nguyen Huy Toi'); // Địa chỉ email và tên người gửi
        $mail->addAddress($mailAddress, $name); // Địa chỉ mail và tên người nhận

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Ma Xac Nhan Mat Khau'; // Tiêu đề
        $mail->Body = 'Ma xac nhan de lay lai mat khau cua ban la: ' . $content; // Nội dung

        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

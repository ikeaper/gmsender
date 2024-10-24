<?php
namespace PHPMailer\PHPMailer;

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';

// 示例
$sender_email = 'xxxx@gmail.com';     //发送者邮箱
$email_pass="xxxx xxxx xxxx xxxx";          // 设置方式：设置->账号和导入->更改密码恢复选项->安全性->搜索“应用专用”
$receiver_email = 'xxxx@gmail.com';    // 接收者邮箱
$title='这里是邮件标题' . time();                  // 邮件标题
$body='<h1>这里是邮件内容</h1>' . date('Y-m-d H:i:s'); //邮件内容
$altbody='';    // 如果邮件客户端不支持HTML则显示此内容
GMsender::send($sender_email,$email_pass,$receiver_email,$title,$body,$altbody);




class GMsender
{
    /**GoogleMail发送器
     * @param $sender_email     -发送者邮箱
     * @param $email_pass       -Gmail是应用专用密码
     * @param $receiver_email   -接收者邮箱
     * @param $title            -邮件标题
     * @param $body             -邮件内容
     * @param $altbody          -邮件客户端不支持HTML则显示此内容
     * @return bool
     */
    static  public function send($sender_email,$email_pass,$receiver_email,$title,$body,$altbody=''):bool
    {


        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //服务器配置
            $mail->CharSet = "UTF-8";                     //设定邮件编码
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();                             // 使用SMTP
            $mail->Host = 'smtp.gmail.com';                // SMTP服务器
            $mail->SMTPAuth = true;                      // 允许 SMTP 认证
            $mail->Username = $sender_email;                // SMTP 用户名  即邮箱的用户名
            $mail->Password = $email_pass;;             // SMTP 密码  部分邮箱是授权码(例如163邮箱) Gmail是应用专用密码
            $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
            $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持
            // $sender_email = 'xxx@gmail.com';     //发送者邮箱
            // $receiver_email = 'xxx@gmail.com';    // 接收者邮箱
            // $title='这里是邮件标题' . time();                  // 邮件标题
            // $body='<h1>这里是邮件内容</h1>' . date('Y-m-d H:i:s'); //邮件内容
            // $altbody='';    // 如果邮件客户端不支持HTML则显示此内容

            $mail->setFrom($sender_email, 'Mailer');  //发件人
            $mail->addAddress($receiver_email, 'Joe');  // 收件人
            //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
            $mail->addReplyTo($sender_email, 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                    //抄送
            //$mail->addBCC('bcc@example.com');                    //密送

            //发送附件
            // $mail->addAttachment('../xy.zip');         // 添加附件
            // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

            //Content
            $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = $title;
            $mail->Body = $body;
            $mail->AltBody = $altbody;

            $mail->send();
            echo '邮件发送成功';
            return true;
        } catch (Exception $e) {
            echo '邮件发送失败: ', $mail->ErrorInfo;
            return false;
        }
    }
}



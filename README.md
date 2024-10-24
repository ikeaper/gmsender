# gmsender
google mail sender#

// 示例

$sender_email = 'xxxx@gmail.com';     //发送者邮箱

$email_pass="xxxx xxxx xxxx xxxx";          // 设置方式：设置->账号和导入->更改密码恢复选项->安全性->搜索“应用专用”

$receiver_email = 'xxxx@gmail.com';    // 接收者邮箱

$title="这里是邮件标题" . time();        // 邮件标题

$body='<h1>这里是邮件内容</h1>' . date('Y-m-d H:i:s'); //邮件内容

$altbody='';    // 如果邮件客户端不支持HTML则显示此内容

GMsender::send($sender_email,$email_pass,$receiver_email,$title,$body,$altbody);


<?php

define('IN_PHPWeb', true);
include("./zy_smarty.php");
if (empty($_REQUEST['act']))
{$_REQUEST['act'] = 'info';}else{$_REQUEST['act'] = trim($_REQUEST['act']);}
if ($_REQUEST['act'] == "info")
{echo('<script>location.href="zy_logo.php";</script>');
exit;}


if ($_REQUEST['act'] == "logo"){	

$conn = new mysqli($db_host, $db_user, $db_pass, $sql_name);
if ($conn->connect_error) {
    die("连接失败: ");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据

	function xin_check($sql_str) { 
		return preg_match('select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|\;|CREATE|ALTER|DROP|TRUNCATE', $sql_str);
	}	
    $email = $conn->real_escape_string($_POST['zy_name']);
    $password = $conn->real_escape_string($_POST['zy_pwd']);
	if(xin_check($email)){ exit('提交的参数非法！');};
	if(xin_check($password)){ exit('提交的参数非法！');};	
    $stmt = $conn->prepare("SELECT user_id FROM moba_admin_user WHERE user_name = ? AND password = ?");    
    if ($stmt) {
        $stmt->bind_param("ss", $email, md5($password));
        $stmt->execute();
        $result = $stmt->get_result();
        // 检查是否有结果
        if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			
            // --- success branch in logo.php ---
            /* Set cookie scope BEFORE session_start (do this in both logo.php & zy_index.php) */
            session_set_cookie_params([
              'lifetime' => 0,
              'path'     => '/',                              // safe for whole site
              'domain'   => $_SERVER['HTTP_HOST'],            // fangliulab.su.domains
              'secure'   => !empty($_SERVER['HTTPS']),        // true on HTTPS
              'httponly' => true,
              'samesite' => 'Lax',
            ]);
            
            session_start();
            session_regenerate_id(true);                       // avoid fixation; creates a new SID
            $_SESSION['user_name'] = $email;
            $_SESSION['user_id']   = $row['user_id'];
            
            session_write_close();                             // ensure session data is flushed to disk
            
            // sanity: if something has already printed, you’ll see where
            if (headers_sent($f, $l)) { die("Headers already sent at $f:$l"); }
            
            // Use absolute URL, then STOP
            header('Location: https://fangliulab.su.domains/manasixvies/zy_index.php', true, 302);
            exit;
        } else {
            // 登录失败
			die('<script>alert("登录失败！");history.go(-1);</script>');
        }        
        // 关闭预处理语句
        $stmt->close();
    }
}
// 关闭数据库连接
$conn->close();

}



if($_REQUEST['act'] == "logout"){
session_start();
unset($_SESSION['user_name']);
$_SESSION['user_name']=="";
$_SESSION['user_id']=="";
echo('<script>alert("注销成功！"); location.href="zy_logo.php";</script>');
exit;}
include("./zy_close.php");///关闭
?>

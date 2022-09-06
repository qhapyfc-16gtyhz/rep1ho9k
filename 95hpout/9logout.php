<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php
session_start();
$_SESSION = array();
session_destroy();

echo
 "<a>ありがとうございました。<br>
 ログアウトしました。
</a>"
."<br><br>";

?>
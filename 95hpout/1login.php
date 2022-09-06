
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php
session_start();
require_once('funct.php');
?>

<form method='post' action='1login.php'>
    <p>
        <label for="shaban"> 社員番号：</label>
        <input type='text' name='shaban'>
    </p>
    <p>
        <label for="pwr">パスワード：</label>
        <input type='password' name='pwr'>
    </p>
    <input type='submit' value='送信する'>
</form>

<?php
if(!empty($_SESSION['login'])){
    echo"ログイン済です。<br><br>";
    echo"<a href=3nenpyohyoji.php>年表の表示画面に移ります。→→→　</a>"."<br>";
    exit;
}
if((empty($_POST['shaban']))||(empty($_POST['pwr']))){
    echo"あなたの社員番号＆パスワードを入力してください。<br>";
    exit;
}

try{

$user = "XX";
$password = "XX";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
];
$dbh = new PDO('mysql:host=localhost; dbname=shasi_db', $user, $password, $opt);

$sql = "SELECT pwr FROM shain2 WHERE shaban = :shaban";

$stmt = $dbh->prepare($sql);

$stmt->bindValue(":shaban", $_POST['shaban'], PDO::PARAM_STR);
$stmt->execute();
$result = $stmt -> fetch(PDO::FETCH_ASSOC);

if(!$result){
    echo "ログインできませんでした。";
    exit;
}
if(password_verify($_POST['pwr'], $result['pwr'])){
    session_regenerate_id(true);
    $_SESSION['login'] = true;
    header("Location: 3nenpyohyoji.php");
    
}else{
    echo "社員番号、パスワードを確認してください。";
}

} catch (PDOException $e) {
    echo "エラーです。<br>";
    exit;
}
?>

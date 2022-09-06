
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php
require_once ('funct.php');

try{
$user = "XX";
$password = "XX";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
];
$dbh = new PDO('mysql:host=localhost; dbname=shasi_db', $user, $password, $opt);

$sql = "INSERT INTO coment2 (inc, kwd, cmt, nepinc, nepyr) VALUES (NULL, :kwd, :cmt, NULL, :nepyr)";

$stmt = $dbh->prepare($sql);

$stmt->bindValue(":kwd", $_POST['kwd'], PDO::PARAM_STR);
$stmt->bindValue(":cmt", $_POST['cmt'], PDO::PARAM_STR);
$stmt->bindValue(":nepyr", $_POST['nepyr'], PDO::PARAM_INT);

$stmt->execute();
echo "<br>";
echo "事象年、キーワード、コメントを受け付けました。<br><br>";
echo "<a href='5comtlist.php'>コメントの一覧が見られます。　→→→　</a>";

} catch (PDOException $e) {
    echo "エラーです。 <br>";
    exit;
}
?>
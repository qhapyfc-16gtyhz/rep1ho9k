
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php

echo "コメント削除　完了です。";
echo "<br><br>";

require_once ('funct.php');

if(empty($_POST['inc'])){
    echo "データを確認してください。";
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

$sql = "DELETE FROM coment2 WHERE inc=:inc";
$stmt = $dbh->prepare($sql);

$inc = (int) $_POST['inc'];

$stmt->bindValue(":inc", $inc, PDO::PARAM_INT);

$stmt->execute();

echo "→→　コメントを削除しました。"."<br>";
echo "<a href='5comtlist.php'>コメント一覧に戻ります。</a>";

} catch (PDOException $e) {
    echo "エラーです。 <br>";
    exit;
}
?>

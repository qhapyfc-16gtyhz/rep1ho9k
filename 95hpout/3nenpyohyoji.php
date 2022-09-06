
<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
    <title>年表の表示画面です。</title>
    <link rel='stylesheet' type='text/css' href='./style.css'>
</head>

<body>
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

$sql = "SELECT * FROM nenpyo3";

$statement = $dbh->query($sql);

echo "<br>年表を表示します。<br><br>";

while($row = $statement->fetch()){
    echo "年表番号：".str2html($row[0]). "<br>";
    echo "年：".str2html($row[1]). "<br>";
    echo "事象：".str2html($row[2]). "<br><br>";
    }

echo "<a href='5comtlist.php'>コメント一覧を見る。　→→→　</a>";
echo "<br>";    
echo "<a href='4addcomt.html'>キーワード、コメント入力へ→　</a>"."<br><br>";

} catch (PDOException $e) {
    echo "年表表示　できませんでした。 <br>";
    exit;
}
?>

</body>
</html>
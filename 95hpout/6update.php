
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php

echo "コメントなどの更新をします。";
echo "<br><br>";

require_once ('funct.php');

if(empty($_POST['inc'])){
    echo "操作がうまくいっていないようです。年表の画面からもう一度進めてください。";
    echo "<a href='3nenpyohyoji.php'>年表画面に移る</a>";
    exit;
}
if(!preg_match('/\A\d{1,11}+\z/u', $_POST['inc'])){
    echo "整理番号が違うようです。年表の画面からもう一度進めてください。";
    echo "<a href='3nenpyohyoji.php'>年表画面に移る</a>";
    exit;
}

if(empty($_POST['kwd'])){
    echo "キーワードを記入してください。空欄になっています。"."<br>";
    echo "<a href='5comtlist.php'>コメント画面一覧に戻る。　→</a>";
    exit;
}

if(empty($_POST['cmt'])){
    echo "コメントを記入してください。空欄になっています。"."<br>";
    echo "<a href='5comtlist.php'>コメント一覧に戻る。　→</a>"."<br>";
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

$sql = "UPDATE coment2 SET kwd=:kwd, cmt=:cmt, nepyr=:nepyr WHERE inc=:inc";
$stmt = $dbh->prepare($sql);

$inc = (int) $_POST['inc'];
$nepyr = (int) $_POST['nepyr'];

$stmt->bindValue(":inc", $inc, PDO::PARAM_INT);
$stmt->bindValue(":kwd", $_POST['kwd'], PDO::PARAM_STR);
$stmt->bindValue(":cmt", $_POST['cmt'], PDO::PARAM_STR);
$stmt->bindValue(":nepyr", $nepyr, PDO::PARAM_INT);

$stmt->execute();

echo "データの更新ができました。無事完了です。"."<br>";
echo "<br>";
echo "コメント一覧に戻ります。"."<br>";
echo "<a href='5comtlist.php'>コメント一覧に戻る。　→→→</a>";

} catch (PDOException $e) {
    echo "エラーです。 <br>";
    exit;
}
?>
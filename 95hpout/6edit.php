
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php

echo "コメントなどの更新画面です。";
echo "<br><br>";

require_once ('funct.php');

if(empty($_GET['inc'])){
    echo "入力がうまくできませんでした。";
    echo "<a href='5comtlist.php'>コメント一覧に移ります。→　</a>";
    exit;
}
if(!preg_match('/\A\d{1,11}+\z/u', $_GET['inc'])){
    echo "整理番号が違うようです。";
    echo "<a href='5comtlist.php'>番号を確認してください。</a>";
    exit;
}

$inc = (int) $_GET['inc'];

$user = "XX";
$password = "XX";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
];
$dbh = new PDO('mysql:host=localhost; dbname=shasi_db', $user, $password, $opt);

$sql = "SELECT inc, kwd, cmt, nepyr FROM coment2 WHERE inc=:inc";

$stmt = $dbh->prepare($sql);
$stmt->bindValue(":inc", $inc, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$result){
    echo "指定したデータはありません。";
    exit;
}

$inc = str2html($result['inc']);
$kwd = str2html($result['kwd']);
$cmt = str2html($result['cmt']);
$nepyr = str2html($result['nepyr']);

$html_form = <<<EOD
<form action='6update.php' method='post'>
    <p>
        <label for='kwd'> キーワード：</label>
        <input type='text' name='kwd' value='$kwd'>
    </p>
    <p>
        <label for='cmt'> コメント：</label>
        <input type='text' name='cmt' value='$cmt'>
    </p>
    <p>
        <label for='nepyr'> 事象年：</label>
        <input type='integer' name='nepyr' value='$nepyr'>
    </p>

    <p class='button'>
        <input type='hidden' name='inc' value='$inc'>
        <input type='submit' value='更新データを送信する。'
    </p>
</form>
EOD;
echo $html_form;

echo "<br>";
echo "更新するのを見合わせたい場合："."<br>";

echo "<a href='5comtlist.php'>コメント一覧に戻る。　→</a>"."<br>";
?>
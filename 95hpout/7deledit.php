
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php
echo "選んだキーワードやコメントを、項目ごと削除する画面です。"."<br>";
echo "削除したらもとに戻せませんので注意してください。"."<br>";
echo "<br>";

require_once ('funct.php');

if(empty($_GET['inc'])){
    echo "データを確認してください。";
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
<form action='7delupdate.php' method='post'>
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
        <input type='submit' value='この項目をすべて削除する（戻せません）。'
    </p>
</form>
EOD;
echo $html_form;

echo "<br>";
echo "削除操作をやめる。"."<br>";

echo "<a href='5comtlist.php'>コメント一覧に戻る。　→</a>"."<br>";
    
?>
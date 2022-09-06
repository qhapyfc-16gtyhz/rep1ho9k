
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php
require_once ('funct.php');

echo "<br>";
echo "<a>削除操作の画面です。</a>"."<br>";
echo "<a>注意してください。削除したらもとに戻りません。</a>"."<br><br>";

echo "（削除操作をやめたい場合。↓）"."<br>";
echo "<a href='5comtlist.php'>　コメント一覧に戻る。　→</a>"."<br><br>";

echo "<br>";
echo "削除を進める場合。→→　"."<br><br>";
try {
    $user = "XX";
    $password = "XX";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ];
    $dbh = new PDO('mysql:host=localhost;dbname=shasi_db', $user, $password, $opt);
    $sql = 'SELECT inc, kwd, cmt, nepinc, nepyr FROM coment2';
    $statement = $dbh->query($sql);

        while ($row = $statement->fetch()){
        echo  "＜この項を削除する　↓＞". "<br>";
        
        echo "いつのこと？：". str2html($row[4]) ."年"."<br>";
        echo "キーワード：". str2html($row[1]) . "<br>";
        echo "コメント：". str2html($row[2]) . "<br>";
?>
        <a href="7deledit.php?inc=<?php echo(int) $row['inc']?>">削除操作用のページへ。→→→</a>
        <br>
<?php
         echo "<br>";
        }

} catch (PDOException $e) {
    echo "エラーです。 <br>";
    exit;
}
?>
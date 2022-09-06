
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex"/>
</head>

<?php
require_once ('funct.php');

echo "<a>コメント一覧 画面</a>"."<br><br>";

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

    echo "<a href='3nenpyohyoji.php'>年表　一覧へ　→→　</a>"."<br>";
    echo "<a href='4addcomt.html'> キーワード、コメントを新たに記入する　→→　</a>"."<br>";
    echo "<br>";
    echo "<a href='7comtdelist.php'> （コメント削除画面に移る　→→→→　）</a>"."<br>";
    echo "<a href='9logout.php'> （ログアウトする　→→→→　）</a>"."<br><br>";

    while ($row = $statement->fetch()){
        echo "いつのこと？：". str2html($row[4]) ."年"."<br>";
        echo "キーワード：". str2html($row[1]) . "<br>";
        echo "コメント：". str2html($row[2]) . "<br>";
           
        echo "（更新する。）：";
        ?>

        <a href="6edit.php?inc=<?php echo(int) $row['inc']?>">このコメントを更新する。→</a>
        <br>

        <?php
        echo "<br>";
        }

} catch (PDOException $e) {
    echo "エラーです。 <br>";
    exit;
}
?>
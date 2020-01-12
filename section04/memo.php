<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<?php
require('dbconnect.php');

$id = $_REQUEST['id'];
if (!is_numeric($id) || $id <= 0) {
    print('1以上の数字で指定してください');
    exit();
}

$memos = $db->prepare('SELECT * FROM memos WHERE id=?');
$memos->execute(array($id));
$memo = $memos->fetch();
?>
<article>
    <pre><?php print($memo['memo']); ?></pre>

    <a href="update.php?id=<?php print($memo['id']); ?>">編集する</a>
     | 
    <a href="delete.php?id=<?php print($memo['id']); ?>">削除する</a>
     | 
    <a href="index.php">戻る</a>
</article>

</main>
</body>    
</html>
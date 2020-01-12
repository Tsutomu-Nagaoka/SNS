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
<pre>
<?php
$success = file_put_contents('../../news_data/news.txt', '2018-06-01 ホームページをリニューアルしました');
if ($success) {
    print('ファイルへの書き込みが完了しました');
} else {
    print('書き込みに失敗しました。フォルダの権限などを確認してください。');
}
?>
</pre>
</main>
</body>    
</html>
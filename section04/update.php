<?php require('dbconnect.php'); ?>
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
if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
    $memos->execute(array($id));
    $memo = $memos->fetch();
}
?>

<form action="update_do.php" method="post">
    <input type="hidden" name="id" value="<?php print($id); ?>">
    <textarea name="memo" cols="50" rows="10"><?php print($memo['memo']); ?></textarea><br>
    <button type="submit">登録する</button>
</form>
</main>
</body>    
</html>
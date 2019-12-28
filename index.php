<?php
// 共通変数・関数ファイルを読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　トップページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// ログイン認証
require('auth.php');

// 画面処理
// 画面表示用データ取得
// GETパラメータを取得
// カレントページ
$currentPageNum = (!empty($_GET['p'])) ? $_GET['p'] : 1;//デフォルトは１ページ目
// カテゴリー
$category = (!empty($_GET['c_id'])) ? $_GET['c_id'] : '';
// ソート順
$sort = (!empty($_GET['sort'])) ? $_GET['sort'] : '';

// パラメータに不正な値が入っているかチェック
if(!is_int((int)$currentPageNum)){
  error_log('エラー発生：指定ページに不正な値が入りました');
  header("Location:index.php"); //トップページへ
}
// 表示件数
$listSpan = 20;
// 現在の表示レコード先頭を算出
$currentMinNum = (($currentPageNum-1)*$listSpan); //1ページ目なら(1-1)*20 = 0 、 ２ページ目なら(2-1)*20 = 20
// DBから商品データを取得
$dbProductData = getProductList($currentMinNum, $category, $sort);
// DBからカテゴリデータを取得
$dbCategoryData = getCategory();
// debug('現在のページ：'.$currentPageNum);
//debug('フォーム用DBデータ：'.print_r($dbFormData,true));
//debug('カテゴリデータ：'.print_r($dbCategoryData,true));

debug('画面表示終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<');

?>
<?php

$siteTitle = 'MyBooks';
require('head.php');
 ?>

<body class="page-home page-2colum">

  <!-- ヘッダー -->

<?php
 require('header.php')
?>

<!-- メインコンテンツ -->

<div id="contents" class="site-width">

  <img src="images/library.jpg" alt="" class="back-img">
  <h1 class="site-title">MyBooksについて</h1>
  <p>自分の本棚をみんなと共有しよう！</p>

  <!-- サイドバー -->
  <section id="sidebar">
    <form name="" method="get">
      <h1 class="title">カテゴリー</h1>
      <div class="selectbox">
        <span class="icn_select"></span>
        <select name="c_id" id="">
          <option value="0" <?php if(getFormData('c_id',true) == 0 ){ echo 'selected'; } ?> >選択してください</option>
          <?php
            foreach($dbCategoryData as $key => $val){
          ?>
            <option value="<?php echo $val['id'] ?>" <?php if(getFormData('c_id',true) == $val['id'] ){ echo 'selected'; } ?> >
              <?php echo $val['name']; ?>
            </option>
          <?php
            }
          ?>
        </select>
   </div>
   <h1 class="title">表示順</h1>
   <div class="selectbox">
     <span class="icn_select"></span>
     <select name="sort">
       <option value="0" <?php if(getFormData('sort',true) == 0 ){ echo 'selected'; } ?> >選択してください</option>
       <option value="1" <?php if(getFormData('sort',true) == 1 ){ echo 'selected'; } ?> >金額が安い順</option>
       <option value="2" <?php if(getFormData('sort',true) == 2 ){ echo 'selected'; } ?> >金額が高い順</option>
     </select>
   </div>
     <input type="submit" name="" value="検索">
   </form>
  </section>

  <!-- Main -->
  <section id="main">
    <div class="search-title">
      <div class="search-left">
        <span class="total-num"><?php echo sanitize($dbProductData['total']);?></span>件の本が見つかりました
      </div>
      <div class="search-right">
        <span class="num"><?php echo (!empty($dbProductData['data'])) ? $currentMinNum+1 : 0; ?></span> - <span class="num"><?php echo $currentMinNum+count($dbProductData['data']); ?></span>件 / <span class="num"><?php echo sanitize($dbProductData['total']); ?></span>件中
      </div>
    </div>
    <div class="panel-list">
      <?php
         foreach($dbProductData['data'] as $key => $val):
       ?>
         <a href="productDetail.php<?php echo (!empty(appendGetParam())) ? appendGetParam().'&b_id='.$val['id'] : '?b_id='.$val['id']; ?>" class="panel">
           <div class="panel-head">
             <img src="<?php echo sanitize($val['pic1']); ?>" alt="<?php echo sanitize($val['name']); ?>">
           </div>
           <div class="panel-body">
            <p class="panel-title"><?php echo sanitize($val['name']); ?> <span class="point">おすすめ度 <?php echo sanitize(number_format($val['recommend'])); ?></span></p>
          </div>
        </a>
        <?php
      endforeach;
      ?>
    </div>

  <?php pagination($currentPageNum, $dbProductData['total_page']); ?>
  </section>

</div>

<?php
 require('footer.php');
 ?>

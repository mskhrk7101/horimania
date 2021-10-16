<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
$user_id = $_SESSION['user_id'];

$sql = 'SELECT COUNT(*) FROM item_table WHERE owner_id = :id AND is_status = 2';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["count_error_msg" => "{$error[2]}"]);
    exit();
} else {
    $request_count = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>マイページ</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="head-menu">
        <div class="search">
            <input type="text" name="search" placeholder="検索" value="" size="20">
        </div>
        <div class="info">
            <a href="info.php">🔔<?= $request_count[0] ?>件</a>
        </div>
        <div class="log_out">
            <a href="log_out.php">ログアウト</a>
        </div>
    </div>
    <!-- ハンバーガーメニュー -->
    <div class="menu-btn">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="menu">
        <a href="user_edit.php" class="menu__item">アカウント編集</a>
        <a href="setting.php" class="menu__item">設定</a>
        <a href="company.php" class="menu__item">ホリマニアとは？</a>
        <a href="help.php" class="menu__item">ヘルプ</a>
        <a href="contact.php" class="menu__item">お問い合わせ</a>
    </div>
    <div>
        <a href="my_post.php">投稿一覧</a>
    </div>
    <div>
        <a href="my_page.php">出品中</a>
        <a href="offer.php">オファー</a>
        <a href="treading.php">取引中</a>
        <a href="finished.php">取引済み</a>
    </div>
    <h1>取引中</h1>

    <fieldset>
        <legend>相手の出品商品 詳細</legend>
        <div>
            <div class="img"><img src=<?= $tradeitem_result["item_image"] ?>></div>
            <div class="aaa">商品名<?= $tradeitem_result["item_name"] ?></div>
            <div class="aaa">メーカー<?= $tradeitem_result["brand_name"] ?></div>
            <div class="aaa">サイズ<?= $tradeitem_result["size"] ?></div>
        </div>
    </fieldset>
    </div>
    <div class="updown">↑↓</div>
    <div class="who">
        <fieldset>
            <legend>自分の出品商品 詳細</legend>
            <div>
                <div class="img"><img src=<?= $my_result["item_image"] ?>></div>
                <div class="aaa">商品名<?= $my_result["item_name"] ?></div>
                <div class="aaa">メーカー<?= $my_result["brand_name"] ?></div>
                <div class="aaa">サイズ<?= $my_result["size"] ?></div>
            </div>
        </fieldset>
    </div>

    <form action="chat.php" method="POST" class="market">
        <input type="submit" name="chat" value="チャット" width="50px" height="50px">
    </form>

    <div>スターテス</div>
    <div class="sub-top">
        <a href="index2.php"><img alt="market" src="img/iconmonstr-shopping-cart-thin.png" width="50px" height="50px"> <br> マーケット</a> <br>

        <a href="media2.php"><img alt="media" src="img/safari_logo_icon_144917.png" width="50px" height="50px"> <br> メディア</a> <br>

        <a href="post_status.php"><img alt="post_status" src="img/iconmonstr-plus-circle-thin.png" width="50px" height="50px"> <br> 出品</a> <br>

        <a href="like.php"><img alt="like" src="img/iconmonstr-heart-thin.png" width="50px" height="50px"> <br> お気に入り</a> <br>

        <a href="my_page.php"><img alt="my_page" src="img/iconmonstr-user-male-thin.png" width="50px" height="50px"> <br>マイページ</a> <br>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $('.menu-btn').on('click', function() {
                $('.menu').toggleClass('is-active');
            });
        }());
    </script>
</body>

</html>
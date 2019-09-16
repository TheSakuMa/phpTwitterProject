<?php
// OAuthスクリプトの読み込み
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

// Consumer key
$consumer_key = "fFo7i2mbcXaoM4ycimzmh6s8y";
// Consumer secret
$consumer_secret = "lHcCROz5AGsKQDmNa9IZHIsUm4E0iLakxEh6BOOt5hcaYvuji3";
// Access token
$access_token = "1166169015313502208-QrFuDdzOgI5mG8SFZHZHkPQI4VIpsu";
// Access token secret
$access_token_secret = "E3mm0EFw0DoQn3hwE39HNj4LvxYFhGIw38auQLTbgGc4M";

// おまじない
$header = 'Content-Type: text/plain; charset=utf-8';

// つぶやく

try {
  // TwistOAuthの新しい接続を生成
  $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
  // ツイートする
  $res = $connection->post('statuses/update', [
    'status' => 'やばい'
  ]);
  // おまじない
  header($header, true, 200);
  // 返却値。成功したら、「ツイートしました。」とブラウザに表示
  echo "ツイートしました";
  var_dump($res);
} catch (Exception $e) {
  // おまじない
  header($header, true, $e->getCode() ?: 500);
  // ツイートに失敗したら、「ツイート失敗」と表示
  echo "ツイート失敗: {$e->getMessage()}\n";
}

?>
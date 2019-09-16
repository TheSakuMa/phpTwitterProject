<?php
// OAuthスクリプトの読み込み
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
$words = htmlspecialchars($_GET['words']);
require_once 'config.php';

// Consumer key
$consumer_key = API_KEY;
// Consumer secret
$consumer_secret = API_SECRET;
// Access token
$access_token = ACCESS_TOKEN;
// Access token secret
$access_token_secret = ACCESS_SECRET;

// おまじない
$header = 'Content-Type: text/plain; charset=utf-8';

$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
// ツイート取得
/**
 * q: 検索キーワード
 * result_type: 取得ツイートの種類
 * count: 取得ツイート数
 */
$tweet_params = array('q' => $words, 'result_type' => 'recent', 'count' => '10');
$tweets = $connection->get('search/tweets', $tweet_params)->statuses;

/* 
  echo "<h2>取得したツイート情報一覧</h2>";
  for($i = 0; $i < 10; $i++) {
    echo "<p>";
    var_dump($tweets[$i]);
    echo "</p>";
  }
*/

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>ツイートを取得する</title>
  </head>
  <body>
    <form method="get" action="">
      <input type="text" name="words">
      <input type="submit" value="検索">
    </form>
    <div>
      <?php echo "<h2>取得したツイート本文</h2>" ?>
      <?php 
        for($i = 0; $i < 10; $i++) {
          $st = $tweets[$i];
          $user = $st->user;
          echo "<p>$user->name</p>";
          echo "<p>$st->text</p><br>";
        }
      ?>
    </div>
  </body>
</html>
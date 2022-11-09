<?php
// 関数ファイルを読み込み
require('function.php');

// 変数
$err_msg = array(); // エラーメッセージ格納用の配列
$quant = ''; // パスワードの個数
$passLen = ''; // パスワードの桁の長さ
$checked1 = ''; // radioボタン
$checked2 = ''; // radioボタン

// POST送信がある場合
if (!empty($_POST)) {
  debug('POST送信があります');
  debug('POST情報は [ ' . print_r($_POST, true) . ' ] です');

  // POST送信を変数に格納
  $passLen = (isset($_POST['passLen'])) ? $_POST['passLen'] : 'len8';
  $quant = (isset($_POST['quant'])) ? $_POST['quant'] : '';

  if(empty($quant)) {
    $err_msg['quant'] = '未入力です';
  }
  if($quant > 10) {
    $err_msg['quant'] = '1度に生成できるパスワードは10個までです';
  }

  // radioボタンにcheckedを表示
  if ($passLen === 'len8') {
    $checked1 = 'checked';
    debug('チェックされた桁数は [ 8 ] 桁です');
  } else {
    $checked2 = 'checked';
    debug('チェックされた桁数は [ 12 ] 桁です');
  }
}

?>


<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns#">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- OGPの設定 -->
  <meta property="og:title" content="password-generator">
  <meta property="og:type" content="website">
  <meta property="og:description" content="パスワード生成ツールです。">
  <meta property="og:url" content="https://yn-it.com/password-generator/">
  <meta property="og:site_name" content="パスワード生成">
  <meta property="og:image" content="https://yn-it.com/password-generator/password-generator.png">

  <!-- Twitter用のOGPの設定 -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@ynit1979">
  
  <link rel="stylesheet" href="style.css">
  <title>パスワード生成</title>
</head>

<body>
  <div class="form__container">
    <form method="post" class="form">
      <h1 class="form__title">パスワード生成</h1>
      <label>
        パスワードを何個生成しますか (最大10個まで)
        <input type="number" name="quant" value="<?php if (isset($quant)) echo $quant; ?>" class="form__input" placeholder="半角数字で入力してください">
        <span class="err-msg"><?php if(!empty($err_msg['quant'])) echo $err_msg['quant']; ?></span>
      </label>
      <label class="radio">
        <input type="radio" name="passLen" value="len8" <?php echo $checked1; ?> class="form__radio" checked="checked">
        <span class="radio__text">8桁</span>
      </label>
      <label class="radio">
        <input type="radio" name="passLen" value="len12" <?php echo $checked2; ?> class="form__radio">
        <span class="radio__text">12桁</span>
      </label>
      <input type="submit" value="パスワードを生成する" class="btn">
      <div class="showPass__wrap">
        <?php
        if ($passLen === 'len8') {
          for ($i = 0; $i < $quant; ++$i) {
        ?>
            <div class="<?php if(empty($err_msg['quant'])) echo 'showPass__card'; ?>">
              <p class="showPass"><?php if (empty($err_msg['quant'])) echo makePassGene(8); ?></p>
            </div>
          <?php
          }
        } else {
          for ($i = 0; $i < $quant; ++$i) {
          ?>
            <div class="<?php if(empty($err_msg['quant'])) echo 'showPass__card'; ?>">
              <p class="showPass"><?php if (empty($err_msg['quant'])) echo makePassGene(12); ?></p>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </form>
    <img src="password-generator.png" alt="screenshot" style="display: none;">
  </div>
</body>

</html>
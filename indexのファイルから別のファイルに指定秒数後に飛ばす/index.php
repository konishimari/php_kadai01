<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ページの指定時間後のリダイレクト</title>
</head>

<body>
    <?php
    $clock = 3;
    $text = "これはindex.phpのページです";
    echo "{$text}<br>{$clock}秒後に別のページに飛びます";

    header("refresh:{$clock}; url=write.php");
    exit;
    ?>
</body>

</html>
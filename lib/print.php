<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>


<?php
// 단일 태그
function print_single($str)
{
    $text = file_get_contents("./data/sample" . $_GET['id'] . "/" . $str);
    echo $text;
}
// 불특정 복수의 태그 생성
function print_multi($str)
{
    $list = scandir('./data/sample' . $_GET['id'] . '/' . $str);
    $i = 0;
    while ($i < count($list)) {
        if ($list[$i] != '.') {
            if ($list[$i] != '..') {
                $text = file_get_contents('./data/sample' . $_GET['id'] . '/' . $str . '/' . $list[$i]);
                echo "<p>$text</p>";
            }
        }
        $i = $i + 1;
    }
}
?>


</body>

</html>
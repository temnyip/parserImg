<?php
//echo phpinfo();
//exit;
require_once 'vendor/autoload.php';
$img_url = $_POST['img'];
$title = $_POST['name'];
$text = $_POST['text'];
$end_date = $_POST['date'];

$db = new Db(
    "127.0.0.1",
    "3306",
    "first",
    "root",
    ""
);
require_once 'phpQuery/phpQuery/phpQuery.php';
header('Content-type: text/html; charset=utf-8');

function print_arr($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function get_content($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
return $res;

}

function parser($url, $start, $end) {
    if($start < $end) {
        // $file = file_get_contents($url);
        $file = get_content($url);
        $doc = phpQuery::newDocument($file);
        foreach ($doc->find('.page .media') as $article) {
            $article = pq($article);
//            $article->find('.stacking-badge')->remove(); //удаляет лишнее
//            $article->find('.badge')->remove();
//            $article->find('.pod_summary')->remove();

            $img = $article->find('.media-object img')->attr('src'); //выводит лого
            $name = $article->find('.pod_brand')->html();    //вывод название магазина + купоны и бонусы (с помощью remove удаляем лишнее)
            $opisanie = $article->find('.pod_description')->html();
            $date = $article->find('.pod_expiry')->html();
            echo "<img src='$img'>";
            echo '<hr>';
            echo $name;
            echo '<hr>';
            echo $opisanie;
            echo '<hr>';
            echo $date;
            echo '<hr>';
        }


//        $current = $doc->find('.hidden .')->next()->attr(href);
//        if (!empty($next)) {
//           $start++;
//            parser($next, $start, $end);
//        }
    }
}
$url = 'https://www.coupons.com/store-loyalty-card-coupons/acme-coupons/';
$start = 0;
$end = 3;
parser($url, $start, $end);

//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
////curl_setopt($ch, CURLOPT_HEADER, true);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
////curl_setopt($ch, CURLOPT_NOBODY, true);
//curl_exec($ch);
//curl_close($ch);

// весь блок для записи в файл
//    $fp = fopen("file.txt", "w");
//    $ch = curl_init($url);
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//    curl_setopt($ch, CURLOPT_FILE, $fp);
//    $res = curl_exec($ch);
//    curl_close($ch);
//    var_dump($res);


//$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$res = curl_exec($ch);
//curl_close($ch);




?>
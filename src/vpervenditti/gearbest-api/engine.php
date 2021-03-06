<?php
$file = file_get_contents("./config.json");
$config = json_decode($file, true);
$time = time();

function curlRequest($method, $args)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_HEADER, 0);
    curl_setopt($c, CURLOPT_URL, "https://affiliate.gearbest.com/api/products/" . $method . "?" . $args);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    $r = curl_exec($c);
    curl_close($c);
    return json_decode($r);
}

function getCompletedOrders($page = 1)
{
    global $config;
    global $time;
    $str = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $time . "&lkid=" . $config['lkid'] . "&currency=" . $config['currency'] . "&page=" . $page . "&sign=" . $sign;
    return curlRequest("list-promotion-products", $args);
}

function listPromotionProduct($page = 1)
{
    global $config;
    global $time;
    $str = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $time . "&lkid=" . $config['lkid'] . "&currency=" . $config['currency'] . "&page=" . $page . "&sign=" . $sign;
    return curlRequest("products/list-promotion-products", $args);
}


function listEventCreative($type, $category, $size, $page = 1)
{
    global $config;
    global $time;
    $str = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $time . "&lkid=" . "&type=" . $type . "&category=" . $category . "&language=" . $config['language'] . "&size=" . $size . "&page=" . $page . "&sign=" . $sign . "&lkid=" . $config['lkid'];
    return curlRequest("banner/list-event-creative", $args);
}


function listProductCreative($type, $category, $page = 1)
{
    global $config;
    global $time;
    $str = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $time . "&type=" . $type . "&category=" . $category . "&page=" . $page . "&sign=" . $sign . "&lkid=" . $config['lkid'];
    return curlRequest("promotions/list-product-creative", $args);
}


function listCoupons($category, $page = 1)
{
    global $config;
    global $time;
    $str = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $time . "&language=" . $config['language'] . "&category=" . $category . "&page=" . $page . "&sign=" . $sign . "&lkid=" . $config['lkid'];
    return curlRequest("coupon/list-coupon", $args);
}

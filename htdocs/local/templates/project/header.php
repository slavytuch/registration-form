<?

use Bitrix\Main\Page\Asset;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<html>
<head>
    <?
    $APPLICATION->ShowHead(); ?>
    <div id="panel"><?
        $APPLICATION->ShowPanel(); ?></div>
    <?
    Asset::getInstance()->addCss('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css');
    ?>
    <title><?
        $APPLICATION->showTitle() ?></title>
</head>
<body>
<div class="container mt-5">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "top",
        array(
            "ROOT_MENU_TYPE" => "top",
            "MAX_LEVEL" => "2",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "Y",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "36000000",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => ""
        )
    ); ?>
    <h1 class="my-3"><?
        $APPLICATION->showTitle(false) ?></h1>
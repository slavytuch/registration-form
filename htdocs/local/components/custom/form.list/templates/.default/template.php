<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?>

<?
if ($arResult['ITEMS']):
    $sortUrl = $arResult['SORT_URL'];
    ?>
    <div class="row my-1 border-bottom">
        <a href="<?=$sortUrl['ID']?>" class="col"><?= Loc::getMessage('ID') ?></a>
        <a href="<?=$sortUrl['LAST_NAME']?>" class="col"><?= Loc::getMessage('LAST_NAME') ?></a>
        <a href="<?=$sortUrl['NAME']?>" class="col"><?= Loc::getMessage('NAME') ?></a>
        <a href="<?=$sortUrl['ID']?>" class="col"><?= Loc::getMessage('SECOND_NAME') ?></a>
        <a href="<?=$sortUrl['EMAIL']?>" class="col"><?= Loc::getMessage('EMAIL') ?></a>
        <a href="<?=$sortUrl['PHONE']?>" class="col"><?= Loc::getMessage('PHONE') ?></a>
        <a href="<?=$sortUrl['COMPANY']?>" class="col"><?= Loc::getMessage('COMPANY') ?></a>
        <a href="<?=$sortUrl['POSITION']?>" class="col"><?= Loc::getMessage('POSITION') ?></a>
    </div>
    <?
    foreach ($arResult['ITEMS'] as $form): ?>

        <div class="row my-1 border-bottom">
            <div class="col"><?= $form['ID'] ?></div>
            <div class="col"><?= $form['LAST_NAME'] ?></div>
            <div class="col"><?= $form['NAME'] ?></div>
            <div class="col"><?= $form['SECOND_NAME'] ?></div>
            <div class="col"><?= $form['EMAIL'] ?></div>
            <div class="col"><?= $form['PHONE'] ?></div>
            <div class="col"><?= $form['COMPANY'] ?></div>
            <div class="col"><?= $form['POSITION'] ?></div>
        </div>
    <?
    endforeach; ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.pagenavigation",
        "",
        array(
            "NAV_OBJECT" => $arResult['NAV_OBJECT'],
        ),
        false
    ); ?>
<?
else: ?>
    <div class="alert alert-danger">
        <?= Loc::getMessage('DATA_NOT_FOUND') ?>
    </div>
<?
endif; ?>

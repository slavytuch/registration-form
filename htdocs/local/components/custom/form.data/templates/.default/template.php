<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<?if($arResult['FORM_DATA']):
    $formData = $arResult['FORM_DATA'];
    ?>
<div class="row my-1 border-bottom">
    <div class="col"><?=Loc::getMessage('ID')?></div>
    <div class="col"><?=$formData['ID']?></div>
</div>
<div class="row my-1 border-bottom">
    <div class="col"><?=Loc::getMessage('LAST_NAME')?></div>
    <div class="col"><?=$formData['LAST_NAME']?></div>
</div>
<div class="row my-1 border-bottom">
    <div class="col"><?=Loc::getMessage('NAME')?></div>
    <div class="col"><?=$formData['NAME']?></div>
</div>
<div class="row my-1 border-bottom">
    <div class="col"><?=Loc::getMessage('SECOND_NAME')?></div>
    <div class="col"><?=$formData['SECOND_NAME']?></div>
</div>
<div class="row my-1 border-bottom">
    <div class="col"><?=Loc::getMessage('EMAIL')?></div>
    <div class="col"><?=$formData['EMAIL']?></div>
</div>
<div class="row my-1 border-bottom">
    <div class="col"><?=Loc::getMessage('PHONE')?></div>
    <div class="col"><?=$formData['PHONE']?></div>
</div>
<div class="row my-1 border-bottom">
    <div class="col"><?=Loc::getMessage('COMPANY')?></div>
    <div class="col"><?=$formData['COMPANY']?></div>
</div>
<div class="row my-1 border-bottom">
    <div class="col"><?=Loc::getMessage('POSITION')?></div>
    <div class="col"><?=$formData['POSITION']?></div>
</div>
<?else:?>
<div class="alert alert-danger">
    <?=Loc::getMessage('DATA_NOT_FOUND')?>
</div>
<?endif;?>

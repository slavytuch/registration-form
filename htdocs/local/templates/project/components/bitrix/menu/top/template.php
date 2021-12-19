<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<?
if (!empty($arResult)): ?>

    <nav class="nav">
    <?
    foreach ($arResult as $arItem):
        ?>
        <?
        if ($arItem["SELECTED"]):?>
            <a href="<?= $arItem["LINK"] ?>" class="btn btn-primary my-2"><?= $arItem["TEXT"] ?></a>
        <?
        else:?>
            <a href="<?= $arItem["LINK"] ?>" class="btn btn-secondary my-2"><?= $arItem["TEXT"] ?></a>
        <?
        endif ?>

    <?
    endforeach ?>

    </nav>

<?
endif ?>
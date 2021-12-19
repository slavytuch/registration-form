<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->addExternalJS("https://www.google.com/recaptcha/api.js?render=" . RECAPTCHA_V3_SITE_KEY);
?>

<form method="post" action="/submitUserForm" enctype="multipart/form-data" class="js-user-form">
    <div class="form-group">
        <label for="lastName"><?= Loc::getMessage('LAST_NAME') ?></label>
        <input class="form-control" id="lastName" type="text" name="LAST_NAME" required>
    </div>
    <div class="form-group">
        <label for="name"><?= Loc::getMessage('NAME') ?></label>
        <input class="form-control" id="name" type="text" name="NAME" required>
    </div>
    <div class="form-group">
        <label for="secondName"><?= Loc::getMessage('SECOND_NAME') ?></label>
        <input class="form-control" id="secondName" type="text" name="SECOND_NAME" required>
    </div>
    <div class="form-group">
        <label for="email"><?= Loc::getMessage('EMAIL') ?></label>
        <input class="form-control" id="email" type="text" name="EMAIL" required>
    </div>
    <div class="form-group">
        <label for="phone"><?= Loc::getMessage('PHONE') ?></label>
        <input class="form-control" id="phone" type="text" name="PHONE" required>
    </div>
    <div class="form-group">
        <label for="company"><?= Loc::getMessage('COMPANY') ?></label>
        <input class="form-control" id="company" type="text" name="COMPANY" required>
    </div>
    <div class="form-group">
        <label for="position"><?= Loc::getMessage('POSITION') ?></label>
        <input class="form-control" id="position" type="text" name="POSITION" required>
    </div>
    <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">
    <button class="btn btn-success"><?=Loc::getMessage('REGISTER')?></button>
</form>

<div class="alert alert-danger js-form-submit-error" style="display: none">
</div>
<div class="alert alert-success js-form-submit-success" style="display: none">
</div>
<script>
    BX.message(<?=CUtil::PhpToJSObject(Loc::loadLanguageFile(__FILE__))?>);
    BX.recatpchaSiteKey = '<?=RECAPTCHA_V3_SITE_KEY?>'
</script>
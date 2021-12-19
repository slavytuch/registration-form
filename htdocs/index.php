<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->setTitle('Форма регистрации')?>
<?
$APPLICATION->IncludeComponent('custom:form.register', '.default');
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
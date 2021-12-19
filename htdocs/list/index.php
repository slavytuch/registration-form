<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->setTitle('Список регистраций')?>
<?
$APPLICATION->IncludeComponent('custom:form.list', '.default');
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

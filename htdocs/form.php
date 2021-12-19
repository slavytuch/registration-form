<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Информация по форме');
?>
<?
$APPLICATION->IncludeComponent('custom:form.data', '.default', ['SECRET' => $_REQUEST['SECRET']]); ?>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

<?php

use Bitrix\Main\Application;
use Project\UserFormTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class FormData extends CBitrixComponent
{

    public function executeComponent()
    {
        if(!$this->arParams['SECRET']) {
            \ShowError('Параметр SECRET не задан');
        }

        $formData = UserFormTable::getList(
            [
                'filter' => ['=SECRET' => $this->arParams['SECRET']],
                'select' => ['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'EMAIL', 'PHONE', 'COMPANY', 'POSITION']
            ]
        )->fetch();

        if(!$formData) {
            if (!defined("ERROR_404")) {
                define("ERROR_404", "Y");
            }
            \CHTTP::setStatus("404 Not Found");
            if ($GLOBALS['APPLICATION']->RestartWorkarea())
            {
                if (!defined("BX_URLREWRITE")) {
                    define("BX_URLREWRITE", true);
                }
                require(Application::getDocumentRoot()."/404.php");
                die();
            }
        }

        $this->arResult['FORM_DATA'] = $formData;

        $this->includeComponentTemplate();
    }
}
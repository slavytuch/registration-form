<?php

use Project\UserFormTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class FormList extends CBitrixComponent
{
    public function executeComponent()
    {
        $nav = new \Bitrix\Main\UI\PageNavigation("nav-form-list");
        $nav->allowAllRecords(true)
            ->setPageSize(
                $this->arParams['ITEMS_PER_PAGE'] && $this->arParams['ITEMS_PER_PAGE'] > 0 ?
                    $this->arParams['ITEMS_PER_PAGE'] : 10
            )
            ->initFromUri();

        $order = ['ID' => 'DESC'];
        if ($this->request['orderField'] && $this->request['orderDirection']) {
            $order = [$this->request['orderField'] => $this->request['orderDirection']];
        }

        $res = UserFormTable::getList(
            [
                'order' => $order,
                'select' => ['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'EMAIL', 'PHONE', 'COMPANY', 'POSITION'],
                'cache' => ['ttl' => '3600000'],
                "count_total" => true,
                "offset" => $nav->getOffset(),
                "limit" => $nav->getLimit(),
            ]
        );

        $nav->setRecordCount($res->getCount());

        while ($form = $res->fetch()) {
            $this->arResult['ITEMS'][] = $form;
        }
        $this->arResult['NAV_OBJECT'] = $nav;

        $this->arResult['SORT_URL'] = $this->getSortUrl();

        $this->IncludeComponentTemplate();
    }

    protected function getSortUrl()
    {
        global $APPLICATION;
        $result = [];
        foreach (['ID', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'EMAIL', 'PHONE', 'COMPANY', 'POSITION'] as $fieldCode) {
            $direction = 'ASC';
            if ($this->request['orderField'] == $fieldCode && $this->request['orderDirection'] == $direction) {
                $direction = 'DESC';
            }
            $result[$fieldCode] = $APPLICATION->GetCurPageParam(
                'orderField=' . $fieldCode . '&orderDirection=' . $direction,
                ['orderField', 'orderDirection']
            );
        }

        return $result;
    }
}
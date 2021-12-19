<?

if ($GLOBALS['USER']->isAdmin()) {
    $aMenuLinks = array_merge(
        $aMenuLinks,
        [
            [
                "Список форм",
                "/list/",
                [],
                [],
                ""
            ]
        ]
    );
}

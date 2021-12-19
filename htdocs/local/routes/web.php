<?php
use Bitrix\Main\Routing\RoutingConfigurator;
use Project\Controllers\UserFormController;

return function (RoutingConfigurator $routes) {
    $routes->post('/submitUserForm', function (\Bitrix\Main\HttpRequest $request){
        return (new UserFormController())->submitForm($request);
    });
};
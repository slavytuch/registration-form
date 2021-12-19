<?php

namespace Project\Controllers;

use Bitrix\Main\Context;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Routing\Controllers\PublicPageController;
use Bitrix\Main\Security\Random;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use ReCaptcha\ReCaptcha;
use Project\UserForm;
use Project\UserFormTable;

class UserFormController
{
    public function __construct()
    {
        $this->checkTable();
    }

    /**
     * Обработчик сохранения формы формы регистрации из post запроса
     * @param HttpRequest $request
     * @return string
    */
    public function submitForm(HttpRequest $request): string
    {
        $response = [
            'success' => true
        ];

        try {
            $recaptcha = new ReCaptcha(RECAPTCHA_V3_SECRET_KEY);
            $recaptchaResponse = $recaptcha->verify($request['g-recaptcha-response']);
            if (!$recaptchaResponse->isSuccess()) {
                throw new \Exception(
                    'Ошибка валидации рекаптчи:' . implode(', ', $recaptchaResponse->getErrorCodes()) . json_encode(
                        $request
                    )
                );
            }

            $newUserForm = new UserForm();
            $newUserForm->setName($request['NAME']);
            $newUserForm->setLastName($request['LAST_NAME']);
            $newUserForm->setSecondName($request['SECOND_NAME']);
            $newUserForm->setEmail($request['EMAIL']);
            $newUserForm->setPhone($request['PHONE']);
            $newUserForm->setCompany($request['COMPANY']);
            $newUserForm->setPosition($request['POSITION']);
            list($secretString, $qrCodeImagePath) = $this->generateSecret();
            $newUserForm->setSecret($secretString);
            $newUserForm->setQrCodeFilePath($qrCodeImagePath);

            $result = $newUserForm->save();
            if (!$result->isSuccess()) {
                unlink($qrCodeImagePath);
                throw new \Exception(implode(PHP_EOL, $result->getErrorMessages()));
            }

            $response['data']['ID'] = $result->getId();
            $response['data']['img'] = $qrCodeImagePath;

            \CEvent::send(
                'FORM_REGISTER',
                Context::getCurrent()->getSite(),
                [
                    'EMAIL' => $newUserForm->getEmail(),
                    'ID' => $result->getId(),
                    'QR_CODE_FILE_PATH' => $qrCodeImagePath
                ]
            );
        } catch (\Exception $ex) {
            $response['success'] = false;
            $response['message'] = $ex->getMessage();
        } finally {
            return json_encode($response);
        }
    }

    /**
     * Проверяет наличие таблицы форм в БД при обращении к контроллеру, если её нет - создаёт
     * Это определённый костыль, обычно такие вещи пишутся миграции для переноса на бой
     * @return void
    */
    protected function checkTable(): void
    {
        $connection = \Bitrix\Main\Application::getConnection();
        if (!$connection->isTableExists(UserFormTable::getTableName())) {
            UserFormTable::getEntity()->createDbTable();
        }
    }

    /**
     * Генерирует рандомную строку и создаёт изображение qr-кода для детальной страницы формы
     * @return array
    */
    protected function generateSecret(): array
    {
        $secretString = Random::getString(10);
        $baseUrl = (Context::getCurrent()->getRequest()->isHttps() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
        $url = $baseUrl . '/form/' . $secretString;
        $dirPath = '/upload/qr-code/';
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $dirPath) && !is_dir($_SERVER['DOCUMENT_ROOT'] . $dirPath)) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . $dirPath);
        }
        $imgPath = $dirPath . $secretString . '.png';
        if (file_exists($imgPath)) {
            return $this->generateSecret();
        }
        $qrCodeBuildResult = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->size(300)
            ->data($url)
            ->build();

        $qrCodeBuildResult->saveToFile( $_SERVER['DOCUMENT_ROOT'] . $imgPath);

        return [$secretString, $imgPath];
    }
}
<?php

namespace app\controllers;

use app\models\Go;
use app\models\Shortlinks;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\validators\UrlValidator;
use yii\httpclient\Client;

use yii\web\Response;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class SiteController extends Controller {
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGenerate() {
        $longurl = Yii::$app->request->post("url");
        $validator = new UrlValidator();
        if ($validator->validate($longurl)) {
            $client = new Client();
            try {
                $response = $client->createRequest()
                    ->setMethod('GET')
                    ->setUrl($longurl)
                    ->send();
                if (!$response->isOk) {
                    return $this->asJson(["error" => "Данный URL не доступен"]);
                }
            } catch (\Exception $ex) {
                return $this->asJson(["error" => $ex->getMessage() . ' ' . $ex->getLine()]);
            }
            $shortLink = Shortlinks::find()->where(['longurl' => $longurl])->one();
            if (!$shortLink) {
                $shortLink = new Shortlinks;
                $shortLink->shorturlsuffix = Yii::$app->security->generateRandomString(10);
                while (Shortlinks::find()->where(['shorturlsuffix' => $shortLink->shorturlsuffix])->one()) {
                    $shortLink->shorturlsuffix = Yii::$app->security->generateRandomString(10);
                }
                $shortLink->longurl = $longurl;
                if (!$shortLink->save()) {
                    return $this->asJson(["error" => "не удалось создать короткую ссылку"]);
                }
            }
            return $this->asJson([
                'shortlink' => Url::to(['/site/go?l=' . $shortLink->shorturlsuffix], 'http'),
                'counter' => Go::find()->where(['shorturlsuffix' => $shortLink->shorturlsuffix])->count(),
            ]);
        } else {
            return $this->asJson(["error" => "Данный URL не валиден"]);
        }
    }

    public function actionGenerateQr()
    {
        // 1. Настраиваем ответ Yii2 как 'raw' (сырые данные), так как мы отдадим изображение
        Yii::$app->response->format = Response::FORMAT_RAW;
        // 2. Устанавливаем правильный HTTP-заголовок Content-Type
        Yii::$app->response->headers->add('Content-Type', 'image/png');

        // 3. Создаем объект QR-кода с вашими данными (текст, URL и т.д.)
        $qrCode = QrCode::create(Yii::$app->request->get('l')); // Замените на ваши данные

        // 4. (Опционально) Настраиваем внешний вид
        $qrCode->setSize(300); // Размер в пикселях
        // Другие настройки: setMargin(10), setForegroundColor(...) и т.д.

        // 5. Создаем "писатель" для формата PNG
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // 6. Отправляем результат (строку с бинарными данными PNG) в браузер
        return $result->getString();
    }

    public function actionGo() {
        $suffix = Yii::$app->request->get('l');
        $shortLink = Shortlinks::find()->where(['shorturlsuffix' => $suffix])->one();
        if ($shortLink) {
            $go = new Go;
            $go->shorturlsuffix = $shortLink->shorturlsuffix;
            $go->ip = Yii::$app->request->userIP;
            $go->save();
            return '<head><meta http-equiv="refresh" content="0; url=' . $shortLink->longurl . '"></head>';
        } else {
            return 'Данный URL не валиден';
        }
    }
}

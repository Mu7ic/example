<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Client;
use app\models\ClientPhones;
use SimpleXMLElement;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * @return int
     */
    public function actionIndex()
    {
        $xml_file = Yii::getAlias('@app') . '/clients.xml';

        if (file_exists($xml_file)) {
            $xml = simplexml_load_string(file_get_contents($xml_file));
            $c = 0; //количество клиентов
            $p = 0; //количество номеров
            //Сохраняем каждый клиент
            foreach ($xml as $client) {
                $id = $client->attributes()->id;
                $clients = Client::find()->where(['hash_id' => (string)$id])->one();
                if ($clients == NULL) {
                    $clients = new Client();
                    $clients->hash_id = (string)$id;
                    $clients->created = time();
                    $c++;
                }
                $clients->name = (string)$client->name;
                $clients->membership_date = (string)$client->membership_date;
                $clients->age = $client->age;
                $clients->city = (string)$client->city;
                $clients->save();
                //сохраняем телефоны каждого клиента на отдельной таблице
                foreach ($client->numbers->number as $number) {
                    $phones = ClientPhones::find()->where(['client_id' => $clients->id, 'phone' => (string)$number])->one();
                    if ($phones == NULL) {
                        $phones = new ClientPhones();
                        $phones->created = time();
                        $p++;
                    }
                    $phones->client_id = $clients->id;
                    $phones->phone = (string)$number;
                    $phones->save();
                }
            }
            echo "Клиенты: $c, Телефоны: $p";
        }

        return ExitCode::OK;
    }
}

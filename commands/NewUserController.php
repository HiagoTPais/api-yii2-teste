<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\User;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class NewUserController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($username, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->setPassword($password);
        $user->generateAuthKey();

        \Yii::$app->db->createCommand()
            ->insert('user', [
                'username' => $user->username,
                'password' => $user->password,
                'authKey' => $user->authKey,
            ])->execute();

        $newUser = \Yii::$app->db->createCommand('SELECT * FROM user ORDER BY id DESC LIMIT 1')->queryAll();

        echo json_encode($newUser);
    }
}

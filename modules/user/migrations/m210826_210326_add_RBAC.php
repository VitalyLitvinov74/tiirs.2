<?php

use yii\db\Migration;

/**
 * Class m210826_210326_add_RBAC
 */
class m210826_210326_add_RBAC extends Migration
{
    /**
     * {@inheritdoc}
     * Необходимо проверять существования таблицы в каждом модуле.
     * Запрещено менять структуру таблиц правил, ролей, и разрешений
     */
    public function safeUp()
    {
        Yii::$app->runAction('migrate', [
            'migrationPath' => '@yii/rbac/migrations/',
            'interactive' => false
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //дописать
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210826_210326_add_RBAC cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m210904_071538_add_modules
 */
class m210904_071538_add_modules extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        \yii\helpers\VarDumper::dump('asdasd');die;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210904_071538_add_modules cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210904_071538_add_modules cannot be reverted.\n";

        return false;
    }
    */
}

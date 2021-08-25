<?php

use yii\db\Migration;

/**
 * Class m210823_113001_user_table
 */
class m210823_113001_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('vloop_users', [
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'password_hash'=>$this->string(),
            'auth_key'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('vloop_users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210823_113001_user_table cannot be reverted.\n";

        return false;
    }
    */
}

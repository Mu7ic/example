<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m210226_125154_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'hash_id' => $this->string()->notNull(),
            'age' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'membership_date' => $this->string()->notNull(),
            'created' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%client}}');
    }
}

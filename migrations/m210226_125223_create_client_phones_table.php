<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_phones}}`.
 */
class m210226_125223_create_client_phones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%client_phones}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'phone' => $this->string()->notNull(),
            'created' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%client_phones}}');
    }
}

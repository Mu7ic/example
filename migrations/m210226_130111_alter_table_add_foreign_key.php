<?php

use yii\db\Migration;

/**
 * Class m210226_130111_alter_table_add_foreign_key
 */
class m210226_130111_alter_table_add_foreign_key extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addForeignKey(
            'fk-phones-client_id',
            'client_phones',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-phones-client_id',
            'client_phones'
        );
    }

}

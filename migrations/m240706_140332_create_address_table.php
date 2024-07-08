<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%address}}`.
 */
class m240706_140332_create_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'cep' => $this->string(),
            'street' => $this->string(),
            'number' => $this->string(),
            'city' => $this->string(),
            'state' => $this->string(),
            'complement' => $this->string(),
        ]);

        $this->createIndex(
            'idx-address-customer_id',
            'address',
            'customer_id'
        );

        $this->addForeignKey(
            'fk-address-customer_id',
            'address',
            'customer_id',
            'customer',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%address}}');
    }
}

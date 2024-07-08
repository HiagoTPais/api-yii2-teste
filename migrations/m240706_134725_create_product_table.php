<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m240706_134725_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'name' => $this->string(),
            'value' => $this->decimal(8, 2),
            'photo' => $this->string(),
        ]);

        $this->createIndex(
            'idx-product-customer_id',
            'product',
            'customer_id'
        );

        $this->addForeignKey(
            'fk-customer-customer_id',
            'product',
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
        $this->dropTable('{{%product}}');
    }
}

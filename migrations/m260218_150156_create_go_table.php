<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%go}}`.
 */
class m260218_150156_create_go_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%go}}', [
            'id' => $this->primaryKey(),
            'shorturlsuffix' => $this->string(50)->notNull(),
            'ip' => $this->string(20)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%go}}');
    }
}

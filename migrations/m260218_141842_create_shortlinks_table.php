<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shortlinks}}`.
 */
class m260218_141842_create_shortlinks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shortlinks}}', [
            'id' => $this->primaryKey(),
            'shorturlsuffix' => $this->string(50)->notNull(),
            'longurl' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shortlinks}}');
    }
}

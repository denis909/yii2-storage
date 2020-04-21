<?php

namespace denis909\storage\migrations;

use yii\db\Migration;

class m150318_213934_create_storage_table extends Migration
{

    public $tableName = '{{%storage}}';

    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'component' => $this->string()->notNull(),
            'path' => $this->string(1024)->notNull(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'user_id' => $this->integer(),
            'upload_ip' => $this->string(45),
            'created_at' => $this->integer()->notNull()
        ], $tableOptions);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
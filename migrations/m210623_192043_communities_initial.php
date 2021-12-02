<?php

use yii\db\Migration;

/**
 * Class m210623_192043_communities_initial
 */
class m210623_192043_communities_initial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('communities_community', [
            'id' => $this->primaryKey(),
            'child_id' => 'varchar(45) DEFAULT NULL',
            'parent_id' => 'varchar(45) DEFAULT NULL',
        ], '');

        // creates index for column `child_id`
        $this->createIndex(
            'idx-community-child_id',
            'communities_community',
            'child_id'
        );

        // add foreign key for table `space`
        // $this->addForeignKey(
        //     'fk-community-child_id',
        //     'communities_community',
        //     'child_id',
        //     'space',
        //     'guid',
        //     'CASCADE'
        // );

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-community-parent_id',
            'communities_community',
            'parent_id'
        );

        // add foreign key for table `space`
        // $this->addForeignKey(
        //     'fk-community-parent_id',
        //     'communities_community',
        //     'parent_id',
        //     'space',
        //     'guid',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210623_191041_communities_inital cannot be reverted.\n";
        $this->dropTable('communities_community');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210623_192043_communities_initial cannot be reverted.\n";

        return false;
    }
    */
}

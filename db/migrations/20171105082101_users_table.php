<?php


use Phinx\Migration\AbstractMigration;

class UsersTable extends AbstractMigration
{

    public function up()
    {
        $users = $this->table('users');
        $users
            ->addColumn('username', 'string', ['limit' => 50])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('first_name', 'string', ['limit' => 50])
            ->addColumn('last_name', 'string', ['limit' => 50])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('birthday', 'date')
            ->addIndex(['username', 'password'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->save();
    }

    public function down()
    {
        $this->dropTable('users');
    }
}

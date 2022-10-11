<?php

use Yuga\Database\Migration\Migration;
use Yuga\Database\Migration\Schema\Table;

class CreateJobsTable extends Migration
{
	/**
	* This method contains the entire schema of the table you want to create
	* It's what the php yuga migration:up runs 
	*
	* @param null
	* 
	* @return null
	*/
	public function up()
	{
		$this->schema->create('jobs', function (Table $table) {
			$table->column('id')->bigint()->primary()->increment();
			$table->column('queue')->string(255)->nullable();
			$table->column('status')->bool()->nullable();
			$table->column('weight')->integer()->nullable();
			$table->column('attempts')->integer()->nullable();
			$table->column('available_at')->datetime()->nullable();
			$table->column('data')->text()->nullable();
			$table->column('error')->text()->nullable();
            $table->timestamps();
		});
	}

	/**
	* When php yuga migration:down is run, the method will be run
	*
	* @param null
	* 
	* @return null
	*/
	public function down()
	{
		$this->schema->dropIfExists('jobs');
	}

	/**
	 * When php yuga migration:seed is run, this method will run, 
	 * Put here what records you want to intialize the table
	 * 
	 * @param null
	 * 
	 * @return null
	 */
	public function seeder()
	{

	}
}
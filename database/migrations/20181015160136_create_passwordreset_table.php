<?php
use Yuga\Database\Migration\Migration;
use Yuga\Database\Migration\Schema\Table;

class CreatePasswordResetTable extends Migration
{
	/**
	* This method contains the entire schema of the table you want to create
	* I'ts what the php yuga migration:up runs 
	*
	* @param null
	* 
	* @return null
	*/
	public function up()
	{
		$this->schema->create('password_resets', function (Table $table) {
			$table->column('id')->bigint()->primary()->increment();
			$table->column('email')->string()->index();
            $table->column('token')->string();
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
		$this->schema->dropIfExists('password_resets');
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
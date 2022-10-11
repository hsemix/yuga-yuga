<?php
/**
 * Register here your migration classes that create the tables in the database
 */
return [
    'migrate'   => [
		CreateUsersTable::class,
		CreatePasswordResetTable::class,
		CreateJobsTable::class,
	],
    'seed'      => [
	],
];
<?php

return [
	
	/*
	 * If set to false, no activities will be saved to the database.
	 */
	'enabled'                             => env('ACTIVITY_LOGGER_ENABLED', true),

	/*
	 * If no log name is passed to the activity() helper
	 * we use this default log name.
	 */
	'prefix_log_table'                    => 'activity_log',

	/*
	 * If no log name is passed to the activity() helper
	 * we use this default log name.
	 */
	'default_queue_name'                    => 'default',
	
	/*
	 * This model will be used to log activity.
	 * It should be implements the mderakhshi\ActivityLog\Model\Activity interface
	 * and extend Illuminate\Database\Eloquent\Model.
	 */
	'activity_model'                      => mderakhshi\ActivityLog\Model\Activity::class,
	
	/*
	 * This is the name of the table that will be created by the migration and
	 * used by the Activity model shipped with this package.
	 */
	'database_name'                       => 'activity_log',
];

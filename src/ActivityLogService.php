<?php
namespace mderakhshi\ActivityLog;

use Illuminate\Support\Str;
use mderakhshi\ActivityLog\Model\Activity;

class ActivityLogService {
	
	public function __call($method, $argument)
	{
		$argument[0]      ??= null;
		$argument[0]      = !is_array($argument[0]) ? ['content' => $argument[0]] : $argument[0];
		$activityLogModel = config('activitylog.activity_model');
		$log              = new $activityLogModel;
		
		$collectionName       = $method;
		$prefixCollectionName = trim(config('activitylog.prefix_log_table', null), '_');
		if (!empty($prefixCollectionName)) {
			$collectionName = $prefixCollectionName.$collectionName;
		}
		$collectionName = Str::snake($collectionName);
		
		$log->setCollection($collectionName);
		$log->create($argument[0]);
	}
	
}



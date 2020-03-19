<?php


namespace mderakhshi\ActivityLog\Traits;


use mderakhshi\ActivityLog\ActivityLogsObserver;

trait LogsActivity {
	protected array $logAttributes = [];
	
	protected array $logAttributesToIgnore = [];
	
	protected array $logAttributesToAppend = [];
	
	protected static function bootLogsActivity()
	{
		if (config('activitylog.enabled', true) === false) {
			return;
		}
		static::observe(ActivityLogsObserver::class);
	}
	
	public function logAttributes()
	{
		if (count($this->logAttributes) === 0) {
			return false;
		}
		
		return $this->logAttributes;
	}
	
	public function logAttributesToIgnore()
	{
		if (count($this->logAttributesToIgnore) === 0) {
			return false;
		}
		
		return $this->logAttributesToIgnore;
	}
	
	public function logAttributesToAppend()
	{
		if (count($this->logAttributesToAppend) === 0) {
			return false;
		}
		
		return $this->logAttributesToAppend;
	}
}

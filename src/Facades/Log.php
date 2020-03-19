<?php namespace mderakhshi\Curl\Facades;


use Illuminate\Support\Facades\Facade;


class Log extends Facade {
	
	protected static function getFacadeAccessor()
	{
		return 'ActivityLog';
	}
	
}

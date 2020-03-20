<?php namespace mderakhshi\Curl;


use Illuminate\Support\ServiceProvider;
use mderakhshi\ActivityLog;

class ActivityLogServiceProvider extends ServiceProvider {

    /**
     * @var bool
     */
    protected $defer = true;


    /**
     * @return void
     */
    public function register()
    {
	    $this->app->bind('ActivityLog', function()
	    {
		    return new ActivityLogService();
	    });
    }
    

}

<?php namespace mderakhshi\ActivityLog;


use Illuminate\Support\ServiceProvider;

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

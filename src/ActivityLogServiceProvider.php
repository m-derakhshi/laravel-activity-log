<?php namespace mderakhshi\ActivityLog;


use Illuminate\Support\ServiceProvider;

class ActivityLogServiceProvider extends ServiceProvider {

    /**
     * @var bool
     */
    protected $defer = true;
	
	public function boot()
	{
		$this->publishes([
			                 __DIR__.'/../config/activitylog.php' => config_path('activitylog.php'),
		                 ], 'config');
		
	}

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

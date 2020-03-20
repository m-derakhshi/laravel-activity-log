<?php


namespace mderakhshi\ActivityLog\Model;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
	public    $timestamps = false;
	protected $connection = 'mongodb';
	protected $collection = 'logs';
	protected $guarded    = [];
	
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	
	/**
	 * @param  array  $attributes
	 * @param  bool   $exists
	 *
	 * @return Eloquent
	 */
	public function newInstance($attributes = [], $exists = false) {
		$model = parent::newInstance($attributes, $exists);
		$model->setCollection($this->collection);
		
		return $model;
	}
	
	/**
	 * set collection in mongodb to save log
	 *
	 * @param $collection
	 */
	public function setCollection(String $collection) {
		$this->collection = $collection;
	}
	
}

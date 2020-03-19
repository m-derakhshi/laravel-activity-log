<?php


namespace mderakhshi\ActivityLog;


class ActivityLogsObserver {
	
	private $model;
	
	private array $attributes;
	
	public function created($model)
	{
		$attributes = $model->toArray();
		unset($attributes['updated_at']);
		$this->setConstruct($model, $attributes);
	}
	
	public function updated($model)
	{
		$attributes = [];
		foreach ($model->toArray() as $key => $value) {
			if ($model->isDirty($key) or in_array($key, ['updated_at'])) {
				$attributes[$key] = $value;
			}
		}
		$this->setConstruct($model, $attributes);
	}
	
	public function deleted($model)
	{
		$attributes = ['deleted_at' => $model->deleted_at->toDateTimeString()];
		$this->setConstruct($model, $attributes);
	}
	
	
	private function setConstruct($model, array $attributes)
	{
		$this->model      = $model;
		$this->attributes = $attributes;
		
		if ($this->filter()) {
			$this->append();
			$this->dispatch();
		}
	}
	
	private function filter(): bool
	{
		$modelAttributesStore = $this->model->logAttributes();
		if ($modelAttributesStore) {
			$this->attributes = array_filter($this->attributes, fn($item, $key) => in_array($key, $modelAttributesStore), true);
		}
		
		$modelAttributesToIgnore = $this->model->logAttributesToIgnore();
		if ($modelAttributesToIgnore) {
			$this->attributes = array_filter($this->attributes, fn($item, $key) => !in_array($key, $modelAttributesToIgnore), true);
		}
		
		return count($this->attributes) > 0 ? true : false;
	}
	
	private function append()
	{
		$modelAttributesToAppend = $this->model->logAttributesToAppend();
		if ($modelAttributesToAppend) {
			$newAttribute = [];
			foreach ($modelAttributesToAppend as $attribute) {
				if (preg_match('|\.|i', $attribute)) {
					$newAttribute[$attribute] = $this->appendProperty($attribute);
					continue;
				}
				$newAttribute[$attribute] = isset($this->model->$attribute) ? $this->model->$attribute : null;
			}
			$this->attributes = array_merge($this->attributes, $newAttribute);
		}
	}
	
	
	private function appendProperty(string $attribute)
	{
		$outputValue = $this->model;
		$objectDepth = explode('.', trim('.', $attribute));
		foreach ($objectDepth as $property) {
			if (empty($property) or !isset($outputValue->$property)) {
				$outputValue = 'error append attribute.';
				break;
			}
			$outputValue = $outputValue->$property;
		}
		
		return $outputValue;
	}
	
	
	public function dispatch()
	{
		$queueName = config('activitylog.default_queue_name', 'default');
		dispatch((new ActivityLogJob($this->model->getTable(), $this->attributes))->onQueue($queueName));
	}
	
}

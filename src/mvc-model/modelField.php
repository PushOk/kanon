<?php
require_once dirname(__FILE__).'/modelExpression.php';
require_once dirname(__FILE__).'/modelAggregation.php';
class modelField{
	/**
	 * @var modelCollection
	 */
	//protected $_collection = null; // FIXME remove collection
	protected $_fieldString = null;
	protected $_fieldName = null;
	protected $_uniqueId = null;
	public function getUniqueId(){
		//if ($this->_uniqueId === null){
			//$this->_uniqueId = kanon::getUniqueId('modelField:'.$this->_collection->getUniqueId().'.'.$this->_fieldName);
		//}
		return $this->_uniqueId;
	}
	/*public function getUniqueId(){
		return $this->_collection->getUniqueId().'__'.$this->_fieldName;
		}*/
	public function __construct($collection, $fieldName){
		//$this->_collection = $collection;
		$this->_fieldString = $collection->getUniqueId().'.`'.$fieldName.'`';
		$this->_uniqueId = kanon::getUniqueId('modelField:'.$collection->getUniqueId().'.'.$fieldName);
		$this->_fieldName = $fieldName;
	}
	public function getName(){
		return $this->_fieldName;
	}
	/**
	 * @return modelCollection
	 */
	/*public function getCollection(){
		return $this->_collection;
	}*/
	public function __toString(){
		return $this->_fieldString;
	}
	/**
	 * = $value
	 * @param $value
	 */
	public function is($value){
		return new modelExpression($this, '=', $value);
	}
	/**
	 * != $value
	 * @param $value
	 */
	public function not($value){
		return new modelExpression($this, '<>', $value);
	}
	public function min(){
		return new modelAggregation($this, 'MIN');
	}
	public function max(){
		return new modelAggregation($this, 'MAX');
	}
	public function sum(){
		return new modelAggregation($this, 'SUM');
	}
	public function avg(){
		return new modelAggregation($this, 'AVG');
	}
	/**
	 * < $value
	 * @param $value
	 */
	public function lt($value){
		return new modelExpression($this, '<', $value);
	}
	/**
	 * <= $value
	 * @param $value
	 */
	public function lte($value){
		return new modelExpression($this, '<=', $value);
	}
	/**
	 * > $value
	 * @param $value
	 */
	public function gt($value){
		return new modelExpression($this, '>', $value);
	}
	/**
	 * >= $value
	 * @param $value
	 */
	public function gte($value){
		return new modelExpression($this, '>=', $value);
	}
	public function in($value){
		return new modelExpression($this, 'IN', $value);
	}
	public function notIn($value){
		return new modelExpression($this, 'NOT IN', $value);
	}
	public function like($value){
		return new modelExpression($this, 'LIKE', $value);
	}
	public function notLike($value){
		return new modelExpression($this, 'NOT LIKE', $value);
	}
}
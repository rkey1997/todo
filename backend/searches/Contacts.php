<?php

namespace app\searches;


use Yii;
use yii\base\InvalidConfigException;

class Contacts extends \yii\base\Model {

	public $login;
	public $email;
	public $password;
	public $id_user;

	public $page;
	public $pageSize;
	public $pagesTotal;

	protected $query;

	public function rules() {
		return [
    		[['login', 'email', 'password'], 'safe'],
    		[['page', 'pageSize', 'pagesTotal'], 'integer']
		];
	}

	public function setQuery($query) {
        $this->query = $query;
	}

	public function search() {
        if (!$this->query instanceof \yii\db\QueryInterface) {
               throw new InvalidConfigException('The "query" property must be an instance of a class that implements the QueryInterface e.g. yii\db\Query or its subclasses.'.$this->query::className());
        }
        if(!$this->load(Yii::$app->request->queryParams, '') || !$this->validate()) {
		    return [
		    	'item' => [], 
		    	'pagination' => [
		    		'page' => null,
		    		'pageSize' => null,
		    		'pagesTotal' => null, 
		    	]
		    ];
		}
		
	    $this->query->andFilterWhere(['like', 'login', $this->login]);
	    $this->query->andFilterWhere(['like', 'password', $this->password]);
        $countQuery = clone $this->query;
        $count = (int) $this->query->count();
        $page = $this->page ? (int)$this->page : 1;
        $pageSize = $this->pageSize ? (int)$this->pageSize : 10; 
        $this->query->limit($pageSize)->offset(($page - 1) * $pageSize);
	    return [
	    	'item' => $this->query->all(), 
	    	'pagination' => [
	    		'page' => $page,
	    		'pageSize' => $pageSize,
	    		'pagesTotal' => ceil($count/$pageSize), 
	    	]
	    ];
	}

}

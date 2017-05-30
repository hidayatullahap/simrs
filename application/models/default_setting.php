<?php
class default_setting extends CI_Model{
	private $page = 1;
	private $limitItemPage = 10;
	private $sort = "DESC";

    public function pagination($type){
        switch ($type) {
    case 'PAGE':
        return $this->page; break;
    case 'LIMIT':
    	return $this->limitItemPage; break;
    case 'SORT':
    	return $this->sort; break;
    default:
        return null; break;
		}
	}
}
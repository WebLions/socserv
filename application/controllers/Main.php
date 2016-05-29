<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->model('categories_model');
		$this->load->model('filters_model');
		$this->load->model('service_model');
		$this->data['categories'] = $this->categories_model->getCategories();
		$this->data['filters'] = $this->filters_model->getFilters();

		$services = $this->service_model->getServices();
		for($i=0;$i<count($services);$i++){
			$services[$i]['coordinates'] = json_decode($services[$i]['coordinates']);
		};
		$this->data['services'] = $services;

		foreach ($this->data['categories'] as $key=>$value) {
			$params['category_ids'] = $value['id'];
			$this->data['categories'][$key]['values'] = $this->filters_model->getFilters($params);
		}

		$this->load->view('map/home', $this->data);
	}
}

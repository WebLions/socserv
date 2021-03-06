<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->model('categories_model');
		$this->load->model('filters_model');
		$this->load->model('service_model');
		$this->load->model('main_model');
		$this->data['categories'] = $this->categories_model->getCategories();
		foreach ($this->data['categories'] as $key=>$value) {
			$params['category_ids'] = $value['id'];
			$this->data['categories'][$key]['values'] = $this->filters_model->getFilters($params);
		}
		$services = $this->service_model->getServices();
		for($i=0;$i<count($services);$i++){
			$services[$i]['coordinates'] = json_decode($services[$i]['coordinates']);
		};
		$this->data['services'] = json_encode($services);

		$this->data['relation'] = $this->main_model->getRelations();

		foreach ($this->data['relation'] as $key=>$value) {
			$id = $value['id_filter'];
			$result[$id][] = $value['id_services'];
		}
		$this->data['relation'] = json_encode($result);

		$this->load->view('header');
		$this->load->view('map/home', $this->data);
		$this->load->view('footer');
	}

}

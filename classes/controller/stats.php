<?php

defined('SYSPATH') or die('No direct access allowed.');

class Controller_Stats extends Controller_System_Backend {

    public function before() {

        parent::before();

        Assets::package(array('jquery-ui'));
        
        $this->breadcrumbs
                ->add(__('Activity'), URL::backend('stats'));
    }

    public function action_index() {


        $this->breadcrumbs
                ->add(__('Activity_graphs'), URL::backend('stats'));

        $data = array();

        $data['browsers'] = Model::factory('Stats_Reports')->browsers();
        $data['hourses'] = Model::factory('Stats_Reports')->hourses();

        $this->template->content = View::factory('stats/index', $data);
    }

    public function action_reports() {

        $this->breadcrumbs
                ->add(__('Creating_reports'), URL::backend('reports'));

        $data = array();

         if (HTTP_Request::POST == $this->request->method()){
            $post = $this->request->post();
            $data['post'] = $post;
         }
         
         
                
        $data['hourses'] = Model::factory('Stats_Reports')->hourses($post);

        $this->template->content = View::factory('stats/reports', $data);
    }

}

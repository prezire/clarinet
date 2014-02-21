<?php
  function showView($view, $data = null, $viewAsData = false)
  {
    $CI = &get_instance();
    $CI->load->view('commons/layouts/header');
    $CI->load->view($view, $data, $viewAsData);
    $CI->load->view('commons/layouts/footer');
  }
  function showJsonView($data)
  {
    $CI = &get_instance();
    $CI->output
    ->set_content_type('application/json')
    ->set_output(json_encode($data, false));
  }
?>
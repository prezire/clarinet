<?php
  function getVerticals()
  {
    $CI = &get_instance();
    return $CI->db->get('verticals');
  }
  function validateSession()
  {
    $CI = get_instance();
    if(!$CI->session->userdata('user')->id)
      redirect(site_url('user/login'));
  }
?>
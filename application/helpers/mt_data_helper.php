<?php
  function getVerticals()
  {
    $CI = get_instance();
    $a = array();
    $r = $CI->db->get('verticals')->result();
    foreach($r as $id => $v)
    {
      $s = $v->id . '';
      $a[$s] = $v->name;
    }
    return $a;
  }
  function validateSession()
  {
    $CI = get_instance();
    if(!$CI->session->userdata('user')->id)
      redirect(site_url('user/login'));
  }
  function isSuperAdmin()
  {
    $CI = &get_instance();
    return $CI->session->userdata('user')->role_id == 1;
  }
?>
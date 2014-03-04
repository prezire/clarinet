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
  function userIs($roleName)
  {
    $CI = get_instance();
    $uId = $CI->session->userdata('user')->role_id;
    $roleId = $CI->db->get_where
    (
      'roles', 
      array('name' => $roleName)
    )->row()->id;
    return $roleId == $uId;
  }
?>
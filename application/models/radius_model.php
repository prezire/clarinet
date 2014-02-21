<?php
  class Radius_Model extends CI_Model
  {
    public function __construct()
    {
      parent::__construct();
    }
    public final function listing()
    {
      $this->db->select('r.id, r.name, r.description, r.longitude, r.latitude');
      $this->db->from('radius r');
      return $this->db->get();
    }
    public final function createAdmin($id, $userId)
    {
      $this->db->insert
      (
        'radius_admins', 
        array('radius_id' => $id, 'user_id' => $userId)
      );
      return $this->db->insert_id();
    }
    public final function create()
    {
      $i = $this->input;
      $sVerts = implode(',', $i->post('verticals'));
      $lng = $i->post('longitude');
      $lat = $i->post('latitude');
      $cosRadLat = cos(deg2rad($lat));
      $radLng = deg2rad($lng);
      $sinRadLat = sin(deg2rad($lat));
      $a = array
      (
        'longitude' => $lng,
        'latitude' => $lat,
        'name' => $i->post('organizationName'),
        'verticals' => $sVerts,
        'description' => $i->post('description'),
        'address' => $i->post('address'),
        'website' => prep_url($i->post('website')),
        'phone' => $i->post('phone'),
        'company_email' => $i->post('companyEmail'),
        'cosine_radians_latitude' => $cosRadLat, 
        'radians_longitude' => $radLng,
        'sine_radians_latitude' => $sinRadLat
      );
      $this->db->insert('radius', $a);
      return $this->db->insert_id();
    }
    public final function read($id)
    {
      return $this->db->get_where('radius', array('id' => $id));
    }
    public final function update()
    {
      $i = $this->input;
      $sVerts = implode(',', $i->post('verticals'));
      $lng = $i->post('longitude');
      $lat = $i->post('latitude');
      $cosRadLat = cos(deg2rad($lat));
      $radLng = deg2rad($lng);
      $sinRadLat = sin(deg2rad($lat));
      $a = array
      (
        'name' => $i->post('name'),
        'verticals' => $sVerts,
        'description' => $i->post('description'),
        'address' => $i->post('address'),
        'website' => prep_url($i->post('website')),
        'phone' => $i->post('phone'),
        'company_email' => $i->post('companyEmail'),
        'longitude' => $i->post('longitude'),
        'latitude' => $i->post('latitude'),
        'cosine_radians_latitude' => $cosRadLat, 
        'radians_longitude' => $radLng,
        'sine_radians_latitude' => $sinRadLat
      );
      $this->db->where('id', $i->post('id'));
      $this->db->update('radius', $a);
      return $i->post('id');
    }
    public final function delete($id)
    {
      return $this->db->delete('radius', array('id' => $id));
    }
    public final function getVerticals()
    {
      return $this->db->get('verticals');
    }
	public final function search($keywords)
	{
		$s = "SELECT name, verticals, description, " . 
        "address, website FROM radius " . 
				"WHERE MATCH(name, verticals, " . 
				"description, address, website) " . 
				"AGAINST('$keywords')";
		return $this->db->query(urldecode($s));
	}
    public final function getAllWithinRadius
    (
      $longitude, 
      $latitude, 
      $distance, 
      $keywords
    )
    {
      /*
		Haversine. KM = 6371, MI = 3959.
		Google's version: 
        SELECT id, (6371 * acos(cos(radians(37)) * cos(radians(lat)) * cos(radians(lng) - radians(-122)) + sin(radians(37)) * sin( radians(lat)))) AS distance FROM markers HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;
      //
      $this->db->query("SET @earthKmRadius = 6371;");
      $this->db->query("SET @longitude = $longitude;");
      $this->db->query("SET @latitude = $latitude;");
      $this->db->query("SET @radLon = RADIANS(@longitude);");
      $this->db->query("SET @radLat = RADIANS(@latitude);");
      $this->db->query("SET @sinLat = SIN(@radLat);");
      $this->db->query("SET @cosLat = COS(@radLat);");
      $s = "SELECT *, " . 
      "(@earthKmRadius * ACOS(@cosLat * cosine_radians_latitude * COS(radians_longitude - @radLon) + @sinLat * sine_radians_latitude)) AS distance FROM radius " . 
      "HAVING distance < $distance " . 
      "ORDER BY distance LIMIT 0, 20";*/
      $s = "SELECT id, name, description, address, website, longitude, latitude, (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) AS distance FROM radius WHERE name LIKE '%$keywords%' OR description LIKE '%$keywords%' OR address LIKE '%$keywords%' OR website LIKE '%$keywords%' GROUP BY name HAVING distance < $distance ORDER BY distance LIMIT 0, 20";
      return $this->db->query($s);
    }
  }
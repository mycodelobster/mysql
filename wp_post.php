$this->db->select('wp_posts.ID');
		$this->db->select('wp_posts.post_title');
		$this->db->select("GROUP_CONCAT(CASE WHEN wp_term_taxonomy.taxonomy='category' then  wp_terms.`name` end order by  wp_terms.`name` ) as category");
		$this->db->from('wp_posts');
		$this->db->join('wp_term_relationships','wp_term_relationships.object_id=wp_posts.ID');
		$this->db->join('wp_term_taxonomy','wp_term_taxonomy.term_taxonomy_id=wp_term_relationships.term_taxonomy_id ');
		$this->db->join('wp_terms','wp_terms.term_id=wp_term_taxonomy.term_id');
		$this->db->where('wp_posts.post_author',1);
		$this->db->where('wp_posts.post_status','publish');
		$this->db->where('wp_posts.post_type','post');
		$this->db->group_by('wp_posts.ID');
		$data['post_listing'] = $this->db->get()->result();

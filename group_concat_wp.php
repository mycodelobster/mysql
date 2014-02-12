SELECT
wp_posts.post_title,
GROUP_CONCAT(CASE WHEN wp_term_taxonomy.taxonomy='category' then  wp_terms.`name` end order by  wp_terms.`name` ) as category,
GROUP_CONCAT(CASE WHEN wp_term_taxonomy.taxonomy='post_tag' then  wp_terms.`name` end order by  wp_terms.`name` ) as tag
FROM
wp_posts
INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
INNER JOIN wp_term_taxonomy ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
INNER JOIN wp_terms ON wp_term_taxonomy.term_id = wp_terms.term_id
WHERE
wp_posts.post_author = 1 AND
wp_posts.post_status = 'publish' AND
wp_posts.post_type = 'post'
GROUP BY
wp_posts.ID

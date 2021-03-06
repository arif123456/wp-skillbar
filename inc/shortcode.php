<?php

if( !defined( 'ABSPATH' ) ) exit;


/** 
 * 
 * shortcode
 * 
*/

function wpskillbar_shortcode($id){

   ob_start();
   
   if(isset($id['id'])){
      $WPSKILLBAR = $id['id'];
   }
    
   global $post;
   $args = array(
      'orderby' => 'date',
      'order' => 'DESC',
      'post_type' =>  'skillbar',
      'page_id'     => $WPSKILLBAR
  );


   $query = new WP_Query($args);

   ?>
      <?php if ($query->have_posts()) : ?>
         <?php while($query->have_posts()): $query->the_post(); ?>
            <?php 

               $repeatField =   get_post_meta($post->ID, 'wpskillbar_save_meta_value', true);
               
               if($repeatField != ''){
                    foreach ($repeatField as $value) {

                        ?>

                        <div class="skill-block">
                            <h4><?php echo $value['skill_title']; ?></h4>
                            <div class="skill-item">
                                <div class="skill-percentage" aria-valuenow="<?php echo $value['skill_value']; ?>"><span><?php echo $value['skill_value']; ?></span></div>
                            </div>
                        </div>

                        <?php
                        
                    }
               }else{
                   echo 'Not Found';
               }
               
            
            ?>

         <?php endwhile; ?>
      <?php endif; ?>
      
   <?php
   
   require_once 'style.php';

   return ob_get_clean();
   
}

add_shortcode('WPSKILLBAR','wpskillbar_shortcode');




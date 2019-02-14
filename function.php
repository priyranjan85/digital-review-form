<?php 



$upload_dir = wp_upload_dir(); 
$url= get_option('digital_thankyou');



if(isset($_POST['done']))
{
  $path=$upload_dir['path'];
  if($_FILES["file1"]["error"]==0)
  {
    $tmp_name = $_FILES["file1"]["tmp_name"];
    $name= $_FILES["file1"]['name'];
    $temp = explode(".", $_FILES["file1"]["name"]);
    $newfilename = $temp['0'].'_'.rand(000000,999999).'.' .$temp['1'];
    #var_dump($newfilename);die();
    $urls=$upload_dir['url'].'/'.$newfilename;
    $check=move_uploaded_file($tmp_name,$path.'/'.$newfilename);
    #var_dump($check);
  }else{
  	$urls=$upload_dir['url'].'/default-avatar.jpg';
  }
             $id = wp_insert_post(
              array('post_title'=>$_POST['fname'],
	          'post_status' => 'draft',    
	          'post_type'=>'review_form', 
	          'post_content'=> $_POST['feedback']
    		  ));

       add_post_meta( $id, 'email_id', $_POST['emailid'] );
       add_post_meta( $id, 'telphone_no', $_POST['phone_no']);
       add_post_meta( $id, 'delivery_address', $_POST['address'] );
       add_post_meta( $id, 'rating',$_POST['star'] );
       add_post_meta( $id, 'feedback',$_POST['feedback']);
       add_post_meta( $id, 'image',$urls);
     
     
            $subject = 'Review From';
            $body = 'The email body content';
            $headers = array('Content-Type: text/html; charset=UTF-8');
	          $to =get_option('digital_emailid');;
        
                
                $publish=get_home_url()."?publish=".$id;
                $msg.="<p>Hi Admin <br/>Please Find My Feedback</p>";
                $msg.='<p>'.$_POST['feedback'].'</p>';
                $msg.='<a href="'.$publish.'" style="background: #000;padding: 8px 14px;color: #fff;display: inline-block;border-radius: 12px;">Publish</a>';
            wp_mail( $to, $subject, $msg, $headers );

        
				     
				    
				    
         
      //  wp_mail( $to, $subject, $body, $headers );
        
          echo "<script>window.location='{$url}';</script>";
}


?>
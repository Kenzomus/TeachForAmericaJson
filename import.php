<?php
class importjson {

  
public function send_request($url) {
    // make request to get the data
    $headers = array('Content-Type' => 'application/json');
    $options = array($headers,);
  $request = drupal_http_request($url,$options );
    //dpm($request->data);
   
     if (($request->code!=200)) { 
        drupal_set_message(t("URL request " .$url. " returned unexpected status code" .$request->code. "," . "error" ));
         return FALSE;
     } 
     // else uses drupal_json_decode to turn into array
   
     $json_responses = json_decode($request->data,true);
   
     //dpm($json_responses);
    
 
   
    return $json_responses;
}  
  public function create_node($json_responses) {
    if (is_array($json_responses)) {
        foreach ($json_responses as $json_response ) {
   // get and the set the values
              $node = new stdClass();
            //creating a bare node
   
              $node->type = 'post';
            //giving it type
             $node->language = LANGUAGE_NONE;
             $node->status = 1;
            //give it a published staus
   
              $node->title = $json_responses['title'];
             //gives title
   
             $node->body = $json_responses['body'];
             //gives body
   
              node_save($node);
   
   }
  }
}
}
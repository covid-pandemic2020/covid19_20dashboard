
<?php
//index.php

$error = '';
$name = '';
$message = '';
$a=array();
function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}


$output = '';
$row = 1;
$handle = fopen("employee.csv", "r");
     if ($handle!== FALSE) {

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);

	if($data[1]=="0"){
	for ($c=0; $c < $num; $c++) {
        
            if(empty($data[$c])) {
               $value = "&nbsp;";
	}}
			$output .= '
  <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$data[2].'</b> on <i>'.$data[4].'</i></div>
  <div class="panel-body">'.$data[3].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$data[0].'">Reply</button></div>
 </div>
 ';
	  $output1 = get_reply_comment($handle,$data[0],0);
	  if($output1!='')
		  $output .=$output1;
	  array_push($a,$output);
	
      }
	  $output= '';
	  $row++;
     }
	  
	
     }
	 
	 
	 function get_reply_comment($handle, $parent_id, $marginleft)
	 {
		$output = '';
		$rowfunc = 1;
		$marginleft = $marginleft + 48;
		
		$handle = fopen("employee.csv", "r");
        if ($handle!== FALSE) {
       
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
       
	  if($data[1]==$parent_id){
	    
	  for ($c=0; $c < $num; $c++) {
        
            if(empty($data[$c])) {
               $value = "&nbsp;";
	}}
			$output .= '
  <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
  <div class="panel-heading">By <b>'.$data[2].'</b> on <i>'.$data[4].'</i></div>
  <div class="panel-body">'.$data[3].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$data[0].'">Reply</button></div>
 </div>
 ';
	  $output .= get_reply_comment($handle,$data[0], $marginleft);
			
      }
	 
	  $rowfunc++;
     }
	  
     }
      	 
	  fclose($handle);
      return $output;
	 }
	 
    fclose($handle);
	foreach(array_reverse($a) as $value){
    echo $value;
   }
	//echo $output;	

?>

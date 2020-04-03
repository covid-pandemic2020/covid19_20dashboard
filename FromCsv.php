<?php

//add_comment.php
$error = '';
$comment_name = '';
$comment_content = '';
//echo '<script>alert("Welcome to Geeks for Geeks")</script>';
if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

 if($error == '')
 {
  $file_open = fopen("employee.csv", "a");
  $no_rows = count(file("employee.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'Comment_id'  => $no_rows,
   'Parent_id' => $_POST["comment_id"],
   'Comment_name'  => $comment_name,
   'Comment_Content' => $comment_content,
   'Comment_Date' => date("d/m/Y h:i:sa")
  );
  fputcsv($file_open, $form_data);
  $comment_name = '';
  $comment_content = '';
  $error = '<label class="text-success">Thank you for valuable comments</label>';
  
 }

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
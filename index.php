<?php

require('./db.php');


$res = (object)[
  "success" => false,
  "message" => ''
];
$db = DB::getData();
$users = empty($db) ? [] : json_decode($db, true);


$task = !empty($_GET['task']) ? $_GET['task'] : 'restricted';


// Add User
if( $task == 'addUser' ) {
  $newUser = !empty($_GET['newUser']) ? json_decode( $_GET['newUser'], true ) : [];

  if(!empty($newUser)) {
    $users[] = $newUser;
    DB::saveData($users);

    $res->success = true;
    $res->message = "User added successfully!";
    $res->users = $users;
  }

  else {
    $res->message = "Error! No user data.";
  }
  
}


// Get Users
else if ( $task == 'getUsers' ) {
  $res->success = true;
  $res->users = $users;
}


// Delete User
else if ( $task == 'deleteUser' ) {
  $index = isset($_GET['index']) ? (int)$_GET['index'] : -1;

  if( $index > -1 ) { // to capture index 0
    
    array_splice( $users, $index, 1 );
    DB::saveData($users);

    $res->success = true;
    $res->users = $users;
    
  }

}


// Restricted
else {
  $res->message = "Restricted area.";
}





// Return Response
echo json_encode($res);
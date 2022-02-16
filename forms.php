<!DOCTYPE html>
<html>
<head>
<title>USER REGISTRATION</title>
<link rel ="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div>
  <form action="insert.php" method="post">
   <div class="container">
       <div class="row">
       <div class="col-sm-3">    
      <h1> REGISTRATION</h1>
      <hr class="mb-3">
      <label for="firstname"><b>Name<b></label>
      <input class="form-control" type ="text" name="firstname" required> 
      
      <label for="email"><b>Email<b></label>
      <input class="form-control" type ="email" name="email" required>
      
      <label for="password"><b>Password<b></label>
      <input class="form-control" type ="password" name="password" required>
<br>
 
     <label for="user_type">Choose a user:</label>
     <select id="user_type" name="user_type">
    <option value="student">student</option>
    <option value="admin">admin</option>
  </select>
  <br>
    <p>select user_status:</p>
    <input type="radio" id="active" name="user_status" value="0">
<label for="active">active</label>
  <input type="radio" id="inactive" name="user_status" value="1">
<label for="inactive">inactive</label>
<br>
<hr class="mb-3">
<input class="btn btn-success" type="submit" name="create" value="submit">
</div>
</div>

</div>
</form>
</div>

</body>
</html>










<?php  

$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "company";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `company` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $id = $_POST["idEdit"];
    $company_name = $_POST["company_nameEdit"];
    $address = $_POST["addressEdit"];

  // Sql query to be executed
  $sql = "UPDATE `company` SET `id` = '$id' , `company_name` = '$company_name', `address` = '$address' WHERE `company`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $id= $_POST["id"];
    $company_name = $_POST["company_name"];
    $address = $_POST["address"];

  // Sql query to be executed
  $sql = "INSERT INTO `company` (`id`, `company_name`, `address`) VALUES ('$id', '$company_name', '$address')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


  <title>Company</title>

</head>

<body>
 
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit the information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/abc/company1.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">ID</label>
              <input type="text" class="form-control" id="idEdit" name="idEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Company Name</label>
              <input type="text" class="form-control" id="company_nameEdit" name="company_nameEdit" aria-describedby="emailHelp">
            </div> 

            <div class="form-group">
              <label for="desc">Address</label>
              <input type="text" class="form-control" id="addressEdit" name="addressEdit" aria-describedby="emailHelp">
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="/crud/logo.svg" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link active" href="http://localhost/abc/company1.php">Company<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/abc/employee1.php">Employee</a>
        </li>
      </ul>
      
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
 
 <style>
  .container{
    text-align: center;
  }
  form{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
  input{
      border: 2px solid black;
      border-radius: 6px;
      outline: none;
      width: 50%;
      margin: 11px;
      font-size: 16px;
      padding: 7px; 
  }
  .btn{
        color:white;
        background: purple;
        padding: 8px 12px;
        font-size: 20px;
        border: 2px solid white;
        border-radius: 14px;
        cursor: pointer;
    }
</style>

 <div class="container my-4">
    <h2>Welcome to our company</h2>
    <form action="/abc/company1.php" method="post">
            <input type="text" name="id" id="id" placeholder="Enter your ID">
            <input type="text" name="company_name" id="company_name" placeholder="Enter your company name">
            <input type="text" name="address" id="address" placeholder="Enter the address">
            <button class="btn">Submit</button>
        </form>
  </div>

  <div class="container my-4">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">ID</th>
          <th scope="col">Company Name</th>
          <th scope="col">Address</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `company`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['id'] . "</td>
            <td>". $row['company_name'] . "</td>
            <td>". $row['address'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
          </tr>";
        } 
          ?>
      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        id = tr.getElementsByTagName("td")[0].innerText;
        company_name = tr.getElementsByTagName("td")[1].innerText;
        address = tr.getElementsByTagName("td")[2].innerText;
        console.log(id, company_name, address);
        idEdit.value = id;
        company_nameEdit.value = company_name;
        addressEdit.value = address;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/abc/company1.php?delete=${sno}`;
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>
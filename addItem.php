<?php
session_start();
if(!(isset($_SESSION['name'])))
header('Location:index.php');
include './connection/connection.php';
?>
<html>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styleOld.css">
  <title>Add Items</title>
</head>
<style type="text/css">

  .schselect select{
            border: 2px solid #0069D9;
            color: #0069D9 ;
        }
        .schselect select:focus{
            border: 2px solid #0069D9;
            color: #0069D9;
        }
        .schselect select option{
            background: #fff;
            color: #0069D9;
        }
  .concont{
    display: grid;
    height: 100vh;
    width: 100vw;
    grid-template-rows: auto 1fr;
  }
  .conbar{
    display: grid;
    grid-template-columns: repeat(5,auto);
    justify-content:  center;
  }
  .concontent-item-enter{
    display: grid;
    grid-template-columns:1fr minmax(auto,auto) 1fr;
    grid-template-rows: 1fr minmax(auto,auto) 1fr;  
  }
  .concontent-item-enter-data{
    display: grid;
    grid-template-rows: repeat(5, auto);
    grid-column: 2/3;
    grid-row: 2/3;
  }
  .consubb{
    height: 38px;
  }
  .header-wrapper{overflow: hidden; text-align: center; background: #fff; padding-top: 5px; padding-bottom: 0px;}
.site-name{display: inline-block;}
.site-name h1{margin: 0; font-size: 34px; /*color: #34b091; font-family: 'source_sans_probold'; text-transform: uppercase;*/ letter-spacing: 2px;  color: #6a7d78;}

  </style>
<body>
<div class="header-wrapper">
      <div class="site-name">
        <table><tr><td><a href="index.html"><img src="150dpi.png" height=80px></a></td><td><h1>Indian Institute of Information Technology Bhagalpur</h1></td></tr></table>
      </div>
 
    </div

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand head" href="stockReceive.php?inventory=all">Computer Centre Inventory Management System (CCIMS)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Stock Entry
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="stockReceive.php?inventory=all">Stock Purchase</a>
            <a class="dropdown-item" href="stockIssue.php?inventory=all">Stock Issue</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle  bg-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Add New
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="addDepartment.php">Department</a>
            <a class="dropdown-item bg-primary" href="addItem.php">Item</a>
            <a class="dropdown-item" href="addScheme.php">Scheme</a>
            <a class="dropdown-item " href="addVendor.php">Supplier</a>
          </div>
        </li>
        <a class="nav-item nav-link" href="viewReceived.php">View</a>
        <a class="nav-item nav-link" href="help.html">Help</a>
        <a class="nav-item nav-link" href="destroy.php">LogOut</a>
      </div>
    </div>
  </nav>
  <!-- navbar ends -->

  <br>
  <br>
  <br>
  <div class="concontent-item">
    <div class="concontent-item-enter">
      <div class="concontent-item-enter-data">
          <legend>Add Item</legend>
    <div class="form-group">
    <form name="itemForm" method="POST">
          <label for="items">Item Name</label>
          <input type="text" onchange="upperCase(this)" class="form-control" id="items" name="itemname" placeholder="Enter Category" >
        </div>


        <div class="form-group">
          <label for="unit">Select Unit</label>
          <select class="custom-select" name="itemunit" id="unit">
            <option value="">----</option>
            <option value="Box">Box</option>
            <option value="Dozen">Dozen</option>
            <option value="Foot">Foot</option>
            <option value="Pcs">Pcs</option>
            <option value="Inch">Inch</option>
            <option value="Kgs">Kgs</option>
            <option value="Meter">Meter</option>
          </select>
        </div>

        <div class="form-group">
          <label for="category">Select Inventory</label>
          <select class="custom-select" name="iteminvent" id="category">
            <option value="">----</option>
            <option value="Equipments">Equipments</option>
            <option value="Consumable">Consumable</option>
          </select>

        </div>


        <button type="submit" class="btn btn-primary consubb" name="itemsubm" onclick="return inventoryValidation()">Submit</button>
    </form>
<?php
include 'connection/connection.php';
if (isset($_POST['itemsubm'])) {
$itemname=$_POST['itemname'];
$itemunit=$_POST['itemunit'];
$iteminvent=$_POST['iteminvent'];
$qry="INSERT INTO items_objects values('','$itemname','$itemunit','$iteminvent','')";
$exe=mysqli_query($conn,$qry);
if (!$exe) {
  echo "<script>alert('Item Already Exists !');</script>";
}else{
  echo "<script>alert('Item Added');</script>";
}
}
?>
</div>
</div>  



</div>




</div>
<script type="text/javascript">
  function upperCase(valueN){
    var a=valueN.value.toUpperCase();
    valueN.value=a;
  }

  function inventoryValidation(){
    if(document.itemForm.itemname.value == ""){
      alert('Please select Category!');
      return false;
    }
    if(document.itemForm.itemunit.value == ""){
      alert('Please select Unit!');
      return false;
    }
    if(document.itemForm.iteminvent.value == ""){
      alert('Please select Inventory!');
      return false;
    }
  }
</script>
</body>
</html>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- end of javascript files -->
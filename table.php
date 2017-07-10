<?php
include_once "db.php";
$db = new db();
if(!empty($_REQUEST['delete'])){
  $resp=$db->deleted($_REQUEST['delete']);
  if($resp == 'success'){
    $msg = "<span style='margin-top:4%;font-size: 50px;color:#1ab188;text-align:center;'>Data Deleted Successfully!</span>";
  }else{
    $msg = "<span style='margin-top:4%;font-size: 50px;color:red;text-align:center;'>Data Not Dalated!</span>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Table</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">  
  <script type="text/javascript">
  function myFunction(){
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++){
      td = tr[i].getElementsByTagName("td")[0];
      if(td){
        if(td.innerHTML.toUpperCase().indexOf(filter) > -1){
          tr[i].style.display = "";
        }else{
          tr[i].style.display = "none";
        }
      } 
    }
  } 
  </script>
  <style type="text/css">
    input{
      color: black;
      font-weight: bold;
      margin-top: 3%;
      background-image: url('searchicon.png'); 
      background-position: 10px 12px; 
      background-repeat: no-repeat; 
      width: 100%; 
      font-size: 16px; 
      padding: 12px 20px 12px 40px; 
      border: 1px solid #ddd; 
      margin-bottom: 12px; 
    }
    #top{
      width: 100%;
      margin-top: 2%;
    }
    a{
      float: right;
      margin-left: 2%;
      margin-bottom: 2%;
      margin-top: 2%;
    }
    a:hover{
      color: red;
    }
    .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
      margin: 0;
    }
    .pagination a.active {
      background-color: #4CAF50;
      color: white;
    }
    .pagination a:hover:not(.active) {background-color: #ddd;}
  </style>
</head>

<body style="background-color: #f0f0f0;">
<div id="top">
  <a href="index.php">Sign Out</a>
</div>
 <?php if(!empty($msg)){
    echo "$msg";
  } ?>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

<table id="myTable">
  <tr class="header">
    <th>Name</th>
    <th>Country</th>
    <th>Phone Number</th>
    <th>Subject</th>
    <th>Marks</th>
  </tr>
  <?php
    $offset = 0;
    $page_result = 5; 
    if($_REQUEST['pageno'])
    {
      $page_value = $_REQUEST['pageno'];
      if($page_value > 1)
      { 
          $offset = ($page_value - 1) * $page_result;
      }
    }
    $sql = "SELECT * From data WHERE deleted='0' LIMIT $offset, $page_result";
    $res = mysqli_query($db->conn, $sql);
    if($res != 'error'){
      while($row = mysqli_fetch_assoc($res)){
  ?>
  <tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['country']; ?></td>
    <td><?php echo $row['number']; ?></td>
    <td><?php echo $row['subject']; ?></td>
    <td><?php echo $row['marks']; ?></td>
    <td><a href="table.php?delete=<?php echo $row['id']; ?>" onclick="return alert('Are you Sure?');">Delete</td>
  </tr>
  <?php
      }
    }else{
  ?>
    <tr><td>No Data Found!!</td></td>
  <?php
    }
    $query = "SELECT * FROM data";
    $count = mysqli_query($db->conn, $query);
    $pagecount = mysqli_num_rows($count);
    $num = $pagecount / $page_result ;
    if($_REQUEST['pageno'] > 1)
    {
      echo "<a href='table.php?pageno=".($_REQUEST['pageno']-1)."'> Prev </a>";
    }
    for($i = 1 ; $i <= $num ; $i++)
    {
      echo "<a href='table.php?pageno=".$i."'>".$i."</a>";
    }
    if($num!= 1)
    {
      echo "<a href = 'table.php?pageno=".($_REQUEST['pageno']+1)."'> Next </a>";
    }

  ?>
  
</table>
</body>
</html>

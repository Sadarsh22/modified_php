<html>
<title>Index Page</title>

<head>
</head>

<body>

    <style>
        #header {
            margin: auto;
            width: 50%;
            padding: 30px;
            text-align: center;
        }

        #deleteAll {
            margin-left: 5%;
            margin-top: 1%;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function deleterow() {

            var curr_id = $_REQUEST['id'];
            alert("curr_id");

        }

        $(document).ready(function() {
            $('.Delete').click(function() {
                confirm("are you sure you want to delete");
            });
        })


        function selectAllCheckboxes() {
            let val = document.getElementsByName("all");

            if (val[0].checked == true) {
                for (let i = 0; i < val.length; i++) {
                    val[i].checked = true;
                }
            } else if (val[0].checked == false) {
                for (let i = 0; i < val.length; i++) {
                    val[i].checked = false;
                }
            }
        }

        function singleCheckbox() {
            let val = document.getElementsByName("all");
            if (val[0].checked == true) {
                let c = 0;
                for (let i = 1; i < val.length; i++) {
                    if (val[i].checked == false) c++;
                }
                if (c == val.length - 1) val[0].checked = false;
                else val[0].checked = false;
            } else {
                let c = 0;
                for (let i = 1; i < val.length; i++) {
                    if (val[i].checked == true) c++;
                }
                if (c == val.length - 1) val[0].checked = true;
            }
        }

        function validateDeleteAll() {
            let check = document.getElementsByName("all");
            let c = 0;
            for (let i = 0; i < check.length; i++) {
                if (check[i].checked == true) c++;
            }
            if (c == 0) {
                alert("please select atleast one record to delete");
                return false;
            } else if (c > 0) {
                confirm("are you sure you want to delete");
            }
            return true;
        }
    </script>

    <div id='header'>
        <input type="text" name="searchbar" id="searchbar" placeholder="Search" />&nbsp;
        <input type="button" name="search" id="search" value="Search" />&nbsp;
        <a href="index.php"><button>+New</button></a>
    </div>

    <?php

    include 'login_credentials.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conn = new mysqli($hostname, $username, $password, 'adarsh');

    $query = "select id, first_name,last_name,email,phone,file_name  from customer";
    $queryResult = mysqli_query($conn, $query);
    $c = 0;
    echo "<table border='1' bordercolor='orange' align='center' id='listingTable'>";
    echo "<tr>
      <th>
        <input
          type='checkbox'
          id='all'
          name='all'
          value='0'
          onclick='selectAllCheckboxes()'
        />
      </th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Image</th>
      <th>Action</th>
    </tr>";
    while ($queryRow = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
        //print_r($queryRow);
    ?>
        <tr id='$c'>
            <td><input type='checkbox' id='all' name='all' value='$c' onclick='singleCheckbox()''/></td>
        <td><?php echo $queryRow['first_name']; ?></td>
        <td><?php echo $queryRow['last_name']; ?></td>
        <td><?php echo $queryRow['email']; ?></td>
        <td><?php echo $queryRow['phone']; ?></td>
        <td></td>
        <td> <a href="#">View</a> | <a href="index.php?id=<?php echo $queryRow['id']; ?>"> Edit </a> | 
        <a href="listings.php?id=<?php echo $queryRow['id']; ?> ?rowid=<?php echo $c; ?>"> <button onclick="deleterow()">Delete</button> </a></td></tr>
<?php
    $c++;
    }
?>
</table>
      
    <button id="deleteAll" onclick="validateDeleteAll()">Delete All</button>
</body>

</html>
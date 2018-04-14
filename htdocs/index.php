<!DOCTYPE html>  
<head>
  <title>UPDATE PostgreSQL data with PHP</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

</head>
<body>
  <h2>Supply bookid and enter</h2>
  <ul>
    <form name="display" action="index.php" method="POST" >
      <li>Book ID:</li>
      <li><input type="text" name="bookid" /></li>
      <li><input type="submit" name="submit" /></li>
    </form>
  </ul>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
	//select * from employee
    $db     = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=Pznp070070");	
    //$result = pg_query($db, "SELECT c_custkey FROM customer where book_id = '$_POST[bookid]'");		// Query template
	$result = pg_query($db, "SELECT c_custkey FROM customer");		// Query template
	$result1 = pg_query($db, "SELECT p_partkey FROM part");		// Query template
	$result2 = pg_query($db, "SELECT s_suppkey FROM supplier");		// Query template
	
    //$row    = pg_fetch_assoc($result);		// To store the result row
	//echo "<script>console.log( 'Debug result: " . $result . "' );</script>";
	//echo "<script>console.log( 'Debug row: " . json_encode($row) . "' );</script>";
	
	echo "<script>
	var array = [];
		array.push('');
	var array1 = [];
		array1.push('');
	var array2 = [];
		array2.push('');
	</script>";
	while($row = pg_fetch_assoc($result)){		
		echo "<script>		
		array.push(";
		echo $row['c_custkey'];
		echo ")
		</script>";
	}
	
	while($row1 = pg_fetch_assoc($result1)){		
		echo "<script>		
		array1.push(";
		echo $row1['p_partkey'];
		echo ")
		</script>";
	}
	
	while($row2 = pg_fetch_assoc($result2)){		
		echo "<script>		
		array2.push(";
		echo $row2['s_suppkey'];
		echo ")
		</script>";
	}
    if (isset($_POST['submit'])) {
		echo "        <div class='row'>
          <div class='form-group col-md-6'>
            <label class='control-label' for='startDate'>Start Date</label>
            <input type='text' class='form-control' id='startDate' name='startDate' placeholder='yyyy-mm-dd'/>
          </div>
          <div class='form-group col-md-6'>
            <label class='control-label' for='endDate'>End Date</label>
            <input type='text' class='form-control' id='endDate' name='endDate' placeholder='yyyy-mm-dd'/>
          </div>
        </div>";
		
        echo "<ul><form name='update' action='index.php' method='POST' >     	    			
		<div class='form-group col-md-4'>
            <label for='cusID'>Customer ID</label>
			<select id='select_CustomerList' class='form-control'></select>
        </div>		
		<div class='form-group col-md-4'>
            <label for='cusID'>Part ID:</label>
			<select id='select_PartList' class='form-control'></select>
        </div>				  
		<div class='form-group col-md-4'>
            <label for='cusID'>Supplier ID:</label>
			<select id='select_SupplierList' class='form-control'></select>
        </div>
		<li><input type='submit' name='new' /></li>  
    	</form>  
    	</ul>";		
		echo "
		<script>         
            var myDiv = document.getElementById('select_CustomerList');

            for (var i = 0; i < array.length; i++) {
                var option = document.createElement('option');
                option.value = array[i];
                option.text = array[i];
                myDiv.appendChild(option);
            }
			
			var myDiv1 = document.getElementById('select_PartList');

            for (var i = 0; i < array1.length; i++) {
                var option = document.createElement('option');
                option.value = array[i];
                option.text = array[i];
                myDiv1.appendChild(option);
            }
			
			var myDiv2 = document.getElementById('select_SupplierList');
			for (var i = 0; i < array2.length; i++) {
                var option = document.createElement('option');
                option.value = array[i];
                option.text = array[i];
                myDiv2.appendChild(option);
            }
					
		</script>
		
		";
		
		
    }
    if (isset($_POST['new'])) {	// Submit the update SQL command
        $result = pg_query($db, "UPDATE book SET book_id = '$_POST[bookid_updated]',  
    name = '$_POST[book_name_updated]',price = '$_POST[price_updated]',  
    date_of_publication = '$_POST[dop_updated]'");
        if (!$result) {
            echo "Update failed!!";
        } else {
            echo "Update successful!";
        }
    }
    ?> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- datepicker !-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <!-- our scripts !-->
    <script src="datepicker.js"></script>	
</body>
</html>

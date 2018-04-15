<!DOCTYPE html>  
<head>
  <title>UPDATE PostgreSQL data with PHP</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even) {
		background-color: #dddddd;
	}
  </style>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	
	

</head>
<body>

<div class="container">
		<h2>Data warehouse</h2>
			<ul>
				<form name="display" action="index.php" method="POST" >
				<li><input type="submit" name="submit" value = "Start/refresh"/></li>
				</form>
			</ul>
</div>






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
	if (isset($_POST['submit0'])) {		
		if(trim($_POST['select_CustomerList']) == ''){
			$custkey = -1;
		} else{
			$custkey = $_POST['select_CustomerList'];
		}
		if(trim($_POST['select_PartList']) == ''){
			$partkey = -1;
		} else{
			$partkey = $_POST['select_PartList'];
		}
			
		if(trim($_POST['select_SupplierList']) == ''){
			$suppkey = -1;
		} else{
			$suppkey = $_POST['select_SupplierList'];
		}
		if(trim($_POST['startDate']) == ''){
			$startDate = 1990-01-01;
		} else{
			$startDate =	$_POST['startDate'];
		}
		if(trim($_POST['endDate']) == ''){
			$endDate = 2018-04-15;
		} else{
			$endDate = $_POST['endDate'];
		}
		
		$resultcustkey = pg_query($db, "select * from sumExtendedPrice(custkey=> " .$custkey. ",partkey=> " .$partkey. ",suppkey => " .$suppkey. "
		,startOdate => '". $startDate ."',endOdate => '".$endDate."');");	
		echo "<table>";
		echo " <tr>
				<th>region name</th>
				<th>nation name</th>
				<th>market segment</th>
				<th>extended price</th>
				<tr>";
		while($rowreport2 = pg_fetch_assoc($resultcustkey)){
			echo "<tr>";
			echo "<script>console.log( 'Debug result: " . json_encode($rowreport2) . "' );</script>";
			echo "<td>".$rowreport2['region_name'] . "</td>";
			echo "<td>".$rowreport2['nation_name'] . "</td>";
			echo "<td>".$rowreport2['market_segment'] . "</td>";
			echo "<td>".$rowreport2['extended_price_sum'] . "</td>";
			echo "</tr>";			
		}
		echo "</table>";	
	}	
	if (isset($_POST['submit2'])) {		
		if(trim($_POST['select_CustomerList']) == ''){
			$custkey = -1;
		} else{
			$custkey = $_POST['select_CustomerList'];
		}
		if(trim($_POST['select_PartList']) == ''){
			$partkey = -1;
		} else{
			$partkey = $_POST['select_PartList'];
		}
			
		if(trim($_POST['select_SupplierList']) == ''){
			$suppkey = -1;
		} else{
			$suppkey = $_POST['select_SupplierList'];
		}
		if(trim($_POST['startDate']) == ''){
			$startDate = 1990-01-01;
		} else{
			$startDate =	$_POST['startDate'];
		}
		if(trim($_POST['endDate']) == ''){
			$endDate = 2018-04-15;
		} else{
			$endDate = $_POST['endDate'];
		}
		
		$resultcustkey = pg_query($db, "select * from orderPriority(custkey=> " .$custkey. ",partkey=> " .$partkey. ",suppkey => " .$suppkey. "
		,startOdate => '". $startDate ."',endOdate => '".$endDate."');");		
		echo "<table>";
		echo " <tr>
				<th>order priority</th>
				<th>order count</th>
				<tr>";
		while($rowreport2 = pg_fetch_assoc($resultcustkey)){
			echo "<tr>";
			echo "<script>console.log( 'Debug result: " . json_encode($rowreport2) . "' );</script>";
			echo "<td>".$rowreport2['order_priority'] . "</td>";
			echo "<td>".$rowreport2['order_count'] . "</td>";
			echo "</tr>";			
		}
		echo "</table>";	
	}
	
	if (isset($_POST['submit1'])) {
				if(trim($_POST['select_CustomerList']) == ''){
			$custkey = -1;
		} else{
			$custkey = $_POST['select_CustomerList'];
		}
		if(trim($_POST['select_PartList']) == ''){
			$partkey = -1;
		} else{
			$partkey = $_POST['select_PartList'];
		}
			
		if(trim($_POST['select_SupplierList']) == ''){
			$suppkey = -1;
		} else{
			$suppkey = $_POST['select_SupplierList'];
		}
		if(trim($_POST['startDate']) == ''){
			$startDate = 1990-01-01;
		} else{
			$startDate =	$_POST['startDate'];
		}
		if(trim($_POST['endDate']) == ''){
			$endDate = 2018-04-15;
		} else{
			$endDate = $_POST['endDate'];
		}
		
		$resultcustkey = pg_query($db, "select * from pricingSummary(custkey=> " .$custkey. ",partkey=> " .$partkey. ",suppkey => " .$suppkey. "
		,startOdate => '". $startDate ."',endOdate => '".$endDate."');");		
		echo "<table>";
		echo " <tr>
				<th>year</th>
				<th>month</th>
				<th>group_count</th>
				<th>total_extended_price</th>
				<th>total_disct_extended_price</th>
				<th>total_disct_extended_price_tax</th>
				<th>avg_quantity</th>
				<th>avg_extended_price</th>
				<th>avg_disct</th>
				<tr>";
		while($rowreport2 = pg_fetch_assoc($resultcustkey)){
			echo "<tr>";
			//echo "<script>console.log( 'Debug result: " . json_encode($rowreport2) . "' );</script>";
			echo "<td>".$rowreport2['year'] . "</td>";
			echo "<td>".$rowreport2['month'] . "</td>";
			echo "<td>".$rowreport2['group_count'] . "</td>";
			echo "<td>".$rowreport2['total_extended_price'] . "</td>";
			echo "<td>".$rowreport2['total_disct_extended_price'] . "</td>";
			echo "<td>".$rowreport2['total_disct_extended_price_tax'] . "</td>";
			echo "<td>".$rowreport2['avg_quantity'] . "</td>";
			echo "<td>".$rowreport2['avg_extended_price'] . "</td>";
			echo "<td>".$rowreport2['avg_disct'] . "</td>";
			echo "</tr>";			
		}
		echo "</table>";	

	}
    if (isset($_POST['submit'])) {
		echo "<div>  
		";
		
        echo "<ul><form name='update' action='index.php' method='POST' >
		<div class='row'>
          <div class='form-group col-md-6'>
            <label class='control-label' for='startDate'>Start Date</label>
            <input type='text' class='form-control' id='startDate' name='startDate' placeholder='yyyy-mm-dd' name='startDate' value = '1990-01-01'/>
          </div>
          <div class='form-group col-md-6'>
            <label class='control-label' for='endDate'>End Date</label>
            <input type='text' class='form-control' id='endDate' name='endDate' placeholder='yyyy-mm-dd' name='enddate' value = '2018-01-01'/>
          </div>
        </div>
<div class = 'row'>		
		<div class='form-group col-md-4'>
            <label for='cusID'>Customer ID</label>
			<select id='select_CustomerList' class='form-control'  name='select_CustomerList'></select>
        </div>	
		<div class='form-group col-md-4' id = 'custName'>
		
		</div>	
</div>	
<div class = 'row'>		
		<div class='form-group col-md-4'>
            <label for='cusID'>Part ID:</label>
			<select id='select_PartList' class='form-control'  name='select_PartList'></select>
        </div>
		<div class='form-group col-md-4' id = 'partName'>
		
		</div>	
</div>		
<div class = 'row'>		
		<div class='form-group col-md-4'>
            <label for='cusID'>Supplier ID:</label>
			<select id='select_SupplierList' class='form-control'  name='select_SupplierList'></select>
        </div>
		<div class='form-group col-md-4' id = 'suppName'>
		
		</div>	
</div>	
		<li><input type='submit' name='new' value = '3.1'/></li>
		
		<li><input type='submit' name='submit0' value='3.2 Display the total sum of the extended prices'/></li> 	
		<li><input type='submit' name='submit1' value='3.3 Pricing Summary Report Query'/></li> 		
		<li><input type='submit' name='submit2' value='3.4 Order Priority Checking Query'/></li> 
    	</form>  
    	</ul>
		</div>
		";	
		
		

		
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
			";
		echo "function getCustomerName(){
			    console.log('1');
				document.cookie = 'c_custkey = ' + String($('#select_CustomerList').val()).trim(); " ;				
				$resultcustkey = pg_query($db, "SELECT c_name FROM customer where c_custkey = " . $_COOKIE['c_custkey']);
				while($rowcustkey = pg_fetch_assoc($resultcustkey)){	
				//echo "console.log( 'Debug result: " . $result . "' );";				
				echo "$('#custName').text('" . $rowcustkey['c_name'] . "' );";				
				}				
		echo "
			}";

		echo "function getPartName(){
			console.log('2');
				setcookie(String($('#select_PartList').val()).trim(), $value);
				document.cookie = 'p_partkey = ' + String($('#select_PartList').val()).trim(); " ;				
				$resultpartkey = pg_query($db, "SELECT p_name FROM part where p_partkey = " . $value);
				while($rowpartkey = pg_fetch_assoc($resultpartkey)){	
				//echo "console.log( 'Debug result: " . $result . "' );";				
				echo "$('#partName').text('" . $rowpartkey['p_name'] . "' );";				
				}				
		echo "
			}";
		echo "function getSuppName(){
			console.log('3');
				document.cookie = 's_suppkey = ' + String($('#select_SupplierList').val()).trim(); " ;				
				$resultsuppkey = pg_query($db, "SELECT s_name FROM supplier where s_suppkey = " . $_COOKIE['s_suppkey']);
				while($rowsuppkey = pg_fetch_assoc($resultsuppkey)){	
				//echo "console.log( 'Debug result: " . $result . "' );";				
				echo "$('#suppName').text('" . $rowsuppkey['s_name'] . "' );";				
				}				
		echo "
			}			
		</script>		
		";			
    }
    if (isset($_POST['new'])) {	// Submit the update SQL command
	

		
        echo "<ul><form name='update' action='index.php' method='POST' >
				<div class = 'row'>		
					<div class='form-group col-md-4' id = 'custName'>
		
					</div>	
			</div>	
			<div class = 'row'>		
					<div class='form-group col-md-4' id = 'partName'>
		
					</div>	
			</div>		
			<div class = 'row'>		
					<div class='form-group col-md-4' id = 'suppName'>
		
					</div>	
			</div>	
			<div class = 'row'>		
					<div class='form-group col-md-4' id = 'orderkey'>
		
					</div>	
			</div>	";		

//custkey integer default -1, partkey integer default -1, suppkey integer default -1,starTOdate date default null, endOdate date default null
		echo "<script>console.log( 'Debug result: " . json_encode($_POST) . "' );</script>";
		if(trim($_POST['select_CustomerList']) == ''){
			$custkey = -1;
		} else{
			$custkey = $_POST['select_CustomerList'];
		}
		if(trim($_POST['select_PartList']) == ''){
			$partkey = -1;
		} else{
			$partkey = $_POST['select_PartList'];
		}
			
		if(trim($_POST['select_SupplierList']) == ''){
			$suppkey = -1;
		} else{
			$suppkey = $_POST['select_SupplierList'];
		}
		if(trim($_POST['startDate']) == ''){
			$startDate = 1990-01-01;
		} else{
			$startDate =	$_POST['startDate'];
		}
		if(trim($_POST['endDate']) == ''){
			$endDate = 2018-04-15;
		} else{
			$endDate = $_POST['endDate'];
		}
		
		$resultcustkey = pg_query($db, "select * from getItems(custkey=> " .$custkey. ",partkey=> " .$partkey. ",suppkey => " .$suppkey. "
		,startOdate => '". $startDate ."',endOdate => '".$endDate."');");



		
	echo "<table>";
		echo " <tr>
				<th>order key</th>
				<th>customer name</th>
				<th>part name</th>
				<th>supplier name</th>
				<th>order date</th>
				<th>extended price</th>
				<tr>";	
	while($roworderkey = pg_fetch_assoc($resultcustkey)){		
				//echo "console.log( 'Debug result: " . json_encode($roworderkey) . "' );";				
				//echo "<div class= 'row'><div class='col-md-4'>orderkey</div><div class='col-md-4'>" . $roworderkey['l_orderkey'] . "' </div></div>";
				echo "<tr>";
				echo "<td>".$roworderkey['order_key'] . "</td>";
				echo "<td>".$roworderkey['customer_name'] . "</td>";
				echo "<td>".$roworderkey['part_name'] . "</td>";
				echo "<td>".$roworderkey['supplier_name'] . "</td>";				
				echo "<td>".$roworderkey['order_date'] . "</td>";
				echo "<td>".$roworderkey['extended_price'] . "</td>";
				echo "</tr>";				
				
				}						
	
	echo "</table>";	   
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

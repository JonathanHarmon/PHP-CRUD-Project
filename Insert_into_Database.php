<?php
require_once("include/DB.php");

$NameError="";
$SSNError="";
$DeptError="";
$SalaryError="";
$HomeAddressError="";
$Ename="";
$SSN="";
$Dept="";
$Salary="";
$HomeAddress="";

if (isset($_POST["Submit"])) {
    if (empty($_POST["Ename"])) {
		$NameError="Name is required.";
	}
	else {
		$EName=Test_User_Input($_POST["Ename"]);
		if(!preg_match("/^[A-Za-z. ]*$/", $EName)) {
		$NameError="Only letters, white spaces, and periods allowed.";	
		}
    }
    if (empty($_POST["SSN"])) {
        $SSNError="Social security number is required";
    } else {
		$SSN=Test_User_Input($_POST["SSN"]);
		if(!preg_match("/^(?!666|000|9\\d{2})\\d{3}-(?!00)\\d{2}-(?!0{4})\\d{4}$/", $SSN)) {
		$SSNError="Please use xxx-xx-xxxx format with numbers and hyphens only";	
		}
    }
    if (empty($_POST["Dept"])) {
        $DeptError="Department name is required";
    } else {
		$Dept=Test_User_Input($_POST["Dept"]);
		if(!preg_match("/^[A-Za-z. ]*$/", $Dept)) {
		$DeptError="Only letters, white spaces, and periods allowed.";	
		}
    }   
    if (empty($_POST["Salary"])) {
        $SalaryError="Salary is required";
    } else {
		$Salary=Test_User_Input($_POST["Salary"]);
		if(!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $Salary)) {
        $SalaryError="Only numbers and period allowed.";	
		}
    }
    if (empty($_POST["HomeAddress"])) {
        $HomeAddressError="Home address is required.";
    } else {
		$HomeAddress=Test_User_Input($_POST["HomeAddress"]);
		if(!preg_match("/[A-Za-z0-9'\.\-\s\,]/", $HomeAddress)) {
            $HomeAddressError="Please use letters, numbers, periods, hyphens, and commas only.";	
		}
    }  




    if(!empty($_POST["Ename"])&&!empty($_POST["SSN"])&&!empty($_POST["Dept"])&&!empty($_POST["Salary"])&&!empty($_POST["HomeAddress"])){
        if((preg_match("/^[A-Za-z. ]*$/",$EName)==true)&&(preg_match("/^(?!666|000|9\\d{2})\\d{3}-(?!00)\\d{2}-(?!0{4})\\d{4}$/",$SSN)==true)&&(preg_match("/^[A-Za-z. ]*$/",$Dept)==true)&&(preg_match("/^[0-9]+(\.[0-9]{1,2})?$/",$Salary)==true)&&(preg_match("/[A-Za-z0-9'\.\-\s\,]/",$HomeAddress)==true))
        {

    

            $ConnectingDB;
            $sql = "INSERT INTO emp_record(ename,ssn,dept,salary,homeaddress)
            VALUES(:enamE,:ssN,:depT,:salarY,:homeaddresS)";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue('enamE',$EName);
            $stmt->bindValue('ssN',$SSN);
            $stmt->bindValue('depT',$Dept);
            $stmt->bindValue('salarY',$Salary);
            $stmt->bindValue('homeaddresS',$HomeAddress);
            $Execute = $stmt->execute();
            if ($Execute) {
                echo '<div class="success"> Record has been added successfully</div>';
            } 
        } 
    }       







}

function Test_User_Input($Data){
    return $Data;
}

?>


<!DOCTYPE>

<html>
	<head>
		<title>Insert Data Into Database</title>
        <link rel="stylesheet" href="include/style.css">
	</head>
	<body>
<?php ?>
<div>
    <form class="" action="Insert_into_Database.php" method="post">
        <fieldset>
            <span class="FieldInfo">Employee Name:</span>
            <br>
            <input type="text" name="Ename" value=""><span class="Error"><?php echo $NameError; ?></span>
            <br>
            <span class="FieldInfo">Social Security Number: xxx-xx-xxxx format</span>
            <br>
            <input type="text" name="SSN" value=""><span class="Error"><?php echo $SSNError; ?></span>
            <br>
            <span class="FieldInfo">Department:</span>
            <br>
            <input type="text" name="Dept" value=""><span class="Error"><?php echo $DeptError; ?></span>
            <br>
            <span class="FieldInfo">Yearly Salary: numbers only</span>
            <br>
            <input type="text" name="Salary" value=""><span class="Error"><?php echo $SalaryError; ?></span>
            <br>
            <span class="FieldInfo">Home Address:</span>
            <br>
            <textarea name="HomeAddress" rows="8" cols="80"></textarea><span class="Error"><?php echo $HomeAddressError; ?></span>
            <br>
            <input type="submit" name="Submit" value="Submit Your Record">
        </fieldset>
    </form>
</div>


	    
	</body>
</html>

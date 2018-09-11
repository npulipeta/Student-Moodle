
<?php
require 'connect.php';

session_start();

function isStudent($username,$db)
{
	$sql="SELECT * FROM Student WHERE student_id='{$username}'";
	$result = pg_query($db, $sql);
	if(pg_num_rows($result)>0)
    {
      //header('Location: student.php');
    	return TRUE;
    }
    return False;
}

function isFaculty($username,$db)
{
	$sql="SELECT * FROM Faculty WHERE faculty_id='{$username}'";
	$result = pg_query($db, $sql);
	if(pg_num_rows($result)>0)
    {
      //header('Location: student.php');
    	return TRUE;
    }
    return False;
}

function isNonTeachingStaff($username,$db)
{
	$sql="SELECT * FROM Staff WHERE staff_id='{$username}'";
	$result = pg_query($db, $sql);
	if(pg_num_rows($result)>0)
    {
      //header('Location: student.php');
    	return TRUE;
    }
    return False;
}

$Data = explode("$", $_POST['data']);

if(strcmp($Data[0],"insert")==0)
{
	$sql="INSERT INTO Registers(student_id,semester,year,course_id) VALUES ( '{$Data[1]}','{$Data[2]}','{$Data[3]}','{$Data[4]}')";
	
	$result = pg_query($db, $sql);

}
if(strcmp($Data[0],"delete")==0)
{
	$sql="DELETE FROM Registers WHERE (student_id,semester,year,course_id) = ( '{$Data[1]}','{$Data[2]}','{$Data[3]}','{$Data[4]}')";
	//echo $sql;
	// DELETE FROM Registers WHERE (student_id,semester,year,course_id)=('a','first',2015,'CSL211');
	$result = pg_query($db, $sql);
}
?>
<?php

/*

               Krit Karan Singh

  Indian Institute of Information Technology, Sricity
  */
// ob_start();
// session_start();
// require_once 'dbconnect.php';


$btn = $_GET['submit'];
$srch = $_GET['search'];

if(!$btn)
{
	echo "Please submit a Keyword";
}

else
{
	$len = strlen($srch);

	if($len<=1)
	{
		echo "Search term is very short";
	}

	else
	{
		echo "You searched for <i>$srch</i> <hr size='1'></br>";

		$db_host = "localhost";
$db_name = "hello";
$db_user = "root";
$db_pass = "internetking1";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


		$srch_exploded = explode (" ", $srch);

        foreach($srch_exploded as $srch_each)
        { 
             
            $x++;

            if($x==1)
            {
               $construct .="keywords LIKE '%$srch_each%'";
            }
            else
            {
               $construct .="AND keywords LIKE '%$srch_each%'";
            }

        }

        $construct ="SELECT * FROM searchengine WHERE $construct";
        $run = mysql_query($construct);
        $foundnum = mysql_num_rows($run);

        if ($foundnum==0)
        {
         
         echo "Sorry, there are no matching result for <b>$srch</b>.</br></br>1. 
         Try more general words. for example: If you want to search 'how to create a website'
         then use general keyword like 'create' 'website'</br>2. Try different words with similar
         meaning</br>3. Please check your spelling";
         
         }

         else
         {
             echo "$foundnum results found !<p>";
 
             while($runrows = mysql_fetch_assoc($run))
             {
                
                $title = $runrows ['title'];
                $desc = $runrows ['description'];
                $url = $runrows ['url'];
 
               echo "
                    <a href='$url'><b>$title</b></a><br>
                    $desc<br>
                    <a href='$url'>$url</a><p>
                     
                    ";
 
              }
           
          }

    }

}
?>

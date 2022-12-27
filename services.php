    <?php

    //Insert Function To insert the data 

    function insert($table_name,$fields,$conn)
    {
    	
    	 $col = "insert into $table_name (`".implode("` , `",array_keys($fields))."`)";
         $val = " values('";		

        foreach($fields as $key => $value) { 
            $fields[$key] = $value;
        }

        $val .= implode("' , '",array_values($fields))."');";	
        $combine = $col.$val;

    	mysqli_query($conn,$combine);
    	$last_id = mysqli_insert_id($conn);
        $fields = array();
        return $last_id;

    }

<?php
/*
* Create databse to this applicatio for create, update, view and delete
* fuction. also conection with local and server data base
*/

class database{

	protected $hostname;
	protected $user;
	protected $password;
	protected $database;

protected function connect(){
	
	$this->hostname="localhost";
	$this->user="root";
	$this->password="";
	$this->database="rnd";
	$con = new mysqli($this->hostname,$this->user,$this->password,$this->database) or die(mysql_error);

	return $con;
} 

}

class myQuery extends database{

public	function getData($table,$field ='*',$coditionArr,$orderByField,$orderByType='desc',$limit=''){

	//select $fields from table $conditio $orderBy $limit $orderType 
	
	// $sql = "select * from curd";
	if($field!=''){

	$sql = "select $field from $table";
	}else{

	$sql = "select * from $table";
	}

	if($coditionArr!=''){
		$sql.= ' where ';
		$count = count($coditionArr);
		$i=1;
		foreach($coditionArr as $key=>$value){
			if($i==$count){
				$sql.="$key='$value'";
			}else{
				$sql.="$key='$value' and ";
			}
			$i++;
		} 
	}

	if($orderByField!=''){
		$sql.=" order by $orderByField $orderByType";
	}

	if($limit!=''){
		$sql.=" limit $limit ";
	}
	
	// die($sql);

	$result = $this->connect()->query($sql);
	
	if($result->num_rows>0){
		$arr=array();
		while($row=$result->fetch_assoc()){
			// print_r($row);
			$arr[]=$row;
		}
		return $arr;
	}else{
		return 0;
	}

	print_r($result);
	} 


public	function inserttData($table,$coditionArr){
	
	if($coditionArr!=''){
		foreach($coditionArr as $key=>$value){
			$fieldArr[] =$key;
			$valueArr[] =$value;

		} 
		$field = implode(",",$fieldArr);
		$value = implode("','",$valueArr);
		$value = "'".$value."'";
		$sql = "insert into $table ($field) values($value)";

	$result = $this->connect()->query($sql);
	}


}


public	function deleteData($table,$coditionArr)
	{
		if($coditionArr!=''){
		$sql = "delete from $table where ";
				$count = count($coditionArr);
		$i=1;
		foreach($coditionArr as $key=>$value){
			if($i==$count){
				$sql.="$key='$value'";
			}else{
				$sql.="$key='$value' and ";
			}
			$i++;
		}
		$result = $this->connect()->query($sql);
		}
	}

	public	function updateData($table,$coditionArr,$whereField,$whereValue)
	{
		if($coditionArr!=''){
		$sql = "update $table set ";
		$count = count($coditionArr);
		$i=1;
		foreach($coditionArr as $key=>$value){
			if($i==$count){
				$sql.="$key='$value'";
			}else{
				$sql.="$key='$value' , ";
			}
			$i++;
		}
		$sql.= " where $whereField='$whereValue'";
		
		$result = $this->connect()->query($sql);
		}
	} 
}

?>
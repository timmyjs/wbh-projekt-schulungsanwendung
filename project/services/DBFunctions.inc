<?php
	function db_query($db,$sql_tpl,$args=null){
		if($args == null){
			$sql = $sql_tpl;
		}else{
			foreach($args as $arg){
				$arg = strip_tags($arg);
				$arg = mysqli_real_escape_string($db, $arg);
			}
			$sql = str_replace(array_keys($args), array_values($args), $sql_tpl);
		}

		$res = mysqli_query($db, $sql);
		$ret = array();

		while ($row = mysqli_fetch_assoc($res)) {
			$ret[] = $row;
		}
		
		return $ret;
	}
?>
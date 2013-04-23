<?php
    function get_category_nav() {
        $root = $_SERVER['DOCUMENT_ROOT'];
        require($root . "/636800/common/db_config.php");
        $db = new mysqli($db_host, $db_username, $db_password, $db_database);
        if($db->connect_errno > 0) die("Unable to connect to mysql. " . $db->connect_error);
        $sql = "select c_name from tbl_category ORDER BY c_name";
        $result = $db->query($sql);
        if(!$result) die("Query unsuccessful. " . $db->connect_error);
		$html = "\n<nav id='category_nav'>\n";
        $html .= "   <ul>\n";
        $html .= "		<li><a href='#' id='allCategory'>all</a></li>\n";
        if($result->num_rows > 0) {
            while($row = $result->fetch_array(MYSQLI_NUM)) {
                $html .= "      <li><a href='#' id='$row[0]'>$row[0]</a></li>\n";

            }
        
        }
        $html .= "   </ul>\n";
		$html .= "</nav>\n";
		$db->close();
        return $html;
    }
?>
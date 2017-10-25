<?php
function displayLastGames($opt, $highlight) {

    require "db/config.php";
    $dbCon = mysqli_connect("p:".$myHost, $myUser, $myPass, $myDB);

    if(empty($opt)) { $opt = 10; }
    if(empty($highlight)) { $highlight = false; }
    $str;
    $query = "SELECT * FROM `full` ORDER BY `id` DESC LIMIT " . $opt . ";";
    $q_res = mysqli_query($dbCon, $query);
//            or die("Could not perform ".$query."<br />".mysqli_error()."<br />");
    $q_res_copy = mysqli_query($dbCon, $query);
//            or die("Could not perform ".$query."<br />".mysqli_error()."<br />");
    
    $mArr = array();
    if(mysqli_num_rows($q_res_copy)) {
        while($row = mysqli_fetch_array($q_res_copy, MYSQLI_ASSOC)) {
            $mArr[$row['ball_1']]++;
            $mArr[$row['ball_2']]++;
            $mArr[$row['ball_3']]++;
            $mArr[$row['ball_4']]++;
            $mArr[$row['ball_5']]++;
            $mArr[$row['ball_6']]++;
        }
    }
    
    if(mysqli_num_rows($q_res)) {
        $str = "<span class=\"tableContainer\">"
                . "<table>"
                . "<tr>"
                . "<th colspan=8>" . LAST_GAMES . "</th>"
                . "</tr>"
                . "<tr>"
                . "<th>" . CONST_ID . "</th>"
                . "<th>" . CONST_DATE . "</th>"
                . "<th>I</th>"
                . "<th>II</th>"
                . "<th>III</th>"
                . "<th>IV</th>"
                . "<th>V</th>"
                . "<th>VI</th>"
                . "</tr>";
        while($row = mysqli_fetch_array($q_res, MYSQLI_ASSOC)) {
            $hl_begin = "";
            $hl_end = "";
            if($highlight) {
                $hl_begin = "<span style=\"border-radius:30px;background-color:#00ff00;\">";
                $hl_end = "</span>";
            }
            
            $str .= "<tr>"
                    . "<td width=40>".$row['id']."</td>"
                    . "<td width=100>".$row['date']."</td>";
            if($mArr[$row['ball_1']] > 1) {
                $str .= "<td width=30>".$hl_begin.$row['ball_1'].$hl_end."</td>";
            } else {
                $str .= "<td width=30>".$row['ball_1']."</td>";
            }
            if($mArr[$row['ball_2']] > 1) {
                $str .= "<td width=30>".$hl_begin.$row['ball_2'].$hl_end."</td>";
            } else {
                $str .= "<td width=30>".$row['ball_2']."</td>";
            }
            if($mArr[$row['ball_3']] > 1) {
                $str .= "<td width=30>".$hl_begin.$row['ball_3'].$hl_end."</td>";
            } else {
                $str .= "<td width=30>".$row['ball_3']."</td>";
            }
            if($mArr[$row['ball_4']] > 1) {
                $str .= "<td width=30>".$hl_begin.$row['ball_4'].$hl_end."</td>";
            } else {
                $str .= "<td width=30>".$row['ball_4']."</td>";
            }
            if($mArr[$row['ball_5']] > 1) {
                $str .= "<td width=30>".$hl_begin.$row['ball_5'].$hl_end."</td>";
            } else {
                $str .= "<td width=30>".$row['ball_5']."</td>";
            }
            if($mArr[$row['ball_6']] > 1) {
                $str .= "<td width=30>".$hl_begin.$row['ball_6'].$hl_end."</td>";
            } else {
                $str .= "<td width=30>".$row['ball_6']."</td>";
            }
            $str .= "</tr>";
        }
        $str .= "</table>"
                . "</span>";
    }
    mysqli_free_result($q_res);
    return $str;
}

<?php
    if(isset($_GET['str'])){
        $str = $_GET['str'];
        $strarray = explode(" ",$str);
        $freq = array();
        foreach ($strarray as $word){
            if(isset($freq[$word])){
                $freq[$word]++;
            }else{
                $freq[$word] = 1;
            }
        }
        $result = "<table border='1'><tr><th>Word</th><th>Frequency</th></tr>";
        foreach($freq as $key => $value){
            $result = $result."<tr><td>".$key."</td><td>".$value."</td></tr>";
        }
        $result = $result."</table>";
        echo $result;
    }
?>
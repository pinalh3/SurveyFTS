<?php


        
        					  
        					  
         function logap($message, $login, $p)
         {
            $datelog= date("Y/m/d");
            $timelog= date("H:i:s");
            $txt= "$datelog,$timelog,$p,$login,$message\n";
            $myfile = fopen("log/log.txt", "a+") or die("Unable to open file!");
            fwrite($myfile, $txt);
            
            
            fclose($myfile);
        
        }
        
        
?>
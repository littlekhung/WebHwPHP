<html>
    <head>
        <title>u5988065</title>
    </head>
    <body>
        <h1>Please upload a file</h1>
        <form action = "" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
            <input type="file" name="text" id="file" />
            <input type="submit" name="submit" value="Submit" />
        </form>
        <?php
            if(isset($_FILES['text'])){
                if($_FILES['text']['size']<100000 && $_FILES['text']['type']=='text/plain'){
                    if($_FILES['text']['error']>0){
                        echo 'Return Code: '.$_FILES['text']['error'].'<br>';
                    }
                    else{
                        $file_name = $_FILES['text']['name'];
                        $file_tmp =$_FILES['text']['tmp_name'];
                        echo "Upload Successful<br>";
                        openNRead($_FILES['text']['tmp_name']);
                    }
                }else{
                    echo "Upload Fail (File must be txt and size must kess than 1MB)";
                }     
            }
            function openNRead($file){
                echo "<h2>Please find the content of the upload file below:</h2>";
                $words = "";
                $file = fopen($file,"r") or exit("Unable to open file!");
                while(!feof($file)){
                    $line = fgets($file);
                    $words = $words.$line;
                    echo $line."<br>";
                }
                fclose($file);
                ext($words);
            }

            function ext($words){
                echo "<h3>Extracted words:</h3><div id='extracted'>";
                $patterns = array();
                $patterns[0] = "/\s(a|an|the|that|this|those|these|is|am|are|isn't|aren't|not|has|have|had|hasn't|haven't|hadn't|will|won't|shall|after|in|to|on|with|into)\s/";
                $patterns[1] = "/\d/";
                $patterns[2] = "/'s|s'|'re|'ll|\#|\%|\&|\*|\!|\?|\.|,|\\\/";
                echo strtolower(preg_replace($patterns, ' ', $words));
                echo "</div><br>";
                echo "<button onclick='getFreq();'>Display Frequency</button>";
                echo "<div id='result'></div>";
            }
        ?>
    </body>
    <script>
        function getFreq() {
            var result = document.getElementById("result");
            var str = document.getElementById("extracted");
            result.innerHTML = "<h3>Table of words and frequencies of the uploaded file</h3>";
            if (window.XMLHttpRequest) {// code for IE,Firefox,Chrome,Opera,Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState ==4 && xmlhttp.status==200) {
                    result.innerHTML = result.innerHTML+xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "getfreq.php?str=" + str.innerText, true);
            xmlhttp.send();
        }
    </script>
</html>
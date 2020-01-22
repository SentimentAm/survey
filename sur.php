<head runat="server">
    <title></title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
</script> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
      input[type="text"], textarea {

  background-color : #5cb85c; 

}
  </style>
</head>
<body>
    <?php
function generate_data(){
    $lines = array();
    if ($fh = fopen('124.csv', 'r')) {
            while (!feof($fh)) {
                $line = fgets($fh);
                array_push($lines, $line);
    } 
    fclose($fh);
    return $lines;
}
}
function write_file($text, $result){
            $ans = $_POST['sentiment'];
            $uname = $_POST['uname'];
            $content = "\n" . $text . "," . $result . ',' . $uname;
            $fields = [$text, $result, $uname, $ans];
            $file = fopen('let.csv', 'a' );
            fputcsv( $file, $fields, ',', '"' );
            fclose( $file );
            return 0;
}

if(!isset($result)){
$lines = generate_data();
$row = 1;
$all_id = array();
if (($handle = fopen("let.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
            if(isset($_GET['username'])){
                if($data[2] == $_GET['username']){
                    array_push($all_id, $data[1]);
            }else{
                    array_push($all_id, 0);
            }
            }
            else{
                if($data[2] == $_POST['uname']){
                    array_push($all_id, $data[1]);
                }else{
                    array_push($all_id, 1);    
                }               
            }
        }
    }
    fclose($handle);
    $u_all_id = array_unique($all_id);
    $result = max($u_all_id);
    $text = $lines[$result];
    $text = explode(",", $text);
    $text = $text[0];
    if($result == 8){
                            header("Location: final.php ");
                            exit;
                            return 0;

    }

}
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $result = (int)$_POST['txt'];
        $lines = generate_data();
    if($result>10){
        header("Location: final.php ");
        exit;
        return 0;
    }
        if($result==10){
            echo "Thank you for filling the form";
            return 0;
        }
         $h = $result;
         $text = $lines[$result];
         $text = explode(",", $text);
         $text = $text[0];
        if(isset($_POST['sentiment'])){
            write_file($text, $result);
            $result = $result + 1;
            if((int)$_POST['txt'] == 8){
                     header("Location: final.php ");
                            exit;
                            return 0;
            }
            $text = $lines[$result];
            $text = explode(",", $text);
            $text = $text[0];
            $fp = fopen("123.txt", 'a');//opens file in append mode  
            fwrite($fp, ";");  
            fclose($fp); 

        

        
}else{
            $error = "Please choose one button";
            $text =  $_POST['tweet'];
}
        }
    if(isset($_POST['uname'])){
         $uname = $_POST['uname'];

    }
    
    ?>
            <div id="mytext">
                 
            </div>
            <div class="card text-center border border-danger" style="width: 50rem; margin: 0 auto; float: none;  margin-bottom: 10px; background-color: #5cb85c;">
            <div id="myform card-body" style="width: 50rem; margin: 0 auto; float: none;  margin-bottom: 10px; margin-top: 10%">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <textarea name="tweet" style="border: none; resize: none; font-size: 34px; line-height: 1.5; color: white; text-align: justify;" disabled><?php if(isset($text)){echo $text;}?></textarea><br>
            <input type="text" name="uname" style="display: none; background-color: #5cb85c;" value=<?php if(isset($_GET['username'])){echo $_GET['username'];}else if(isset($uname)){echo $uname;}?>>
            <textarea name="txt" rows="4" cols="50" id="txts" style="display: none;">
            <?php if(isset($result)){echo $result;}else{echo 1;}?></textarea>
            <label class="radio-inline" style="color: white"><input class="radio-inline" id="pos" type="radio" name="sentiment" value="positive">Positive</label>
            <label class="radio-inline" style="color: white"><input class="radio-inline" id="neg" type="radio" name="sentiment" value="negative">Negative</label>
            <label class="radio-inline" style="color: white"><input class="radio-inline" id="neu" type="radio" name="sentiment" value="nuetral"> Neutral</label>
            <label class="radio-inline" style="color: white; "><input class="radio-inline" id="mix" type="radio" name="sentiment" value="mixed"> Mixed </label>
            <?php if(isset($error)){echo $error;}?><br><br>
            <button type="submit" class="btn btn-lg btn-primary" name="file" id="file" style="margin: 10%;">Save</button>
        </form>
            </div>
        </div>
    </form>
</body>

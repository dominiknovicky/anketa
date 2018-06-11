<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        $send = $_GET['buttonSend'];
        $checkbox = $_GET['checkbox'];
        $anketa = $_GET['anketa'];

        if ($send) {
            if ($anketa) {

                if ($checkbox) {
                    $dotaz = "update jazyky set ".$anketa."=".$anketa."+1";
                    $conn = mysqli_connect("localhost:3306", "root", "", "anketa");
                    if(!$conn){
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    if ($_COOKIE['clickedPHP'] == true) {
                        echo "You have already voted";
                    }
                    else {

                        if($conn->query($dotaz) == true) {
                            echo "<h1 style='font-size: 20px; font-weight: bold; padding: 15px 0'>Thanks for voting<h1>";

                            $dotaz = "select * from jazyky";
                            $conn = mysqli_connect("localhost:3306", "root", "", "anketa");
                            $result = $conn->query($dotaz);
                            if ($result->num_rows > 0) {
                                setcookie("clickedPHP", true);

                                while($row = $result->fetch_assoc()) {
                                    $res = $row["javascript"]+$row["java"]+$row["c"]+$row["mysql"]+$row["html"];
                                    $javascript = number_format($row["javascript"]/$res, 3)*100;
                                    $java = number_format($row["java"]/$res, 3)*100;
                                    $c = number_format($row["c"]/$res, 3)*100;
                                    $mysql = number_format($row["mysql"]/$res, 3)*100;
                                    $html = number_format($row["html"]/$res, 3)*100;
                                    echo "<div>
                                    <div>
                                    <span style='width:100px; display:inline-block'>JavaScript:</span>
                                    <div class='jazyk' style='width:".$javascript."%;height:10px;background:black; display:inline-block; border-radius:5px'></div> ".$javascript."%
                                    </div>

                                    <div>
                                    <span style='width:100px; display:inline-block'>Java:</span>
                                    <div class='jazyk' style='width:".$java."%;height:10px;background:darkgreen; display:inline-block; border-radius:5px'></div> ".$java."%
                                    </div>

                                    <div>
                                    <span style='width:100px; display:inline-block'>C:</span>
                                    <div class='jazyk' style='width:".$c."%;height:10px;background:red; display:inline-block; border-radius:5px'></div> ".$c."%
                                    </div>

                                    <div>
                                    <span style='width:100px; display:inline-block'>MySQL:</span>
                                    <div class='jazyk' style='width:".$mysql."%;height:10px;background:darkblue; display:inline-block; border-radius:5px'></div> ".$mysql."%
                                    </div>

                                    <div>
                                    <span style='width:100px; display:inline-block'>HTML:</span>
                                    <div class='jazyk' style='width:".$html."%;height:10px;background:orange; display:inline-block; border-radius:5px'></div> ".$html."%
                                    </div>"
                                    ."</div>";
                                }
                            } else {
                                echo "0 results";
                            }
                        }
                    }
                }
                else {
                    echo 'Je potrebne suhlasit so spracovanim osobnych udajov.';
                }
            }
            else {
                echo 'Vyberte jednu z moznosti.';
            }
        }

    ?>
</body>
</html>
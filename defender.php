<?php require_once ("config.php");?>
<?php
    session_start(); 

    function writeMsgt($conn,$sql) {        
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()){
            $id = $row['id'];            
            $value = 0;  
            echo '<tr>                   
                    <td>'.$row['id'].'</td>
                    <td>'.$row['Name'].'</td>
                    <td>'.$row['Position'].'</td>
                    <td>'.$row['Country'].'</td>
                    
                                                                     
                    <td>                        
                        <button class="btn btn-success btn-sm" name = "button0">
                            <a href = "defender.php?addid='.$id.'" class="text-light" style="font-weight:bold">     
                                Add Player
                            </a>
                        </button>
                    </td>
                </tr>';
        }
    }
                    

    if (isset($_GET['addid'])){
        $id = $_GET['addid'];
        $name = $_SESSION['name'];
        $sqlF = "Select * FROM `$name` where Position='defender'";
        
        $resultF = mysqli_query($conn,$sqlF);
        if ((mysqli_num_rows($resultF)<=3)) {
            $sql = "INSERT INTO  `$name` (Name, Position,Country,id) SELECT Name, Position,Country,id FROM `players` where id =$id;";
            try{

                $result = mysqli_query($conn,$sql);
                if ($result ){  

                    header('location:defender.php');
            }}
            catch (Exception $e ){
                echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "Cant add same player",
                            
                            type: "warning",
                        }, function() {
                            window.location.href= "defender.php";
                        });
                    }, 1000);
            </script>';
            }
        
        }
        else{
            echo    '<script>
                        setTimeout(function() {
                            swal({
                                title: "All 4 out of 4 Member has been added",
                                text : " You cant add more member! ",
                                type: "success",
                            }, function() {
                            window.location = "goalkeeper.php";
                            });
                        }, 1000);
                    </script>';
        }
        
       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="team_create_backgroun1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <title> Fantasy Team Selection</title>
</head>

<body>
    
    <div class='bg'style="height:133% ;">
        <div>
            <header>Team Creation</header>
            
        </div>
        
        
        <div class="column3">
            <h2 style='font-family:"myFirstFont"; background-color:#500808; font-weight: 200px;margin-bottom:1.9%;width:50%; margin-left:27%;'>Defender(
                
                <?php 
                    $nam1 = $_SESSION['name'];
                    $sqlF = "Select * FROM `$nam1` where Position='Defender'"; 
                    $resultF = mysqli_query($conn,$sqlF);
                    echo mysqli_num_rows($resultF);
                ?>
            out of 4  )</h2>
            
        
            </h2>
            <table class = 'content-table' style="background-color: aliceblue;font-family:'myFirstFont';margin-left: -400px;margin-right: -400px;">
                <thead class= 'class="p-3 mb-2 bg-dark text-white'>
                    <tr>
                        <th >Player ID</th>
                        <th >Name</th>  
                        <th>Position</th>
                        <th >Country</th>
                        
                        
                        
                                                                           
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>

                    <?php           
                        $sql = "Select * FROM `players` where Position='Defender'";
                        writeMsgt($conn,$sql);
                    ?>
                    
                </tbody>
                <!---- ---------------------------------------------------  -->
            </table>
        </div>

        <div>
            <button class="btn btn-success btn-lg" onclick="location.href='goalkeeper.php'" type="button" style="width: 12% ; font-weight:bold;font-family:'myFirstFont'; font: weight 80%; margin-left: 60%; margin-bottom:5% ;background-color:#500808;">
                NEXT
            </button>
        </div>
        <div >
        <button class="btn btn-success btn-lg" onclick="location.href='mid_fielder.php'" type="button" style="width: 12% ; font-weight:bold;font-family:'myFirstFont'; font: weight 80%; margin-left: 28%;margin-top:-13.5%; background-color:#500808;" >
                Previous
            </button>
        </div>    
    
    </div> 
  
</body>
</html>







<?php
    
    include 'db_connection/connection.php';
    if(isset($_POST['uemail']) && isset($_POST['upass']) 
       && !empty($_POST['uemail']) && !empty($_POST['upass'])  ){
    
        
        $var1=($_POST['uemail']);
        $var2=($_POST['upass']);
        
        
        
        try{
            
            
            $sqlquery="SELECT * FROM users WHERE email='$var1' AND password='$var2'";
            
            
            try{
                $returnval=$dbcon->query($sqlquery);

                if($returnval->rowCount()==1){
                    
                    session_start();
                    
                    $_SESSION['useremail']=$var1;
                    
                    $userData = $returnval->fetch();
                    $_SESSION['usertype'] = $userData['user_type'];
                    $_SESSION['userId'] = $userData['id'];


                    ?>
                        <script>
                            window.location.assign('homepage.php');
                        </script>
                    <?php
                }
                else{

                    
                    ?>
                        <script>
                            window.location.assign('login.php');
                        </script>
                    <?php
                }
            }
            catch(PDOException $ex){

                ?>
                    <script>
                        window.location.assign('login.php');
                    </script>
                <?php
            }
        }
        catch(PDOException $ex){

            ?>
                <script>
                    window.location.assign('login.php');
                </script>
            <?php
        }
        
    }
    else{
        
        ?>
            <script>
                window.location.assign('login.php');
            </script>
        <?php
    }
?>
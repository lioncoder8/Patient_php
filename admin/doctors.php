<?php 
    include("../default/admin/header.php"); 
    include("../default/admin/doctors_title.php")
?>

    <!-- main content start -->
    <div class="w3-main container" style="margin-left:400px">
        
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">
                            <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
                            All Doctors (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
               
               <tr >
                   <td colspan="2">
                       <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">
                           
                            Add New Doctor
                        </p>
                   </td>
                   <td colspan="2">
                       <a href="?action=add&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Add New</font></button>
                           </a></td>
               </tr>
                <tr >
                    <td width="13%">
                        <a href="doctors.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="doctors">';

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["docname"];
                                    $c=$row00["docemail"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
                            ?>
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Kolkata');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from doctor where docemail='$keyword' or docname='$keyword' or docname like '$keyword%' or docname like '%$keyword' or docname like '%$keyword%'";
                    }else{
                        $sqlmain= "select * from doctor order by docid desc";

                    }



                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Doctor Name
                                
                                </th>
                                <th class="table-headin">
                                    Email
                                </th>
                                <th class="table-headin">
                                    Specialties
                                </th>
                                <th class="table-headin">
                                    Events
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $docid=$row["docid"];
                                    $name=$row["docname"];
                                    $email=$row["docemail"];
                                    $spe=$row["specialties"];
                                    $spcil_res= $database->query("select sname from specialties where id='$spe'");
                                    $spcil_array= $spcil_res->fetch_assoc();
                                    $spcil_name=$spcil_array["sname"];
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($name,0,30)
                                        .'</td>
                                        <td>
                                        '.substr($email,0,20).'
                                        </td>
                                        <td>
                                            '.substr($spcil_name,0,20).'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=edit&id='.$docid.'&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=view&id='.$docid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id='.$docid.'&name='.$name.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
                                        </div>
                                        </td>
                                    </tr>';
                                    
                                }
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    <?php 
    if($_GET){
        
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='drop'){
            $nameget=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>('.substr($nameget,0,40).').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-doctor.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='view'){
            $sqlmain= "select * from doctor where docid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["docname"];
            $email=$row["docemail"];
            $spe=$row["specialties"];
            $proc=$row["procedures"];
            
            $spcil_res= $database->query("select sname from specialties where id='$spe'");
            $spcil_array= $spcil_res->fetch_assoc();
            $spcil_name=$spcil_array["sname"];

            $proc_res= $database->query("select sname from specialties where id='$proc'");
            $proc_array= $proc_res->fetch_assoc();
            $proc_name=$proc_array["sname"];

            $tele=$row['doctel'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            eDoc Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialties: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$spcil_name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Procedures: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$proc_name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                </td>
                            </tr>

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif($action=='add'){
                $error_1=$_GET["error"];
                $errorlist= array(
                    '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                    '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                    '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                    '4'=>"",
                    '0'=>'',

                );
                if($error_1!='4'){
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                        <a class="close" href="doctors.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">'.
                                    $errorlist[$error_1]
                                .'</td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Doctor.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <form action="add-new.php" method="POST" class="add-new-form">
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Doctor Name" required><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" required><br>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Choose specialties: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="spec" id="specChange" class="box" onchange = "showSpecial(this.value)"><option value="0"></option><br/>';
                                        $list11 = $database->query("select  * from  specialties where choose_type='s' order by id asc;");
       
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["sname"];
                                            $id00=$row00["id"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };
                                    echo'</select><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Choose Procedures:</label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="prod" id="prodChange" class="box"><option value="0"></option><br/>';
                                        
                                        $list11 = $database->query("select  * from  specialties where choose_type='p' order by id asc;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row001=$list11->fetch_assoc();
                                            $pn=$row001["sname"];
                                            $id001=$row001["id"];
                                            $id002=$row001["choose_id"];
                                            echo "<option class = 'specialpoint' data-sort = ".$id002." value=".$id001.">$pn</option><br/>";
                                        };

                                    echo'</select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                </td>
                            </tr><tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Conform Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                </td>
                            </tr>
                            
                
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Add" class="login-btn btn-primary btn">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';

            }else{
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            <br><br><br><br>
                                <h2>New Record Added Successfully!</h2>
                                <a class="close" href="doctors.php">&times;</a>
                                <div class="content">
                                    
                                    
                                </div>
                                <div style="display: flex;justify-content: center;">
                                
                                <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
        ';
            }
        }elseif($action=='edit'){
            $sqlmain= "select * from doctor where docid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["docname"];
			$prod=$row["procedures"];
            $email=$row["docemail"];
            $spe=$row["specialties"];
            
			$spcil2_res= $database->query("select pname from procedures where id='$prod'");
            $spcil2_array= $spcil2_res->fetch_assoc();
            $spcil2_name=$spcil2_array["pname"];
			
            $spcil_res= $database->query("select sname from specialties where id='$spe'");
            $spcil_array= $spcil_res->fetch_assoc();
            $spcil_name=$spcil_array["sname"];
            $tele=$row['doctel'];

            $error_1=$_GET["error"];
                $errorlist= array(
                    '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                    '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                    '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                    '4'=>"",
                    '0'=>'',

                );

            if($error_1!='4'){
                    echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="doctors.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">'.
                                            $errorlist[$error_1]
                                        .'</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Doctor Details.</p>
                                        Doctor ID : '.$id.' (Auto Generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-doc.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="'.$id.'" name="id00">
                                            <input type="hidden" name="oldemail" value="'.$email.'" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="'.$email.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="'.$name.'" required><br>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Telephone: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="'.$tele.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Choose specialties:</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <select name="spec" id="e_specChange" class="box" onchange = "change_edit(this)"><option value="0"></option><br/>';
                                            $list11 = $database->query("select  * from  specialties where choose_type='s' order by id asc;");
                                            for ($y=0;$y<$list11->num_rows;$y++){
                                                $row00=$list11->fetch_assoc();
                                                $sn=$row00["sname"];
                                                $id00=$row00["id"];
                                                echo "<option value=".$id00." ".($sn==$spcil_name?'selected':'').">$sn</option><br/>";
                                                if($sn==$spcil_name)$idset = $id00;
                                            };
                                            echo '</select><br><br>
                                        </td>
                                    </tr>
									
									<tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Choose Procedures: </label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="prod" id="e_prodChange" class="box"><option value="0"></option><br/>';
                                                                                       
                                            $list11 = $database->query("select  * from  specialties where choose_type='p' order by id asc;");

                                            for ($y=0;$y<$list11->num_rows;$y++){
                                                $row001=$list11->fetch_assoc();
                                                $pn=$row001["sname"];
                                                $id001=$row001["id"];
                                                $id002=$row001["choose_id"];
                                                echo "<option class = 'e_specialpoint' data-sort = "
                                                .$id002." value=".$id001." ".($prod==$id001?'selected':'')
                                                .">$pn</option><br/>";
                                            };
                                            echo '</select><br><br>
                                        </td>
                                    </tr>
									
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">Conform Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
        }else{
            echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Edit Successfully!</h2>
                            <a class="close" href="doctors.php">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';



        }; };
    };

?>
</div>

<script>
    change_edit();
    showSpecial(0);
    var specChange = document.getElementById("specChange");
    
    // specChange.onchange = function() {showSpecial(this.value)};
    function showSpecial(params) {
        var specialpoints = document.querySelectorAll(".specialpoint");
        for (let i = 0; i < specialpoints.length; i++) {
            if (specialpoints[i].dataset.sort == params) {
                specialpoints[i].style.display = "";
            } else {
                specialpoints[i].style.display = "none";
            }
        }
        if (document.getElementById("prodChange")) {
            document.getElementById("prodChange").value = "0";
            
        }
    }
    function change_edit(e = -1) {
        var e_specChange = document.getElementById("e_specChange");
        if (e_specChange) {
            var e_specialpoints = document.querySelectorAll(".e_specialpoint");
            for (let i = 0; i < e_specialpoints.length; i++) {
                if (e_specialpoints[i].dataset.sort == e_specChange.value) {
                    e_specialpoints[i].style.display = "";
                } else {
                    e_specialpoints[i].style.display = "none";
                }
            }
            if (document.getElementById("e_prodChange") && e !=-1) {
                document.getElementById("e_prodChange").value = "0";
            }
        }
    }
</script>
    <!-- footer script start -->
    <?php include("../default/doctor/footer.php") ?>
<?php include '../../database_connection.php';?>
<?php
 session_start();
$company_id = $_SESSION['company_id'];
?>




                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Meeting Chariman</th>
                                                <th>Meeting member</th>
                                                <th>Meeting Date</th>
                                                <th>Meeting Location</th>
                                                <th>Meeting Status</th>
                                                 <th>Edit Meeting</th>
                                                <th>Delete Meeting</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $allUserSql = "SELECT * FROM meetings mt left join committees cm on cm.id=mt.committee_id WHERE mt.company_id='$company_id'";
                                                $allUserQuery = mysqli_query($connect,$allUserSql);
                                                $sl = 1;
                                                while($allUserData = mysqli_fetch_array($allUserQuery)){
                                                    $meeting_id=$allUserData['meeting_id'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sl++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allUserData['title']; ?>
                                                        </td>
                                                        <!-- <td>
                                                            <?php echo $allUserData['description']; ?>
                                                        </td> -->
                                                         <td>
                                                        <?php 
                                                            $committeeChairman = $allUserData['chairman_id'];
                                                            $userListSqlC = "SELECT name from users where id in ($committeeChairman)";
                                                            $userListQueryC = mysqli_query($connect,$userListSqlC);
                                                            while($userListDataC = mysqli_fetch_array($userListQueryC)){
                                                                ?>
                                                                    <span class="btn btn-sm btn-round btn-danger mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo $userListDataC['name'];  ?></span>
                                                                <?php
                                                            }

                                                        ?>
                                                        </td>
                                                        <td>
                                                        <?php 
                                                            $committeeUsers = $allUserData['committee_users'];
                                                            $userListSql = "SELECT name from users where id in ($committeeUsers)";
                                                            $userListQuery = mysqli_query($connect,$userListSql);
                                                            while($userListData = mysqli_fetch_array($userListQuery)){
                                                                ?>
                                                                    <span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo $userListData['name'];  ?></span>
                                                                <?php
                                                            }

                                                        ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allUserData['meeting_date']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allUserData['location']; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($allUserData['is_open']==0) { ?>
                                                                <span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo "Open";  ?></span>

                                                                <?php
                                                            }else
                                                            {
                                                                ?>
                                                            
                                                                <span class="btn btn-sm btn-round btn-danger mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo "Closed";  ?></span>
                                                            <?php
                                                        }
                                                            ?>
                                                        </td>
                                                         <td>
                                                            <button class="btn btn-sm btn-success edit_data_class"   style="float:right;" id="<?php print $meeting_id;?>">  <span>Edit</span>
                                                            </button>
                                                         </td>
                                                         <td>
                                                            <button class="btn btn-sm btn-danger delete_data_class" style="float:right;" id="del_<?php print $meeting_id;?>"><span>delete</span>
                                                            </button>
                                                        </td>
                                                        <!-- <td>
                                                        <?php 
                                                            $entry_user_id = $allUserData['entry_user_id'];
                                                            $userListSqlE = "SELECT name from users where id in ($entry_user_id)";
                                                            $userListQueryE = mysqli_query($connect,$userListSqlE);
                                                            while($userListDataE = mysqli_fetch_array($userListQueryE)){
                                                                ?>
                                                                    <span class="btn btn-sm btn-round btn-danger mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo $userListDataE['name'];  ?></span>
                                                                <?php
                                                            }

                                                        ?>
                                                        </td>
                                                         <td>
                                                            <?php echo $allUserData['create_at']; ?>
                                                        </td> -->
                                                    </tr>
                                                    <?php
                                                }

                                            ?>  
                                           
                                        </tbody>
                                   
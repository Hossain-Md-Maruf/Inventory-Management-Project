<?php
session_start();
include ('navigation.php');
$conn=connect();

    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));
if(isset($_POST['submit'])){
	$uname = $_POST['uname'];
    $sql= "SELECT * from users_info where name='$uname'";
    $res= $conn->query($sql);
	?>
    <h2>hdgfdgfdhf</h2>
<div id="list2">
                        <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead class="thead-light">
                            <tr>
                                <th data-field="date" data-filter-control="select" data-sortable="true">User</th>
                                <th data-field="examen" data-filter-control="select" data-sortable="true"> Email</th>
                                <?php
                                    if($thisUser['is_admin']==1){
                                        echo '<th data-field="note" data-sortable="true">Is Active</th>';
                                    }
                                ?>
                                <th data-field="note" data-sortable="true">Last Login Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(mysqli_num_rows($res)>0) {
                                while ($row = mysqli_fetch_assoc($res)) {

                                    echo '<tr>';
                                    echo '<td>'. $row['name'].'</td>';
                                    echo '<td>'. $row['email'].'</td>';
                                    if($thisUser['is_admin']==1) {
                                        if($row['is_active']=='1'){
                                            $active= "Active";
                                        } else{
                                            $active= "Inactive";
                                        }
                                        echo '<td>' . $active . '</td>';
                                    }
                                    echo '<td>'. date("Y-m-d h:i:sa",strtotime($row['last_login_time'])).'</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                        </div>
                        <?php 
}
?> 
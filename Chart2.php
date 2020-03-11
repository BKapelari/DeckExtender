<?php

OCP\User::checkLoggedIn();
$sUser = OCP\User::getUser();

/**
 * Nextcloud - Dashboard Charting app
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Mark Partlett <mark@partlettconsulting.com.au>
 * @copyright 2019, Mark Partlett <mark@partlettconsulting.com.au>
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
?>


<style>
.widget-content .front{
    overflow: auto !important
}

</style>

<div class="widget-deck " id="widget-deck-today">



    <?php 




?>



<?php 


$servername = "localhost:3306";
$username = "user";
$password = 'pass';
$dbname = "db";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$today = date('Y-m-d');
$today_start = "1990-01-01 00:00:00";
$today_end = $today." 23:59:59";




$sql = "SELECT id, title, duedate, stack_id FROM `oc_deck_cards` WHERE `duedate` BETWEEN '".$today_start."' AND '".$today_end."' AND id IN (SELECT card_id FROM oc_deck_assigned_users WHERE `participant` = '".$sUser."') AND NOT `deleted_at` AND NOT `archived`";

$cards = $conn->query($sql);

$sql = "SELECT id, board_id FROM `oc_deck_stacks`";
$stacks = $conn->query($sql);
$board = [];
while($stack = $stacks->fetch_assoc()) {
    $board[$stack['id']] = $stack['board_id'];
}

$sql = "SELECT id, title, color FROM `oc_deck_boards`";
$result = $conn->query($sql);

while($row = $result->fetch_array()){
    $boards[$row['id']] = $row;
}

$conn->close();

function remove_numbers($string) {
    $num = array(0,1,2,3,4,5,6,7,8,9,' ');
    return str_replace($num, null, $string);
}


//print_r($board);

?>



        <div class="content-wrapper">
            <p>Nutzer: <?=$sUser?> <br>Datum: <?=$today?></p>
        

            <div class="task-list">
                <div class="grouped-tasks">
                    <ol class="tasks" type="list">

<?php  

if ($cards->num_rows > 0) {
    // output data of each row
    while($row = $cards->fetch_assoc()) {
        $board_id = $board[$row['stack_id']];
        
        
        ?>

                        <li class="task-item sortable-chosen">
                            <div class="task-body">
                                <div style="color:#fff; width:34px; line-height:34px; text-transform:uppercase; height:100%; background-color:#<?=$boards[$board_id]['color']?>;">
                                    <div>
                                        <?php 
                                        $num = remove_numbers($boards[$board_id]['title']);
                                        echo substr($num,0,3); ?>
                                    </div>
                                </div>
                                <div class="task-info">
                                    <div class="title">
                                        <a href="https://cloud.domain.com/apps/deck/#!/board/<?=$board_id?>//card/<?=$row['id']?>" target="_blank">
                                            <?= $row['title'] ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="task-body-icons">
                                    <div class="task-status-container">
                                        <!---->
                                    </div>
                                    <!---->
                                    <div class="duedate <?php if($today != date("Y-m-d", strtotime($row['duedate']))): echo " overdue"; endif;?>">
                                    <?= $row['duedate'] ?>
                                    </div>
                                    <!---->
                                    <!---->
                                    <!---->

                                </div>
                            </div>
                        </li>

                        <?php
    }
} else {
    echo "0 results";
}



?>
                    </ol>

            </div>
        </div>
    </div>
</div>
<div class="widget-chart1b" id="widget-chart1b">

</div>
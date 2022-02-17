<?php
session_start();
require('Include/header.php');
require('Class/User.php');
require('Class/Reservation.php');

    // $now = date('Y-m-d h:i:s',strtotime("yesterday"));

    

$test = new Reservation();
// $getDebut = $test->getDebut($debut);

    $now = date('Y-m-d h:i:s',strtotime("yesterday"));
    var_dump($now);
    




if(!empty($_GET['week']))
{
    $week = $_GET['week'];
}
else
{   
    $week = 0;
}
$i=0;
$j=0;
$temps_anterieur = strtotime(date('Y-m-d h:i:s',strtotime("Monday this week +$i days + weeks $j:00:00")));


?>

<main>
    <section>
        <form action="" method="get">
            <button style ="background:green">suivant</button>
            <input type="hidden" value="<?= $week + 1 ?>" name="week">
        </form>

        <form action="" method="get">
            <button style ="background:green">précédent</button>
            <input type="hidden" value="<?= $week - 1 ?>" name="week">
        </form>         

        <table>
            <thead>
                <th></th>
                <?php 
            
                for($i=0  ;$i<7; $i++): ?>
                    <th><?= $dateFrench = $test->formatDate($i,$week);?></th>
                <?php endfor; ?>
            </thead>

            <tbody>
                <?php for ($j = 8; $j <=19; $j++ ): ?>
                    <tr>
                            <td><?= $j. ":00"?></td>
                        
                        <?php
                            for ($i=0; $i < 7;$i++)
                            {
                                
                                $date_debut = date('Y-m-d h:i:s',strtotime("Monday this week +$i days +$week weeks $j:00:00"));

                                $showResa = $test->showResa(date('Y-m-d',strtotime('Monday this week +'.$i."days +$week weeks")).' '.$j.':00:00'); 

                                if (!empty($showResa))
                                {  ?>
                                    <td style="background:purple";>
                                        <a href="reservation.php?id=<?=$showResa[0]['id']?>>">
                                            <?= $showResa[0]['login'].' '.$showResa[0]['titre']?>
                                        </a> 
                                    </td> 
                                <?php
                                }
                                else if ($i > 4 )
                                {
                                    ?>
                                    <td style ="background:red";></td>
                                <?php
                                }
                                else if ($date_debut <= $now)
                                { ?>

                                    <td style ="background:yellow";>
                                        <span>Indisponible</span>
                                    </td>
                                   
                                   <?php 
                                }
                                else
                                {  
                                    ?>
                                 
                                    <td style ="background:green";>
                                        <form action="reservation-form.php" method="get">
                                            <button type="submit" name="date" value="<?=$date_debut?>"style ="background:green">LIBRE</button>
                                        </form>
                                    </td>
                                <?php
                                }
                            }  
                        ?>
                            
                    </tr>
                <?php endfor;?>
            </tbody>    
        </table>
    </section>
</main>        

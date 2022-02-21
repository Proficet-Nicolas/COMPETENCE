<div class="collab">
   <form class="mainscreen" method="post" action="index.php">  
    <div class="tablecompetences">
        <table class="situations"style="width: 100%;">
            <tr class="topLine">
                <td class="situations" style="font-size:20px; text-align:center; width:40%; color:white;">Compétences</td>
            </tr>
            <?php
                $dataActivites = getActivites();

                while ($dataA = $dataActivites->fetch()) {
                    echo "
                        <tr>
                            <td style='padding:0px; text-align:left;' class='situations'>
                            <div style='text-align:center; border-bottom: 1px solid black; background-color:lightgrey; padding:5px;'> B" . $dataA["id_bloc"] . ".A" . $dataA["drawID"] . " - " . $dataA["nom"] . "</div>";

                    $dataCompetences = getCompetences($dataA["id_activite"], $dataA["id_bloc"]);
                    while ($dataC = $dataCompetences->fetch()) {
                        $isCompetencesUsedSituation = isCompetencesUsedSituation($dataC["id_competence"], $_GET["id_situation"]);
                        $isUsed = "white;";
                        $isChecked = ""; 

                    while ($dataC2 = $isCompetencesUsedSituation->fetch()) {
                        if(isset($dataC2)) {
                            $isUsed = "rgb(169, 230, 174)";
                        }
                    }

                        echo "<div style='margin: 0px; padding:5px; background-color:" . $isUsed . "'>B"  . $dataA["id_bloc"] . ".A" . $dataA["drawID"] . ".C" . $dataC["drawID"]. " - " . $dataC["nom"] . "</div>";
                    }
                }
                echo "</td>";
            ?>
            </tr>
        </table>
    </div>
</form>


<?php
function get_political_bias($political_points) { ?>
    <i class="fas fa-bullseye"></i> Posizionamento Politico<br>
    <div class="bar-container political-bias-bar">
        <div class="triangle" style="left:<?php echo $political_points; ?>%;"></div>
    </div>
<?php }



function get_political_bias_big($political_points) { ?>
    <i class="fas fa-bullseye"></i> Posizionamento Politico<br>
    <div class="bar-container political-bias-bar" style="width:300px">
        <div class="triangle" style="left:<?php echo $political_points; ?>%;"></div>
    </div>
<?php }

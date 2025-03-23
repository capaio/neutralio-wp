<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script>
    function toggleComment(id) {
        var comment = document.getElementById('ai-comment-' + id);
        comment.classList.toggle('collapsed');
        var toggleButton = document.getElementById('toggle-button-' + id);
        if (comment.classList.contains('collapsed')) {
            toggleButton.textContent = 'Leggi tutto';
        } else {
            toggleButton.textContent = 'Mostra meno';
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        var comments = document.querySelectorAll('.ai-comment');
        comments.forEach(function(comment) {
            comment.classList.add('collapsed');
        });
    });
</script>

<style>
    .score-card {
      width: 100%;
      max-width: 300px;
      height: 40px;
      /*background-color: rgb(202, 137, 77);*/
      color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 5px 5px;
      box-sizing: border-box;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .score-card:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .left {
      font-size: 0.8rem;
      font-weight: 600;
      text-align: left; /* Align title to the left */
    }

    .right {
      font-size: 0.9em;
      font-weight: bold;
      text-align: right; /* Align score to the right */
    }

    .emoji {
      font-size: 1.0rem;
      margin-bottom: 4px;
    }

    .score-text {
      font-size: 0.9em;
      font-weight: bold;
      line-height: 1;
    }

    .score-text small {
      font-size: 0.6rem;
      opacity: 0.8;
    }

    .fa-star, .fa-check-double, .fa-balance-scale, .fa-language, .fa-dollar-sign, .fa-book-open {
      color: #fff; /* Set icons to white */
    }

    @media (max-width: 768px) {
        .neut-card-image-desktop {
            display: none;
        }
        .neut-card-image-mobile {
            display: none;
        }
    }

    @media (min-width: 769px) {
        .neut-card-image-desktop {
            display: block;
        }
        .neut-card-image-mobile {
            display: none;
        }
    }

    .tooltip {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }

    .tooltip .tooltiptext {
      visibility: hidden;
      width: 200px;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -100px;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
      content: '';
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
      visibility: visible;
      opacity: 1;
    }

  </style>

<div class="news-card">
    <div class="newspaper-stripe">
        <div class="newspaper-info">
            <img class="neut-card-image-desktop" style="margin-bottom:0px!important" src="<?php echo esc_url($news->newspaper_logo); ?>" alt="Logo">
            <div class="newspaper-name"><?php echo esc_html($news->newspaper_name); ?> <?php echo $bandiera ?? '' ?></div>
        </div>
    </div>
    <div class="row">
        <div class="column column-1-5">
            <img class="neut-card-image-mobile" style="margin-bottom:0px!important" src="<?php echo esc_url($news->img); ?>" alt="Logo">
            
            <div class="total-score" style="margin-top: 10px; width: 100%;">
                <div class="score-card" style="
                <?php
                    $hue = ($news->n_score / 100) * 120; // 0 = red, 120 = green
                    $backgroundColor = "hsl($hue, 70%, 45%)";
                    echo "background-color: $backgroundColor;";
                ?>">
                    <div class="left"><i class="fas fa-star"></i> N Score: </div>
                    <div class="right">
                        <?php echo round($news->n_score); ?><small>/100 </small> 
                        <div class="tooltip">
                            <i class="fas fa-question-circle"></i>
                            <span class="tooltiptext">NScore è il punteggio che Neutralio assegna a ciascuna notizia. Esso è calcolato sulla base di un algoritmo. Tra i fattori tenuti in considerazione ci sono accuratezza, obiettività, bias. NScore varia da 0 a 100, dove 0 rappresenta la notizia meno affidabile e 100 la più affidabile.</span>
                        </div>
                    </div>
                </div>
            </div>
            
<!--            <div class="total-score" style="margin-top: 10px; width: 100%;">
                <div class="score-card" style="background-color:rgb(44, 98, 150);">
                    <div class="left"><i class="fas fa-check-double"></i> Completezza: </div>
                    <div class="right">
                        <?php echo round($news->completeness_score); ?><small>/100</small> 
                    </div>
                </div>
            </div>

            <div class="total-score" style="margin-top: 10px; width: 100%;">
                <div class="score-card" style="background-color:rgb(14, 52, 88);">
                    <div class="left"><i class="fas fa-balance-scale"></i> Bias: </div>
                    <div class="right">
                        <?php echo round($news->bias_score); ?><small>/100</small> 
                    </div>
                </div>
            </div>

            <div class="total-score" style="margin-top: 10px; width: 100%;">
                <div class="score-card" style="background-color: rgb(9, 36, 61);">
                    <div class="left"><i class="fas fa-language"></i> Ling: </div>
                    <div class="right">
                        <?php echo round($news->language_score); ?><small>/100</small> 
                    </div>
                </div>
            </div> -->

        </div>
        <div class="column column-4-5">
            <div class="news-title-row">
                <div class="news-title">
                    <?php echo esc_html($news->title); ?>
                </div>
            </div>
            <div id="ai-comment-<?php echo esc_attr($news->id); ?>" class="ai-comment">
                <p><strong>Completezza:</strong> <?php echo esc_html($ai_comment['completeness']); ?></p>
                <p><strong>Bias:</strong> <?php echo esc_html($ai_comment['bias']); ?></p>
                <p><strong>Linguaggio:</strong> <?php echo esc_html($ai_comment['language']); ?></p>
            </div>
            <div id="toggle-button-<?php echo esc_attr($news->id); ?>" class="toggle-button" onclick="toggleComment('<?php echo esc_attr($news->id); ?>')">Leggi tutto</div>
            <div class="category-scores">
                <div class="category_neut">
                    <i class="fas fa-check-double"></i> Completezza<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->completeness_score / 20)); ?>
                    </div>
                </div>
                <div class="category_neut">
                    <i class="fas fa-balance-scale"></i> Bias<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->bias_score / 20)); ?>
                    </div>
                </div>
                <div class="category_neut">
                    <i class="fas fa-pen"></i> Linguaggio<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->language_score / 20)); ?>
                    </div>
                </div>
            </div>
            <div class="dropdown" style="text-align: right;">
                <button style="background-color: <?php echo $news->is_paywall == 1 ? 'orange' : 'green'; ?>;">
                    <a href="<?php echo esc_url($news->url); ?>" target="_blank" style="color:#FFF">
                        <?php if ($news->is_paywall == 1) { ?>
                            Leggi (a pagamento) 💰 <i class="fa-solid fa-up-right-from-square"></i>
                        <?php } else { ?>
                            Leggi <i class="fa-solid fa-up-right-from-square"></i>
                        <?php } ?>
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>
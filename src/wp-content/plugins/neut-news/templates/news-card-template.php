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

<div class="news-card">
    <div class="newspaper-stripe">
        <div class="newspaper-info">
            <img style="margin-bottom:0px!important" src="<?php echo esc_url($news->newspaper_logo); ?>" alt="Logo">
            <div class="newspaper-name"><?php echo esc_html($news->newspaper_name); ?></div>
        </div>
    </div>
    <div class="row">
        <div class="column column-1-5">
            <img style="margin-bottom:0px!important" src="<?php echo esc_url($news->img); ?>" alt="Logo">
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
            <div id="toggle-button-<?php echo esc_attr($news->id); ?>" class="toggle-button" onclick="toggleComment('<?php echo esc_attr($news->id); ?>')">Mostra analisi</div>
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
                    <i class="fas fa-language"></i> Linguaggio<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->language_score / 20)); ?>
                    </div>
                </div>
            </div>
            <div class="total-score">
                <i class="fas fa-star"></i> NScore: <?php echo round($news->n_score); ?>/100
            </div>
            <div class="dropdown" style="text-align: right;">
                <button>
                    <a href="<?php echo esc_url($news->url); ?>" target="_blank" style="color:#FFF">Leggi</a>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="news-card">
            <div class="newspaper-stripe">
                <div class="newspaper-info">
                    <img style="margin-bottom:0px!important" src="<?php echo esc_url($news->newspaper_logo); ?>" alt="Logo">
                    <div class="newspaper-name"><?php echo esc_html($news->newspaper_name); ?></div>
                </div>
            </div>
            <div class="news-title-row">
                <div class="news-title">
                    <?php echo esc_html($news->title); ?>
                </div>
                <div class="dropdown">
                    <button>
                        <a href="<?php echo esc_url($news->url); ?>" target="_blank" style="color:#FFF">Read</a>
                    </button>
                </div>
            </div>

            <!-- Display Scores -->
            <div class="category-scores">
                <div class="category_neut">
                    <i class="fas fa-check-double"></i> Completeness<br>
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
                    <i class="fas fa-language"></i> Language<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->language_score / 20)); ?>
                    </div>
                </div>
            </div>

            <!-- Overall Score -->
            <div class="total-score">
                <i class="fas fa-star"></i> NScore: <?php echo round($news->n_score); ?>/100
            </div>

            <!-- AI Comment -->
            <div class="ai-comment">
                <p><strong>Completeness:</strong> <?php echo esc_html($ai_comment['completeness']); ?></p>
                <p><strong>Bias:</strong> <?php echo esc_html($ai_comment['bias']); ?></p>
                <p><strong>Language:</strong> <?php echo esc_html($ai_comment['language']); ?></p>
            </div>
        </div>
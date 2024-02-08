<?php
    /*
    =====================
        Components
    =====================
    */
    
    
    function button($label = 'Button', $href = '#', $target = '_self', $class = '')
    {
        return '<a class="button ' . $class . '" href="' . $href . '" target="' . $target . '"><span class="button__text">' . $label . '</span></a>';
    }
    
    function button_acf($link, $class = '', $customLabel = '')
    {
        if ($link):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            if ($customLabel) $link_title = $customLabel;
            return '<a class="button ' . $class . '" href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '"><span class="button__text">' . esc_html($link_title) . '</span></a>';
        endif;
    }
    
    
    function button_icon($label = 'Button', $href = '#', $target = '_self', $class = '')
    {
        return '<a class="buttonIcon ' . $class . '" href="' . $href . '" target="' . $target . '"><span class="buttonIcon__inner"><span class="buttonIcon__text">' . esc_html($label) . '</span><span class="buttonIcon__icon">' . get_inline_svg('icon-arrow.svg') . '</span></span></a>';
    }
    
    function button_icon_acf($link, $class = '', $customLabel = '')
    {
        if ($link):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            if ($customLabel) $link_title = $customLabel;
            return '<a class="buttonIcon ' . $class . '" href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '"><span class="buttonIcon__inner"><span class="buttonIcon__text">' . esc_html($link_title) . '</span><span class="buttonIcon__icon">' . get_inline_svg('icon-arrow.svg') . '</span></span></a>';
        endif;
    }
    
    function button_icon_bg_acf($link, $class = '', $customLabel = '')
    {
        if ($link):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            if ($customLabel) $link_title = $customLabel;
            return '<a class="buttonIconBg ' . $class . '" href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '"><span class="buttonIconBg__inner"><span class="buttonIconBg__text">' . esc_html($link_title) . '</span><span class="buttonIconBg__icon">' . get_inline_svg('icon-play.svg') . '</span></span></a>';
        endif;
    }
    
    function button_download_acf($file, $class = '', $customLabel = '')
    {
        if ($file):
            $link_url = $file['url'];
            $link_title = __('Download PDF', 'ibrigu');
            $link_target = '_blank';
            if ($customLabel) $link_title = $customLabel;
            return '<a class="button button--download ' . $class . '" href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '"><span class="button__inner"><span class="button__icon">' . get_inline_svg('icon-download.svg') . '</span><span class="button__text">' . esc_html($link_title) . '</span></span></a>';
        endif;
    }
    
    
    function icon_block_acf($icon, $label = '')
    {
        if ($icon) {
            return '<div class="icon-block"><span class="icon-block__icon"><img src="' . $icon['url'] . '"></span><span class="icon-block__label">' . $label . '</span></div>';
        }
    }

//ACF image
    function image_acf($image, $class = '')
    {
        if (!empty($image)): ?>
            <?php
            $imgWidth = $image['width'];
            $imgHeight = $image['height'];
            
            if ($image['mime_type'] === 'image/svg+xml') {
                $img = wp_get_attachment_image_src($image['id'], 'full');
                $imgWidth = $img[1];
                $imgHeight = $img[2];
            }
            
            $imgRatio = 100 * $imgHeight / $imgWidth;
            $blockPadding = 'padding-bottom:' . $imgRatio . '%;';
            if($imgWidth <= 960) {
                $blockMaxWidth = 'max-width:' . $imgWidth / (1920 / 2) * 100 . '%;';
            } else {
                $blockMaxWidth = 'max-width: 100%;';
            }
            ?>
            <div class="img-wrap" style="<?php echo $blockMaxWidth . ' ' . 'flex: 1;'?>">
                <div class="img-block" style="<?php echo $blockPadding; ?>">
                    <img src="<?php echo esc_url($image['url']); ?>" class="lazy-img <?php echo $class; ?>"
                         alt="<?php echo esc_attr($image['alt']); ?>"/>
                </div>
                <noscript>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                </noscript>
            </div>
        <?php endif;
    }
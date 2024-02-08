<?php
    $dropdownList = get_sub_field('dropdown_list');
    
    $backgroundColor = get_sub_field('background_color');
    $paddingTop = get_sub_field('paddingTop');
    $paddingBottom = get_sub_field('paddingBottom');
    $paddingTop_mobile = get_sub_field('paddingTop_mobile');
    $paddingBottom_mobile = get_sub_field('paddingBottom_mobile');
?>
<?php if ($dropdownList) : ?>
    <section
            class="dropdown-block <?php echo 'pt-' . $paddingTop_mobile . ' pb-' . $paddingBottom_mobile . ' pt-md-' . $paddingTop . ' pb-md-' . $paddingBottom; ?>">
        <div class="container" style="background-color: <?php echo $backgroundColor; ?>">
            <div class="dropdown-block__wrap dropdown--desk">
                <ul class="dropdown-block__list">
                    <?php foreach ($dropdownList as $idx => $dropdown) : ?>
                        <?php if ($idx % 2 == 0) : ?>
                            <?php
                            $d_title = $dropdown['title'];
                            $d_content = $dropdown['content'];
                            ?>
                            
                            <?php if ($d_title && $d_content) : ?>
                                <li class="list--item dropdown--item">
                                    <div class="list--item__title dropdown--title">
                                        <span class="dropdown--title__text"><?php echo $d_title; ?></span>
                                        <span class="dropdown--title__icon"><?php echo file_get_contents(get_template_directory_uri() . '/assets/images/dropdown_arrow.svg'); ?></span>
                                    </div>
                                    <div class="list--item__content dropdown--content">
                                        <?php echo $d_content; ?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <ul class="dropdown-block__list">
                    <?php foreach ($dropdownList as $idx => $dropdown) : ?>
                        <?php if ($idx % 2 !== 0) : ?>
                            <?php
                            $d_title = $dropdown['title'];
                            $d_content = $dropdown['content'];
                            ?>
                            
                            <?php if ($d_title && $d_content) : ?>
                                <li class="list--item dropdown--item">
                                    <div class="list--item__title dropdown--title">
                                        <span class="dropdown--title__text"><?php echo $d_title; ?></span>
                                        <span class="dropdown--title__icon"><?php echo file_get_contents(get_template_directory_uri() . '/assets/images/dropdown_arrow.svg'); ?></span>
                                    </div>
                                    <div class="list--item__content dropdown--content">
                                        <?php echo $d_content; ?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="dropdown-block__wrap dropdown--mobile">
                <ul class="dropdown-block__list">
                    <?php foreach ($dropdownList as $dropdown) : ?>
                        <?php
                        $d_title = $dropdown['title'];
                        $d_content = $dropdown['content'];
                        ?>
                        
                        <?php if ($d_title && $d_content) : ?>
                            <li class="list--item dropdown--item">
                                <div class="list--item__title dropdown--title">
                                    <span class="dropdown--title__text"><?php echo $d_title; ?></span>
                                    <span class="dropdown--title__icon"><?php echo file_get_contents(get_template_directory_uri() . '/assets/images/dropdown_arrow.svg'); ?></span>
                                </div>
                                <div class="list--item__content dropdown--content">
                                    <?php echo $d_content; ?>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php 
    $heading = get_sub_field('heading');
    $image1 = get_sub_field('image1');
    $image2 = get_sub_field('image2');
    $image3 = get_sub_field('image3');
    $blockLayout = get_sub_field('block_layout');
    $paddingTop = get_sub_field('paddingTop');
    $paddingBottom = get_sub_field('paddingBottom');
    $paddingTop_mobile = get_sub_field('paddingTop_mobile');
    $paddingBottom_mobile = get_sub_field('paddingBottom_mobile');

    $imageClasses = '';
    $contentClasses = '';
    $ThirdColImageClasses = '';
    $LeftColumnClasses = '';
    $RightColumnClasses = '';
    $ThirdColumnStyle= '';
    
    if($blockLayout=='2colsS'):
        $ThirdColImageClasses.= 'display: none;';
        $LeftColumnClasses.= 'col-6';
        $RightColumnClasses.= 'col-6';
    elseif($blockLayout=='2colsLRB'):
        $contentClasses.= 'image-tiles—right';
        $ThirdColImageClasses.= 'display: none;';
        $LeftColumnClasses.= 'col-md-4 col-sm-5 col-4 a align-self-center d-flex align-items-center justify-content-center';
        $RightColumnClasses.= 'col-md-6 col-sm-6 col-7  pt-md-0 ';
    elseif($blockLayout=='2colsLRS'):
        $contentClasses.= 'image-tiles—left';
        $ThirdColImageClasses.= 'display: none;';
        $LeftColumnClasses.= 'col-md-6 col-sm-6 col-7 pt-md-0 ';
        $RightColumnClasses.= 'col-md-4 col-sm-5 col-5  align-self-center d-flex align-items-center justify-content-center';
    elseif($blockLayout=='3colsLU'):
        $ThirdColImageClasses.= 'display: flex; align-self: flex-start;';
        $LeftColumnClasses.= 'col-3 pt-3 align-self-end';
        $RightColumnClasses.= 'col-6 ';
    elseif($blockLayout=='3colsLD'):
        $contentClasses.= 'threeCols';
        $ThirdColImageClasses.= 'display: flex; align-self: flex-start; ';
        $LeftColumnClasses.= 'col-3 pb-1 pb-sm-4 pb-md-6 align-self-end';
        $RightColumnClasses.= 'col-6';
        $ThirdColumnStyle= 'pt-1 pt-sm-3';
    elseif($blockLayout=='3colsRC'):
        $ThirdColumnStyle= 'pt-0 pt-sm-6 pt-4 pt-md-0';
        $contentClasses.= 'threeCols';
        $ThirdColImageClasses.= 'display: flex; align-self: center;';
        $LeftColumnClasses.= 'col-3 pt-1 pt-md-4 pt-sm-3';
        $RightColumnClasses.= 'col-6';
    endif; 
?>
<section class="section <?php echo $contentClasses ?> image-tiles pt-<?php echo $paddingTop_mobile ?> pb-<?php echo $paddingBottom_mobile ?> pt-md-<?php echo $paddingTop ?> pb-md-<?php echo $paddingBottom ?>">
    <div class="container">
        <?php if($heading) : ?>
            <div class="row">
                <div class="col-lg-8 offset-lg-2 image-tiles__heading heading"><?php echo $heading ?></div>
            </div>
        <?php endif; ?>
        <ul class="row image-tiles__list <?php echo $contentClasses ?>">
            <li class="image-tiles__item image-tiles__item—1 <?php echo $LeftColumnClasses ?>">
                <img class="image-tiles__item__image" src="<?php echo esc_url($image1['url']); ?>" alt="<?php echo esc_attr($image1['alt']); ?>" />
            </li>
            <li class="image-tiles__item image-tiles__item—2 <?php echo $RightColumnClasses ?>">
                <img class="image-tiles__item__image" src="<?php echo esc_url($image2['url']); ?>" alt="<?php echo esc_attr($image2['alt']); ?>" />
            </li>
            <?php if( $blockLayout=='3colsLU' || $blockLayout=='3colsRC' || $blockLayout=='3colsLD' ): ?>
                <li class="image-tiles__item image-tiles__item—3 col-3 <?php echo $ThirdColumnStyle ?>" style="<?php echo $ThirdColImageClasses?>">
                    <img class="image-tiles__item__image" src="<?php echo esc_url($image3['url']); ?>" alt="<?php echo esc_attr($image3['alt']); ?>" />
                </li>
            <?php endif; ?>
        </ul>
    </div>
</section>

            
<?php if( get_field('transparent_heading', 'option') ): ?>
 <div class="transparent">
  <div class="transparent-label" style="color:#fff"><span>Реклама</span></div>
  <div class="transparent-inner">
    <div class="transparent-logo" style="background-image:url(<?php the_field('transparent_logo', 'option'); ?>);"></div>
    <div class="transparent-text">
      <div class="transparent-heading"><a target="_blank" title="<?php the_field('transparent_heading', 'option'); ?>" href="<?php the_field('transparent_link', 'option'); ?>" style="color:#fff"><?php the_field('transparent_heading', 'option'); ?></a></div>
      <div class="transparent-descr" style="color:#fff"><?php the_field('transparent_descr', 'option'); ?></div>
      <div class="transparent-tag"><?php the_field('transparent_tag', 'option'); ?></div>
    </div>
  </div>
</div>
<?php endif; ?>
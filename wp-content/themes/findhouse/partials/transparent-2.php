<?php if( get_field('transparent_heading2', 'option') ): ?>
 <div class="transparent">
  <div class="transparent-label"><span>Реклама</span></div>
  <div class="transparent-inner">
    <div class="transparent-logo" style="background-image:url(<?php the_field('transparent_logo2', 'option'); ?>);"></div>
    <div class="transparent-text">
      <div class="transparent-heading"><a target="_blank" title="<?php the_field('transparent_heading2', 'option'); ?>" href="<?php the_field('transparent_link2', 'option'); ?>"><?php the_field('transparent_heading2', 'option'); ?></a></div>
      <div class="transparent-descr"><?php the_field('transparent_descr2', 'option'); ?></div>
      <div class="transparent-tag"><?php the_field('transparent_tag2', 'option'); ?></div>
    </div>
  </div>
  <a class="transparent-button" target="_blank" href="<?php the_field('transparent_link2', 'option'); ?>">перейти на сайт застройщика <i class="fas fa-globe"></i></a>
</div>
<?php endif; ?>
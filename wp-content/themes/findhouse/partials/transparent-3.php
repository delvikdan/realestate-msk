<?php if( get_field('transparent_heading3', 'option') ): ?>
 <div class="transparent">
  <div class="transparent-label"><span>Реклама</span></div>
  <div class="transparent-inner">
    <div class="transparent-logo" style="background-image:url(<?php the_field('transparent_logo3', 'option'); ?>);"></div>
    <div class="transparent-text">
      <div class="transparent-heading"><a target="_blank" title="<?php the_field('transparent_heading3', 'option'); ?>" href="<?php the_field('transparent_link3', 'option'); ?>"><?php the_field('transparent_heading3', 'option'); ?></a></div>
      <div class="transparent-descr"><?php the_field('transparent_descr3', 'option'); ?></div>
      <div class="transparent-tag"><?php the_field('transparent_tag3', 'option'); ?></div>
    </div>
  </div>
  <a class="transparent-button" target="_blank" href="<?php the_field('transparent_link3', 'option'); ?>">перейти на сайт застройщика <i class="fas fa-globe"></i></a>
</div>
<?php endif; ?>
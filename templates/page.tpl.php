<?php print render($page['top']); ?>

<div id="page-wrapper">
  <div id="page" class="<?php print $classes; ?>"<?php print $attributes; ?>>
    <header>
      <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
      <?php endif; ?>
      <?php if ($site_name || $site_slogan): ?>
      <div id="name-and-slogan">
        <?php if ($site_name): ?>
        <div id="site-name"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a></div>
        <?php endif; ?>
        <?php if ($site_slogan): ?>
        <div id="site-slogan"><?php print $site_slogan; ?></div>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <?php print render($page['header']); ?>
    </header>
    <?php if ($main_menu || $secondary_menu): ?>
    <nav id="navigation" class="menu <?php if (!empty($main_menu)) { print 'with-primary'; } if (!empty($secondary_menu)) { print ' with-secondary'; } ?>">
      <?php print theme('links', array('links' => $main_menu, 'attributes' => array('id' => 'primary', 'class' => array('links', 'clearfix', 'main-menu')))); ?><?php print theme('links', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary', 'class' => array('links', 'clearfix', 'sub-menu')))); ?>
    </nav>
    <?php endif; ?>
    <section id="content">
      <?php if ($breadcrumb || $title || $messages || $tabs || $action_links): ?>
      <div id="content-header"><?php print $breadcrumb; ?>
        <?php if ($page['highlighted']): ?>
        <div id="highlighted"><?php print render($page['highlighted']) ?></div>
        <?php endif; ?>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
        <h1 class="title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?><?php print $messages; ?><?php print render($page['help']); ?>
        <?php if ($tabs): ?>
        <div class="tabs"><?php print render($tabs); ?></div>
        <?php endif; ?>
        <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <div id="content-content"><?php print render($page['content']) ?></div>
      <?php print $feed_icons; ?>
    </section>
    <?php if ($page['sidebar_first']): ?>
    <aside id="sidebar-first" class="column sidebar">
      <?php print render($page['sidebar_first']); ?>
    </aside>
    <?php endif; ?>
    <?php if ($page['sidebar_second']): ?>
    <aside id="sidebar-second" class="column sidebar">
      <?php print render($page['sidebar_second']); ?>
    </aside>
    <?php endif; ?>
    <footer id="footer">
      <?php print render($page['footer']); ?>
    </footer>
  </div>
</div>
<?php print render($page['bottom']); ?>
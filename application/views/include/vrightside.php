       
<div class="col-md-3">
                            <!-- BEGIN: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
<?php echo form_open(BASE_URL.'/Blog/search', '" id="myform" enctype="multipart/form-data"'); ?>
    <div class="input-group">
        <input type="text" name="keyword" class="form-control c-square c-theme-border" placeholder="Search blog...">
        <span class="input-group-btn">
            <button class="btn c-theme-btn c-theme-border c-btn-square" type="submit">Go!</button>
        </span>
    </div>
<?php echo form_close(); ?>
<div class="c-content-ver-nav">
     <?php   if(!empty($Blogcategory))  {   ?>
    <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
        <h3 class="c-font-bold c-font-uppercase">Categories</h3>
        <div class="c-line-left c-theme-bg"></div>
    </div>
    <ul class="c-menu c-arrow-dot1 c-theme">
        <?php   foreach($Blogcategory as $pg)  {   ?> 
        <?php if($pg->countcat > 0) { ?>
            <li>
              <a href="<?php  echo BASE_URL.'/Blog/Category/'. $pg->category_title; ?>">
                  <?php  echo $pg->category_title; ?>
                  (<?php  echo $pg->countcat; ?>)
              </a>
             </li>
            <?php }?> 
        <?php }?>        
    </ul>
     <?php }?>
</div>
<div class="c-content-tab-1 c-theme c-margin-t-30">
    <div class="nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="#blog_recent_posts" data-toggle="tab">Recent Posts</a>
            </li>
            <li>
                <a href="#blog_popular_posts" data-toggle="tab">Popular Posts</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="blog_recent_posts">
                <?php   if(!empty($getRecentBlog))  {   ?>
                <ul class="c-content-recent-posts-1">
                     <?php   foreach($getRecentBlog as $gn)  {
                         $image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$gn->blog_image);

                         ?>  
                    <li>
                        <div class="c-image">
                            <img src="<?php if ($gn->blog_image){ echo $image_thumbs;} else { echo IMAGES_BASE_URL.'/image-normal.jpg';}?>" alt="" class="img-responsive"> </div>
                        <div class="c-post">
                            <a href="<?php if ($gn->blog_alias!= ''){echo BASE_URL.'/'.$gn->blog_alias;}else {echo BASE_URL.'Blog/detail/'.$gn->blog_id;} ?>" class="c-title"> <?php  echo $gn->blog_title; ?>... </a>
                            <div class="c-date"><?php echo date_convert($gn->blog_publish_date) ;?></div>
                        </div>
                    </li>
                     <?php }?>
                </ul>
                 <?php }?>
            </div>
            <div class="tab-pane" id="blog_popular_posts">
                <?php   if(!empty($getPopularBlog))  {   ?>
                <ul class="c-content-recent-posts-1">
                     <?php   foreach($getRecentBlog as $gn)  {
                         $image_thumbs = BASE_URL.str_replace('/admin/images','/admin/.thumbs/images',$gn->blog_image);

                         ?>  
                    <li>
                        <div class="c-image">
                            <img src="<?php if ($gn->blog_image){ echo $image_thumbs;} else { echo IMAGES_BASE_URL.'/image-normal.jpg';}?>" alt="" class="img-responsive"> </div>
                        <div class="c-post">
                            <a href="<?php if ($gn->blog_alias!= ''){echo BASE_URL.'/'.$gn->blog_alias;}else {echo BASE_URL.'Blog/detail/'.$gn->blog_id;} ?>" class="c-title"> <?php  echo $gn->blog_title; ?>... </a>
                            <div class="c-date"><?php echo date_convert($gn->blog_publish_date) ;?></div>
                        </div>
                    </li>
                     <?php }?>
                </ul>
                 <?php }?>
            </div>
        </div>
    </div>
</div>

<!-- END: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
</div>

  
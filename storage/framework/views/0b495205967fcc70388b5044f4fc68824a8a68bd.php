<?php $__env->startSection('content'); ?>
<header>
  <div class="header_top">
    <div class="wrapper">
      <div class="header_top1">
        <div class="logo"><img src="images/logo.png" alt="Ring Tone Creator"></div>
        <span class="make_ringtone"><?php echo e(dictionary(Session::get('lang'))['top_text']); ?></span>
        <div class="country_main"><span class="language">Language</span>
          <select name="countries" id="countries" onChange="changeLanguage(this.value)">
            <option value='us' <?php echo e(languageSet('us')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag us" data-title="EN">EN</option>
            <option value='zh' <?php echo e(languageSet('zh')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag cn" data-title="ZH">ZH</option>
            <option value='es' <?php echo e(languageSet('es')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag es" data-title="ES">ES</option>
            <option value='pt' <?php echo e(languageSet('pt')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag pt" data-title="PT">PT</option>
            <option value='ru' <?php echo e(languageSet('ru')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag ru" data-title="RU">RU</option>
            <option value='id' <?php echo e(languageSet('id')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag id" data-title="ID">ID</option>
            <option value='fr' <?php echo e(languageSet('fr')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag fr" data-title="FR">FR</option>
            <option value='de' <?php echo e(languageSet('de')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag de" data-title="DE">DE</option>
            <option value='ja' <?php echo e(languageSet('ja')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag it" data-title="JA">JA</option>
            <option value='nl' <?php echo e(languageSet('nl')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag nl" data-title="NL">NL</option>
            <option value='pl' <?php echo e(languageSet('pl')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag pl" data-title="PL">PL</option>
            <option value='tr' <?php echo e(languageSet('tr')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag tr" data-title="TR">TR</option>
            <option value='ko' <?php echo e(languageSet('ko')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag ko" data-title="KO">KO</option>
            <option value='it' <?php echo e(languageSet('it')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag az " data-title="IT">IT</option>
            <option value='vi' <?php echo e(languageSet('vi')); ?> data-image="images/ringtonemaker/blank.gif" data-imagecss="flag vi" data-title="VI">VI</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="content"> <div class="banner"> <div class="wrapper"> <h1 class="banner_text">FREE RINGTONE CREATOR</h1> </div></div><div class="clear"></div><div id="media_main"> <div id="upload-buttons-wrapper" class="wrapper"> <div class="btns"> <div id="pick-files" class="ui-button-success upload_file">Upload Files</div><div id="reset-all" class="ui-button-danger plupload_disabled clear_queue">Clear Queue</div></div></div>
<?php /*<div class="addSection1">
</div>*/ ?>
<div class="player"> <div id="carousel-wrapper"> <div id="carousel-prev-wrapper"> <div id="carousel-prev" class="disabled"></div></div><div id="container"> <div id="carousel"> <ul id="filelist" class="plupload_filelist"> </ul> </div></div><div id="carousel-next-wrapper"> <div id="carousel-next" class="disabled"></div></div></div></div><div id="content-wrapper"> <div id="content-progress"> <div id="content-progress-status"></div></div><div id="content"></div></div></div><div class="clear"></div>
<?php /*<div class="addSection2">
</div>*/ ?>
<div class="banr_aftr_sec"> <div class="ringtone_left"> <h2 class="ringtone_steps"><?php echo e(dictionary(Session::get('lang'))['on_girl_text']); ?></h2> </div><ul class="step_ul"> <li><span class="step_text"><?php echo e(dictionary(Session::get('lang'))['step1']); ?></span></li><li><span class="step_text"><?php echo e(dictionary(Session::get('lang'))['step2']); ?></span></li><li><span class="step_text"><?php echo e(dictionary(Session::get('lang'))['step3']); ?></span></li><li><span class="step_text"><?php echo e(dictionary(Session::get('lang'))['step4']); ?></span></li><li><span class="step_text"><?php echo e(dictionary(Session::get('lang'))['step5']); ?></span></li><li><span class="step_text"><?php echo e(dictionary(Session::get('lang'))['step6']); ?><br><br></span></li></ul> </div><?php /*?><div class="media_main"> <div class="wrapper"> <div class="btns"> <span class="upload_file"><a href="#"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>UPLOAD FILE</a></span> <span class="clear_queue"><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>CLEAR QUEUE</a></span> </div><span class="drop_file">Drop your file here</span> </div></div><div class="player"> <div class="wrapper"> <span class="player_img"><img src="images/player.png" alt="no-img"></span> </div></div><?php */?> <div class="paragraph-sec"> <p>In this era of competition and being unique everyone wants to have something that sounds cool as well as different and catchy. Each of us is addicted to this technological version of time.</p><p>The most important thing in this current time is “Mobile phones”. Yes! That thing which connects us to others, that assures the existence of our love ones. But when our phone rings we want it to sound good. What if you have an expensive phone and when it rings the ringtone is an embarrassment for you.</p><p>What if you are at some important place and your phone rings with a weird ring tone? And you think why I can’t create a ring tone of my own? Wish I could cut my favorite part of this song and could make it my ringtone.</p><p>Wish I had a ringtone maker! Wish I could create ringtones of my own! Ringtones shows the personality and there is no doubt about it.</p><p>Woo ho! It’s not a dream any more. We present you ringtone maker that can make free ringtones for you. This free ringtone maker is a dream come true indeed. </p><p>Just follow the simple steps and create free ringtone for Android and I phone.</p><p>Upload the audio and set the part which you want as ringtone and then select the type of audio. MP3 type for Android and M4P type for I phone, and then click ‘make ringtone’. Tada! Your desired ringtone is created now download it and show your uniqueness to world.</p><p>Create free ringtones here. Because we care!</p></div><div class="clear"></div></div><footer> <div class="wrapper"> <span class="like_it">Like it? Share it!</span> <ul class="social_ul"> <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><li><a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li><li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li><li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li></ul> </div></footer>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
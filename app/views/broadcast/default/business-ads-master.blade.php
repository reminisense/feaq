<div class="ads-area {{ $ad_class }} abs">
  <div class="top">
    <a class="" href="#"><img src="/images/featherq-home-logo.png"></a>
  </div>
  <div class="vid-container">
    @if ($ad_type == 'internet_tv')
        {{ $ad_src }}
    @elseif ($ad_type == 'carousel')
        <div id="fqCarousel" class="carousel slide" data-ride="carousel" data-interval="<?php print $carousel_interval; ?>" style="min-height: 550px;">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach ($ad_src as $count => $filename)
                    <div class="item <?php $count == 0 ? print 'active' : print ''; ?>">
                        <img id="ad<?php print $count; ?>" src="/<?php print $filename; ?>" alt="Ad<?php print $count; ?>">
                    </div>
                @endforeach
                @if (count($ad_src) < 0)
                    <?php $count = 0; ?>
                @else
                    <?php $count = count($ad_src); ?>
                @endif
                <div class="item <?php $count == 0 ? print 'active' : print ''; ?>">
                    <img id="ad<?php print $count+1; ?>" src="/images/broadcast/carousel/car1.jpg" alt="Ad<?php print $count+1; ?>">
                </div>
                <div class="item">
                    <img id="ad<?php print $count+2; ?>" src="/images/broadcast/carousel/car2.jpg" alt="Ad<?php print $count+2; ?>">
                </div>
                <div class="item">
                    <img id="ad<?php print $count+3; ?>" src="/images/broadcast/carousel/car3.jpg" alt="Ad<?php print $count+3; ?>">
                </div>
                <div class="item">
                    <img id="ad<?php print $count+4; ?>" src="/images/broadcast/carousel/car4.jpg" alt="Ad<?php print $count+4; ?>">
                </div>
            </div>
        </div>
    @endif
  </div>
</div>

<script type="text/javascript">
    $('iframe').css({'height' : $(window).height()});
    $('embed').css({'height' : $(window).height()});
</script>
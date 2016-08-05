<div class="ads-area {{ $ad_class }} abs">
  <div class="top">
      <select class="form-control" id="show-only-service">
          <option value="143">143</option>
          <option value="222">222</option>
          <option value="524">524</option>
      </select>
    <a class="" href="#"><img src="/images/featherq-home-logo.png"></a>
  </div>
  <div class="vid-container">
    @if ($ad_type == 'internet_tv')
        {{ $ad_src }}
    @elseif ($ad_type == 'carousel')
        <div id="fqCarousel" class="carousel slide" data-ride="carousel" data-interval="<?php print $carousel_delay; ?>" style="min-height: 550px;">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach ($ad_src as $count => $filename)
                    <div class="item <?php $count == 0 ? print 'active' : print ''; ?>">
                        <img id="ad<?php print $count; ?>" src="/<?php print $filename; ?>" alt="Ad<?php print $count; ?>" class="center-block">
                    </div>
                @endforeach
                @if (count($ad_src) < 0)
                    <?php $count = 0; ?>
                @else
                    <?php $count = count($ad_src); ?>
                @endif
                <div class="item <?php $count == 0 ? print 'active' : print ''; ?>">
                    <img id="ad<?php print $count+1; ?>" src="/images/broadcast/carousel/bs images 13.jpg" alt="Ad<?php print $count+1; ?>" class="center-block">
                </div>
                <div class="item">
                    <img id="ad<?php print $count+2; ?>" src="/images/broadcast/carousel/bs images 14.jpg" alt="Ad<?php print $count+3; ?>" class="center-block">
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
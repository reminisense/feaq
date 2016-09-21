<div class="ads-area {{ $ad_class }} abs">
  <div class="top">
      <div class="col-md-9 pull-right">
          <ul class="nav nav-tabs nav-justified pull-right" style="margin-top: -4px;">
              <li role="presentation" id="show-all-numbers"><a href="#">ALL</a></li>
              <?php foreach ($service_filters as $count => $service): ?>
                  <li role="presentation" class="dropdown">
                      <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"> {{ $service->name; }} <span class="caret"></span> </a>
                      <ul class="dropdown-menu" id="filter-broadcast">
                          <li class="show-only-service" service_id="{{ $service->service_id; }}">
                              <a href="">{{ $service->name }}</a>
                          </li>
                          <li class="divider" role="separator"></li>
                          @if (isset($terminal_filters[$service->service_id]))
                              @foreach ($terminal_filters[$service->service_id] as $count2 => $terminal)
                                <li class="show-only-terminal" terminal_id="{{ $terminal["terminal_id"] }}" service_name="{{ $service->name }}">
                                    <a href="#">{{ $terminal["terminal_name"] }}</a>
                                </li>
                              @endforeach
                          @endif
                      </ul>
                  </li>
              <?php endforeach; ?>
          </ul>
      </div>
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
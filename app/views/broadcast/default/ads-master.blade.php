<div class="col-md-6">
    @if (strstr($broadcast_type, "2"))
        {{ $ad_src }}
    @elseif ($ad_type == 'image')
        <div id="fqCarousel" class="carousel slide" data-ride="carousel" style="min-height: 550px;">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach ($ad_src as $count => $filename)
                    <div class="item <?php $count == 0 ? print 'active' : print ''; ?>">
                        <img id="ad<?php print $count; ?>" src="/<?php print $filename; ?>" alt="Ad<?php print $count; ?>">
                    </div>
                @endforeach
                @if (!isset($count))
                    <?php $count = 0; ?>
                @endif
                <div class="item <?php $count == 0 ? print 'active' : print ''; ?>">
                    <img id="ad<?php print $count+1; ?>" src="/images/broadcast1.jpg" alt="Ad<?php print $count+1; ?>">
                </div>
                <div class="item">
                    <img id="ad<?php print $count+2; ?>" src="/images/broadcast2.jpg" alt="Ad<?php print $count+2; ?>">
                </div>
                <div class="item">
                    <img id="ad<?php print $count+3; ?>" src="/images/broadcast3.jpg" alt="Ad<?php print $count+3; ?>">
                </div>
                <div class="item">
                    <img id="ad<?php print $count+4; ?>" src="/images/broadcast4.jpg" alt="Ad<?php print $count+4; ?>">
                </div>
            </div>
        </div>
    @elseif ($ad_type == 'video')
        <iframe src="{{ $ad_src }}" id="video-ad" width="100%"></iframe>
    @endif
</div>

<script>
    $('iframe').css({'height' : $(window).height()});
    $('embed').css({'height' : $(window).height()});
</script>
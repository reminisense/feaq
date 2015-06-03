<div class="col-md-6">
    @if (strstr($broadcast_type, "2"))
        {{ $ad_src }}
    @elseif ($ad_type == 'image')
        <div id="fqCarousel" class="carousel slide" data-ride="carousel" style="min-height: 550px;">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @if ($ad_src != '')
                    <div class="item active">
                        <img id="ad1" src="{{ $ad_src }}" alt="Ad1">
                    </div>
                    <div class="item">
                        <img id="ad2" src="/images/broadcast1.jpg" alt="Ad2">
                    </div>
                @else
                    <div class="item active">
                        <img id="ad2" src="/images/broadcast1.jpg" alt="Ad2">
                    </div>
                @endif
                <div class="item">
                    <img id="ad3" src="/images/broadcast2.jpg" alt="Ad3">
                </div>
                <div class="item">
                    <img id="ad4" src="/images/broadcast3.jpg" alt="Ad4">
                </div>
                <div class="item">
                    <img id="ad5" src="/images/broadcast4.jpg" alt="Ad5">
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
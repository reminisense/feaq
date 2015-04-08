<div class="col-md-6">
    @if ($ad_type == 'image')
        <div id="fqCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{ $ad_src }}" alt="Ad1">
                </div>
                <div class="item">
                    <img src="/images/broadcast1.jpg" alt="Ad2">
                </div>
                <div class="item">
                    <img src="/images/broadcast2.jpg" alt="Ad3">
                </div>
                <div class="item">
                    <img src="/images/broadcast3.jpg" alt="Ad4">
                </div>
                <div class="item">
                    <img src="/images/broadcast4.jpg" alt="Ad5">
                </div>
            </div>
        </div>
    @elseif ($ad_type == 'video')
        <iframe src="{{ $ad_src }}" id="video-ad" width="100%" height="700px"></iframe>
    @endif
</div>
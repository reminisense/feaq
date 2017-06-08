<div class="ads-area {{ $ad_class }} abs">
  <div class="top">
      <a class="" href="#"><img src="/images/featherq-home-logo.png"></a>
  </div>
  <div class="vid-container">
    @if ($ad_type == 'internet_tv')
        {{ $ad_src }}
    @elseif ($ad_type == 'local_video')
        <div class="clearfix">
            <div class="row">
                <div class="well">
                <div class="cold-md-12">
                    <div class="alert alert-info">Supported video types: <br/><strong>MP4, Ogg, WebM</strong></div>
                </div>
                <input type="file" multiple="multiple" accept="video/mp4,video/x-m4v,video/*" />
                <video style="height: 100%;" controls autoplay></video>
                </div>
            </div>
        </div>
        <script>
            (function localFileVideoPlayer() {
                'use strict'
                var URL = window.URL || window.webkitURL
                var videoNode = document.querySelector('video')
                var queuedVideos = []
                var videoIndex = 0
                var queueVideoFiles = function (event) {
                    var videoFiles = [];
                    for (var i=0; i < this.files.length; i++) {
                        var file = this.files[i]
                        var type = file.type
                        var canPlay = videoNode.canPlayType(type)
                        if (canPlay === '') canPlay = 'no'
                        var isError = canPlay === 'no'
                        if (isError) {
                            alert("Please upload only MP4, Ogg, and WebM video types.")
                            return
                        }
                        videoFiles[i] = URL.createObjectURL(file)
                    }
                    queuedVideos = videoFiles
                    videoNode.src = queuedVideos[0]
                    videoIndex = 0
                }
                var nextVideo = function() {
                    if (videoIndex < queuedVideos.length-1) {
                        videoIndex = videoIndex + 1
                    }
                    else {
                        videoIndex = 0
                    }
                    videoNode.src = queuedVideos[videoIndex]
                }
                var inputNode = document.querySelector('input')
                inputNode.addEventListener('change', queueVideoFiles, false)
                videoNode.addEventListener('ended', nextVideo, false);
            })()
        </script>
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
            </div>
        </div>
    @endif
  </div>
</div>

<script type="text/javascript">
    $('iframe').css({'height' : $(window).height()});
    $('embed').css({'height' : $(window).height()});
</script>
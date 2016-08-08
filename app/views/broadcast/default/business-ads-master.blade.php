<div class="ads-area {{ $ad_class }} abs">
  <div class="top">
    <a class="" href="#"><img src="/images/featherq-home-logo.png"></a>
  </div>
  <div class="vid-container">
    @if ($ad_type == 'internet_tv')
        {{ $ad_src }}
    @elseif ($ad_type == 'carousel')
        <button id="watch-movie">Watch Movie</button>
    @endif
  </div>
</div>

<script type="text/javascript">
    $('iframe').css({'height' : $(window).height()});
    $('embed').css({'height' : $(window).height()});

    $('#watch-movie').click(function(e) {
        var movieWidth = $('.vid-container').width();
        window.open("", "FeatherQ Stream", "height=200,width="+movieWidth);
    })

    (function localFileVideoPlayer() {
        'use strict'
        var URL = window.URL || window.webkitURL
        var playSelectedFile = function (event) {
            var file = this.files[0]
            var type = file.type
            var videoNode = document.querySelector('video')
            var canPlay = videoNode.canPlayType(type)
            if (canPlay === '') canPlay = 'no'
            var message = 'Can play type "' + type + '": ' + canPlay
            var isError = canPlay === 'no'

            if (isError) {
                return
            }

            var fileURL = URL.createObjectURL(file)
            videoNode.src = fileURL
        }
        var inputNode = document.querySelector('input')
        inputNode.addEventListener('change', playSelectedFile, false)
    })()
</script>
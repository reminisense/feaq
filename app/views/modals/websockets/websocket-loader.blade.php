<div id="WebsocketLoaderModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 20px 0;">
            <div class="modal-body" style="padding-top:10px;">
                <div style="margin:auto;text-align: center;">
                    <img  src="/img/socket-loader.gif" style="margin-top: 5px; margin-right: 20px; width:40px;" alt="socket-loader">
                Establishing network connection with FeatherQ servers. Please wait.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#WebsocketLoaderModal').modal('show');
    });
</script>
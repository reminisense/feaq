<div id="WebsocketLoaderModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="/img/socket-loader.gif" style="margin-top: 5px;" alt="socket-loader">
                Establishing network connection with FeatherQ servers. Please wait.
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#WebsocketLoaderModal').modal('show');
    });
</script>
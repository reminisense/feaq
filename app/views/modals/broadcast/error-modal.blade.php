<div class="modal fade" id="contact-error-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="contactBusinessModal">Contact Business</h3>
            </div>
            <div class="modal-body" ng-controller="fbController">
                <h2 style="margin-top: 0px;">You need a FeatherQ account to contact this business.</h2>
                <p>No account yet? Sign Up with your Facebook Account</p>
                <button class="btn btn-fb" ng-click="login()" data-dismiss="modal">Sign up with Facebook</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-orange btn-lg" data-dismiss="modal" aria-label="Close">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->
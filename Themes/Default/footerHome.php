<p id="Essaie"></p>
        <footer class="col s12 center-align">
            <div class="marginTopMin">
                <address class="col l6 m6 s12">
                    <h5>Où on se trouve</h5>
                    <p title="Adresse postale">Adresse de l'association</p>
                </address>
                <address class="col l6 m6 s12">
                    <h5>Nous contacter</h5>
                    <p title="Adresse mail">Mail</p>
                    <p title="Numéro de téléphone">Numéro de téléphone</p>
                </address>
            </div>
            <div class="row">
                <a role="navigation" data-target="login" class="link blue-text modal-trigger col offset-s3  s3 marginBottomMin" title="Espace membre">Espace membre</a>
                <a role="navigation" data-target="inscription" class="link blue-text modal-trigger col s3 marginBottomMin" title="Inscription">Inscription</a>
            </div>
            <div id="login" class="modal">
                <div class="modal-content">
                    <h4 class="black-text">Connection !</h4>
                    <form name="formLogin" id="formLogin" method="POST">
                        <div class="col s10 offset-s1 input-field">
                            <input type="email" name="mailConnection" id="mailConnection" class="validate" maxlength="70" data-length="70" />
                            <label for="mailConnection" data-error="Adresse mail mal écrit." data-success="Adresse mail correctement écrit." class="validate black-text">Adresse mail</label>
                        </div>
                        <div class="col s10 offset-s1 input-field">
                            <input type="password" name="passwordConnection" id="passwordConnection" class="validate" minlength="4" maxlength="8" data-length="8" />
                            <label for="passwordConnection" data-error="Il faut au minnimum 4 caractères." data-success="Il y a entre 4 et 8 caractères." class="black-text">Mot de passe</label>
                        </div>
                        <input type="submit" id="submitConnection" name="submitConnection" class="btn col s6 offset-s3 marginBottomMin" value="Connexion" title="Connexion" />
                    </form>
                    <a data-target="recoveryPassword" class="link modal-trigger blue-text col s6 offset-s3 marginBottomMin marginTopMin" title="Mot de passe oublié">Mot de passe oublié ?</a>
                </div>
            </div>
            <div id="recoveryPassword" class="modal">
                <div class="modal-content">
                    <h4 class= "black-text">Récupération du mot de passe !</h4>
                    <form name="formRecovery" id="formRecovery" method="POST" action="controllers/connection-Controller.php">
                        <div class="col s10 offset-s1 input-field">
                            <input type="email" name="mailRecovery" id="mailRecovery" class="validate" maxlength="70" data-length="70" title="Mail" />
                            <label for="mailRecovery" data-error="Adresse mail faussement écris." data-success="Adresse mail correctement écris." class="validate black-text">Adresse mail</label>
                        </div>
                        <input type="submit" id="submitRecovery" name="submitRecovery" class="btn col s6 offset-s3 marginBottomMin" value="Envoyer" title="Envoyer" />
                    </form>
                </div>
            </div>
            <div id="inscription" class="modal">
                    <div class="modal-content">
                        <h2 class="center-align">Formulaire d'inscription</h2>
                        <form name="volunteerIdentity" id="volunteerIdentity" method="POST" action="">
                            <div class="col s12 input-field">
                                <input type="text" name="last_name" id="last_name" class="validate" maxlength="255" data-length="255" title="Nom" />
                                <label for="last_name" class="black-text">Nom</label>
                            </div>
                            <div class="marginTop col s12 input-field">
                                <input type="text" name="first_name" id="first_name" class="validate" maxlength="255" data-length="255" title="Prénom" />
                                <label for="first_name" class="black-text">Prénom</label>
                            </div>
                            <div class="col s12 input-field inline">
                                <input type="email" name="mail" id="mail" class="validate" maxlength="255" data-length="255" title="Mail" onblur="checkMailUnique()" />
                                <label for="mail" data-error="Adresse mail faussement écris." data-success="Adresse mail correctement écris." class="black-text">Adresse mail</label>
                                <span id="errorCheckMailUnique">Cette addresse mail est déjà utilisée.</span>
                            </div>
                            <input type="submit" id="submitRegistrer" name="submitRegistrer" class="btn col s6 offset-s3 marginBottomMin" value="Enregistrer le bénévole" title="Enregistrer le bénévole" />
                        </form>
                    </div>
                </div>
        </footer>
        <script src="assets/js/answerComment.js" type="text/javascript"></script>
        <!--<script src="assets/js/ajax.js" type="text/javascript"></script>-->
        <!--<script src="assets/js/checkMailUnique.js.js" type="text/javascript"></script>-->
        <script src="bower_components/materialize/dist/js/materialize.js" type="text/javascript"></script>
    </body>
</html>
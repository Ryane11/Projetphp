'use strict';

var FormValidator = function($form)
{
    this.$form            = $form;
    this.$errorMessage    = $form.find('.error-message');
    this.$totalErrorCount = $form.find('.total-error-count');

    // Tableau gÃ©nÃ©ral de toutes les erreurs de validation trouvÃ©es.
    this.totalErrors = null;
};

FormValidator.prototype.checkDataTypes = function()
{
    var errors;

    // CrÃ©ation d'un petit tableau contenant les erreurs trouvÃ©es.
    errors = new Array();

    this.$form.find('[data-type]').each(function()
    {
        var value;

        /*
         * La mÃ©thode jQuery each() change la valeur de la variable this :
         * elle reprÃ©sente tous les objets DOM sÃ©lectionnÃ©s.
         *
         * Pour notre cas elle reprÃ©sente donc tour Ã  tour chaque champ de
         * formulaire trouvÃ© avec la mÃ©thode jQuery find().
         */

        // RÃ©cupÃ©ration de la valeur du champ du formulaire (sans les espaces).
        value = $(this).val().trim();

        switch($(this).data('type'))
        {
            case 'number':
            if(isNumber(value) == false)
            {
                errors.push(
                {
                    fieldName : $(this).data('name'),
                    message   : 'doit Ãªtre un nombre'
                });
            }
            break;

            case 'positive-integer':
            if(isInteger(value) == false || value <= 0)
            {
                errors.push(
                {
                    fieldName : $(this).data('name'),
                    message   : 'doit Ãªtre un nombre entier positif'
                });
            }
            break;
        }
    });

    // Copie des erreurs trouvÃ©es dans le tableau gÃ©nÃ©ral des erreurs.
    $.merge(this.totalErrors, errors);
};

FormValidator.prototype.checkMinimumLength = function()
{
    var errors;

    // CrÃ©ation d'un petit tableau contenant les erreurs trouvÃ©es.
    errors = new Array();

    // Boucle de recherche de tous les champs de formulaires nÃ©cessitant une longueur minimum.
    this.$form.find('[data-length]').each(function()
    {
        var minLength;
        var value;

        /*
         * La mÃ©thode jQuery each() change la valeur de la variable this :
         * elle reprÃ©sente tous les objets DOM sÃ©lectionnÃ©s.
         *
         * Pour notre cas elle reprÃ©sente donc tour Ã  tour chaque champ de
         * formulaire trouvÃ© avec la mÃ©thode jQuery find().
         */

        // RÃ©cupÃ©ration de la valeur de l'attribut HTML data-length.
        minLength = $(this).data('length');

        // RÃ©cupÃ©ration de la valeur du champ du formulaire (sans les espaces).
        value = $(this).val().trim();

        // Est-ce que ce qui a Ã©tÃ© saisi fait au moins la longueur minimum requise ?
        if(value.length < minLength)
        {
            // Non, donc il y a une erreur.
            errors.push(
            {
                fieldName : $(this).data('name'),
                message   : 'doit avoir au moins ' + minLength + ' caractÃ¨re(s)'
            });
        }
    });

    // Copie des erreurs trouvÃ©es dans le tableau gÃ©nÃ©ral des erreurs.
    $.merge(this.totalErrors, errors);
};

FormValidator.prototype.checkRequiredFields = function()
{
    var errors;

    // CrÃ©ation d'un petit tableau contenant les erreurs trouvÃ©es.
    errors = new Array();

    // Boucle de recherche de tous les champs de formulaires requis.
    this.$form.find('[data-required]').each(function()
    {
        var value;

        /*
         * La mÃ©thode jQuery each() change la valeur de la variable this :
         * elle reprÃ©sente tous les objets DOM sÃ©lectionnÃ©s.
         *
         * Pour notre cas elle reprÃ©sente donc tour Ã  tour chaque champ de
         * formulaire trouvÃ© avec la mÃ©thode jQuery find().
         */

        // RÃ©cupÃ©ration de la valeur du champ du formulaire (sans les espaces).
        value = $(this).val().trim();

        // Est-ce que quelque chose a Ã©tÃ© saisi ?
        if(value.length == 0)
        {
            // Non, alors que le champ est requis, donc il y a une erreur.
            errors.push(
            {
                fieldName : $(this).data('name'),
                message   : 'est requis'
            });
        }
    });

    // Copie des erreurs trouvÃ©es dans le tableau gÃ©nÃ©ral des erreurs.
    $.merge(this.totalErrors, errors);
};

FormValidator.prototype.onSubmitForm = function(event)
{
    var $errorList;

    // Recherche de la balise HTML <p> contenant tous les messages d'erreurs.
    $errorList = this.$errorMessage.children('p');
    $errorList.empty();

    // CrÃ©ation du tableau gÃ©nÃ©ral des erreurs.
    this.totalErrors = new Array();

    // ExÃ©cution des diffÃ©rentes validations.
    this.checkRequiredFields();
    this.checkDataTypes();
    this.checkMinimumLength();

    // Enregistrement du nombre d'erreurs de validation trouvÃ©es dans le formulaire.
    this.$form.data('validation-error-count', this.totalErrors.length);


    // Est-ce que des erreurs ont-Ã©tÃ© trouvÃ©es ?
    if(this.totalErrors.length > 0)
    {
        // Boucle d'affichage de toutes les erreurs trouvÃ©es.
        this.totalErrors.forEach(function(error)
        {
            var message;

            // Construction du message d'erreur final.
            message =
                'Le champ <em><strong>' + error.fieldName +
                '</strong></em> ' + error.message + '.<br>';

            // Ajout du message d'erreur final Ã  la fin de la balise HTML <p>.
            $errorList.append(message);
        });

        // Mise Ã  jour du compteur du nombre total d'erreurs trouvÃ©es.
        this.$totalErrorCount.text(this.totalErrors.length);

        // Affichage de la boite de messages.
        this.$errorMessage.fadeIn('slow');

        /*
         * Par dÃ©faut les navigateurs ont pour comportement d'envoyer le formulaire
         * en requÃªte HTTP Ã  l'URL indiquÃ©e dans l'attribut action des balises <form>
         *
         * Comme il y a des erreurs de validations cela ne sert Ã  rien d'envoyer le
         * formulaire, l'utilisateur doit d'abord corriger ses erreurs.
         *
         * Il faut donc empÃªcher le comportement par dÃ©faut du navigateur.
         */
        event.preventDefault();
    }
};

FormValidator.prototype.run = function()
{
    // Installation d'un gestionnaire d'Ã©vÃ¨nement sur la soumission du formulaire.
    this.$form.on('submit', this.onSubmitForm.bind(this));

    // Est-ce qu'il y a dÃ©jÃ  des messages d'erreurs dans la boite de messages ?
    if(this.$errorMessage.children('p').text().length > 0)
    {
        // Oui, affichage de la boite de messages.
        this.$errorMessage.fadeIn('slow');
    }
};
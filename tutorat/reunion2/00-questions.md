# lien

<https://github.com/webdevproformation/projet_aude/blob/main/tutorat/reunion2/00-questions.md>


# Erreurs des formulaire en rouge

- register.html.twig et contact/index.html.twig


```txt
les messages d'erreurs n'apparaissent pas en rouge quoique je fasse. style: 'red' ou classe error-message avec la couleur fixée dans la feuille form.css =>l'attribut n'apparait pas sur la balise li créée.  code extrait du code du thème bootstrap_5_layout.html.twig'. 
```

<https://github.com/adevoitinne/Correcteur-Au-Teur/blob/main/templates/registration/register.html.twig>

- 1 activer le theme bootstrap dans le fichier config 
- config/packages/twig.yaml

```yaml
twig:
    file_name_pattern: '*.twig'
    

when@test:
    twig:
        strict_variables: true
```

ajouter => 
voir la documentation => <https://symfony.com/doc/current/form/bootstrap5.html>


```yaml
twig:
    file_name_pattern: '*.twig'
    form_themes: ['bootstrap_5_layout.html.twig']
    

when@test:
    twig:
        strict_variables: true
```

<https://github.com/adevoitinne/Correcteur-Au-Teur/blob/main/templates/registration/register.html.twig>


```html
<div class="col-md-6 col-sm-12">
        {{ form_label(registrationForm.email, 'Email :' ) }}
        {{ form_widget(registrationForm.email, { attr: { aria_label:'Veuillez obligatoirement saisir votre email'} }) }}
        {{ form_errors(registrationForm.email) }}
</div>
```

<https://getbootstrap.com/docs/5.3/forms/form-control/>

{{ form_label(registrationForm.email, 'Email :' ) }}

<label for="xxxxx" class="form-label">Email :</label>

// si tout va bien 

{{ form_widget(registrationForm.email, { attr: { aria_label:'Veuillez obligatoirement saisir votre email'} }) }}

<input type="email" class="form-control"  aria_label="Veuillez obligatoirement saisir votre email" id="xxxxx">


// si tout erreur 

<input type="email" class="form-control is-invalid"  aria_label="Veuillez obligatoirement saisir votre email" id="xxxxx">
 

{{ form_errors(registrationForm.email) }}

<div class="invalid-feedback">    

pour le texte dans l'erreur => {{ form_errors() }} , il vient de l'Assert dans l'entité

https://symfony.com/doc/current/reference/constraints/Length.html

1 ajouter la config au fichier .yaml
2 entité => ajouter une Constraint 

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Column()]
    // le champ est OBLIGATOIRE sinon la bdd la refuse =>
    // et au maximum il ya 255 caractères 
    // VARCHAR(255) NOT NULL 
#[Assert\Length(
        min: 2, 
        max: 50, 
        minMessage: "au minimum 2 lettres" , 
        maxMessage: "blabla"
)]
private ?string $type = null ;


terminal 

```sh
symfony console make:crud

entité ?? Requete

controller => OK

test unitaire => no
```

- créer le controller avec 5 méthodes
- formType 
- dossier dans template avec toutes les vues du CRUD 

```sh
symfony serve
```

https://127.0.0.1:8001/requete



# question sur les migrations


dans ma relation ManyToOne entre Request Offer et Member, le fichier de migrations a créé une TEMPORARY TABLE. Je ne sais pas ce que cela veut dire. J’ai fait une erreur quelque part ?dans ma relation ManyToOne entre Request Offer et Member, le fichier de migrations a créé une TEMPORARY TABLE. Je ne sais pas ce que cela veut dire. J’ai fait une erreur quelque part ?


DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"

et je modifie la structure de ma table => ajouter un champ prix sur les requêtes

table temporaire permettent de garder les données lorsque l'on veut changer le nom d'une colonne (sur SQLITE)


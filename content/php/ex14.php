<?php

declare(strict_types=1);

/**
 * Contenu généré depuis ex14.php
 */

return array (
  'id' => 'php-ex14',
  'title' => 'POO PHP',
  'brief' => 'Créer des classes, des objets et de l\'héritage simple.',
  'levels' => 
  array (
    0 => 
    array (
      'level' => 1,
      'title' => 'Débutant — classe et objet',
      'lang' => 'php',
      'instructions' => '<p>Crée une classe <code>Etudiant</code> avec une propriété publique <code>$nom</code>, un constructeur qui la reçoit, et une méthode <code>presentation()</code> qui retourne <code>Je suis</code> suivi du nom. Affiche la présentation pour <code>Amal</code>.</p>',
      'instructionsDarija' => '<p>5leq classe <code>Etudiant</code> b propriété publique <code>$nom</code>, constructeur li kayakhodha, w méthode <code>presentation()</code> li katrje3 <code>Je suis</code> m3a smiya. 3red présentation l <code>Amal</code>.</p>',
      'starter' => '<?php
// classe Etudiant

// objet et affichage
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Je suis Amal',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une classe se déclare avec class.',
        1 => 'Le constructeur s\'appelle __construct.',
        2 => 'On accède aux propriétés avec $this->nom.',
      ),
      'solution' => '<?php
class Etudiant {
    public $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function presentation() {
        return "Je suis " . $this->nom;
    }
}

$etudiant = new Etudiant("Amal");
echo $etudiant->presentation();
?>',
      'explainFr' => '<code>new Etudiant("Amal")</code> crée un objet et appelle le constructeur. <code>$this</code> représente l\'objet courant : la méthode peut lire son propre <code>$nom</code>.',
      'explainDarija' => '<code>new Etudiant("Amal")</code> kat5leq objet w kat3ayet constructeur. <code>$this</code> kaymettel objet li kayn : méthode katqra <code>$nom</code> dyalo.',
    ),
    1 => 
    array (
      'level' => 2,
      'title' => 'Intermédiaire — propriété privée et validation',
      'lang' => 'php',
      'instructions' => '<p>Crée une classe <code>Etudiant</code> avec une propriété <code>private $note</code> valant 0, un setter <code>setNote($note)</code> qui accepte seulement une note entre 0 et 20, et un getter <code>getNote()</code>. Tente de définir 25 et affiche <code>Note invalide</code>.</p>',
      'instructionsDarija' => '<p>5leq classe <code>Etudiant</code> b propriété <code>private $note</code> = 0, setter <code>setNote($note)</code> li kayqbel ghir note bin 0 w 20, w getter <code>getNote()</code>. 7awel t7et 25 w 3red <code>Note invalide</code>.</p>',
      'starter' => '<?php
// classe avec note privée
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Note invalide',
        ),
      ),
      'hints' => 
      array (
        0 => 'private empêche l\'accès direct depuis l\'extérieur.',
        1 => 'Le setter retourne true ou false selon la validité.',
        2 => 'Une note valide est comprise entre 0 et 20 inclus.',
      ),
      'solution' => '<?php
class Etudiant {
    private $note = 0;

    public function setNote($note) {
        if ($note >= 0 && $note <= 20) {
            $this->note = $note;
            return true;
        }
        return false;
    }

    public function getNote() {
        return $this->note;
    }
}

$etudiant = new Etudiant();
echo $etudiant->setNote(25) ? "Note : 25" : "Note invalide";
?>',
      'explainFr' => 'La propriété privée protège l\'état de l\'objet : impossible d\'écrire une note aberrante sans passer par le setter, qui applique la règle métier.',
      'explainDarija' => 'Propriété privée kat7mi état dyal objet : ma tqderch tkteb note ghalta bla ma tdowez b setter, li kaytbeq qa3ida.',
    ),
    2 => 
    array (
      'level' => 3,
      'title' => 'Avancé — héritage et polymorphisme',
      'lang' => 'php',
      'instructions' => '<p>Crée une classe <code>Personne</code> avec <code>$nom</code>, un constructeur et <code>presentation()</code> qui retourne <code>Je suis</code> suivi du nom. Crée <code>Etudiant</code> qui étend <code>Personne</code>, ajoute <code>$filiere</code>, appelle le constructeur parent et redéfinit <code>presentation()</code> pour ajouter <code>, filière GI</code>. Affiche le résultat pour Amal en GI.</p>',
      'instructionsDarija' => '<p>5leq classe <code>Personne</code> b <code>$nom</code>, constructeur w <code>presentation()</code> li katrje3 <code>Je suis</code> m3a smiya. 5leq <code>Etudiant</code> li kattmed <code>Personne</code>, zid <code>$filiere</code>, 3ayet constructeur parent w 3awed 3erref <code>presentation()</code> bach tzid <code>, filière GI</code>. 3red résultat l Amal f GI.</p>',
      'starter' => '<?php
// Personne puis Etudiant
',
      'tests' => 
      array (
        0 => 
        array (
          'type' => 'output_contains',
          'value' => 'Je suis Amal, filière GI',
        ),
      ),
      'hints' => 
      array (
        0 => 'Une classe enfant utilise extends.',
        1 => 'parent::__construct() appelle le constructeur parent.',
        2 => 'parent::presentation() réutilise la logique du parent.',
      ),
      'solution' => '<?php
class Personne {
    protected $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function presentation() {
        return "Je suis " . $this->nom;
    }
}

class Etudiant extends Personne {
    private $filiere;

    public function __construct($nom, $filiere) {
        parent::__construct($nom);
        $this->filiere = $filiere;
    }

    public function presentation() {
        return parent::presentation() . ", filière " . $this->filiere;
    }
}

$etudiant = new Etudiant("Amal", "GI");
echo $etudiant->presentation();
?>',
      'explainFr' => '<code>Etudiant</code> hérite de <code>Personne</code> et enrichit son comportement. La redéfinition de <code>presentation()</code> illustre le polymorphisme : le même appel produit un texte adapté au type réel.',
      'explainDarija' => '<code>Etudiant</code> kayrte men <code>Personne</code> w kayzid 3la comportement dyalo. Redéfinition dyal <code>presentation()</code> katbayen polymorphisme : nefs appel kay3ti texte mnasb l type 7aqiqi.',
    ),
  ),
);

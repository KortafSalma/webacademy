<?php

declare(strict_types=1);

/**
 * Contenu généré depuis php-c14.json
 */

return array (
  'id' => 'php-ch14',
  'title' => 'POO PHP',
  'subtitle' => 'Modéliser le monde avec des classes et des objets',
  'objectives' => 
  array (
    0 => 'Créer une classe avec des propriétés et des méthodes.',
    1 => 'Utiliser un constructeur et le mot-clé $this.',
    2 => 'Comprendre l\'encapsulation et les niveaux de visibilité.',
    3 => 'Étendre une classe par héritage.',
  ),
  'lessons' => 
  array (
    0 => 
    array (
      'id' => 'classe-objet',
      'title' => 'Classe et objet',
      'icon' => '🏛️',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Une <strong>classe</strong> est un modèle ; un <strong>objet</strong> est une instance concrète de ce modèle. Une classe contient des <strong>propriétés</strong> (données) et des <strong>méthodes</strong> (comportements).</p>',
          'darija' => '<p><strong>Classe</strong> hiya modèle ; <strong>objet</strong> hiya instance concrète men had modèle. Classe kat7et <strong>propriétés</strong> (données) w <strong>méthodes</strong> (comportements).</p>',
        ),
        1 => 
        array (
          'type' => 'syntax',
          'lang' => 'php',
          'title' => 'Syntaxe d\'une classe',
          'code' => 'class Etudiant {
    public string $nom;
    public int $note;

    public function afficher(): string {
        return $this->nom . " : " . $this->note . "/20";
    }
}

$e = new Etudiant();
$e->nom = "Amal";
$e->note = 16;
echo $e->afficher();',
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Premier objet',
          'lang' => 'php',
          'code' => '<?php
class Etudiant {
    public string $nom;
    public int $note;

    public function afficher(): string {
        return $this->nom . " : " . $this->note . "/20";
    }
}

$e = new Etudiant();
$e->nom = "Amal";
$e->note = 16;

echo $e->afficher();
?>',
          'output' => 'Amal : 16/20',
          'explainFr' => '<code>new Etudiant()</code> crée un objet. <code>$e-&gt;nom</code> accède à une propriété, <code>$this</code> désigne l\'objet courant à l\'intérieur de la classe.',
          'explainDarija' => '<code>new Etudiant()</code> kat5leq objet. <code>$e-&gt;nom</code> katwsel l propriété, <code>$this</code> kat3ni objet li kayn dakhel classe.',
        ),
        3 => 
        array (
          'type' => 'tip',
          'title' => 'Une classe = un fichier',
          'fr' => 'Par convention, une classe vit dans son propre fichier <code>Etudiant.php</code>, avec le même nom que la classe. Cela facilite l\'autoload et la lecture du projet.',
          'darija' => 'B convention, classe katkon f fichier dyalha <code>Etudiant.php</code>, b nefs smiya dyal classe. Hakka autoload w qraya dyal projet kaywliw sahel.',
        ),
      ),
    ),
    1 => 
    array (
      'id' => 'constructeur-this',
      'title' => 'Constructeur et $this',
      'icon' => '🔨',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Le <strong>constructeur</strong> <code>__construct()</code> s\'exécute automatiquement à la création de l\'objet. Il sert à initialiser les propriétés et à garantir qu\'un objet est toujours dans un état valide.</p>',
          'darija' => '<p><strong>Constructeur</strong> <code>__construct()</code> kaynffed automatiquement melli kayt5leq objet. Kaybda propriétés w kaydmen objet ykon dima f 7ala valide.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Constructeur avec paramètres',
          'lang' => 'php',
          'code' => '<?php
class Etudiant {
    public function __construct(
        private string $nom,
        private int $note
    ) {}

    public function mention(): string {
        if ($this->note >= 16) return "Excellent";
        if ($this->note >= 12) return "Bien";
        if ($this->note >= 10) return "Passable";
        return "Insuffisant";
    }
}

$e = new Etudiant("Amal", 16);
echo $e->nom . " : " . $e->mention();
?>',
          'output' => 'Amal : Excellent',
          'explainFr' => 'La promotion de propriétés dans le constructeur (PHP 8) déclare et initialise <code>$nom</code> et <code>$note</code> en une seule fois. <code>$this-&gt;note</code> lit la propriété de l\'objet.',
          'explainDarija' => 'Promotion dyal propriétés f constructeur (PHP 8) kat3len w katbda <code>$nom</code> w <code>$note</code> f marra wa7da. <code>$this-&gt;note</code> katqra propriété dyal objet.',
        ),
        2 => 
        array (
          'type' => 'warning',
          'title' => '$this hors d\'une méthode',
          'fr' => '<code>$this</code> n\'existe que dans une méthode d\'instance. L\'utiliser dans une fonction globale ou une méthode statique provoque une erreur.',
          'darija' => '<code>$this</code> katkayn ghir f méthode d\'instance. Ila khdemti biha f fonction globale wla méthode statique, ghadi t3tik erreur.',
        ),
      ),
    ),
    2 => 
    array (
      'id' => 'encapsulation',
      'title' => 'Visibilité et encapsulation',
      'icon' => '🔒',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>Les mots-clés <strong>public</strong>, <strong>protected</strong> et <strong>private</strong> contrôlent l\'accès aux membres. L\'<strong>encapsulation</strong> consiste à cacher les données internes et à exposer des méthodes contrôlées (getters/setters).</p>',
          'darija' => '<p>Kelmat <strong>public</strong>, <strong>protected</strong> w <strong>private</strong> kaycontroliw accès l membres. <strong>Encapsulation</strong> hiya tkhbi données dakhliya w t3red méthodes contrôlées (getters/setters).</p>',
        ),
        1 => 
        array (
          'type' => 'table',
          'headers' => 
          array (
            0 => 'Visibilité',
            1 => 'Depuis la classe',
            2 => 'Depuis une classe enfant',
            3 => 'Depuis l\'extérieur',
          ),
          'rows' => 
          array (
            0 => 
            array (
              0 => 'public',
              1 => 'oui',
              2 => 'oui',
              3 => 'oui',
            ),
            1 => 
            array (
              0 => 'protected',
              1 => 'oui',
              2 => 'oui',
              3 => 'non',
            ),
            2 => 
            array (
              0 => 'private',
              1 => 'oui',
              2 => 'non',
              3 => 'non',
            ),
          ),
        ),
        2 => 
        array (
          'type' => 'example',
          'title' => 'Protéger une note',
          'lang' => 'php',
          'code' => '<?php
class Etudiant {
    public function __construct(private int $note = 0) {}

    public function setNote(int $note): void {
        if ($note < 0 || $note > 20) {
            throw new InvalidArgumentException("Note entre 0 et 20");
        }
        $this->note = $note;
    }

    public function getNote(): int {
        return $this->note;
    }
}

$e = new Etudiant(12);
$e->setNote(18);
echo $e->getNote();
?>',
          'output' => '18',
          'explainFr' => 'La propriété est <code>private</code> : impossible d\'écrire <code>$e-&gt;note = 25</code>. Le setter valide la valeur avant de la stocker.',
          'explainDarija' => 'Propriété <code>private</code> : ma tqderch tkteb <code>$e-&gt;note = 25</code>. Setter kayvalidi valeur qbel ma ykhzenha.',
        ),
      ),
    ),
    3 => 
    array (
      'id' => 'heritage',
      'title' => 'Héritage',
      'icon' => '🌳',
      'blocks' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'fr' => '<p>L\'<strong>héritage</strong> permet à une classe enfant (<code>extends</code>) de réutiliser les membres d\'une classe parente. On peut <strong>surcharger</strong> une méthode pour adapter son comportement.</p>',
          'darija' => '<p><strong>Héritage</strong> kaykhalli classe enfant (<code>extends</code>) t3awed testa3mel membres dyal classe parente. T9der <strong>surcharger</strong> méthode bach tbeddel comportement dyalha.</p>',
        ),
        1 => 
        array (
          'type' => 'example',
          'title' => 'Personne et Etudiant',
          'lang' => 'php',
          'code' => '<?php
class Personne {
    public function __construct(protected string $nom) {}

    public function presentation(): string {
        return "Je suis " . $this->nom;
    }
}

class Etudiant extends Personne {
    public function __construct(string $nom, private string $filiere) {
        parent::__construct($nom);
    }

    public function presentation(): string {
        return parent::presentation() . ", étudiant en " . $this->filiere;
    }
}

$e = new Etudiant("Amal", "Informatique");
echo $e->presentation();
?>',
          'output' => 'Je suis Amal, étudiant en Informatique',
          'explainFr' => '<code>parent::__construct()</code> appelle le constructeur du parent. La méthode surchargée ajoute l\'information de filière tout en réutilisant le texte du parent.',
          'explainDarija' => '<code>parent::__construct()</code> kat3ayet constructeur dyal parent. Méthode surchargée kat3awn information dyal filière w kat3awed testa3mel texte dyal parent.',
        ),
      ),
    ),
  ),
  'mistakes' => 
  array (
    0 => 
    array (
      'wrong' => '$etudiant = Etudiant();',
      'fix' => '$etudiant = new Etudiant();',
      'fr' => 'Un objet se crée avec <code>new</code>. Sans ce mot-clé, PHP cherche une fonction.',
      'darija' => 'Objet kayt5leq b <code>new</code>. Bla had kelma, PHP kayqelleb 3la fonction.',
    ),
    1 => 
    array (
      'wrong' => 'echo $this->nom; en dehors d\'une méthode',
      'fix' => 'Utiliser $objet->nom depuis l\'extérieur (si public), ou $this->nom dans la classe.',
      'fr' => '<code>$this</code> n\'a de sens qu\'à l\'intérieur d\'une méthode d\'instance.',
      'darija' => '<code>$this</code> 3ndha ma3na ghir dakhel méthode d\'instance.',
    ),
    2 => 
    array (
      'wrong' => 'Accéder à une propriété private depuis l\'extérieur',
      'fix' => 'Passer par un getter public.',
      'fr' => '<code>private</code> interdit l\'accès externe : c\'est voulu. Exposez une méthode <code>get...</code> si nécessaire.',
      'darija' => '<code>private</code> katmna3 accès men bera : hadi hiya l\'fikra. 3red méthode <code>get...</code> ila khas.',
    ),
  ),
  'summary' => 
  array (
    'fr' => 'La <strong>POO</strong> organise le code en <strong>classes</strong> (modèles) et <strong>objets</strong> (instances). Une classe contient des <strong>propriétés</strong> et des <strong>méthodes</strong>, initialisées par un <strong>constructeur</strong>. <code>public</code>, <code>protected</code> et <code>private</code> contrôlent l\'accès. L\'<strong>héritage</strong> réutilise une classe parente avec <code>extends</code>.',
    'darija' => '<strong>POO</strong> katt3adel code b <strong>classes</strong> (modèles) w <strong>objets</strong> (instances). Classe kat7et <strong>propriétés</strong> w <strong>méthodes</strong>, kaybdaw b <strong>constructeur</strong>. <code>public</code>, <code>protected</code> w <code>private</code> kaycontroliw accès. <strong>Héritage</strong> kay3awed yesta3mel classe parente b <code>extends</code>.',
  ),
);

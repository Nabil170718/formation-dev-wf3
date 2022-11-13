Les propriétés

Code : 

class Animal {
   var $race;
   var $color;
   var $paws_count;
}

$animal = new Animal();
$animal->race = 'chien'; // Accès à l'attribut race en écriture, affecte la valeur 'chien'
echo $animal->race;      // Accès à l'attribut race en lecture, affiche 'chien'

--$this--

class Product {
   private $name;
   public function getName() {
       return $this->name;
   }
   public function setName($name) {
       $this->name = $name;
   }
}

$product = new Product();
$product->setName('Product Name'); // Définit la valeur de la propriété name
echo $product->getName();          // Retourne et affiche la valeur de la propriété name

Le constructeur

Code :

class Animal {
   public $race;
   public $color;
   public function __construct($race='', $color='') {
       $this->race = $race;
       $this->color = $color;
   }
}

$animal = new Animal(); // Appel implicite à $animal->__construct()
$chien = new Animal('chien', 'noir'); // Appel implicite à $chien->__construct('chien', 'noir')

Les méthodes statiques

class MyClass {
   public static $msg = 'Hello world !';
   public static function myStaticMethod() {
        echo self::$msg;
   }
   public static function anotherStaticMethod() {
        echo self::myStaticMethod();
   }
}
MyClass::anotherStaticMethod(); // Appelle myStaticMethod() et affiche Hello world !


La visibilité 

Code : 

class Animal {
   private $_race;
   public $color;
   private function _getRace() {
        return $this->_race;
   }
   public function showRace() {
       echo $this->_getRace();
   }
   public function setRace($race) {
       $this->_race = $race;
   }
   public function getColor() {
       echo $this->color;
   }
}

$animal = new Animal();
$animal->_race = 'chien';  // Fatal error car l'attribut _race est private donc accessible seulement dans la classe
$animal->color = 'noir';   // Pas d'erreur car l'attribut est public donc accessible depuis l'extérieur de la classe
$animal->setRace('chien'); // Pas d'erreur car la méthode setRace est public donc accessible depuis l'extérieur de la classe, et accède à l'attribut _race à l'intérieur de la classe, affecte la valeur chien à l'attribut _race
$animal->_getRace();       // Fatal error car la méthode _getRace est private donc accessible seulement dans la classe
$animal->showRace();       // Pas d'erreur car la méthode showRace est public et appelle la méthode _getRace à l'intérieur de la classe, affiche chien
$animal->getColor();       // Pas d'erreur car la méthode getColor est public


Héritage

Code : 

class Vehicule {
   /* Code */
}

class Voiture extends Vehicule {
   /* Code */
}

class Vehicule {
   private $couleur;
   public function avancer() {
       /* ... */
   }
}

class Voiture extends Vehicule {
   private $vitresElectriques;
   private $consommationAux100;
   public function klaxonner() {
       /* ... */
   }
}

Surcharge de méthode

Code :

class Vehicule {
   public function getMaxSpeed() {
       return 30;
   }
}

class Voiture extends Vehicule {
   public function getMaxSpeed() {
       return 180;
   }
}

$uneVoiture = new Voiture();
echo $uneVoiture->getMaxSpeed(); // Affichera 180

// Il est possible, dans une classe enfant, de faire appel à une méthode de la classe parent :

class Foo {
   public function printItem($string) {
       echo "Impression dans Foo : ". $string ."
";
   }
}

class Bar extends Foo {
   public function printItem($string) {
       echo "Impression dans Bar : ". $string ."
";
   }
}       

$foo = new Foo();
$bar = new Bar();

$itemToPrint = 'Test';



$foo->printItem($itemToPrint); // Affichera Impression dans Foo ...

$bar->printItem($itemToPrint); // Affichera Impression dans Bar ...

class Bar extends Foo {
   public function printItem($string) {
       echo "Impression dans Bar : ". $string ."
";
       parent::printItem($string);
   }
}

$bar = new Bar();
$bar->printItem('Test');


Les espaces de noms :

// inc/Foo.class.php
namespace MyProject\Tools;

/* La classe Foo existe dans le "contexte", ou namespace, MyProject\Tools */
class Foo {
   public function doStuff() {
       echo 'I\'m so busy doing stuff.';
   }
}

// test.php
require_once 'inc/Foo.class.php';
$foo = new MyProject\Tools\Foo();

/* Sans namespace, on aurait écrit : */
$foo = new Foo();

// test.php
require_once 'inc/Foo.class.php';
use \MyProject\Tools\Foo as FooTool;

$foo = new FooTool();

namespace MyProject\Pages;
class Foo {
   public function __construct() {
       echo 'Je suis dans le namespace Pages';
   }
}

namespace MyProject\Tools;
class Foo {
   public function __construct() {
       echo 'Je suis dans le namespace Tools';
   }
}

use \MyProject\Pages\Foo as AFoo;
use \MyProject\Tools\Foo as Fooer;

$foo1 = new AFoo();  // Affichera Je suis dans le namespace Pages
$foo2 = new Fooer(); // Affichera Je suis dans le namespace Tools


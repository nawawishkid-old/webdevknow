# Abstract factory pattern
Provide an interface for creating families of related or dependent objects without specifying their concrete classes.[1]  

Provides a way to encapsulate a group of individual factories that have a common theme without specifying their concrete classes. In normal usage, the client software creates a concrete implementation of the abstract factory and then uses the generic interface of the factory to create the concrete objects that are part of the theme. The client doesn't know (or care) which concrete objects it gets from each of these internal factories, since it uses only the generic interfaces of their products.[1] This pattern separates the details of implementation of a set of objects from their general usage and relies on object composition, as object creation is implemented in methods exposed in the factory interface.[2]  

## Examples
### JSON illustration:
```json
{
  "AbstractSomethingFactory": {
    "createProduct": ""
  },

  "ConcreteSomethingFactoryOne": {
    "extends": "AbstractSomethingFactory",
    "createProduct": "new ConcreteProductOne"
  },
  "ConcreteSomethingFactoryTwo": {
    "extends": "AbstractSomethingFactory",
    "createProduct": "new ConcreteProductTwo"
  },
  "ConcreteSomethingFactoryN": {
    "extends": "AbstractSomethingFactory",
    "createProduct": "new ConcreteProductN"
  },

  "AbstractProduct": {},

  "ConcreteProductOne": {
    "extends": "AbstractProduct"
  },
  "ConcreteProductTwo": {
    "extends": "AbstractProduct"
  },
  "ConcreteProductN": {
    "extends": "AbstractProduct"
  }
}
```
### PHP #1:
https://en.wikipedia.org/wiki/Abstract_factory_pattern#PHP_example
```php
<?php

interface Button
{
    public function paint();
}

interface GUIFactory
{
    public function createButton(): Button;
}

class WinFactory implements GUIFactory
{
    public function createButton(): Button
    {
        return new WinButton();
    }
}

class OSXFactory implements GUIFactory
{
    public function createButton(): Button
    {
        return new OSXButton();
    }
}

class WinButton implements Button
{
    public function paint()
    {
        echo "Windows Button";
    }
}

class OSXButton implements Button
{
    public function paint()
    {
        echo "OSX Button";
    }
}

$appearance = "osx";

$factory = NULL;

switch ($appearance) {
    case "win":
        $factory = new WinFactory();
        break;
    case "osx":
        $factory = new OSXFactory();
        break;
    default:
        break;
}

$button = $factory->createButton();
$button->paint();
```
### PHP #2:
https://sourcemaking.com/design_patterns/abstract_factory/php/2
```php
<?php

/*
 * BookFactory classes
 */
abstract class AbstractBookFactory {
    abstract function makePHPBook();
    abstract function makeMySQLBook();
}

class OReillyBookFactory extends AbstractBookFactory {
    private $context = "OReilly";
    function makePHPBook() {
        return new OReillyPHPBook;
    }
    function makeMySQLBook() {
        return new OReillyMySQLBook;
    }
}

class SamsBookFactory extends AbstractBookFactory {
    private $context = "Sams";
    function makePHPBook() {
        return new SamsPHPBook;
    }
    function makeMySQLBook() {
        return new SamsMySQLBook;
    }
}

/*
 *   Book classes
 */
abstract class AbstractBook {
    abstract function getAuthor();
    abstract function getTitle();
}

abstract class AbstractMySQLBook extends AbstractBook {
    private $subject = "MySQL";
}

class OReillyMySQLBook extends AbstractMySQLBook {
    private $author;
    private $title;
    function __construct() {
        $this->author = 'George Reese, Randy Jay Yarger, and Tim King';
        $this->title = 'Managing and Using MySQL';
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
}

class SamsMySQLBook extends AbstractMySQLBook {
    private $author;
    private $title;
    function __construct() {
        $this->author = 'Paul Dubois';
        $this->title = 'MySQL, 3rd Edition';
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
}

abstract class AbstractPHPBook extends AbstractBook {
    private $subject = "PHP";
}

class OReillyPHPBook extends AbstractPHPBook {
    private $author;
    private $title;
    private static $oddOrEven = 'odd';
    function __construct()
    {
        //alternate between 2 books
        if ('odd' == self::$oddOrEven) {
            $this->author = 'Rasmus Lerdorf and Kevin Tatroe';
            $this->title = 'Programming PHP';
            self::$oddOrEven = 'even';
        }
        else {
            $this->author = 'David Sklar and Adam Trachtenberg';
            $this->title = 'PHP Cookbook';
            self::$oddOrEven = 'odd';
        }
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
}

class SamsPHPBook extends AbstractPHPBook {
    private $author;
    private $title;
    function __construct() {
        //alternate randomly between 2 books
        mt_srand((double)microtime() * 10000000);
        $rand_num = mt_rand(0, 1);

        if (1 > $rand_num) {
            $this->author = 'George Schlossnagle';
            $this->title = 'Advanced PHP Programming';
        }
        else {
            $this->author = 'Christian Wenz';
            $this->title = 'PHP Phrasebook';
        }
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
}

/*
 *   Initialization
 */

  writeln('BEGIN TESTING ABSTRACT FACTORY PATTERN');
  writeln('');

  writeln('testing OReillyBookFactory');
  $bookFactoryInstance = new OReillyBookFactory;
  testConcreteFactory($bookFactoryInstance);
  writeln('');

  writeln('testing SamsBookFactory');
  $bookFactoryInstance = new SamsBookFactory;
  testConcreteFactory($bookFactoryInstance);

  writeln("END TESTING ABSTRACT FACTORY PATTERN");
  writeln('');

  function testConcreteFactory($bookFactoryInstance)
  {
      $phpBookOne = $bookFactoryInstance->makePHPBook();
      writeln('first php Author: '.$phpBookOne->getAuthor());
      writeln('first php Title: '.$phpBookOne->getTitle());

      $phpBookTwo = $bookFactoryInstance->makePHPBook();
      writeln('second php Author: '.$phpBookTwo->getAuthor());
      writeln('second php Title: '.$phpBookTwo->getTitle());

      $mySqlBook = $bookFactoryInstance->makeMySQLBook();
      writeln('MySQL Author: '.$mySqlBook->getAuthor());
      writeln('MySQL Title: '.$mySqlBook->getTitle());
  }

  function writeln($line_in) {
    echo $line_in."<br/>";
  }

?>
```
### PHP #3:
https://sourcemaking.com/design_patterns/abstract_factory/php/3
```php
<?php
/*
 *  Abstract Factory classes
 */

abstract class DB_Abstraction_Factory {
    protected $settings = array();
    protected function __construct() {
        $this->settings = Settings::getInstance();
    }
 
    abstract public function createInstance();
}
 
class DB_Abstraction_Factory_ADODB extends DB_Abstraction_Factory {
    public function __construct() {
        parent::__construct();
    }
    public function createInstance() {
        require_once('/path/to/adodb_lite/adodb.inc.php');
        $dsn = $this->settings['db.dsn'];
        $db = ADONewConnection($dsn);
        return $db;
    }
}
 
class DB_Abstraction_Factory_MDB2 extends DB_Abstraction_Factory {
    public function __construct() {
        parent::__construct();
    }
    public function createInstance() {
        require_once 'MDB2.php';
        $dsn = $this->settings['db.dsn'];
        $db = MDB2::factory($dsn);
        return $db;
    }
}

class DB_Abstraction_AbstractFactory {
    public static function getFactory() {
        $settings = Settings::getInstance();
        switch($settings['db.library'])
        {
            case 'adodblite':
                $factory = new DB_Abstraction_Factory_ADODBLITE();
            break;
            case 'mdb2';
                $factory = new DB_Abstraction_Factory_MDB2();
            break;
        }
        return $factory;
    }
 }

/*
 *  Client's code
 */

// instantiate Abstract Factory
$abstractfactory = new DB_Abstraction_AbstractFactory();
 
// fetch a concrete Factory (decision handled in Abstract Factory static method)
$factory = $abstractfactory::getFactory();
 
// use concrete Factory to create a database connection object from
// the selected database abstraction library
$db = $factory->createInstance();
?>
```
### PHP #4:
```php
<?php

class AbstractSomethingFactory
{
    abstract public function createProduct();
}

class AbstractProduct
{
    abstract public function doSomething();
}

class ConcreteSomethingFactoryOne extends AbstractSomethingFactory
{
    public function createProduct()
    {
        return new ConcreteProductOne();
    }
}

class ConcreteSomethingFactoryTwo extends AbstractSomethingFactory
{
    public function createProduct()
    {
        return new ConcreteProductTwo();
    }
}

class ConcreteSomethingFactoryN extends AbstractSomethingFactory
{
    public function createProduct()
    {
        return new ConcreteProductN();
    }
}

class ConcreteProductOne extends AbstractProduct
{
    public function doSomething()
    {
        // do something
    }
}

class ConcreteProductTwo extends AbstractProduct
{
    public function doSomething()
    {
        // do something
    }
}

class ConcreteProductN extends AbstractProduct
{
    public function doSomething()
    {
        // do something
    }
}
```

## Sources
- [1] https://sourcemaking.com/design_patterns/abstract_factory
- [2] https://en.wikipedia.org/wiki/Abstract_factory_pattern

## See also
- Factory/Abstract factory confusion: https://stackoverflow.com/questions/4719822/factory-abstract-factory-confusion
- Factory: https://en.wikipedia.org/wiki/Factory_(object-oriented_programming)
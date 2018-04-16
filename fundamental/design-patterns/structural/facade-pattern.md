# Facade pattern

> Provide a unified interface to a set of interfaces in a subsystem. The Facade defines a unified, higher level interface to a subsystem that makes it easier to use.<sup>[[1]](#sources)</sup>  

![Example of Facade desgin pattern in UML](https://upload.wikimedia.org/wikipedia/en/5/57/Example_of_Facade_design_pattern_in_UML.png)

A facade is an object that provides a simplified interface to a larger body of code, such as a class library. A facade can:
- make a software library easier to use, understand, and test, since the facade has convenient methods for common tasks
- make the library more readable, for the same reason
- reduce dependencies of outside code on the inner workings of a library, since most code uses the facade, thus allowing more flexibility in developing the system
- wrap a poorly-designed collection of APIs with a single well-designed API

Implementors often use the facade design pattern when a system is very complex or difficult to understand because the system has a large number of interdependent classes or because its source code is unavailable. This pattern hides the complexities of the larger system and provides a simpler interface to the client. It typically involves a single wrapper class that contains a set of members required by the client. These members access the system on behalf of the facade client and hide the implementation details.

## Examples
#### Ruby:
(https://en.wikipedia.org/wiki/Facade_pattern)
```ruby
# Complex Parts
class CPU
  def freeze; end
  def jump(position); end
  def execute; end
end

class Memory
  def load(position, data); end
end

class HardDrive
  def read(lba, size); end
end

# Facade
class ComputerFacade

  def initialize
    @processor = CPU.new
    @ram = Memory.new
    @hd = HardDrive.new
  end

  def start
    @processor.freeze
    @ram.load(BOOT_ADDRESS, @hd.read(BOOT_SECTOR, SECTOR_SIZE))
    @processor.jump(BOOT_ADDRESS)
    @processor.execute
  end
end

# Client
computer_facade = ComputerFacade.new
computer_facade.start
```
#### PHP #1:
(https://en.wikipedia.org/wiki/Facade_pattern)
```php
/**
 * The complicated, underlying logic.
 */
class CPU
{
  public function freeze() {/* ... */}
  public function jump($position) {/* ... */}
  public function execute() {/* ... */}
}

class Memory
{
  public function load($position, $data) {/* ... */}
}

class HardDrive
{
  public function read($lba, $size) {/* ... */}
}

/**
 * The facade that users would be interacting with.
 */
class ComputerFacade
{
  protected $cpu;
  protected $memory;
  protected $hd;

  public function __construct()
  {
    $this->cpu = new CPU;
    $this->ram = new Memory;
    $this->hd = new HardDrive;
  }

  public function start()
  {
    $this->cpu->freeze();
    $this->ram->load(BOOT_ADDRESS, $this->hd->read(BOOT_SECTOR, SECTOR_SIZE));
    $this->cpu->jump(BOOT_ADDRESS);
    $this->cpu->execute();
  }
}

/**
 * How a user could start the computer.
 */
$computer = new ComputerFacade;
$computer->start();
```
#### PHP #2:
(https://sourcemaking.com/design_patterns/facade/php)
```php
<?php

class Book {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
    function getAuthorAndTitle() {
        return $this->getTitle().' by '.$this->getAuthor();
    }
}

class CaseReverseFacade {
    public static function reverseStringCase($stringIn) {
        $arrayFromString = ArrayStringFunctions::stringToArray($stringIn);
        $reversedCaseArray = ArrayCaseReverse::reverseCase($arrayFromString);
        $reversedCaseString = ArrayStringFunctions::arrayToString($reversedCaseArray);
        return $reversedCaseString;
    }
}

class ArrayCaseReverse {
    private static $uppercase_array = 
        array('A', 'B', 'C', 'D', 'E', 'F',
              'G', 'H', 'I', 'J', 'K', 'L',
              'M', 'N', 'O', 'P', 'Q', 'R',
              'S', 'T', 'U', 'V', 'W', 'X',
              'Y', 'Z');
    private static $lowercase_array = 
        array('a', 'b', 'c', 'd', 'e', 'f',
              'g', 'h', 'i', 'j', 'k', 'l',
              'm', 'n', 'o', 'p', 'q', 'r',
              's', 't', 'u', 'v', 'w', 'x',
              'y', 'z');
    public static function reverseCase($arrayIn) {
        $array_out = array();
        for ($x = 0; $x < count($arrayIn); $x++) {
         if (in_array($arrayIn[$x], self::$uppercase_array)) {
                 $key = array_search($arrayIn[$x], self::$uppercase_array);
         $array_out[$x] = self::$lowercase_array[$key];
         } elseif (in_array($arrayIn[$x], self::$lowercase_array)) {
                 $key = array_search($arrayIn[$x], self::$lowercase_array);
         $array_out[$x] = self::$uppercase_array[$key];
             } else {
         $array_out[$x] = $arrayIn[$x];
             }
        }
    return $array_out;
    }
}

class ArrayStringFunctions {
    public static function arrayToString($arrayIn) {
      $string_out = NULL;
      foreach ($arrayIn as $oneChar) {
        $string_out .= $oneChar;
      }
      return $string_out;
    }
    public static function stringToArray($stringIn) {
      return str_split($stringIn);
    }
}
```
#### C#:
(https://en.wikipedia.org/wiki/Facade_pattern)
```c#
namespace DesignPattern.Facade.Sample
{
    // The 'Subsystem ClassA' class
    class CarModel
    {
        public void SetModel()
        {
            Console.WriteLine(" CarModel - SetModel");
        }
    }

    /// <summary>
    /// The 'Subsystem ClassB' class
    /// </summary>
    class CarEngine
    {
        public void SetEngine()
        {
            Console.WriteLine(" CarEngine - SetEngine");
        }
    }

    // The 'Subsystem ClassC' class
    class CarBody
    {
        public void SetBody()
        {
            Console.WriteLine(" CarBody - SetBody");
        }
    }

    // The 'Subsystem ClassD' class
    class CarAccessories
    {
        public void SetAccessories()
        {
            Console.WriteLine(" CarAccessories - SetAccessories");
        }
    }

    // The 'Facade' class
    public class CarFacade
    {
        private readonly CarAccessories accessories;
        private readonly CarBody body;
        private readonly CarEngine engine;
        private readonly CarModel model;

        public CarFacade()
        {
            accessories = new CarAccessories();
            body = new CarBody();
            engine = new CarEngine();
            model = new CarModel();
        }

        public void CreateCompleteCar()
        {
            Console.WriteLine("******** Creating a Car **********");
            model.SetModel();
            engine.SetEngine();
            body.SetBody();
            accessories.SetAccessories();

            Console.WriteLine("******** Car creation is completed. **********");
        }
    }

    // Facade pattern demo
    class Program
    {
        static void Main(string[] args)
        {
            var facade = new CarFacade();

            facade.CreateCompleteCar();

            Console.ReadKey();
        }
    }
}
```
#### Java:
(https://en.wikipedia.org/wiki/Facade_pattern)
```java
/* Complex parts */

class CPU {
    public void freeze() { ... }
    public void jump(long position) { ... }
    public void execute() { ... }
}

class HardDrive {
    public byte[] read(long lba, int size) { ... }
}

class Memory {
    public void load(long position, byte[] data) { ... }
}

/* Facade */

class ComputerFacade {
    private CPU processor;
    private Memory ram;
    private HardDrive hd;

    public ComputerFacade() {
        this.processor = new CPU();
        this.ram = new Memory();
        this.hd = new HardDrive();
    }

    public void start() {
        processor.freeze();
        ram.load(BOOT_ADDRESS, hd.read(BOOT_SECTOR, SECTOR_SIZE));
        processor.jump(BOOT_ADDRESS);
        processor.execute();
    }
}

/* Client */

class You {
    public static void main(String[] args) {
        ComputerFacade computer = new ComputerFacade();
        computer.start();
    }
}
```

## Sources
- [1] https://sourcemaking.com/design_patterns/facade
- https://en.wikipedia.org/wiki/Facade_pattern

## See also
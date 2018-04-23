# Singleton pattern
> ...restricts the instantiation of a class to one object. This is useful when exactly one object is needed to coordinate actions across the system.<sup>[[1]](#sources)</sup>

#### An implementation of the singleton pattern must:
- ensure that only one instance of the singleton class ever exists; and
- provide global access to that instance.

Typically, this is done by:
- declaring all constructors of the class to be private; and
- providing a static method that returns a reference to the instance.

The instance is usually stored as a private static variable; the instance is created when the variable is initialized, at some point before the static method is first called.

<blockquote>
  Essentially, the Singleton pattern is just another form of the global state. Singletons promote obscure APIs that lie about real dependencies and introduce unnecessarily tight coupling between components. They also violate the Single Responsibility Principle because, in addition to their primary duties, they control their own initialization and lifecycle.

  Singletons can easily make unit tests order-dependent because they carry state around for the lifetime of the whole application or unit test suite.
</blockquote>

quote from [TopTal](https://www.toptal.com/qa/how-to-write-testable-code-and-why-it-matters)

## Examples
#### Java #1:
(https://en.wikipedia.org/wiki/Singleton_pattern#Lazy_initialization)
```java
public final class Singleton {
    private static volatile Singleton instance = null;

    private Singleton() {}

    public static Singleton getInstance() {
        if (instance == null) {
            synchronized(Singleton.class) {
                if (instance == null) {
                    instance = new Singleton();
                }
            }
        }
        return instance;
    }
}
```
#### PHP #1:
(https://sourcemaking.com/design_patterns/singleton/php/1)
```php
<?php

/*
 *   Singleton classes
 */
class BookSingleton {
    private $author = 'Gamma, Helm, Johnson, and Vlissides';
    private $title  = 'Design Patterns';
    private static $book = NULL;
    private static $isLoanedOut = FALSE;

    private function __construct() {
    }

    static function borrowBook() {
      if (FALSE == self::$isLoanedOut) {
        if (NULL == self::$book) {
           self::$book = new BookSingleton();
        }
        self::$isLoanedOut = TRUE;
        return self::$book;
      } else {
        return NULL;
      }
    }

    function returnBook(BookSingleton $bookReturned) {
        self::$isLoanedOut = FALSE;
    }

    function getAuthor() {return $this->author;}

    function getTitle() {return $this->title;}

    function getAuthorAndTitle() {
      return $this->getTitle() . ' by ' . $this->getAuthor();
    }
  }
 
class BookBorrower {
    private $borrowedBook;
    private $haveBook = FALSE;

    function __construct() {
    }

    function getAuthorAndTitle() {
      if (TRUE == $this->haveBook) {
        return $this->borrowedBook->getAuthorAndTitle();
      } else {
        return "I don't have the book";
      }
    }

    function borrowBook() {
      $this->borrowedBook = BookSingleton::borrowBook();
      if ($this->borrowedBook == NULL) {
        $this->haveBook = FALSE;
      } else {
        $this->haveBook = TRUE;
      }
    }

    function returnBook() {
      $this->borrowedBook->returnBook($this->borrowedBook);
    }
  }
 ```
#### PHP #2:
(http://designpatternsphp.readthedocs.io/en/latest/Creational/Singleton/README.html)
```php
<?php

final class Singleton
{
    /**
     * @var Singleton
     */
    private static $instance;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): Singleton
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }
}
```

## Sources
- [1] https://en.wikipedia.org/wiki/Singleton_pattern  
- https://sourcemaking.com/design_patterns/singleton
- http://designpatternsphp.readthedocs.io/en/latest/Creational/Singleton/README.html

## See also
- Lazy initialization: https://en.wikipedia.org/wiki/Lazy_initialization
- Why singleton have no use in PHP?: http://blog.gordon-oheim.biz/2011-01-17-Why-Singletons-have-no-use-in-PHP/
# Design pattern
- https://en.wikipedia.org/wiki/Design_Patterns  
- https://sourcemaking.com/design_patterns
- Design patterns in PHP: http://designpatternsphp.readthedocs.io/en/latest/Creational/AbstractFactory/README.html

## 1. Creational pattern
### Abstract factory
Provide an interface for creating families of related or dependent objects without specifying their concrete classes.[1]  
Provides a way to encapsulate a group of individual factories that have a common theme without specifying their concrete classes.[2]  - [1] https://sourcemaking.com/design_patterns/abstract_factory
- [2] https://en.wikipedia.org/wiki/Abstract_factory_pattern
- Factory/Abstract factory confusion: https://stackoverflow.com/questions/4719822/factory-abstract-factory-confusion
- Factory: https://en.wikipedia.org/wiki/Factory_(object-oriented_programming)

#### Example
JSON illustration:
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
PHP:
```php
<?php

class AbstractSomethingFactory
{
		abstract public function createProduct();
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

class AbstractProduct
{
		abstract public function doSomething();
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


### Builder
- https://sourcemaking.com/design_patterns/builder

### Factory method
- https://sourcemaking.com/design_patterns/factory_method

### Object pool
- https://sourcemaking.com/design_patterns/object_pool

### Prototype
- https://sourcemaking.com/design_patterns/prototype

### Singleton
- https://en.wikipedia.org/wiki/Singleton_pattern  

## 2. Structural pattern
### Adapter
- 

### Bridge
- 

### Composite
- 

### Decorator
- 

### Facade
- https://en.wikipedia.org/wiki/Facade_pattern  

### Flyweight
- 

### Private class data
- 

### Proxy
- 

## 3. Behavioral pattern
### Chain of responsibility
- 

### Command
- 

### Interpreter
-

### Iterator
- 

### Mediator
- 

### Memento
- 

### Null object
- 

### Observer
- 

### State
- 

### Strategy
- 

### Template method
-

### Visitor
- 



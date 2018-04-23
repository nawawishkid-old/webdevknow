# Testing

#### Unit Tests, How to Write Testable Code and Why it Matters
- https://www.toptal.com/qa/how-to-write-testable-code-and-why-it-matters

#### How do you unit test private methods?
- https://stackoverflow.com/a/250719/6734629

> You should not test protected/private members directly. They belong to the internal implementation of the class, and should not be coupled with the test. This makes refactoring impossible and eventually you don't test what needs to be tested. You need to test them indirectly using public methods. If you find this difficult, almost sure that there is a problem with the composition of the class and you need to separate it to smaller classes. Keep in mind that your class should be a black box for your test - you throw in something and you get something back, and that's all!

---  [gphilip](https://stackoverflow.com/questions/249664/best-practices-to-test-protected-methods-with-phpunit#comment11573782_2798203)
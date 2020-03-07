## Instalação

1 - Execute o docker
```
./docker-run.sh
```
2 - Instale o composer
```
composer install
```
3 - Rode os testes
```
composer test
```
4 - Acesse o coverage
```
tests-challenge/coverage/index.html
```

5 - Crie os arquivos de teste

## Exemplo de teste
```php
<?php

namespace Tests;

use Iluminate\Container\Container;
use Mockery;

class YourClassTest extends TestCase
{
   public function testYourFunction()
   {
       //declare your input data
       //declare your returns
       //create your mocks
       //instaciate your class
       //call your method
       //assert all the stuff
   }
}
```

## Dicas

```php
$classeMock = \Mockery::Mock(Classe::class)
```
```php
$classeSpy = \Mockery::Spy(Classe::class)
```
```php
$classeMock = \Mockery::mock(Classe::class)->makePartial();
```

## Apresentação

```
https://drive.google.com/open?id=1dN81TLPUgLifMvLDoXYmmrAbbZ4GiSU0
```

## Métodos úteis

```
->shouldReceive('action')
->once()
->twice()
->times()
->never()
->withAnyArgs()
->withNoArgs()
->with()
->withArgs([])
->andReturn()
->andReturnUsing(function (){})
->andReturnSelf()
->andThrowExceptions([new \Exception()]);
->andThrows(new \Exception(), 'error', 500)
```
```
$this->assertInternalType('array', $result);
$this->assertEquals(2, $result);
$this->assertInstanceOf(Class::class, $class);
$this->assertArrayHasKey('key', $myArray);
$this->expectExceptionObject(new \Exception('erro', 401));
```
```
/**
* @covers \Namespace\Class::method
* @expectedException \Exception
* @expectedExceptionCode 500
* @expectedExceptionMessage no publisher set, call connect method before publish
**/
```
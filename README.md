# Entity - A package to help make entities easier

This package contains various things like traits for private immutable attributes, and making entities identifiable with UUID's.

# Installation

```
composer require crudleapps/entity
```

# Example Usage


```php
use Crudle\Entity\Identity\IdentifiedByUuid;
use Crudle\Entity\Property\PrivateImmutableAttributes;

class MyEntity
{
    use IdentifiedByUuid, PrivateImmutableAttributes;

    /**
     * @param string $description
     * @return MyEntity
     */
    public function setDescription(string $description): MyEntity
    {
        return $this->set('description', $description);
    }

    /**
     * @return string
     * @throws \Crudle\Entity\Exception\UndefinedException
     *  When a description has not yet been set
     */
    public function getDescription(): string
    {
        return $this->getOrFail('description');
    }
}

$myEntity = new MyEntity;
$myEntity->getId(); // Crudle\Entity\Identity\Uuid

$myOtherEntity = new MyEntity('fa8588c6-166d-400d-9b13-561704027e94');
```
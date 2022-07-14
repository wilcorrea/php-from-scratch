<?php

declare(strict_types=1);

namespace App\Shared\Entities;

use App\Shared\Entities\Contract\EntityContract;
use DateTimeInterface;
use Exception;
use JsonException;
use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;
use RuntimeException;

use function Helper\generateId;

/**
 * Class Entity
 *
 * @package App\Shared\Entities
 */
abstract class Entity implements EntityContract, JsonSerializable
{
    /**
     * @var string
     */
    protected string $id;

    /**
     * @param array $data
     *
     * @return static
     * @throws Exception
     */
    public static function instance(array $data): static
    {
        $entity = new static();
        $entity->fill($data);
        return $entity;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    protected function setId(string $id): void
    {
        $this->id = $id;
    }


    /**
     * @param array $data
     *
     * @return $this
     * @throws Exception
     */
    public function fill(array $data): self
    {
        if (!isset($data['id'])) {
            $data['id'] = generateId();
        }

        foreach ($data as $attribute => $value) {
            if ($value === null) {
                continue;
            }

            $setter = 'set' . str_replace('_', '', ucwords($attribute, '_'));
            if (!method_exists($this, $setter)) {
                continue;
            }

            $this->$setter($value);
        }
        $properties = (new ReflectionClass($this))->getProperties(
            ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED
        );

        $errors = [];
        foreach ($properties as $property) {
            if ($property->getType()?->allowsNull()) {
                continue;
            }
            $name = $property->getName();
            if (isset($data[$name])) {
                continue;
            }
            $errors[] = $name;
        }

        if (count($errors)) {
            $message = sprintf('Missing required(s) attribute(s) "%s"', implode(', ', $errors));
            throw new RuntimeException($message);
        }
        return $this;
    }

    /**
     * Output an array based on entity properties
     *
     * @param bool $useSnakeCase
     *
     * @return array
     * @throws JsonException
     */
    public function toArray(bool $useSnakeCase = false): array
    {
        $props = [];
        $propertyList = get_object_vars($this);

        foreach ($propertyList as $prop => $value) {
            if ($value instanceof DateTimeInterface) {
                $propertyList[$prop] = $value->format('Y-m-d H:i:s');
            }
        }

        $propertyList = json_decode(json_encode($propertyList, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);

        foreach ($propertyList as $name => $value) {
            if ($useSnakeCase) {
                $name = mb_strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
            }

            $props[$name] = $value;
        }

        return $props;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @throws JsonException
     * @since 5.4
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

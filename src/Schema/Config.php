<?php
namespace GraphQL\Schema;

use GraphQL\Type\Definition\Directive;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Utils;

/**
 * Class Config
 * Note: properties are marked as public for performance reasons. They should be considered read-only.
 *
 * @package GraphQL\Schema
 */
final class Config
{
    /**
     * @var ObjectType
     */
    public $query;

    /**
     * @var ObjectType
     */
    public $mutation;

    /**
     * @var ObjectType
     */
    public $subscription;

    /**
     * @var Type[]
     */
    public $types;

    /**
     * @var Directive[]
     */
    public $directives;

    /**
     * @var Descriptor
     */
    public $descriptor;

    /**
     * @var callable
     */
    public $typeLoader;

    /**
     * @param array $options
     * @return Config
     */
    public static function create(array $options = [])
    {
        $config = new static();

        if (!empty($options)) {
            if (isset($options['query'])) {
                Utils::invariant(
                    $options['query'] instanceof ObjectType,
                    "Schema query must be Object Type if provided but got: " . Utils::getVariableType($options['query'])
                );
                $config->setQuery($options['query']);
            }

            if (isset($options['mutation'])) {
                Utils::invariant(
                    $options['mutation'] instanceof ObjectType,
                    "Schema mutation must be Object Type if provided but got: " . Utils::getVariableType($options['mutation'])
                );
                $config->setMutation($options['mutation']);
            }

            if (isset($options['subscription'])) {
                Utils::invariant(
                    $options['subscription'] instanceof ObjectType,
                    "Schema subscription must be Object Type if provided but got: " . Utils::getVariableType($options['subscription'])
                );
                $config->setSubscription($options['subscription']);
            }

            if (isset($options['types'])) {
                Utils::invariant(
                    is_array($options['types']),
                    "Schema types must be array if provided but got: " . Utils::getVariableType($options['types'])
                );
                $config->setTypes($options['types']);
            }

            if (isset($options['directives'])) {
                Utils::invariant(
                    is_array($options['directives']),
                    "Schema directives must be array if provided but got: " . Utils::getVariableType($options['directives'])
                );
                $config->setDirectives($options['directives']);
            }

            if (isset($options['typeLoader'])) {
                Utils::invariant(
                    is_callable($options['typeLoader']),
                    "Schema type loader must be callable if provided but got: " . Utils::getVariableType($options['typeLoader'])
                );
            }

            if (isset($options['descriptor'])) {
                Utils::invariant(
                    $options['descriptor'] instanceof Descriptor,
                    "Schema descriptor must be instance of GraphQL\\Schema\\Descriptor but got: " . Utils::getVariableType($options['descriptor'])
                );
            }
        }

        return $config;
    }

    /**
     * @return ObjectType
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param ObjectType $query
     * @return Config
     */
    public function setQuery(ObjectType $query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return ObjectType
     */
    public function getMutation()
    {
        return $this->mutation;
    }

    /**
     * @param ObjectType $mutation
     * @return Config
     */
    public function setMutation(ObjectType $mutation)
    {
        $this->mutation = $mutation;
        return $this;
    }

    /**
     * @return ObjectType
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * @param ObjectType $subscription
     * @return Config
     */
    public function setSubscription(ObjectType $subscription)
    {
        $this->subscription = $subscription;
        return $this;
    }

    /**
     * @return Type[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param Type[] $types
     * @return Config
     */
    public function setTypes($types)
    {
        foreach ($types as $index => $type) {
            Utils::invariant(
                $type instanceof Type,
                'Schema types must be GraphQL\Type\Definition\Type[], but entry at index "%s" is "%s"',
                $index,
                Utils::getVariableType($type)
            );
        }

        $this->types = $types;
        return $this;
    }

    /**
     * @return Directive[]
     */
    public function getDirectives()
    {
        return $this->directives;
    }

    /**
     * @param Directive[] $directives
     * @return Config
     */
    public function setDirectives(array $directives)
    {
        foreach ($directives as $index => $directive) {
            Utils::invariant(
                $directive instanceof Directive,
                'Schema directives must be GraphQL\Type\Definition\Directive[] if provided but but entry at index "%s" is "%s"',
                $index,
                Utils::getVariableType($directive)
            );
        }

        $this->directives = $directives;
        return $this;
    }

    /**
     * @return Descriptor
     */
    public function getDescriptor()
    {
        return $this->descriptor;
    }

    /**
     * @param Descriptor $descriptor
     * @return Config
     */
    public function setDescriptor(Descriptor $descriptor)
    {
        $this->descriptor = $descriptor;
        return $this;
    }

    /**
     * @return callable
     */
    public function getTypeLoader()
    {
        return $this->typeLoader;
    }

    /**
     * @param callable $typeLoader
     * @return Config
     */
    public function setTypeLoader(callable $typeLoader)
    {
        $this->typeLoader = $typeLoader;
        return $this;
    }
}

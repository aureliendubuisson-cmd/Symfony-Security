<?php

namespace App\Factory;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;
/**
 * @extends PersistentObjectFactory<Tag>
 *
 * @method static Tag createOne(array $attributes = [])
 * @method static Tag[] createMany(int $number, array|callable $attributes = [])
 * @method static Tag find(object|array|mixed $criteria)
 * @method static Tag findOrCreate(array $attributes)
 * @method static Tag first(string $sortedField = 'id')
 * @method static Tag last(string $sortedField = 'id')
 * @method static Tag random(array $attributes = [])
 * @method static Tag randomOrCreate(array $attributes = [])
 * @method static Tag[] all()
 * @method static Tag[] findBy(array $attributes)
 * @method static Tag[] randomSet(int $number, array $attributes = [])
 * @method static Tag[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TagRepository repository()
 * @method Tag create(array|callable $attributes = [])
 */
final class TagFactory extends PersistentObjectFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function defaults(): array
    {
        return [
            'name' => self::faker()->word(),
            'createdAt' => self::faker()->dateTimeBetween('-1 year'),
        ];
    }

    public static function class(): string
    {
        return Tag::class;
    }
}

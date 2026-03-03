<?php

namespace App\Factory;

use App\Entity\QuestionTag;
use App\Repository\QuestionTagRepository;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<QuestionTag>
 *
 * @method static QuestionTag createOne(array $attributes = [])
 * @method static QuestionTag[] createMany(int $number, array|callable $attributes = [])
 * @method static QuestionTag find(object|array|mixed $criteria)
 * @method static QuestionTag findOrCreate(array $attributes)
 * @method static QuestionTag first(string $sortedField = 'id')
 * @method static QuestionTag last(string $sortedField = 'id')
 * @method static QuestionTag random(array $attributes = [])
 * @method static QuestionTag randomOrCreate(array $attributes = [])
 * @method static QuestionTag[] all()
 * @method static QuestionTag[] findBy(array $attributes)
 * @method static QuestionTag[] randomSet(int $number, array $attributes = [])
 * @method static QuestionTag[] randomRange(int $min, int $max, array $attributes = [])
 * @method static QuestionTagRepository repository()
 * @method QuestionTag create(array|callable $attributes = [])
 */
final class QuestionTagFactory extends PersistentObjectFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function defaults(): array
    {
        return [
            'question' => QuestionFactory::new(),
            'tag' => TagFactory::new(),
            'taggedAt' => \DateTimeImmutable::createFromMutable(self::faker()->datetime()),
        ];
    }

    public static function class(): string
    {
        return QuestionTag::class;
    }
}

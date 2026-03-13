<?php

namespace App\Factory;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Question>
 *
 * @method static Question createOne(array $attributes = [])
 * @method static Question[] createMany(int $number, array|callable $attributes = [])
 * @method static Question find(object|array|mixed $criteria)
 * @method static Question findOrCreate(array $attributes)
 * @method static Question first(string $sortedField = 'id')
 * @method static Question last(string $sortedField = 'id')
 * @method static Question random(array $attributes = [])
 * @method static Question randomOrCreate(array $attributes = [])
 * @method static Question[] all()
 * @method static Question[] findBy(array $attributes)
 * @method static Question[] randomSet(int $number, array $attributes = [])
 * @method static Question[] randomRange(int $min, int $max, array $attributes = [])
 * @method static QuestionRepository repository()
 * @method Question create(array|callable $attributes = [])
 */
final class QuestionFactory extends PersistentObjectFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    public function unpublished(): self
    {
        return self::with(['askedAt' => null]);
    }

    protected function defaults(): array
    {
        return [
            'name' => self::faker()->realText(50),
            'question' => self::faker()->paragraphs(
                self::faker()->numberBetween(1, 4),
                true
            ),
            'askedAt' => self::faker()->dateTimeBetween('-100 days', '-1 minute'),
            'votes' => rand(-20, 50),
            'owner' => UserFactory::new(),
        ];
    }

    public static function class(): string
    {
        return Question::class;
    }
}

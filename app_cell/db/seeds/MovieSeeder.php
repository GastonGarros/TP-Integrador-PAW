<?php


use Phinx\Seed\AbstractSeed;

class MovieSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i=0; $i < 50; $i++) {
            $data[] = [
                'name' => $faker->words(5, true),
                'year' => $faker->year($max = 'now'),
                'director' => $faker->name(),
                'summary' => $faker->text(350)
            ];
        };
        $this->table('movies')->insert($data)->save();
    }
}

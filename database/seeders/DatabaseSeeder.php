<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dataUsers = [
            ['id' => 1, 'surname' => 'Ақын', 'name' => 'Мұрат', 'lastname' => 'Ғалымұлы', 'email' => 'm.aqyn', 'password' => '123123', 'status' => 'director'],
            ['id' => 2, 'surname' => 'Смадинова', 'name' => 'Нургуль', 'lastname' => 'Издебаевна', 'email' => 'n.smadinova', 'password' => '123123', 'status' => 'methodist'],
            ['id' => 3, 'surname' => 'Ахмедеева', 'name' => 'Гульнара', 'lastname' => 'Максатовна', 'email' => 'g.akhmedeeva', 'password' => '123123', 'status' => 'teacher'],
            ['id' => 4, 'surname' => 'Курмангазиева', 'name' => 'Гульмира', 'lastname' => 'Пангереевна', 'email' => 'g.kurmangazieva', 'password' => '123123', 'status' => 'teacher'],
            ['id' => 5, 'surname' => 'Кушербаева', 'name' => 'Гульнара', 'lastname' => 'Жардемовна', 'email' => 'g.kusherbaeva', 'password' => '123123', 'status' => 'teacher'],
            ['id' => 6, 'surname' => 'Исабергенова', 'name' => 'Гүлдана', 'lastname' => 'Аманжановна', 'email' => 'g.isabergenova', 'password' => '123123', 'status' => 'teacher'],
            ['id' => 7, 'surname' => 'Серикбаева', 'name' => 'Нуржамал', 'lastname' => null, 'email' => 'n.serik-baeva', 'password' => '123123', 'status' => 'teacher'],
            ['id' => 8, 'surname' => 'Рахатова', 'name' => 'Жанар', 'lastname' => null, 'email' => 'zh.rakhatova', 'password' => '123123', 'status' => 'teacher'],
            ['id' => 9, 'surname' => 'Төлеу', 'name' => 'Сәнжан', 'lastname' => null, 'email' => 's.toleu', 'password' => '123123', 'status' => 'teacher'],
            ['id' => 10, 'surname' => 'Кожирова', 'name' => 'Эльвира', 'lastname' => 'Сарсенбаевна', 'email' => 'e.kozhirova', 'password' => '123123', 'status' => 'teacher'],
            ['id' => 11, 'surname' => 'Мухаммед', 'name' => 'Бакытджан', 'lastname' => 'Абдуллаұлы', 'email' => 'b.muhammed', 'password' => '123123', 'status' => 'teacher']
        ];

        DB::table('users')->upsert($dataUsers, ['id'], ['surname', 'name', 'lastname', 'email', 'password', 'status']);


        $dataCrusts = [
            ['id' => 1, 'user_id' => 2],
            ['id' => 2, 'user_id' => 3],
            ['id' => 3, 'user_id' => 2],
            ['id' => 4, 'user_id' => 2],
            ['id' => 5, 'user_id' => 3],
            ['id' => 6, 'user_id' => 3],
            ['id' => 7, 'user_id' => 4],
            ['id' => 8, 'user_id' => 5],
            ['id' => 9, 'user_id' => 6],
            ['id' => 10, 'user_id' => 7],
            ['id' => 11, 'user_id' => 5],
            ['id' => 12, 'user_id' => 5],
            ['id' => 13, 'user_id' => 5],
            ['id' => 14, 'user_id' => 7],
            ['id' => 15, 'user_id' => 7],
            ['id' => 16, 'user_id' => 7],
            ['id' => 17, 'user_id' => 11],
            ['id' => 18, 'user_id' => 11],
            ['id' => 19, 'user_id' => 11],
            ['id' => 20, 'user_id' => 11],
        ];
        DB::table('crusts')->upsert($dataCrusts, ['id'], ['user_id']);


        $dataOrgs = [
            ['id' => 1, 'name_kk' => 'МГӨБ-1', 'name_ru' => 'НГДУ-1', 'email' => 'ssssssssss'],
            ['id' => 2, 'name_kk' => 'МГӨБ-2', 'name_ru' => 'НГДУ-2', 'email' => 'ssssssssss'],
            ['id' => 3, 'name_kk' => 'МГӨБ-3', 'name_ru' => 'НГДУ-3', 'email' => 'ssssssssss'],
            ['id' => 4, 'name_kk' => 'МГӨБ-4', 'name_ru' => 'НГДУ-4', 'email' => 'ssssssssss'],
            ['id' => 5, 'name_kk' => 'МДжӨҚКБ', 'name_ru' => 'УПНиПО', 'email' => 'ssssssssss'],
            ['id' => 6, 'name_kk' => 'СҚКБ-1', 'name_ru' => 'УОС-1', 'email' => 'ssssssssss'],
            ['id' => 7, 'name_kk' => 'СҚКБ-2', 'name_ru' => 'УОС-2', 'email' => 'ssssssssss'],
            ['id' => 8, 'name_kk' => 'СҚКБ-3', 'name_ru' => 'УОС-3', 'email' => 'ssssssssss'],
            ['id' => 9, 'name_kk' => 'СҚКБ-5', 'name_ru' => 'УОС-5', 'email' => 'ssssssssss'],
            ['id' => 10, 'name_kk' => 'ТКБ', 'name_ru' => 'УТТ', 'email' => 'ssssssssss'],
            ['id' => 11, 'name_kk' => 'БЖБ', 'name_ru' => 'УБР', 'email' => 'ssssssssss'],
            ['id' => 12, 'name_kk' => 'МКЖжТКЖБ', 'name_ru' => 'УРНОиТК', 'email' => 'ssssssssss'],
            ['id' => 13, 'name_kk' => 'ХжЭБ', 'name_ru' => 'УХиЭ', 'email' => 'ssssssssss'],
            ['id' => 14, 'name_kk' => 'АжТБ', 'name_ru' => 'УАТ', 'email' => 'ssssssssss'],
            ['id' => 15, 'name_kk' => 'ӨТҚжЖБ', 'name_ru' => 'УПТОиКО', 'email' => 'ssssssssss'],
            ['id' => 16, 'name_kk' => 'ӨЭМБ', 'name_ru' => 'УУЭН', 'email' => 'ssssssssss'],
            ['id' => 17, 'name_kk' => 'КОО', 'name_ru' => 'КУЦ', 'email' => 'ssssssssss'],
        ];

        DB::table('orgs')->upsert($dataOrgs, ['id'], ['name_kk', 'name_ru', 'email']);


        $dataGroups = [
            ['id' => 1, 'user_id' => 3, 'start' => '2023-10-30 13:00:00', 'end' => '2023-10-30 15:00:00', 'subject' => 'Өрт-техникалық минимум', 'chin' => 'ИТР', 'commission' => 'Ақын М., Мухаммед Б.', 'quantity' => 30, 'passed_on' => 15, 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 2, 'user_id' => 2, 'start' => '2023-10-30 15:00:00', 'end' => '2023-10-30 17:00:00', 'subject' => 'Өнеркәсіп қауіпсіздігі', 'chin' => 'Рабочий', 'commission' => 'Ақын М., Ахмедеева Г.', 'quantity' => 20, 'passed_on' => 10, 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 3, 'user_id' => 5, 'start' => '2023-10-31 10:00:00', 'end' => '2023-10-31 12:00:00', 'subject' => 'Еңбек қауіпсіздігі және еңбекті қорғау', 'chin' => 'ИТР', 'commission' => 'Бекенова А., Жұмабаев Р.', 'quantity' => 30, 'passed_on' => 15, 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 4, 'user_id' => 4, 'start' => '2023-10-31 13:00:00', 'end' => '2023-10-31 15:00:00', 'subject' => 'Өнеркәсіп қауіпсіздігі', 'chin' => 'Рабочий', 'commission' => 'Тұлебаева Ж., Сарсенов К.', 'quantity' => 20, 'passed_on' => 10, 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01']
        ];

        DB::table('groups')->upsert($dataGroups, ['id'], ['user_id', 'start', 'end', 'subject', 'chin', 'commission', 'quantity', 'passed_on','created_at','updated_at']);


        $dataWorkers = [
            ['id' => 1, 'surname' => 'Серіков', 'name' => 'Серік', 'lastname' => 'Серікұлы', 'org_id' => 1, 'job' => 'оператор', 'crust_id' => 1],
            ['id' => 2, 'surname' => 'Беріков', 'name' => 'Берік', 'lastname' => 'Берікұлы', 'org_id' => 2, 'job' => 'машинист', 'crust_id' => 2],
            ['id' => 3, 'surname' => 'Әлімов', 'name' => 'Әлім', 'lastname' => 'Әлімович', 'org_id' => 7, 'job' => 'электрик', 'crust_id' => 3],
            ['id' => 4, 'surname' => 'Айгеримова', 'name' => 'Айгерим', 'lastname' => 'Айгеримовна', 'org_id' => 5, 'job' => 'бухгалтер', 'crust_id' => 4],
            ['id' => 5, 'surname' => 'Кеннеди', 'name' => 'Джон', 'lastname' => null, 'org_id' => 4, 'job' => 'президент', 'crust_id' => 5],

            ['id' => 6, 'surname' => 'Жусіпбеков', 'name' => 'Жусіп', 'lastname' => 'Жусіпбекович', 'org_id' => 10, 'job' => 'менеджер', 'crust_id' => 6],
            ['id' => 7, 'surname' => 'Мұратбеков', 'name' => 'Мұратбек', 'lastname' => 'Мұратбекович', 'org_id' => 15, 'job' => 'инженер', 'crust_id' => 7],
            ['id' => 8, 'surname' => 'Нұрланова', 'name' => 'Нұрлан', 'lastname' => 'Нұрланович', 'org_id' => 7, 'job' => 'врач', 'crust_id' => 8],
            ['id' => 9, 'surname' => 'Баубекбаев', 'name' => 'Баубек', 'lastname' => 'Баубекбаевич', 'org_id' => 6, 'job' => 'учитель', 'crust_id' => 9],
            ['id' => 10, 'surname' => 'Асхатқызы', 'name' => 'Асхат', 'lastname' => 'Асхатқызы', 'org_id' => 6, 'job' => 'строитель', 'crust_id' => 10],

            ['id' => 11, 'surname' => 'Ерболатов', 'name' => 'Ерболат', 'lastname' => 'Ерболатович', 'org_id' => 1, 'job' => 'механик', 'crust_id' => 11],
            ['id' => 12, 'surname' => 'Даниярбек', 'name' => 'Даниярбек', 'lastname' => 'Даниярбекович', 'org_id' => 5, 'job' => 'программист', 'crust_id' => 12],
            ['id' => 13, 'surname' => 'Қанатұлы', 'name' => 'Қанат', 'lastname' => 'Қанатұлы', 'org_id' => 11, 'job' => 'экономист', 'crust_id' => 13],
            ['id' => 14, 'surname' => 'Мұслимжан', 'name' => 'Мұслимжан', 'lastname' => 'Мұслимжанов', 'org_id' => 12, 'job' => 'юрист', 'crust_id' => 14],
            ['id' => 15, 'surname' => 'Гүлнарқызы', 'name' => 'Гүлнар', 'lastname' => 'Гүлнарқызы', 'org_id' => 14, 'job' => 'дизайнер', 'crust_id' => 15],

            ['id' => 16, 'surname' => 'Әсетұлы', 'name' => 'Әсет', 'lastname' => 'Әсетұлы', 'org_id' => 14, 'job' => 'агроном', 'crust_id' => 16],
            ['id' => 17, 'surname' => 'Нұрбекұлы', 'name' => 'Нұрбек', 'lastname' => 'Нұрбекұлы', 'org_id' => 5, 'job' => 'журналист', 'crust_id' => 17],
            ['id' => 18, 'surname' => 'Айжанқызы', 'name' => 'Айжан', 'lastname' => 'Айжанқызы', 'org_id' => 7, 'job' => 'маркетолог', 'crust_id' => 18],
            ['id' => 19, 'surname' => 'Бақдаулет', 'name' => 'Бақдаулет', 'lastname' => 'Бақдаулетұлы', 'org_id' => 9, 'job' => 'бухгалтер', 'crust_id' => 19],
        ];

        DB::table('workers')->upsert($dataWorkers, ['id'], ['surname', 'name', 'lastname', 'org_id', 'job', 'crust_id']);


        $dataExams = [
            ['id' => 1, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 2, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 3, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 4, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 5, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 6, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 7, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 8, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 9, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 10, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 11, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 12, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 13, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 14, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 15, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 16, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 17, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 18, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 19, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 20, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 21, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 22, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 23, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 24, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],
            ['id' => 25, 'group_id' => rand(1, 4), 'worker_id' => rand(1, 19), 'access_code' => rand(100000, 999999), 'pass' => rand(true, false), 'created_at' => '2024-01-01', 'updated_at' => '2024-01-01'],

        ];
        DB::table('exams')->upsert($dataExams, ['id'], ['group_id', 'worker_id', 'access_code', 'pass','created_at','updated_at']);
    }
}

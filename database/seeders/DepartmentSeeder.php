<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Institute of Business Administration',
            'Institute of Information Technology',
            'Institute of Remote Sensing and GIS',
            'Bangabandhu Institute of Comparative Literature and Culture',
            'Department of International Relations',
            'Department of English',
            'Department of History',
            'Department of Philosophy',
            'Department of Drama & Dramatics',
            'Department of Archaeology',
            'Department of Bangla',
            'Department of Journalism and Media Studies',
            'Department of Fine Art',
            'Department of Computer Science and Engineering',
            'Department of Mathematics',
            'Department of Physics',
            'Department of Environmental Sciences',
            'Department of Statistics',
            'Department of Geological Sciences',
            'Department of Chemistry',
            'Department of Economics',
            'Department of Urban & Regional Planning',
            'Department of Anthropology',
            'Department of Geography & Environment',
            'Department of Government & Politics',
            'Department of Public Administration',
            'Department of Botany',
            'Department of Biochemistry & Molecular Biology',
            'Department of Zoology',
            'Department of Pharmacy',
            'Department of Microbiology',
            'Department of Biotechnology & Genetic Engineering',
            'Department of Public Health and Informatics',
            'Department of Finance & Banking',
            'Department of Marketing',
            'Department of Accounting and Information Systems',
            'Department of Management Studies',
            'Department of Law & Justice',
        ];

        foreach ($departments as $department) {
            Department::create([
                'department' => $department
            ]);
        }
    }
}

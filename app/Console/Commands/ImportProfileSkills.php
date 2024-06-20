<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\JobSkill;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportJobSkills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:job-skills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import job skills from XLSX';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // Load the XLSX file
            $filePath = storage_path('app/public/skills.xlsx');
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Skip the header row
            array_shift($rows);

            foreach ($rows as $row) {
                // Map the row data to the corresponding columns
                $id = $row[0];
                $jobSkillName = $row[1];

                // Validate and sanitize the data as needed
                if (!is_numeric($id) || empty($jobSkillName)) {
                    $this->warn("Skipping invalid row: " . implode(', ', $row));
                    continue;
                }

                // Add to job_skills table
                JobSkill::updateOrCreate(
                    ['job_skill_id' => $id],
                    [
                        'job_skill' => $jobSkillName,
                        'is_default' => 0,
                        'is_active' => 1,
                        'sort_order' => 99999,
                        'lang' => 'en',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }

            $this->info('Job skills imported successfully!');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }

        return 0;
    }
}

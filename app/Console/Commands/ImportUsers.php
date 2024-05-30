<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\ProfileSummary;
use App\ProfileLanguage;
use App\ProfileExperience;
use League\Csv\Reader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from CSV';

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
            $csv = Reader::createFromPath(storage_path('app/public/profiles.csv'), 'r');
            $csv->setHeaderOffset(0);

            foreach ($csv as $record) {
                // Handle multiple emails
                $email = isset($record['email']) ? explode(',', $record['email'])[0] : null;
                $email = trim($email);

                // Handle multiple mobile numbers
                $mobile_num = isset($record['mobile_num']) ? explode(',', $record['mobile_num'])[0] : null;
                $mobile_num = trim($mobile_num);

                // Split first and last names
                $first_name = isset($record['first_name']) ? $record['first_name'] : null;
                $last_name = isset($record['last_name']) ? $record['last_name'] : null;
                $middle_name = null;

                if ($first_name) {
                    $first_name_parts = explode(' ', trim($first_name));
                    if (count($first_name_parts) > 1) {
                        $first_name = array_shift($first_name_parts);
                        $middle_name = implode(' ', $first_name_parts);
                    }
                }

                if ($last_name) {
                    $last_name_parts = explode(' ', trim($last_name));
                    if (count($last_name_parts) > 1) {
                        $last_name = array_pop($last_name_parts);
                        $middle_name = $middle_name ? $middle_name . ' ' . implode(' ', $last_name_parts) : implode(' ', $last_name_parts);
                    }
                }

                //Add to users table
                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'first_name' => $first_name,
                        'middle_name' => $middle_name,
                        'last_name' => $last_name,
                        'name' => trim($first_name . ' ' . $middle_name . ' ' . $last_name),
                        'original_email' => $record['original_email'] ?? null,
                        'father_name' => $record['father_name'] ?? null,
                        'date_of_birth' => !empty($record['date_of_birth']) ? Carbon::parse($record['date_of_birth']) : null,
                        'gender_id' => $record['gender'] ?? null,
                        'marital_status_id' => $record['marital_status_id'] ?? null,
                        'nationality_id' => $record['nationality_id'] ?? null,
                        'national_id_card_number' => $record['national_id_card_number'] ?? null,
                        'country_id' => $record['country_id'] ?? null,
                        'state_id' => $record['state_id'] ?? null,
                        'city_id' => $record['city_id'] ?? null,
                        'phone' => $record['phone'] ?? null,
                        'mobile_num' => $mobile_num,
                        'job_experience_id' => $record['job_experience_id'] ?? null,
                        'career_level_id' => $record['career_level_id'] ?? null,
                        'industry_id' => $record['industry_id'] ?? null,
                        'functional_area_id' => $record['functional_area_id'] ?? null,
                        'current_salary' => $record['current_salary'] ?? null,
                        'expected_salary' => $record['expected_salary'] ?? null,
                        'salary_currency' => $record['salary_currency'] ?? null,
                        'street_address' => $record['street_address'] ?? null,
                        'is_active' => $record['is_active'] ?? null,
                        'verified' => $record['verified'] ?? 0,
                        'verification_token' => $record['verification_token'] ?? null,
                        'provider' => $record['provider'] ?? null,
                        'provider_id' => $record['provider_id'] ?? null,
                        'password' => isset($record['password']) ? Hash::make($record['password']) : Hash::make('password'),
                        'remember_token' => $record['remember_token'] ?? null,
                        'image' => $record['image'] ?? null,
                        'cover_image' => $record['cover_image'] ?? null,
                        'lang' => $record['lang'] ?? null,
                        'created_at' => isset($record['created_at']) ? Carbon::parse($record['created_at']) : now(),
                        'updated_at' => isset($record['updated_at']) ? Carbon::parse($record['updated_at']) : now(),
                        'is_immediate_available' => $record['is_immediate_available'] ?? null,
                        'num_profile_views' => $record['num_profile_views'] ?? null,
                        'package_id' => $record['package_id'] ?? null,
                        'transaction' => $record['transaction'] ?? null,
                        'package_start_date' => isset($record['package_start_date']) ? Carbon::parse($record['package_start_date']) : null,
                        'package_end_date' => isset($record['package_end_date']) ? Carbon::parse($record['package_end_date']) : null,
                        'jobs_quota' => $record['jobs_quota'] ?? null,
                        'availed_jobs_quota' => $record['availed_jobs_quota'] ?? null,
                        'search' => $record['search'] ?? null,
                        'is_subscribed' => $record['is_subscribed'] ?? null,
                        'video_link' => $record['video_link'] ?? null,
                        'email_verified_at' => isset($record['email_verified_at']) ? Carbon::parse($record['email_verified_at']) : null,
                        'is_resume' => $record['is_resume'] ?? null,
                        'resume_temp' => $record['resume_temp'] ?? null
                    ]
                );

                // Add the summary to the summaries table
                if (isset($record['summary']) && !empty($record['summary'])) {
                    ProfileSummary::updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'summary' => $record['summary'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    );
                }

                // Add languages to the profile_languages table
                if (isset($record['languages']) && !empty($record['languages'])) {
                    $languages = explode(', ', $record['languages']);
                    foreach ($languages as $language) {
                        // Extract language and fluency
                        preg_match('/^(.*?) \((.*?)\) - Fluency: (\d+)$/', $language, $matches);
                        if (count($matches) === 4) {
                            $languageName = $matches[1];
                            $fluency = $matches[3];

                            // Assuming you have a method to get language_id and language_level_id by name and fluency
                            $language_id = $this->getLanguageIdByName($languageName);
                            $language_level_id = $this->getLanguageLevelIdByFluency($fluency);

                            ProfileLanguage::updateOrCreate(
                                [
                                    'user_id' => $user->id,
                                    'language_id' => $language_id,
                                ],
                                [
                                    'language_level_id' => $language_level_id,
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]
                            );
                        }

                    }
                }

                $experiences = json_decode($record['professional_experiences'], true);

                foreach ($experiences as $exp) {
                    // Remove the prefix 'Title:' and trim the title
                    $title = isset($exp['title']) ? trim(str_ireplace('Title: ', '', $exp['title'])) : null;

                    // Check if the cleaned title is an empty string and set it to null if it is
                    if ($title === '') {
                        $title = null;
                    }
                    
                    $company = !empty($exp['company']) ? $exp['company'] : null;

                    // Check and parse start date
                    if (isset($exp['start_date']) && preg_match('/^\d{4}-\d{2}$/', $exp['start_date'])) {
                        try {
                            $date_start = Carbon::createFromFormat('Y-m', $exp['start_date'])->startOfMonth()->format('Y-m-d H:i:s');
                        } catch (\Exception $e) {
                            $this->error("Failed to parse start date '{$exp['start_date']}' for user {$record['user_id']} with title '{$title}'");
                            $date_start = null; // Set to null on failure
                        }
                    }

                    // Check and parse end date
                    if (isset($exp['end_date']) && preg_match('/^\d{4}-\d{2}$/', $exp['end_date'])) {
                        try {
                            $date_end = Carbon::createFromFormat('Y-m', $exp['end_date'])->startOfMonth()->format('Y-m-d H:i:s');
                        } catch (\Exception $e) {
                            $this->error("Failed to parse end date '{$exp['end_date']}' for user {$record['user_id']} with title '{$title}'");
                            $date_end = null; // Set to null on failure
                        }
                    }

                    // Insert or update the experience
                    ProfileExperience::updateOrCreate(
                        ['user_id' => $user->id, 'title' => $title],
                        [
                            'company' => $company,
                            'country_id' => $exp['country_id'] ?? null,
                            'state_id' => $exp['state_id'] ?? null,
                            'city_id' => $exp['city_id'] ?? null,
                            'date_start' => $date_start,
                            'date_end' => $date_end,
                            'is_currently_working' => $exp['is_currently_working'] ?? null,
                            'description' => $exp['description'] ?? null,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]
                    );
                }


            }

            $this->info('Users imported successfully!');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }

    private function getLanguageIdByName($name)
    {
        // Implement your logic to get language_id by language name
        // For example, querying from a languages table
        // Assuming you have a Language model
        $language = \App\Language::where('lang', $name)->first();
        return $language ? $language->id : null;
    }
    private function getLanguageLevelIdByFluency($fluency)
    {
        // Map fluency to Beginner, Intermediate, and Expert
        switch ($fluency) {
            case 1:
            case 2:
                $levelName = 1;
                break;
            case 3:
                $levelName = 2;
                break;
            case 4:
            case 5:
                $levelName = 3;
                break;
            default:
                $levelName = null; // or throw an exception, log error, etc.
                break;
        }

        return $levelName;
    }


}
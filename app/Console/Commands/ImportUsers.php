<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\ProfileSummary;
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
        try{
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
                        'name' => $record['name'] ?? null,
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
            }
    
            $this->info('Users imported successfully!');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }   
    }
}
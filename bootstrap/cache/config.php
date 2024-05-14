<?php return array (
  'app' => 
  array (
    'name' => 'ProzTec',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:5bu5DpiYjfUMjTA4vHCWbZGE1cV52RN5heEUSq04MtE=',
    'cipher' => 'AES-256-CBC',
    'log' => 'daily',
    'log_level' => 'error',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'Jrean\\UserVerification\\UserVerificationServiceProvider',
      26 => 'App\\Providers\\RouteServiceProvider',
      27 => 'App\\Providers\\ComposerServiceProvider',
      28 => 'Collective\\Html\\HtmlServiceProvider',
      29 => 'Laracasts\\Flash\\FlashServiceProvider',
      30 => 'Intervention\\Image\\ImageServiceProvider',
      31 => 'Yajra\\DataTables\\DataTablesServiceProvider',
      32 => 'App\\Providers\\CustomConfigServiceProvider',
      33 => 'Anhskohbo\\NoCaptcha\\NoCaptchaServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Flash' => 'Laracasts\\Flash\\Flash',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'DataTables' => 'Yajra\\DataTables\\Facades\\DataTables',
      'APFrmErrHelp' => 'App\\Helpers\\AdminFormErrorHelper',
      'ImgUploader' => 'App\\Helpers\\ImageUploadingHelper',
      'APAuthHelp' => 'App\\Helpers\\AdminAuthorizationHelper',
      'MiscHelper' => 'App\\Helpers\\MiscHelper',
      'NoCaptcha' => 'Anhskohbo\\NoCaptcha\\Facades\\NoCaptcha',
      'UserVerification' => 'Jrean\\UserVerification\\Facades\\UserVerification',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'company' => 
      array (
        'driver' => 'session',
        'provider' => 'companies',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
      'companies' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Company',
      ),
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Admin',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 180,
      ),
      'companies' => 
      array (
        'provider' => 'companies',
        'table' => 'company_password_resets',
        'expire' => 180,
      ),
      'admins' => 
      array (
        'provider' => 'admins',
        'table' => 'admin_password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp\\htdocs\\prozjobs\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => NULL,
        'secret' => NULL,
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'proztec_cache',
  ),
  'captcha' => 
  array (
    'sitekey' => '6LdwvBkpAAAAADPiuu-JGwRFqG05x-tEquuwep2u',
    'secret' => '6LdwvBkpAAAAAF1jU5O9uPiFxsTX6UijpchGhMlZ',
    'options' => 
    array (
      'timeout' => 2.0,
    ),
  ),
  'cors' => 
  array (
    'paths' => 
    array (
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'jarlyc1_job_portal',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'jarlyc1_job_portal',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'jarlyc1_job_portal',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'jarlyc1_job_portal',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
    ),
    'index_column' => 'DT_Row_Index',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => '%s %s NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => '',
    ),
    'pdf_generator' => 'snappy',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
    'parameters' => 
    array (
      'dom' => 'Bfrtip',
      'order' => 
      array (
        0 => 
        array (
          0 => 0,
          1 => 'desc',
        ),
      ),
      'buttons' => 
      array (
        0 => 'create',
        1 => 'export',
        2 => 'print',
        3 => 'reset',
        4 => 'reload',
      ),
    ),
    'generator' => 
    array (
      'columns' => 'id,add your columns,created_at,updated_at',
      'buttons' => 'create,export,print,reset,reload',
      'dom' => 'Bfrtip',
    ),
  ),
  'datatables-fractal' => 
  array (
    'includes' => 'include',
    'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
  ),
  'datatables-html' => 
  array (
    'namespace' => 'LaravelDataTables',
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'temp_path' => '/tmp',
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\xampp\\htdocs\\prozjobs\\storage\\framework/cache/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\prozjobs\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\prozjobs\\storage\\app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
      ),
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 465,
    'from' => 
    array (
      'address' => 'prozjobshop@gmail.com',
      'name' => 'JOB SHOP',
    ),
    'recieve_to' => 
    array (
      'address' => 'prozjobshop@gmail.com',
      'name' => 'JOB SHOP',
    ),
    'encryption' => 'SMTP',
    'username' => 'prozjobshop@gmail.com',
    'password' => '-nky03dqIaak',
    'sendmail' => 'prozjobshop@gmail.com',
    'pretend' => NULL,
  ),
  'newsletter' => 
  array (
    'apiKey' => '9c4d867d35b8f901330217b44c60d7c0-us14',
    'defaultListName' => 'subscribers',
    'lists' => 
    array (
      'subscribers' => 
      array (
        'id' => 'e9cb898c6f',
      ),
    ),
  ),
  'paypal' => 
  array (
    'client_id' => NULL,
    'secret' => NULL,
    'settings' => 
    array (
      'mode' => 'sandbox',
      'http.ConnectionTimeOut' => 1000,
      'log.LogEnabled' => true,
      'log.FileName' => '/home/coolb8/public_html/storage/logs/paypal.log',
      'log.LogLevel' => 'ERROR',
    ),
  ),
  'payu' => 
  array (
    'default' => 'biz',
    'gateways' => 
    array (
      'money' => 
      Tzsk\Payu\Gateway\PayuMoney::__set_state(array(
         'mode' => 'test',
         'key' => 'Aj9QVKLL',
         'salt' => 'qknGnvahLO',
         'auth' => NULL,
         'base' => 'payu.in',
         'serviceProvider' => 'payu_paisa',
         'processUrls' => 
        array (
          'test' => 'https://sandboxsecure.%s/_payment',
          'live' => 'https://secure.%s/_payment',
        ),
      )),
      'biz' => 
      Tzsk\Payu\Gateway\PayuBiz::__set_state(array(
         'mode' => 'test',
         'key' => 'Aj9QVKLL',
         'salt' => 'qknGnvahLO',
         'base' => 'payu.in',
         'processUrls' => 
        array (
          'test' => 'https://test.%s/_payment',
          'live' => 'https://secure.%s/_payment',
        ),
      )),
    ),
    'verify' => 
    array (
      0 => 'pending',
    ),
  ),
  'pdf' => 
  array (
    'mode' => '',
    'format' => 'A4',
    'author' => '',
    'subject' => '',
    'keywords' => '',
    'creator' => 'Laravel Pdf',
    'display_mode' => 'fullpage',
    'tempDir' => 'C:\\xampp\\htdocs\\prozjobs\\../temp/',
    'pdf_a' => false,
    'pdf_a_auto' => false,
    'icc_profile_path' => '',
    'default_font' => 'sans-serif',
    'margin_left' => 0,
    'margin_right' => 0,
    'margin_top' => 5,
    'margin_bottom' => 5,
    'margin_header' => 0,
    'margin_footer' => 0,
    'font_path' => 'C:\\xampp\\htdocs\\prozjobs\\public/fonts/',
    'font_data' => 
    array (
      'fontawesome' => 
      array (
        'R' => 'fontawesome-webfont.ttf',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'queue_jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'repository' => 
  array (
    'pagination' => 
    array (
      'limit' => 15,
    ),
    'fractal' => 
    array (
      'params' => 
      array (
        'include' => 'include',
      ),
      'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
    ),
    'cache' => 
    array (
      'enabled' => false,
      'minutes' => 30,
      'repository' => 'cache',
      'clean' => 
      array (
        'enabled' => true,
        'on' => 
        array (
          'create' => true,
          'update' => true,
          'delete' => true,
        ),
      ),
      'params' => 
      array (
        'skipCache' => 'skipCache',
      ),
      'allowed' => 
      array (
        'only' => NULL,
        'except' => NULL,
      ),
    ),
    'criteria' => 
    array (
      'acceptedConditions' => 
      array (
        0 => '=',
        1 => 'like',
      ),
      'params' => 
      array (
        'search' => 'search',
        'searchFields' => 'searchFields',
        'filter' => 'filter',
        'orderBy' => 'orderBy',
        'sortedBy' => 'sortedBy',
        'with' => 'with',
        'searchJoin' => 'searchJoin',
      ),
    ),
    'generator' => 
    array (
      'basePath' => 'C:\\xampp\\htdocs\\prozjobs\\app',
      'rootNamespace' => 'App\\',
      'stubsOverridePath' => 'C:\\xampp\\htdocs\\prozjobs\\app',
      'paths' => 
      array (
        'models' => 'Entities',
        'repositories' => 'Repositories',
        'interfaces' => 'Repositories',
        'transformers' => 'Transformers',
        'presenters' => 'Presenters',
        'validators' => 'Validators',
        'controllers' => 'Http/Controllers',
        'provider' => 'RepositoryServiceProvider',
        'criteria' => 'Criteria',
      ),
    ),
  ),
  'segments' => 
  array (
    'education' => 
    array (
      0 => 'education',
      1 => 'school',
      2 => 'qualification',
      3 => 'qualifications',
      4 => 'high school',
      5 => 'university',
      6 => 'academic',
      7 => 'background',
      8 => 'college',
    ),
    'degree' => 
    array (
      0 => 'bachelor',
      1 => 'bachelor\'s',
      2 => 'masters',
      3 => 'master',
      4 => 'master\'s',
      5 => 'doctoral',
    ),
    'experience' => 
    array (
      0 => 'employment history',
      1 => 'employment',
      2 => 'work history',
      3 => 'work experience',
      4 => 'professional experience',
      5 => 'professional background',
      6 => 'industry experience',
      7 => 'experience',
      8 => 'career history',
    ),
    'skill' => 
    array (
      0 => 'credentials',
      1 => 'areas of experience',
      2 => 'areas of expertise',
      3 => 'areas of knowledge',
      4 => 'skills',
      5 => 'career related skills',
      6 => 'professional skills',
      7 => 'specialized skills',
      8 => 'technical skills',
      9 => 'computer skills',
      10 => 'computer knowledge',
      11 => 'technical experience',
      12 => 'proficiencies',
      13 => 'languages',
      14 => 'language competencies and skills',
      15 => 'programming languages',
    ),
    'project' => 
    array (
      0 => 'academic projects',
      1 => 'personal projects',
      2 => 'other projects',
      3 => 'professional projects',
      4 => 'projects',
    ),
    'accomplishment' => 
    array (
      0 => 'licenses',
      1 => 'presentations',
      2 => 'conference presentations',
      3 => 'conventions',
      4 => 'dissertations',
      5 => 'exhibits',
      6 => 'papers',
      7 => 'publications',
      8 => 'professional publications',
      9 => 'research grants',
      10 => 'research projects',
      11 => 'current research interests',
      12 => 'thesis',
      13 => 'theses',
      14 => 'activities and honors',
      15 => 'affiliations',
      16 => 'professional affiliations',
      17 => 'associations',
      18 => 'professional associations',
      19 => 'memberships',
      20 => 'professional memberships',
      21 => 'athletic involvement',
      22 => 'community involvement',
      23 => 'civic activities',
      24 => 'extra-Curricular activities',
      25 => 'professional activities',
      26 => 'volunteer work',
      27 => 'volunteer experience',
      28 => 'volunteering',
      29 => 'awards',
      30 => 'honors',
    ),
  ),
  'services' => 
  array (
    'facebook' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'http://localhost/login/jobseeker/facebook/callback',
    ),
    'twitter' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'http://localhost/login/jobseeker/twitter/callback',
    ),
    'google' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'http://localhost/login/jobseeker/google/callback',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp\\htdocs\\prozjobs\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'proztec_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'snappy' => 
  array (
    'pdf' => 
    array (
      'enabled' => true,
      'binary' => '"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf"',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
    'image' => 
    array (
      'enabled' => true,
      'binary' => '"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltoimage"',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'user-verification' => 
  array (
    'email' => 
    array (
      'type' => 'default',
      'view' => NULL,
    ),
    'auto-login' => false,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\prozjobs\\resources\\views',
    ),
    'compiled' => 'C:\\xampp\\htdocs\\prozjobs\\storage\\framework\\views',
  ),
  'nlp' => 
  array (
    'hosts' => 
    array (
      0 => 'http://localhost:6400/',
    ),
    'corenlp_host' => 'http://localhost:9000/',
    'opencalais_key' => NULL,
    'debug' => false,
  ),
  'stripe' => 
  array (
    'stripe_key' => 'pk_test_51N15jALPIYPdXt9hd7DduD1eofLtQKx9bYnEISZr7Nu4aAnPqOQlmMLiswMoKWsDt4e2J4YDjRKV6xynQsKrv5bE00HOpUkYyt',
    'stripe_secret' => 'sk_test_51N15jALPIYPdXt9hxbj5OS9zcI2qcK6cE7KBfdph325i2AmefNvyOBT9LwgF8XrNye2w1LK3h4R4JB2W0VkYK1zB00iOInDb6V',
  ),
  'jobseeker' => 
  array (
    'is_jobseeker_package_active' => 1,
  ),
  'company' => 
  array (
    'is_company_package_active' => 1,
  ),
  'default_lang' => 'en',
);
